<?php
require __DIR__.'/utils.php';
start_session();

if (empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $dest = __DIR__.'/uploads/'.basename($_FILES['file']['name']);
    // No MIME checking, no size limits – deliberately insecure
    if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
        $msg = "File uploaded to $dest";
    } else {
        $msg = "Upload failed";
    }
}
?>
<!doctype html>
<html>
<head><title>Upload - Basic</title></head>
<body>
<h2>File upload (basic)</h2>
<p><?= htmlspecialchars($msg) ?></p>
<form method="post" enctype="multipart/form-data">
    Choose file: <input type="file" name="file"><br>
    <button type="submit">Upload</button>
</form>
<p><a href="dashboard.php">Back to dashboard</a></p>
</body>
</html>