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
    echo json_encode(['ok' => false, 'errors' => ['Please log in to register for events.']]);
    exit;
}

$slug = trim($_POST['slug'] ?? '');
$dept = trim($_POST['department'] ?? '');
$name  = $_SESSION['name'];
$email = $_SESSION['email'];

header('Content-Type: application/json');

$stmt = $pdo->prepare("SELECT id FROM events WHERE slug = :slug");
$stmt->execute(['slug' => $slug]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

$errors = [];
if (!$event)        $errors[] = 'Event not found.';
if ($dept === '')    $errors[] = 'Please select your department.';

if ($errors) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'errors' => $errors]);
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO event_registrations (event_id, name, email, department) VALUES (:event_id, :name, :email, :department)"
);
$stmt->execute([
    'event_id'   => $event['id'],
    'name'       => $name,
    'email'      => $email,
    'department' => $dept,
]);

echo json_encode(['ok' => true]);