<?php

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
include '../koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id='$id' AND role='kader'";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Data tidak ditemukan!");
}
$kader = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);

    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $sql_update = "UPDATE users SET username='$username', password='$password' WHERE id='$id'";
    } else {
        $sql_update = "UPDATE users SET username='$username' WHERE id='$id'";
    }
    if ($conn->query($sql_update) === TRUE) {
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
    <title>Edit Kader</title>
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
    <h2>Edit Kader</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post" action="">
        <input type="text" name="username" value="<?php echo $kader['username']; ?>" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password (kosongkan jika tidak diubah)" />
        <input type="submit" value="Update" />
    </form>
    <p><a href="dashboard.php">Kembali ke Dashboard</a></p>
</div>
</body>
</html>
