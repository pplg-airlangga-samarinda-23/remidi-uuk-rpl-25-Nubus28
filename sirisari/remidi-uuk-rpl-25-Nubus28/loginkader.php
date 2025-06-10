<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD']=== 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users1 (nama,password) VALUES (?,?)";
    $row = $koneksi->execute_query($sql,[$username,$password]);


    if ($row){
        header("location:loginkader.php");
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container"> 
        <h2>Login</h2>
        <form action="lamankades.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</body>
</html>
<?php
echo "</br>";
$username = @$_POST["username"];
$password = @$_POST["password"];
$username_bener ="Kader";
$password_bener = "kader1";
$cek = "admin";
if($password === $password_bener && $username === $username_bener){
    header("location:loginkader.php");
    echo "username dan password benar <br>";
}   
?>