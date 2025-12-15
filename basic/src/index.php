<?php
require __DIR__.'/utils.php';
start_session();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $USERS;
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if (isset($USERS[$user]) && password_verify($pass, $USERS[$user])) {
        // Vulnerable: we set the session ID supplied by the client!

        if (!empty($_POST['sessid'])) {
            session_id($_POST['sessid']);
        }
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