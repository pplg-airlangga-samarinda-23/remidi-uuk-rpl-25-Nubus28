<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
include '../koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id='$id' AND role='kader'";
if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error menghapus data: " . $conn->error;
}
?>
