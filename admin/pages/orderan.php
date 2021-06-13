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
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="icon" href = "https://media.geeksforgeeks.org/wp-content/cdn-uploads/gfg_200X200.png" type = "image/x-icon">
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
