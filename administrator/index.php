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
  <title>Administator</title>
</head>

<body style="background-color: #5F9EA0;">
  <?php include "navbar.php"; ?>
  <br>
  <div class="container">
  <h1 style="text-align: center;"><b>Dashboard</b></h1>
  <br>
  <!-- ID : <?= $_SESSION['id_login']; ?> <br> Pengguna : <?= $_SESSION['nama_pengguna']; ?> -->
  <?php
  //ambil koneksi
  include "../config.php";

  //hitung jumlah barang dari tb_barang
  $barang = mysqli_query($koneksi, "SELECT COUNT(*) as Jumlah FROM tb_barang");
  $jumlahBarang = mysqli_fetch_assoc($barang);

  //hitung jumlah pembelian dari tb_penjualan
  $penjualan = mysqli_query($koneksi, "SELECT COUNT(*) as Jumlah FROM tb_penjualan");
  $jumlahPenjualan = mysqli_fetch_assoc($penjualan);

  //hitung jumlah pengguna dari tb_pelanggan
  $pelanggan = mysqli_query($koneksi, "SELECT COUNT(*) as Jumlah FROM tb_pelanggan");
  $jumlahPelanggan = mysqli_fetch_assoc($pelanggan);
  ?>

<div class="row">
      <div class="col">
        <div class="card" style="width: 10rem;">
          <img src="../img/barang.png" class="card-img-top" alt="..." height="100px" width="300px">
          <div class="card-body">
            <p class="card-text">
              <button type="button" class="btn btn-primary">
                Barang <span class="badge text-bg-secondary"> <?= $jumlahBarang['Jumlah']; ?></span>
              </button>
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card" style="width: 10rem;">
          <img src="../img/pembeli.jpg" class="card-img-top" alt="..." height="100px">
          <div class="card-body">
            <p class="card-text">
              <button type="button" class="btn btn-primary">
                Pembeli <span class="badge text-bg-secondary"> <?= $jumlahPenjualan['Jumlah']; ?></span>
              </button>
            </p>
          </div>
        </div>

      </div>
      <div class="col">
        <div class="card" style="width: 10rem;">
          <img src="../img/pelanggan.png" class="card-img-top" alt="..." height="100px">
          <div class="card-body">
            <p class="card-text">
              <button type="button" class="btn btn-primary">
                Pelanggan <span class="badge text-bg-secondary"> <?= $jumlahPelanggan['Jumlah']; ?></span>
              </button>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        ID : <?= $_SESSION['id_login']; ?>
      </div>
      <div class="card-body">
        <blockquote class="blockquote mb-0">
          <p>Pengguna</p>
          <footer class="blockquote-footer"><?= $_SESSION['nama_pengguna']; ?></footer>
        </blockquote>
      </div>
    </div>
  <!-- <table border="1">
    <tr>
      <td>Data Barang</td>
      <td>Data Pembelian</td>
      <td>Data Pelanggan</td>
    </tr>
    <tr>
      <td><?= $jumlahBarang['Jumlah']; ?></td>
      <td><?= $jumlahPenjualan['Jumlah']; ?></td>
      <td><?= $jumlahPelanggan['Jumlah']; ?></td>
    </tr>
  </table> -->
  </div>
</body>

</html>