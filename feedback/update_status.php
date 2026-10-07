<?php
session_start();
require_once '../includes/db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['ok' => false, 'errors' => ['Not authorized.']]);
    exit;
}

$id     = (int)($_POST['id'] ?? 0);
$status = $_POST['status'] ?? '';
$allowed = ['open', 'in_progress', 'resolved'];

if ($id <= 0 || !in_array($status, $allowed, true)) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'errors' => ['Invalid request.']]);
    exit;
}

$stmt = $pdo->prepare("UPDATE feedback SET status = :status WHERE id = :id");
$stmt->execute(['status' => $status, 'id' => $id]);

echo json_encode(['ok' => true]);