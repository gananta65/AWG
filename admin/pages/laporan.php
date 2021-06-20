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
    <title>Laporan</title>
    <?php include "../header.php";?>
</head>
<body>
<?php include "sidebar.php"; ?>
    <div class="sidebar">
    <h1>Laporan</h1>
        <form action="laporan.php" method="GET"></form>
                <label>Tanggal Awal</label>
                <input type="date" name="tglawal"></input>
                <label>Tanggal Akhir</label>
                <input type="date" name="tglakhir"></input>

                <button type="submit" class="btn btn-primary"name="submit">Cari</button>
        </form>
        <br>
        <div class="print">
        <h2>Hasil Laporan</h2>
            <table class="table" style="width:100%;">
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status Transaksi</th>
                </tr>
                <?php 
                if($transaksi->tampilAll() == False){
                ?><td colspan='6'><center>Tidak ada Transaksi!</center></td>
                    <?php
                }else{
                    $no = 1;
                    foreach ($transaksi->tampilAll() as $data) {
                    
                ?>
                <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $data['kode_transaksi'];?></td>
                    <td><?php echo $data['tgl_transaksi'];?></td>
                    <td><?php echo $data['nama'];?></td>
                    <td><?php echo $data['total'];?></td>
                    <td><?php echo $data['status_transaksi'];?></td>
                </tr>
                <?php }}?>
            </table>
        </div>
        <br>        
        <button onClick="window.print();" style="width: 20%; margin-left: 40%;">Print</button>
    </div>
</body>
</html>