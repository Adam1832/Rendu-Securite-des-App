<?php

function start_session() {
    session_start();

    if (!isset($_SESSION['initialized'])) {
        session_regenerate_id(true);
        $_SESSION['initialized'] = true;
    }
}

function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

$USERS = [
    'alice' => password_hash('alice123', PASSWORD_DEFAULT),
    'bob'   => password_hash('bob456', PASSWORD_DEFAULT),
];
