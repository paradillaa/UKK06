<?php 
 
 include "../config.php";
 
 $nama_pengguna = $_POST['nama_pengguna'];
 $username_pengguna = $_POST['username_pengguna'];
 $password_pengguna = $_POST['password_pengguna'];
 $status = $_POST['status'];

 $sql = mysqli_query($koneksi, "INSERT INTO tb_login VALUES(Null, '$nama_pengguna','$username_pengguna','$password_pengguna','$status')");

 if($sql) {
    header('location: v_registrasi.php');
 }

