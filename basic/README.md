# Bugs et Faille de sécurité
1. Faille XCSS - echo $_GET['msg'];  Déja renseigné comme exemple

2. Faille CSRF - (<p><a href="upload.php">Upload a file</a> | <a href="logout.php">Logout</a></p>)


3. Faille d'Authentification 

Session ID (optional): <input name="sessid"><br>

if (!empty($_POST['sessid'])) {
    session_id($_POST['sessid']);
}
$_SESSION['user'] = $user;

