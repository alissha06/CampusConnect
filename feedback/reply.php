<?php
session_start();
require_once '../includes/db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['ok' => false, 'errors' => ['Not authorized.']]);
    exit;
}

$id      = (int)($_POST['id'] ?? 0);
$message = trim($_POST['message'] ?? '');

$errors = [];
if ($id <= 0)                    $errors[] = 'Invalid ticket.';
if ($message === '')             $errors[] = 'Reply cannot be empty.';
if (mb_strlen($message) > 1000)  $errors[] = 'Reply must be under 1000 characters.';

if (!$errors) {
    $check = $pdo->prepare("SELECT id FROM feedback WHERE id = :id");
    $check->execute(['id' => $id]);
    if (!$check->fetch()) $errors[] = 'Ticket not found.';
}

if ($errors) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'errors' => $errors]);
    exit;
}

$pdo->prepare("INSERT INTO feedback_updates (feedback_id, message, created_by) VALUES (:fid, :message, :admin)")
    ->execute(['fid' => $id, 'message' => $message, 'admin' => $_SESSION['user_id']]);

echo json_encode(['ok' => true]);