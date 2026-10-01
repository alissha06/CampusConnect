<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$category = trim($_POST['category'] ?? '');
$rating   = (int)($_POST['rating'] ?? 0);
$message  = trim($_POST['message'] ?? '');

$errors = [];
if ($name === '')                               $errors[] = 'Name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';
if ($category === '')                            $errors[] = 'Please select a category.';
if ($rating < 1 || $rating > 5)                  $errors[] = 'Please choose a rating.';
if (strlen($message) < 10)                       $errors[] = 'Message must be at least 10 characters.';

header('Content-Type: application/json');

if ($errors) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'errors' => $errors]);
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO feedback (name, email, category, rating, message) VALUES (:name, :email, :category, :rating, :message)"
);
$stmt->execute([
    'name'     => $name,
    'email'    => $email,
    'category' => $category,
    'rating'   => $rating,
    'message'  => $message,
]);

echo json_encode(['ok' => true]);