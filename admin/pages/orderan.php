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
  <title>Orderan</title>
  <?php include "../header.php";?>
</head>
<body>
<?php include "sidebar.php"; ?>
<div class="sidebar">
  <h2>Daftar Orderan</h2>
    <table class="table">
      <tr>
        <th>Kode Transaksi</th>
        <th>Nama Customer</th>
        <th>Total Belanja</th>
        <th>Status Transaksi</th>
        <th>Aksi</th>
      </tr>
      <?php 
            if($transaksi->tampilSemua() == False){
                ?><td colspan='5'><center>Belum ada Transaksi!</center></td>
                <?php
                }else{
                foreach ($transaksi->tampilSemua() as $data) {
                ?>
      <tr>
          <td><?php echo $data['kode_transaksi'];?></td>
          <td><?php echo $data['nama'];?></td>
          <td><?php echo $barang->rupiah($data['total']);?></td>  
          <td><?php echo $data['status_transaksi'];?></td>       
          <td>
            <a href="lihat-order.php?id=<?php echo $data['kode_transaksi'];?>&aksi=lihat" class="btn btn-primary">Lihat Orderan</a>
          </td>
      </tr>
      <?php }}?>
    </table>
</div>

</body>
</html>
