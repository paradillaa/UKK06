<?php
session_start();
//cek session 
if ($_SESSION['login'] != 'admin') {
  //kembali ke halaman login
  header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body style="background-color: #5F9EA0;">
  <?php include "navbar.php"; ?>
  <br>
  <div class="container">
  <h1><b>Daftar Pengguna</b></h1>
  <br>
  <a href="v_tambah_pengguna_baru.php" class="btn btn-dark" > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
  <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
  </svg> Tambah Pengguna</a>
  <br><br>
  <table class="table table-striped table-hover">
    <tr class="table-light">
      <td><b>Id Login</b></td>
      <td><b>Nama</b></td>
      <td><b>Username</b></td>
      <td><b>Password</b></td>
      <td><b>Status</b></td>
      <td><b>Aksi</b></td>
    </tr>
    <?php
    include "../config.php";
    $sql = mysqli_query($koneksi, 'SELECT * FROM tb_login ORDER BY id_login DESC');
    foreach ($sql as $pengguna) {
    ?>
      <tr>
        <td><?= $pengguna['id_login'] ?></td>
        <td><?= $pengguna['nama_pengguna'] ?></td>
        <td><?= $pengguna['username_pengguna'] ?></td>
        <td><?= $pengguna['password_pengguna'] ?></td>
        <td><?= $pengguna['status'] ?></td>
        <td><a href="v_ubah_pengguna.php?id_login=<?= $pengguna['id_login'] ?>" class="btn btn-info">Ubah</a></td>
      </tr>
      <script src="../js/bootstrap.min.js"></script>
     <?php } ?>
  </table>
  </div>
</body>

</html>