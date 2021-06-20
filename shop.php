<?php include "header.php";

?>
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
            <?php 
                if(isset($_GET['barang'])){
                    $tampil = $barang->search($_GET['barang'],$_GET['brand']);
                }else if(isset($_GET['brand'])){
                    $tampil = $barang->search('',$_GET['brand']);
                }
                if($tampil == false){
                    echo "No Data!";
                }else{
                foreach ($tampil as $data) {
                $gbr = $gambar->tampil1Gambar($data['kode_barang']);
             ?>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img style="height: 200px;" src="Gambar/<?php echo $gbr['foto'] ?>" alt="">
                        </div>
                        <h2><a href="" style="display: block;
  width: 200px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;" title="<?php echo $data['nama'];?>"><?php echo $data['nama'];?></a></h2>
                        <div class="product-carousel-price">
                            <ins><?php echo $rp->rupiah($data['harga']);?></ins>
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="admin/includes/prosesKeranjang.php?id=<?php echo $data['kode_barang'];?>&aksi=tambah">Add to cart</a>
                        </div>                       
                    </div>
                 </div>    
                 <?php }}?>         
                    </div>    
                </div>
            </div>
        </div>
    </div>
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
    </div>
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
  </body>
</html>