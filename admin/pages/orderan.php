<?php
  // require_once("../includes/inventaris.php");

  // $inventaris = new inventaris();
  // $id = $inventaris->getMaxIdInventaris();

  // session_start();

  // if(! $_SESSION['login']){
  //     header('Location: ../login.php');
  // }
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
        <th>Aksi</th>
      </tr>
      <tr>
          <td></td>
          <td></td>
          <td></td>         
          <td>
            <a href="lihat-order.php?aksi=edit" class="btn btn-primary">Lihat Orderan</a>
            <a href="#" class="btn btn-success">Kirim</a>
          </td>
      </tr>
    </table>
</div>

</body>
</html>
