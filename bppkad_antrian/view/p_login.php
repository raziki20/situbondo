<?php
include 'koneksi.php';
$username = $_POST['username'];
$password = $_POST['password'];
$login    = mysqli_query($connect, "select * from user where username='$username' and password='$password'");
$result   = mysqli_num_rows($login);
if($result>0){
    $user = mysqli_fetch_array($login);
    session_start();
    $_SESSION['username'] = $user['username'];
    header("location:landingpage.php");
}else{
	echo "<script>alert('username atau password salah')</script>";
	echo "<meta http-equiv='refresh' content='1 url=index.php'>";

}
?>