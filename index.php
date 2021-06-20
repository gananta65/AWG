<?php include "header.php";?>        
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel">
                        <?php foreach ($barang->tampil() as $data) {
                            $gbr = $gambar->tampil1Gambar($data['kode_barang']);
                        ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="Gambar/<?php echo $gbr['foto'] ?>" style="height: 300px;" alt="">
                                    <div class="product-hover">
                                        <a  href="admin/includes/prosesKeranjang.php?id=<?php echo $data['kode_barang'];?>&aksi=tambah" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a  href="product.php?id=<?php echo $data['kode_barang'];?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>
                                
                                <h2><a href="single-product.html" style="display: block;
  width: 200px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;" title="<?php echo $data['nama'];?>"><?php echo $data['nama'];?></a></h2>
                                
                                <div class="product-carousel-price">
                                    <ins><?php echo $rp->rupiah($data['harga']);?></ins>
                                    <br>
                                    <ins>sisa <?php echo $data['stok'];?></ins>
                                    <br>
                                    <br>
                                    <ins style="color:black;"><?php echo $data['lokasi'];?></ins>
                                </div> 
                            </div>
                            <?php }?>                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    
    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <?php foreach ($merk->tampilMerk() as $data) {
                            ?>
                            <a href="shop.php?brand=<?php echo $data['kode_merk'];?>"><img src="Brand/<?php echo $data['foto'];?>" alt=""></a>
                            <?php }?>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->
    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2021 AWG Electronics. All Rights Reserved. <a href="index.php" target="_blank">AWG-electronics.com</a></p>
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