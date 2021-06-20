<?php include "header.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $data = $barang->editBarang($id);
    }else{
        echo "<script>window.location.href='index.php';</script>";
    }
    
?>   
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Product</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">             
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="row">
                            <div class="col-sm-6">
                            <?php
                            if ($gambar->tampil1Gambar($id) == false) {
                                    echo "Belum ada Data!";
                            }else{
                                $gambar_utama = $gambar->tampil1Gambar($id);
                            }
                            ?>
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="Gambar/<?php echo $gambar_utama['foto']?>" alt="">
                                    </div>
                                    <div class="product-gallery">
                            <?php 
                            if ($gambar->tampil1Gambar($id) == false) {
                                    echo "Belum ada Data!";
                            }else{
                                foreach ($gambar->tampilGambar($id) as $gbr) {
                            ?>
                                        <img src="Gambar/<?php echo $gbr['foto'];?>" alt="">
                            <?php }
                            }?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name"><?php echo $data['nama'];?></h2>
                                    <div class="product-inner-price">
                                        <ins><?php echo $barang->rupiah($data['harga']);?></ins>
                                    </div>    
                                    
                                    <form action="admin/includes/prosesKeranjang.php?aksi=tambahBanyak"  method="post" class="cart">
                                        <div class="quantity">
                                            <input type="text" name="kode_barang" value="<?php echo $data['kode_barang'];?>" hidden>
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="jumlah" min="1" step="1">
                                        </div>
                                        <button class="add_to_cart_button" type="submit">Add to cart</button>
                                    </form>   
                                    
                                    
                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>
                                                <br>
                                                <p><?php echo nl2br($data['deskripsi']);?></p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                    <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Your rating</p>

                                                        <div class="rating-wrap-post">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>                   
                            </div>
                        </div>
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