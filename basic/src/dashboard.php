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
    // Correction: Encoder la sortie pour neutraliser le code HTML
    echo htmlspecialchars($_GET['msg']); // <-- Correction XSS
}
?>
<!-- =========================== -->

<p><a href="upload.php">Upload a file</a> 
| 
<form method="post" action="logout.php" style="display:inline;">
    <?php
    // Génère le jeton et le stocke en session
    $csrf_token = generate_csrf_token(); 
    ?>
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf_token) ?>">
    <button type="submit" style="background:none; border:none; color:blue; cursor:pointer; padding:0; text-decoration:underline;">
        Logout
    </button>
</form>
</p>
</body>
</html>