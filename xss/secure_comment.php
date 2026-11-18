<?php
$comment = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'] ?? '';
}
?>
<!DOCTYPE html>
<html>
<head><title>Secure Comment</title></head>
<body>
    <h2>Secure Comment Page</h2>
    <form method="POST">
        <textarea name="comment" rows="4" cols="40" placeholder="Enter a comment (e.g., <b>Bold Text</b>)" required></textarea><br><br>
        <button type="submit">Post Comment</button>
    </form>
    
    <?php if ($comment !== ''): ?>
        <h3>Submitted Comment:</h3>
        <div>
            <?php 
            echo htmlspecialchars($comment, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); 
            ?>
        </div>
    <?php endif; ?>
</body>
</html>
