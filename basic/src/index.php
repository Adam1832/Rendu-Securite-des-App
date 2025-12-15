<?php
require __DIR__.'/utils.php';
start_session();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $USERS;
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if (isset($USERS[$user]) && password_verify($pass, $USERS[$user])) {
        // --- PATCH D'AUTHENTIFICATION (Session Fixation) ---
        // 1. Suppression du champ sessid (dans la partie HTML)
        // 2. Régénération de l'ID de session pour invalider l'ancien (fixé)
        session_regenerate_id(true);

        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!doctype html>
<html>
<head><title>Login - Basic</title></head>
<body>
<h2>Login (basic)</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
    Username: <input name="username"><br>
    Password: <input type="password" name="password"><br>
    <!-- Session fixation demo field -->
    Session ID (optional): <input name="sessid"><br>
    <button type="submit">Log in</button>
</form>
</body>
</html>