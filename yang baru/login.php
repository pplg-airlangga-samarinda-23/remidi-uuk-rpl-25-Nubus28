<?php
session_start();
include 'koneksi.php';
$conn->query("INSERT INTO users (username, password, role) VALUES 
('admin', MD5('admin123'), 'admin') 
ON DUPLICATE KEY UPDATE username=username");

$conn->query("INSERT INTO users (username, password, role) VALUES 
('kader', MD5('kader123'), 'kader') 
ON DUPLICATE KEY UPDATE username=username");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role']    = $user['role'];
        
        if ($user['role'] == 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: kader/dashboard.php");
        }
        exit();
    } else {
        $error = "Username atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Posyandu</title>
</head>
<body>
<div class="login-container">
    <h2>Login Posyandu</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="submit" value="Login" />
    </form>
</div>
</body>
</html>
