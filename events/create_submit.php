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

$title      = trim($_POST['title'] ?? '');
$slugInput  = trim($_POST['slug'] ?? '');
$category   = trim($_POST['category'] ?? '');
$desc       = trim($_POST['description'] ?? '');
$eventDate  = trim($_POST['event_date'] ?? '');
$eventTime  = trim($_POST['event_time'] ?? '');
$venue      = trim($_POST['venue'] ?? '');
$seatsInfo  = trim($_POST['seats_info'] ?? '');

// Normalize the slug: lowercase, spaces/invalid characters become hyphens
$slug = strtolower(trim($slugInput));
$slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
$slug = trim($slug, '-');

if ($title === '' || $slug === '' || $category === '' || $desc === '' || $venue === '') {
    header('Location: create.php');
    exit;
}

// Make sure the slug is actually unique before inserting
$check = $pdo->prepare("SELECT id FROM events WHERE slug = :slug");
$check->execute(['slug' => $slug]);
if ($check->fetch()) {
    // a duplicate slug would break event links, so stop here rather than silently appending a number
    $_SESSION['error'] = 'An event with that URL slug already exists. Please choose a different one.';
    header('Location: create.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO events (slug, category, title, description, event_date, event_time, venue, seats_info, posted_by)
     VALUES (:slug, :category, :title, :description, :event_date, :event_time, :venue, :seats_info, :posted_by)"
);
$stmt->execute([
    'slug'        => $slug,
    'category'    => $category,
    'title'       => $title,
    'description' => $desc,
    'event_date'  => $eventDate,
    'event_time'  => $eventTime,
    'venue'       => $venue,
    'seats_info'  => $seatsInfo,
    'posted_by'   => $_SESSION['user_id'],
]);

header('Location: index.php');
exit;