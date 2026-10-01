<?php
require_once '../includes/db.php';
require_once '../includes/upload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: post.php');
    exit;
}

// Read and trim each field. The ?? '' means "use empty string if not sent".
$type     = $_POST['item_type'] ?? 'lost';
$name     = trim($_POST['item_name'] ?? '');
$category = trim($_POST['category'] ?? '');
$desc     = trim($_POST['description'] ?? '');
$location = trim($_POST['location'] ?? '');
$date     = $_POST['item_date'] ?? '';
$email    = trim($_POST['contact_email'] ?? '');

$errors = [];
if (!in_array($type, ['lost', 'found'], true))        $errors[] = 'Invalid report type.';
if ($name === '')                                      $errors[] = 'Item name is required.';
if ($category === '')                                  $errors[] = 'Please select a category.';
if (strlen($desc) < 10)                                $errors[] = 'Description must be at least 10 characters.';
if ($location === '')                                  $errors[] = 'Location is required.';
if ($date === '')                                       $errors[] = 'Date is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))        $errors[] = 'A valid contact email is required.';

if ($errors) {
    http_response_code(422);
    header('Content-Type: application/json');
    echo json_encode(['ok' => false, 'errors' => $errors]);
    exit;
}

try {
    $photoPath = save_uploaded_photo($_FILES['photo'], __DIR__ . '/../uploads/lostfound', 'uploads/lostfound/');
} catch (RuntimeException $e) {
    http_response_code(422);
    header('Content-Type: application/json');
    echo json_encode(['ok' => false, 'errors' => [$e->getMessage()]]);
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO lost_found (item_name, type, category, description, location, item_date, contact, photo_path, status)
     VALUES (:item_name, :type, :category, :description, :location, :item_date, :contact, :photo_path, 'open')"
);
$stmt->execute([
    'item_name'   => $name,
    'type'        => $type,
    'category'    => $category,
    'description' => $desc,
    'location'    => $location,
    'item_date'   => $date,
    'contact'     => $email,
    'photo_path'  => $photoPath,
]);

header('Content-Type: application/json');
echo json_encode(['ok' => true]);