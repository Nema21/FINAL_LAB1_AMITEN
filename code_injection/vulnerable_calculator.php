<?php
$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expression = $_POST['expression'] ?? '';
    try {
        eval("\$result = $expression;");
    } catch (Throwable $t) {
        $result = "Error evaluating expression.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Vulnerable Calculator</title></head>
<body>
    <h2>Vulnerable Calculator</h2>
    <form method="POST">
        Enter Math Expression: 
        <input type="text" name="expression" required>
        <button type="submit">Calculate</button>
    </form>
    <?php if ($result !== ''): ?>
        <p>Result: <?php echo htmlspecialchars((string)$result, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
</body>
</html>
