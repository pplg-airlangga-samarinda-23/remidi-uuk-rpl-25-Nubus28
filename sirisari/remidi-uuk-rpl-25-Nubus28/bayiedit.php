<?php
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = $_GET['id'];
    $sql = "SELECT * FROM kader WHERE id=?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $NAMA = $_POST["NAMA"] ?? "Nama";
    $UMUR = $_POST["UMUR"] ?? "Umur";
    $KELAMIN = $_POST["KELAMIN"] ?? "Kelamin";
    $ALAMAT = $_POST["ALAMAT"] ?? "Alamat";
    $KONDISI = $_POST["KONDISI"] ?? "Kondisi";
    $NAMAORTU = $_POST["NAMAORTU"] ?? "Nama ortu";
    $id = $_POST["id"] ?? "";

    $sql = "UPDATE kader SET NAMA=?, UMUR=?, KELAMIN=?, ALAMAT=?, KONDISI=?, NAMAORTU=? WHERE id=?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sissssi", $NAMA, $UMUR, $KELAMIN, $ALAMAT, $KONDISI, $NAMAORTU, $id);

    if ($stmt->execute()) {
        header("Location: BAYI.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>BAYI MASUK</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 style="font-size:large;">BAYI</h1>
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">
    <div class="form-item">
        <label for="NAMA">NAMA</label>
        <input type="text" name="NAMA" id="NAMA" value="<?= $row['NAMA'] ?? '' ?>">
    </div>
    <div class="form-item">
        <label for="UMUR">UMUR</label>
        <input type="number" name="UMUR" id="UMUR" value="<?= $row['UMUR'] ?? '' ?>">
    </div>
    <div class="form-item">
        <label for="KELAMIN">KELAMIN</label>
        <input type="text" name="KELAMIN" id="KELAMIN" value="<?= $row['KELAMIN'] ?? '' ?>">
    </div>
    <div class="form-item">
        <label for="ALAMAT">ALAMAT</label>
        <input type="text" name="ALAMAT" id="ALAMAT" value="<?= $row['ALAMAT'] ?? '' ?>">
    </div>
    <div class="form-item">
        <label for="KONDISI">KONDISI BAYI</label>
        <input type="text" name="KONDISI" id="KONDISI" value="<?= $row['KONDISI'] ?? '' ?>">
    </div>
    <div class="form-item">
        <label for="NAMAORTU">NAMA ORTU</label>
        <input type="text" name="NAMAORTU" id="NAMAORTU" value="<?= $row['NAMAORTU'] ?? '' ?>">
    </div>
    <button type="submit">Submit</button>
</form>
<a href="lamankades.php">Kembali</a>
</body>
</html>
