<?php
include 'koneksi.php';

if (@$_POST['simpan']) {

  $nama = @$_POST['nama'];
  $email = @$_POST['email'];
  $username = @$_POST['username'];
  $password = password_hash(@$_POST['username'], PASSWORD_DEFAULT);


  mysqli_query($connect, "INSERT INTO user(nama,email,username,password) VALUES ('$nama','$email','$username', '$password')");

?>

<script type="text/javascript">
  alert("Berhasil Daftar");
  window.location.href="index.php"

</script>

<?php  }
 ?>