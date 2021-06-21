<?php
  require_once("../includes/transaksi.php");
  require_once("../includes/barang.php");
  

  session_start();

  if(! $_SESSION['login']){
      header('Location: ../login.php');
  }
  $transaksi = new transaksi();
  $barang = new barang();
  $gambar = new barang();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pengiriman</title>
  <?php include "../header.php";?>
</head>
<body>
<?php include "sidebar.php"; ?>
<div class="sidebar">
  <h2>Daftar 2 Transaksi dengan Nilai Bayar Tertinggi</h2>
    <table class="table">
      <tr>
        <th>Kode Transaksi</th>
        <th>Nama Customer</th>
        <th>Total Belanja</th>
      </tr>
      <?php 
            if($transaksi->tampilBayarTertinggi() == False){
                ?><td colspan='5'><center>Belum ada Transaksi!</center></td>
                <?php
                }else{
                foreach ($transaksi->tampilBayarTertinggi() as $data) {
                ?>
      <tr>
          <td><?php echo $data['kode_transaksi'];?></td>
          <td><?php echo $data['nama'];?></td>
          <td><?php echo $barang->rupiah($data['total']);?></td>  
      </tr>
      <?php }}?>
    </table>
</div>
<div class="sidebar">
  <h2>Data Barang dengan Stok 0</h2>
    <table class="table">
      <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Merk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Lokasi</th>
      </tr>
      <?php 
            if($barang->stok0() == False){
                ?><td colspan='5'><center>Belum ada Transaksi!</center></td>
                <?php
                }else{
                foreach ($barang->stok0() as $data) {
                ?>
      <tr>
          <td><?php echo $data['kode_barang']?></td>
          <td><?php echo $data['nama']?></td>
          <td><?php echo $data['kategori']?></td>
          <td><?php echo $data['merk']?></td>
          <td><?php echo $barang->rupiah($data['harga'])?></td>
          <td><?php echo $data['stok']?></td>
          <td><?php echo $data['lokasi']?></td>
      </tr>
    <?php
    }}
    ?>
    </table>
    </div>
    <div class="sidebar">
  <h2>Data BILL</h2>
  <table class="table">
            <tr>
                <th>Transaction Code</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php 
            if($transaksi->tampilAll() == False){
                ?><td colspan='3'><center>No Transaction!</center></td>
                <?php
                }else{
                foreach ($transaksi->tampilAll() as $data) {
                ?>
            <tr>
                <td><?php echo $data['kode_transaksi'];?></td>
                <td><?php echo $data['nama'];?></td>
                <td><?php echo $barang->rupiah($data['total']);?></td>
                <td><?php echo $data['status_transaksi'];?></td>    
                <td>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#<?php echo $data['kode_transaksi'];?>">
                Kirim
                </button>
                </td>
            </tr>
            <div class="modal fade" id="<?php echo $data['kode_transaksi'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Data Belanjaan</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  <?php 
    if($transaksi->tampilDetail($data['kode_transaksi']) == False){
        ?><h1><center>Belum ada Transaksi!</center></h1>
        <?php
        }else{
        foreach ($transaksi->tampilDetail($data['kode_transaksi']) as $data) {
          if ($gambar->tampil1Gambar($data['kode_barang']) == false) {
            echo "Belum ada Data!";
          }else{
            $gbr = $gambar->tampil1Gambar($data['kode_barang']);
          }
          ?>
  <div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-3">
      <img src="/AWG/Gambar/<?php echo $gbr['foto'];?>" class="card-img h-100" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $data['nama'];?></h5>
        <p class="card-text"><?php echo $data['jumlah'];?>pc(s)</p>
        <p class="card-text"><small class="text-muted"><?php echo $barang->rupiah($data['subtotal']);?></small></p>
      </div>
    </div>
  </div>
</div>
<?php }}?>
            </div>
            </div>
        </div>
        </div>
            <?php }}?>
            </table>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
</html>
