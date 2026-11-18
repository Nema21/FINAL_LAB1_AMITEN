<?php
require_once '../config.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $sql = "SELECT id, username, password FROM users WHERE username = :username";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $message = "Secure login successful! Welcome, " . htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8');
        } else {
            $message = "Invalid username or password.";
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $message = "An error occurred during login.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Secure Login</title></head>
<body>
    <h2>Secure Login (PDO Prepared Statements)</h2>
    <form method="POST">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <p><?php echo $message; ?></p>
</body>
</html>
