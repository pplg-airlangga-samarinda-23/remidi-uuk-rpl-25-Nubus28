<?php

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = md5($_POST['password']); 
    $role = 'kader';
    
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kader</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container {
            width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
        input[type="submit"] {
            padding: 10px;
            width: 100%;
            background: #5cb85c;
            color: #fff;
            border: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Tambah Kader</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="submit" value="Tambah" />
    </form>
    <p><a href="dashboard.php">Kembali ke Dashboard</a></p>
</div>
</body>
</html>
