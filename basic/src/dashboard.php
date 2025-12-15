<?php
require __DIR__.'/utils.php';
start_session();

if (empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html>
<head><title>Dashboard – Basic</title></head>
<body>
<h2>Welcome, <?= htmlspecialchars($_SESSION['user']) ?></h2>

<!-- ==== XSS REFLECTED DEMO ==== -->
<?php
// NOTE : on n'échappe PAS la valeur ici exprès pour la démonstration.
// Dans une vraie appli, on ferait toujours htmlspecialchars().
if (isset($_GET['msg'])) {
    echo $_GET['msg'];   // <-- reflet non filtré
}
?>
<!-- =========================== -->

<p><a href="upload.php">Upload a file</a> | <a href="logout.php">Logout</a></p>
</body>
</html>