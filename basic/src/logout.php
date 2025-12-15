<?php
require __DIR__.'/utils.php';
start_session();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request");
}

if (!verify_csrf_token($_POST['csrf'] ?? '')) {
    die("CSRF token invalid");
}

session_destroy();
header('Location: index.php');
exit;
