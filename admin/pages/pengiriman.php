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
  <h2>Daftar Pengiriman</h2>
    <table class="table">
      <tr>
        <th>No. Resi</th>
        <th>Kode Transaksi</th>
        <th>Nama Customer</th>
        <th>Total Belanja</th>
        <th>Status Pengiriman</th>
        <th>Aksi</th>
      </tr>
      <tr>
          <td></td>
          <td></td>
          <td></td>   
          <td></td> 
          <td></td>       
          <td>
            <a href="editInventaris.php?id=<?php echo $data['id_inventaris'] ;?>&aksi=edit" class="btn btn-primary">Lihat Orderan</a>
          </td>
      </tr>
    </table>
</div>

</body>
</html>
