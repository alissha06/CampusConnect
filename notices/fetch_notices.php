<?php
require_once '../includes/db.php';
header('Content-Type: application/json; charset=utf-8');

$q        = trim($_GET['q'] ?? '');
$category = $_GET['category'] ?? 'all';
$allowed  = ['academic', 'examination', 'events', 'placement', 'general'];

$sql = "SELECT id, title, description, category, posted_at FROM notices WHERE 1=1";
$params = [];

if ($q !== '') {
    $sql .= " AND (title LIKE :q1 OR description LIKE :q2)";
    $params['q1'] = '%' . $q . '%';
    $params['q2'] = '%' . $q . '%';
}
if (in_array($category, $allowed, true)) {
    $sql .= " AND category = :cat";
    $params['cat'] = $category;
}
$sql .= " ORDER BY posted_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as &$r) {
    $r['date'] = date('d M Y', strtotime($r['posted_at']));
}
echo json_encode($rows);