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

function valid_date($d) {
    $dt = DateTime::createFromFormat('Y-m-d', $d);
    return $dt && $dt->format('Y-m-d') === $d;
}

$title    = trim($_POST['title'] ?? '');
$category = $_POST['category'] ?? '';
$start    = $_POST['start_date'] ?? '';
$end      = trim($_POST['end_date'] ?? '');
$desc     = trim($_POST['description'] ?? '');
$allowed  = ['academic', 'exam', 'holiday', 'event'];

if ($title === '' || !in_array($category, $allowed, true) || !valid_date($start)) {
    header('Location: create.php');
    exit;
}
if ($end !== '' && (!valid_date($end) || $end < $start)) {
    header('Location: create.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO academic_calendar (title, category, start_date, end_date, description, posted_by)
     VALUES (:title, :category, :start_date, :end_date, :description, :posted_by)"
);
$stmt->execute([
    'title'       => $title,
    'category'    => $category,
    'start_date'  => $start,
    'end_date'    => $end === '' ? null : $end,
    'description' => $desc === '' ? null : $desc,
    'posted_by'   => $_SESSION['user_id'],
]);

header('Location: index.php');
exit;