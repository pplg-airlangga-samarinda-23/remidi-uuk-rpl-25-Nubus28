<?php
// kader/edit_baby.php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'kader') {
    header("Location: ../login.php");
    exit();
}
include '../koneksi.php';

$baby_id = $_GET['id'];
$kader_id = $_SESSION['user_id'];
$sql = "SELECT * FROM babies WHERE id='$baby_id' AND kader_id='$kader_id'";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Data bayi tidak ditemukan!");
}
$baby = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $birth_date = $conn->real_escape_string($_POST['birth_date']);
    
    $sql_update = "UPDATE babies SET name='$name', birth_date='$birth_date' WHERE id='$baby_id'";
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
    <title>Edit Bayi</title>
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
    <h2>Edit Bayi</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post" action="">
        <input type="text" name="name" value="<?php echo $baby['name']; ?>" placeholder="Nama Bayi" required />
        <input type="date" name="birth_date" value="<?php echo $baby['birth_date']; ?>" placeholder="Tanggal Lahir" required />
        <input type="submit" value="Update" />
    </form>
    <p><a href="dashboard.php">Kembali ke Dashboard</a></p>
</div>
</body>
</html>
