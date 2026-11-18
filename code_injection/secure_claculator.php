<?php
$result = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = $_POST['num1'] ?? '';
    $num2 = $_POST['num2'] ?? '';
    $operation = $_POST['operation'] ?? '';
    if (!is_numeric($num1) || !is_numeric($num2)) {
        $error = "Please enter valid numerical values.";
    } else {
        $num1 = (float)$num1;
        $num2 = (float)$num2;

        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                break;
            case 'subtract':
                $result = $num1 - $num2;
                break;
            case 'multiply':
                $result = $num1 * $num2;
                break;
            case 'divide':
                if ($num2 == 0) {
                    $error = "Division by zero is not allowed.";
                } else {
                    $result = $num1 / $num2;
                }
                break;
            default:
                $error = "Invalid operation selected.";
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Secure Calculator</title></head>
<body>
    <h2>Secure Calculator</h2>
    <form method="POST">
        Number 1: <input type="text" name="num1" required><br><br>
        Operation: 
        <select name="operation">
            <option value="add">Addition (+)</option>
            <option value="subtract">Subtraction (-)</option>
            <option value="multiply">Multiplication (*)</option>
            <option value="divide">Division (/)</option>
        </select><br><br>
        Number 2: <input type="text" name="num2" required><br><br>
        <button type="submit">Calculate</button>
    </form>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php elseif ($result !== ''): ?>
        <p>Result: <?php echo htmlspecialchars((string)$result, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
</body>
</html>
