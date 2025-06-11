<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'kader') {
    header("Location: ../login.php");
    exit();
}
include '../koneksi.php';

$kader_id = $_SESSION['user_id'];
$sql = "SELECT * FROM babies WHERE kader_id='$kader_id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Kader Posyandu</title>
</head>
<body>
<div class="container">
    <h2>Dashboard Kader</h2>
    <p>
        <a href="add_baby.php" class="button">Tambah Bayi</a> |
        <a href="../logout.php">Logout</a>
    </p>
    
    <h3>Daftar Bayi</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Bayi</th>
            <th>Tanggal Lahir</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['birth_date']; ?></td>
            <td>
                <a href="edit_baby.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete_baby.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a> |
                <a href="add_growth.php?baby_id=<?php echo $row['id']; ?>">Catat Pertumbuhan</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
