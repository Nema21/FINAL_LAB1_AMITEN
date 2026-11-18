<?php
$comment = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'] ?? '';
}
?>
<!DOCTYPE html>
<html>
<head><title>Vulnerable Comment</title></head>
<body>
    <h2>Vulnerable Comment Page</h2>
    <form method="POST">
        <textarea name="comment" rows="4" cols="40" placeholder="Enter a comment." required></textarea><br><br>
        <button type="submit">Post Comment</button>
    </form>
    
    <?php if ($comment !== ''): ?>
        <h3>Submitted Comment:</h3>
        <div>
            <?php 
            echo $comment; 
            ?>
        </div>
    <?php endif; ?>
</body>
</html>
