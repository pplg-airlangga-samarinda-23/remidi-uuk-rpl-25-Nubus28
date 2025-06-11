<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
include '../koneksi.php';

$sql = "SELECT * FROM users WHERE role='kader'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin Posyandu</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 900px; margin: 20px auto; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
        a { text-decoration: none; color: #337ab7; }
        .button {
            padding: 8px 12px;
            background: #5cb85c;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Dashboard Admin</h2>
    <p>
        <a href="add_kader.php" class="button">Tambah Kader</a> | 
        <a href="../logout.php">Logout</a>
    </p>
    
    <h3>Daftar Kader Posyandu</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td>
                <a href="edit_kader.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="delete_kader.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
