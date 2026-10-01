<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$slug = trim($_POST['slug'] ?? '');
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$dept = trim($_POST['department'] ?? '');

header('Content-Type: application/json');

$stmt = $pdo->prepare("SELECT id FROM events WHERE slug = :slug");
$stmt->execute(['slug' => $slug]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

$errors = [];
if (!$event)                                     $errors[] = 'Event not found.';
if ($name === '')                                 $errors[] = 'Name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))  $errors[] = 'A valid email is required.';
if ($dept === '')                                 $errors[] = 'Please select your department.';

if ($errors) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'errors' => $errors]);
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO event_registrations (event_id, name, email, department) VALUES (:event_id, :name, :email, :department)"
);
$stmt->execute([
    'event_id'   => $event['id'],
    'name'       => $name,
    'email'      => $email,
    'department' => $dept,
]);

echo json_encode(['ok' => true]);