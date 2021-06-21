<?php
    require_once("admin/includes/barang.php");
    require_once("admin/includes/customer.php");
    require_once("admin/includes/keranjang.php");
    require_once("admin/includes/transaksi.php");
    session_start();
    $transaksi = new transaksi();
    $customer = new customer();
    $barang = new barang();
    $rp = new barang();
    $gambar = new barang();
    $merk = new barang();
    $searchmerk = new barang();
    if (isset($_SESSION['customer'])) {
        $keranjang = new keranjang();
        $jumlah = $keranjang->jumlahBarang($_SESSION['customer']);
        if ($keranjang->totalBelanja($_SESSION['customer']) == false) {
            echo "total belanja = null";
          }else{
            $total = $keranjang->totalBelanja($_SESSION['customer']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AWG Electronics</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <link rel = "icon" href = "/AWG/admin/assets/images/logo.png" type = "image">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <!-- <li><a href="#"><i class="fa fa-user"></i> My Account</a></li> -->
                            <li>
                            <?php
                            if(isset($_SESSION['customer'])){
                            ?>
                            <a style="display:inline-block;" href="dataCustomer.php"><i class="fa fa-user"> <?php echo $_SESSION['nama'];?></i></a>
                            <a style="display:inline-block;" href="admin/includes/prosesCustomer.php?aksi=logout" onclick="return confirm('Anda Ingin Logout?')"><i class="fa fa-user"> Logout</i></a>
                            <?php
                            }else{
                                echo '<button type="button" data-toggle="modal" data-target="#exampleModalLong">
                                <i class="fa fa-user"> Login</i>
                            </button>&nbsp';?>
                            <button type="button" href="register.php" onclick="window.location.href='register.php'">
                                <i class="fa fa-user"> Register</i>
                            </button>
                            <?php }?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="./"><img src="img/logo-AWG.png"></a></h1>
                    </div>
                </div>
                <?php if (isset($_SESSION['customer'])) {
                ?>
                <div class="col-sm-6">
                    <div class="shopping-item">
                        
                        <a href="cart.php">Cart - <span class="cart-amunt"><?php echo $barang->rupiah($total['total']);?></span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php echo $jumlah['jml'];?></span></a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="shop.php">Products</a></li>
                        <?php if(isset($_SESSION['customer'])){?>
                            <li><a href="transaction.php">Transaction</a></li>
                        <?php }?>
                        <li>
                            <div class="form-inline">
                            <form action="shop.php" method="get">
                                <div class="input-group" data-widget="sidebar-search">
                                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" name="barang" aria-label="Search">
                                  <select class="selectpicker form-control" data-live-search="true" name="brand">
                                    <option value="" selected>Brands</option>
                                    <?php foreach ($searchmerk->tampilMerk() as $data ) {
                                    ?>
                                    <option value="<?php echo $data['kode_merk'];?>"><?php echo $data['merk'];?></option>
                                    <?php }?>
                                </select>
                                  <div class="input-group-append">
                                    <button type="submit" name class="btn btn-sidebar">
                                      <i class="fas fa-search fa-fw"></i>
                                    </button>
                                  </div>
                                </div>
                                <div class="input-group" data-widget="sidebar-search">
                                  <div class="input-group-append">
                                  </div>
                                </div>
                                </form>
                              </div>
                        </li>
                        <!-- <li><a href="single-product.html">Single product</a></li>
                        <li><a href="cart.html">Cart</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Others</a></li>
                        <li><a href="#">Contact</a></li> -->
                    </ul>
                </div>  
            </div>
        </div>
    </div>
    <br>
    <!-- End mainmenu area -->