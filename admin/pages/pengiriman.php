<?php
  require_once("../includes/transaksi.php");
  require_once("../includes/barang.php");

  session_start();

  if(! $_SESSION['login']){
      header('Location: ../login.php');
  }
  $transaksi = new transaksi();
  $barang = new barang();
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
  <h2>Daftar Pengiriman</h2>
    <table class="table">
      <tr>
        <th>Kode Transaksi</th>
        <th>Nama Customer</th>
        <th>Total Belanja</th>
        <th>Status Transaksi</th>
      </tr>
      <?php 
            if($transaksi->tampilDikirim() == False){
                ?><td colspan='5'><center>Belum ada Transaksi!</center></td>
                <?php
                }else{
                foreach ($transaksi->tampilDikirim() as $data) {
                ?>
      <tr>
          <td><?php echo $data['kode_transaksi'];?></td>
          <td><?php echo $data['nama'];?></td>
          <td><?php echo $barang->rupiah($data['total']);?></td>  
          <td><?php echo $data['status_transaksi'];?></td>
      </tr>
      <?php }}?>
    </table>
</div>

</body>
</html>
