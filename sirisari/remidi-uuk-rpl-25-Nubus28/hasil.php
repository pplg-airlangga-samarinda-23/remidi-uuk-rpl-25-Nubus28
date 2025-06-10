<?php
require 'koneksi.php';
$sql = "SELECT * FROM kader";
$rows = $koneksi->execute_query($sql)->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bayi masuk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bayi</h1>
    <h2>
          <a href="bayiedit.php">edit</a>
    </h2>
    <table border="1">
        <thead>
            <th>id</th>
            <th>NAMA</th>
            <th>UMUR </th>
            <th>KELAMAIN</th>
            <th>ALAMAT</th>
            <th>KONDISI</th>
            <th>NAMA ORTU</th>
            
        </thead>
        <tbody>
            <?php $no=0; foreach ($rows as $row) : ?>
                <tr>
                    <td><?=++$no?></td>
                    
                        <td>rayhan</td>
                        <td>2</td> 
                        <td>laki laki</td>
                        <td>gg cendana</td>
                        <td>sehat</td>
                         <td>fitri</td>
                    <td>
                    
                    </td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
    <a href="lamankades.php">Kembali</a>
</body>
</html>