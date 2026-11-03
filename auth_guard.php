<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (empty($_SESSION['role']) || !in_array($_SESSION['role'], ['student', 'faculty', 'admin'], true)) {
    header('Location: index.php?error=Please%20login%20to%20continue');
    exit;
}
if (basename($_SERVER['SCRIPT_NAME'] ?? '') === 'admin.php' && $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    exit('Access denied. Admin login is required.');
}
