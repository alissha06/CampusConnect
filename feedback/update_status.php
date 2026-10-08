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
$status  = $_POST['status'] ?? '';
$allowed = ['open', 'in_progress', 'resolved'];

if ($id <= 0 || !in_array($status, $allowed, true)) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'errors' => ['Invalid request.']]);
    exit;
}

$cur = $pdo->prepare("SELECT status FROM feedback WHERE id = :id");
$cur->execute(['id' => $id]);
$current = $cur->fetchColumn();

if ($current === false) {
    http_response_code(404);
    echo json_encode(['ok' => false, 'errors' => ['Ticket not found.']]);
    exit;
}

if ($current !== $status) {
    try {
        $pdo->beginTransaction();
        $pdo->prepare("UPDATE feedback SET status = :status WHERE id = :id")
            ->execute(['status' => $status, 'id' => $id]);
        $pdo->prepare("INSERT INTO feedback_updates (feedback_id, status, created_by) VALUES (:fid, :status, :admin)")
            ->execute(['fid' => $id, 'status' => $status, 'admin' => $_SESSION['user_id']]);
        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['ok' => false, 'errors' => ['Could not update the ticket.']]);
        exit;
    }
}

echo json_encode(['ok' => true]);