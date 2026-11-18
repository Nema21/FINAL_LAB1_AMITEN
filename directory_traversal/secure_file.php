<?php
$content = '';
$error = '';
$allowed_files = [
    'doc1' => 'document1.txt',
    'doc2' => 'document2.txt',
    'doc3' => 'document3.txt'
];

$base_dir = realpath(__DIR__ . '/uploads');

if (isset($_GET['doc'])) {
    $doc_id = $_GET['doc'];

    if (array_key_exists($doc_id, $allowed_files)) {
        $target_file = $base_dir . DIRECTORY_SEPARATOR . $allowed_files[$doc_id];
        $real_path = realpath($target_file);
        if ($real_path !== false && strpos($real_path, $base_dir . DIRECTORY_SEPARATOR) === 0 && is_file($real_path)) {
            $content = file_get_contents($real_path);
        } else {
            $error = "Access denied or file does not exist.";
        }
    } else {
        $error = "Invalid document identifier selected.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Secure File Viewer</title></head>
<body>
    <h2>Secure File Viewer</h2>
    <p>Select a document: 
        <a href="?doc=doc1">Document 1</a> | 
        <a href="?doc=doc2">Document 2</a> | 
        <a href="?doc=doc3">Document 3</a>
    </p>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <?php if ($content): ?>
        <pre><?php echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8'); ?></pre>
    <?php endif; ?>
</body>
</html>
