<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$dept     = trim($_POST['department'] ?? '');
$password = $_POST['password'] ?? '';
$confirm  = $_POST['confirm_password'] ?? '';

function fail($msg) {
    $_SESSION['error'] = $msg;
    header('Location: register.php');
    exit;
}

if ($name === '')                              fail('Name is required.');
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) fail('Enter a valid email address.');
if ($dept === '')                               fail('Please select your department.');
if (strlen($password) < 8)                     fail('Password must be at least 8 characters.');
if ($password !== $confirm)                    fail('Passwords do not match.');

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
if ($stmt->fetch()) fail('This email is already registered.');

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare(
    "INSERT INTO users (name, email, department, password_hash, role) VALUES (:name, :email, :department, :hash, 'student')"
);
$stmt->execute(['name' => $name, 'email' => $email, 'department' => $dept, 'hash' => $hash]);

header('Location: login.php');
exit;