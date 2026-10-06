<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: create.php');
    exit;
}

$title    = trim($_POST['title'] ?? '');
$desc     = trim($_POST['description'] ?? '');
$category = $_POST['category'] ?? '';
$allowed  = ['academic','examination','events','placement','general'];

if ($title === '' || $desc === '' || !in_array($category, $allowed, true)) {
    header('Location: create.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO notices (title, description, category, posted_by) VALUES (:title, :description, :category, :posted_by)"
);
$stmt->execute([
    'title' => $title,
    'description' => $desc,
    'category' => $category,
    'posted_by' => $_SESSION['user_id'],
]);

header('Location: index.php');
exit;