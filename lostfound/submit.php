<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/upload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: post.php');
    exit;
}

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    header('Content-Type: application/json');
    echo json_encode(['ok' => false, 'errors' => ['Please log in to post an item.']]);
    exit;
}

$type     = $_POST['item_type'] ?? 'lost';
$name     = trim($_POST['item_name'] ?? '');
$category = trim($_POST['category'] ?? '');
$desc     = trim($_POST['description'] ?? '');
$location = trim($_POST['location'] ?? '');
$date     = $_POST['item_date'] ?? '';
$email    = $_SESSION['email'];

$errors = [];
if (!in_array($type, ['lost', 'found'], true)) $errors[] = 'Invalid report type.';
if ($name === '')                               $errors[] = 'Item name is required.';
if ($category === '')                           $errors[] = 'Please select a category.';
if (strlen($desc) < 10)                         $errors[] = 'Description must be at least 10 characters.';
if ($location === '')                           $errors[] = 'Location is required.';
if ($date === '')                                $errors[] = 'Date is required.';

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
    "INSERT INTO lost_found (item_name, type, category, description, location, item_date, contact, photo_path, status, posted_by)
     VALUES (:item_name, :type, :category, :description, :location, :item_date, :contact, :photo_path, 'open', :posted_by)"
);
$stmt->execute([
    'item_name'  => $name,
    'type'       => $type,
    'category'   => $category,
    'description'=> $desc,
    'location'   => $location,
    'item_date'  => $date,
    'contact'    => $email,
    'photo_path' => $photoPath,
    'posted_by'  => $_SESSION['user_id'],
]);

header('Content-Type: application/json');
echo json_encode(['ok' => true]);