<?php
session_start();
//cek session 
if ($_SESSION['login'] != 'petugas') {
  //kembali ke halaman login
  header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Penjualan</title>
  <link rel="stylesheet" href="v_detail_penjualan.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body style="background-color: #5F9EA0;">
  <?php include "navbar.php" ?>
  <div class="container">
  <h1><b>Penjualan</b></h1>
  <br>
  <?php
  //ambil koneksi
  include "../config.php";
  //ambil data id_pelanggan dari URL
  $id_pelanggan = $_GET['id_pelanggan'];
  //cari datanya
  $sql = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan INNER JOIN tb_penjualan ON tb_pelanggan.id_pelanggan = tb_penjualan.id_pelanggan");
  // $pelanggan = mysqli_fetch_assoc($sql);

  foreach ($sql as $pelanggan) {

    //cek data berdasarkan id_pelanggan
    if ($pelanggan['id_pelanggan'] == $id_pelanggan) {
  ?>

<div class="col-md-3 col-sm-6">
                <div class="pricingTable blue">
                    <div class="pricingTable-header">
                        <i class="fa fa-diamond"></i>
                        <div class="price-value"> <span class="month"><b>APK MART</b></span> </div>
                    </div>
                    <h3 class="heading">Transaksi</h3>
                    <div class="pricing-content">
                        <ul>
                            <li><b>ID Pelanggan :</b> <br><?= $pelanggan['id_pelanggan'] ?></li>
                            <li><b>Nama :</b> <br> <?= $pelanggan['nama_pelanggan'] ?></li>
                            <li><b>Alamat :</b> <br> <?= $pelanggan['alamat_pelanggan'] ?></li>
                            <li><b>Telepon :</b> <?= $pelanggan['telepon_pelanggan'] ?></li>
                        </ul>
                    </div>
                    <!-- <div class="pricingTable-signup">
                        <a href="#">sign up</a>
                    </div> -->
                </div>
            </div>
      <!-- <table class="table table-borderless" class="shadow p-3 mb-5 bg-body rounded"">
        <tr>
          <td><b>ID Pelanggan</b></td>
          <td>:</td>
          <td><b><?= $pelanggan['id_pelanggan'] ?></b></td>
        </tr>
        <tr>
          <td><b>Nama Pelanggan</b></td>
          <td>:</td>
          <td><b><?= $pelanggan['nama_pelanggan'] ?></b></td>
        </tr>
        <tr>
          <td><b>Alamat</b></td>
          <td>:</td>
          <td><b><?= $pelanggan['alamat_pelanggan'] ?></b></td>
        </tr>
        <tr>
          <td><b>Telepon</b></td>
          <td>:</td>
          <td><b><?= $pelanggan['telepon_pelanggan'] ?></b></td>
        </tr>
      </table> -->
      <!-- tambah barang -->
      <br>
      <form action="m_beli_barang.php" method="post">
        <input type="hidden" name="id_penjualan" id="" value="<?= $pelanggan['id_penjualan']  ?>">
        <input type="hidden" name="id_pelanggan" id="" value="<?= $pelanggan['id_pelanggan']  ?>">

        <!-- //button -->
        
        <input type="submit" value="Tambah Barang" class="btn btn-dark">
        
      </form>
      <br>
      <!-- daftar barang yang dibeli -->
      <table class="table table-dark">
        <tr>
          <td><b>Nama Barang</b></td>
          <td><b>Harga</b></td>
          <td><b>Jumlah</b></td>
          <td><b>Sub Total</b></td>
          <td><b>Stok Barang</b></td>
          <td colspan="2"><b>Aksi</b></td>
        </tr>
        <?php
        //ambil data detail barang pada tb_detail_penjualan
        $data = mysqli_query($koneksi, "SELECT * FROM tb_detail_penjualan");

        //ambil data barang pada tb_barang
        $dataBarang = mysqli_query($koneksi, "SELECT * FROM tb_barang");

        //tampilkan data detail barang
        foreach ($data as $detail) {
          if ($detail['id_penjualan'] == $pelanggan['id_penjualan']) {

            //ambil data harga barang pada tb_barang
            foreach ($dataBarang as $barang) {
              if ($barang['id_barang'] == $detail['id_barang']) {
                $harga_barang =  $barang['harga_barang'];
                $stok_barang = $barang['stok_barang'];
              }
            }
        ?>
            <tr>
              <!-- kolom pilih barang -->
              <td>
                <form action="m_update_barang_detail.php" method="post">
                  <input type="hidden" name="id_detail_penjualan" value="<?= $detail['id_detail_penjualan'] ?>">
                  <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan'] ?>">
                  <select name="id_barang" id="" onchange="this.form.submit()" class="form-control">
                    <?php
                    foreach ($dataBarang as $barang) {
                    ?> <option value="<?= $barang['id_barang'] ?>" <?php if ($barang['id_barang'] == $detail['id_barang']) echo "selected"; ?>><?= $barang['nama_barang'] ?></option>
                    <?php } ?>
                  </select>
                </form>
              </td>


              <!-- kolom jumlah barang dan sub total dan stok barang -->
              <form action="m_hitung_sub_total.php" method="post">
                <input type="hidden" name="id_detail_penjualan" value="<?= $detail['id_detail_penjualan'] ?>">
                <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan'] ?>">
                <input type="hidden" name="id_barang" value="<?= $detail['id_barang'] ?>">
                <td>
                  <input type="text" name="harga_barang" id="" value="<?= $harga_barang ?>" readonly class="form-control">
                </td>
                <td><input type="number" name="jumlah_barang" value="<?= $detail['jumlah_barang'] ?>" tabindex="1" onchange="this.form.submit()" class="form-control"></td>
                <td>
                  <input type="text" name="sub_total" id="" value="<?= $detail['sub_total'] ?>" readonly class="form-control">
                </td>
                <td>
                  <input type="text" name="stok_barang" value="<?= $stok_barang ?>" readonly class="form-control">
                </td>
              </form>

              <!-- kolom hapus -->
              <td>
              <form action="m_hapus_detail_barang.php" method="post">
                    <input type="hidden" name="jumlah_barang" value="<?= $detail['jumlah_barang'] ?>">
                    <input type="hidden" name="id_barang" value="<?= $detail['id_barang'] ?>">


                    <input type="hidden" name="id_detail_penjualan" value="<?= $detail['id_detail_penjualan'] ?>">
                    <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan'] ?>">
                    <input type="submit" value="Hapus" class="btn btn-danger">
                  </form>
              </td>
            </tr>
        <?php   }
        }
        ?>

        <!-- kolom hitung total -->
        <form action="m_hitung_total.php" method="post">
          <input type="hidden" name="id_penjualan" value="<?= $detail['id_penjualan'] ?>">
          <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan'] ?>">
          <tr>
            <?php
            //  hitung total pembelian dari tb_detail_penjualan
            $hitung = mysqli_query($koneksi, "SELECT SUM(sub_total) AS Total FROM tb_detail_penjualan WHERE id_penjualan='$pelanggan[id_penjualan]'");
            $total = mysqli_fetch_assoc($hitung);
            ?>
            <td colspan="2"></td>
            <td>Total</td>
            <td><input type="text" name="total" id="" value="<?= $total['Total'] ?>" class="form-control" readonly></td>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td>Bayar</td>
            <td><input type="number" name="bayar" id="bayar" onchange="this.form.submit()" tabindex="1" class="form-control"></td>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td>Kembali</td>
            <td><input type="number" name="kembali" id="" value="<?php if (isset($_GET['kembali'])) {
                                                                    echo    $kembali = $_GET['kembali'];
                                                                  } ?>" readonly class="form-control"></td>
            <td colspan="2"></td>
          </tr>
          <script src="../js/bootstrap.min.js"></script>
        </form>
      </table>
  <?php }
  } ?>
  </div>
</body>

</html>