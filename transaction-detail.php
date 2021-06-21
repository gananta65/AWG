<?php include "header.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        $id = null;
    }
    
?>
<br>
<div class="container" aria-hidden="true">  
            <div class="w-100" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle"><b>Transaction Data</h2>
            </div>
            <div class="modal-body">
            <h2>Data Belanjaan</h2>
  <?php 
    if($transaksi->tampilDetailCust($id,$_SESSION['customer']) == False){
        ?><h1><center>Belum ada Transaksi!</center></h1>
        <?php
        }else{
        foreach ($transaksi->tampilDetailCust($id,$_SESSION['customer']) as $data) {
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
        <h5 class="card-title"> <?php echo $data['nama'];?></h5>
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
</div>
<br>
<div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2021 AWG Electronics. All Rights Reserved. <a href="index.html" target="_blank">AWG-electronics.com</a></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->
    <?php include 'login-customer.php';?>
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="js/main.js"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="js/bxslider.min.js"></script>
	<script type="text/javascript" src="js/script.slider.js"></script>
  </body>
</html>