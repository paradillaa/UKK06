<?php 
 
 include "../config.php";
 
 $id_login = $_POST['id_login'];
 $nama_pengguna = $_POST['nama_pengguna'];
 $username_pengguna = $_POST['username_pengguna'];
 $password_pengguna = $_POST['password_pengguna'];
 $status = $_POST['status'];

 $sql = mysqli_query($koneksi, "UPDATE tb_login SET id_login='$id_login',nama_pengguna='$nama_pengguna',username_pengguna='$username_pengguna',password_pengguna='$password_pengguna',status='$status' WHERE id_login='$id_login'");

 if($sql) {
    header('location: v_registrasi.php');
 }

