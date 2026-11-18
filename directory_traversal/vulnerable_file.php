<?php
$content = '';
$error = '';

if (isset($_GET['file'])) {
    $filename = $_GET['file'];
    $filepath = "uploads/" . $filename;

    if (file_exists($filepath)) {
        $content = file_get_contents($filepath);
    } else {
        $error = "File not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Vulnerable File Viewer</title></head>
<body>
    <h2>Vulnerable File Viewer</h2>
    <p>Select a document: 
        <a href="?file=document1.txt">Document 1</a> | 
        <a href="?file=document2.txt">Document 2</a> | 
        <a href="?file=document3.txt">Document 3</a>
    </p>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <?php if ($content): ?>
        <pre><?php echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8'); ?></pre>
    <?php endif; ?>
</body>
</html>
