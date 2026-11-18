<?php
require_once '../config.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    
    try {
        $stmt = $pdo->query($sql);
        $user = $stmt->fetch();

        if ($user) {
            $message = "Login successful! Welcome, " . $user['username'];
        } else {
            $message = "Invalid username or password.";
        }
    } catch (PDOException $e) {
        $message = "An error occurred during login.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Vulnerable Login</title></head>
<body>
    <h2>Vulnerable Login</h2>
    <form method="POST">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <p><?php echo $message; ?></p>
</body>
</html>
