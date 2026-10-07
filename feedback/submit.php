<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    header('Content-Type: application/json');
    echo json_encode(['ok' => false, 'errors' => ['Please log in to submit feedback.']]);
    exit;
}

$name     = $_SESSION['name'];
$email    = $_SESSION['email'];
$category = trim($_POST['category'] ?? '');
$rating   = (int)($_POST['rating'] ?? 0);
$message  = trim($_POST['message'] ?? '');

$errors = [];
if ($category === '')           $errors[] = 'Please select a category.';
if ($rating < 1 || $rating > 5) $errors[] = 'Please choose a rating.';
if (strlen($message) < 10)      $errors[] = 'Message must be at least 10 characters.';

header('Content-Type: application/json');

if ($errors) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'errors' => $errors]);
    exit;
}
$ticketNumber = 'FB-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(2)));
$stmt = $pdo->prepare(
    "INSERT INTO feedback (ticket_number,user_id, name, email, category, rating, message) VALUES (:user_id, :name, :email, :category, :rating, :message)"
);
$stmt->execute([
    'ticket'   =>$ticketNumber,
    'user_id'  => $_SESSION['user_id'],
    'name'     => $name,
    'email'    => $email,
    'category' => $category,
    'rating'   => $rating,
    'message'  => $message,
]);

echo json_encode(['ok' => true]);