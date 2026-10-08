<?php
session_start();
require_once '../includes/db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'errors' => ['Please log in first.']]);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'errors' => ['Invalid request.']]);
    exit;
}

$items  = require '../includes/checklist_items.php';
$key    = $_POST['item'] ?? '';
$action = $_POST['action'] ?? '';

if (!isset($items[$key]) || !in_array($action, ['complete', 'undo'], true)) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'errors' => ['Invalid item.']]);
    exit;
}

if ($action === 'complete') {
    $stmt = $pdo->prepare("INSERT IGNORE INTO checklist_progress (user_id, item_key) VALUES (:uid, :k)");
} else {
    $stmt = $pdo->prepare("DELETE FROM checklist_progress WHERE user_id = :uid AND item_key = :k");
}
$stmt->execute(['uid' => $_SESSION['user_id'], 'k' => $key]);

echo json_encode(['ok' => true]);