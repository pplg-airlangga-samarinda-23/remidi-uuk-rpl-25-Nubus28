<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'kader') {
    header("Location: ../login.php");
    exit();
}
include '../koneksi.php';

$kader_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $birth_date = $conn->real_escape_string($_POST['birth_date']);
    
    $sql = "INSERT INTO babies (kader_id, name, birth_date) VALUES ('$kader_id', '$name', '$birth_date')";
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
    <title>Tambah Bayi</title>
    <style>
         body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
         .container {
             width: 400px;
             margin: 50px auto;
             background: #fff;
             padding: 20px;
         }
         input[type="text"], input[type="date"] {
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
    <h2>Tambah Bayi</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Nama Bayi" required />
        <input type="date" name="birth_date" placeholder="Tanggal Lahir" required />
        <input type="submit" value="Tambah" />
    </form>
    <p><a href="dashboard.php">Kembali ke Dashboard</a></p>
</div>
</body>
</html>
