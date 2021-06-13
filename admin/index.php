<?php
  session_start();

  if(!$_SESSION['login']){
      header('Location: login.php');
  }
  require_once("includes/barang.php");
  $barang = new barang();
?>
<html>
<head>
    <title>
        Admin
    </title>
    <link rel="stylesheet" href="/AWG/admin/assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <link rel = "icon" href = "/AWG/admin/assets/images/logo.php" type = "image/x-icon">
    </head>
<body>
<?php include ('pages/sidebar.php'); ?>
    <div class="sidebar">
        <h1 class="text-dashboard">
            <p class="text-main-dashboard">
                Admin
            </p>
        </h1>
        <a href="pages/daftar-barang.php" class="btn btn-outline-danger btn-block"><h1><?php foreach ($barang->tampilJumlahBarang() as $data){echo $data['total'];} ?></h1>Barang</a>
            <a href="pages/orderan.php" class="btn btn-outline-secondary btn-block"><h1>0</h1>Orderan Menunggu</a>
            <a href="pages/pengiriman.php" class="btn btn-outline-primary btn-block"><h1>0</h1>Pengiriman Berlangsung</a>
        </div>
        </div>
    </div>
</body>
</html>