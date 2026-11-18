<?php
require_once '../config.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $message = "Username and password are required.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute([
                ':username' => $username,
                ':password' => $hashed_password
            ]);
            $message = "Registration successful! Password stored securely as a hash.";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $message = "Username already exists.";
            } else {
                error_log($e->getMessage());
                $message = "Registration failed. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Secure Registration</title></head>
<body>
    <h2>User Registration</h2>
    <form method="POST">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Register</button>
    </form>
    <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
    <p><a href="login.php">Go to Login</a></p>
</body>
</html>
