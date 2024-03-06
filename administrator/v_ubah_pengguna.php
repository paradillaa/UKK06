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
    <title>Ubah Pengguna</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body style="background-color: #5F9EA0;">
    <?php include "navbar.php"; ?>
    <br>
    <div class="container">
    <h1>Ubah Pengguna</h1>
    <br>
    <div class="container m-3">
    <?php 
    include "../config.php";

    $id_login = $_GET['id_login'];
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_login WHERE id_login='$id_login'");
    $pengguna = mysqli_fetch_assoc($sql);
    ?>
    <form action="m_ubah_pengguna.php" method="post">
        <input type="hidden" name="id_login" id="" value="<?= $pengguna['id_login'] ?>">
        <table>
        <tr>
                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                </svg> <b>Nama</b></td>
                <td>:</td>
                <td><input type="text" name="nama_pengguna" id="" value="<?= $pengguna['nama_pengguna'] ?>" class="form-control"></td>
            </tr>
            <tr>
                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg>  <b>Username</b></td>
                <td>:</td>
                <td><input type="text" name="username_pengguna" id="" value="<?= $pengguna['username_pengguna'] ?>" class="form-control"></td>
            </tr>
            <tr>
                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pass" viewBox="0 0 16 16">
                <path d="M5.5 5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                <path d="M8 2a2 2 0 0 0 2-2h2.5A1.5 1.5 0 0 1 14 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-13A1.5 1.5 0 0 1 3.5 0H6a2 2 0 0 0 2 2m0 1a3 3 0 0 1-2.83-2H3.5a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5h-1.67A3 3 0 0 1 8 3"/>
                </svg> <b>Password</b></td>
                <td>:</td>
                <td><input type="text" name="password_pengguna" id="" value="<?= $pengguna['password_pengguna'] ?>" class="form-control"></td>
            </tr>
            <tr>
                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
                </svg> <b>Status</b></td>
                <td>:</td>
                <td>
                    <select name="status" id="" class="form-select form-select-lg mb-3">
                        <?php 
                         if ($pengguna['status'] == "Administrator"){
                            echo "<option value='Administrator' selected>Administrator</option>";
                         }else{
                            echo "<option value='Administrator'>Administrator</option>";
                         }

                         if ($pengguna['status'] == "Petugas"){
                            echo "<option value='Petugas' selected>Petugas</option>";
                         }else{
                            echo "<option value='Petugas'>Petugas</option>";
                         }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Simpan" class="btn btn-secondary"></td>
            </tr>
            <script src="../js/bootstrap.min.js"></script>
        </table>
    </form>
    </div>
    </div>
</body>
</html>