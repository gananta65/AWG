<?php include "header.php";
?>
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="#">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($keranjang->tampil($_SESSION['customer']) as $data) {
                                        $gbr = $gambar->tampil1Gambar($data['kode_barang']);
                                    ?>
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove" href="#">×</a> 
                                            </td>

                                            <td class="product-thumbnail">
                                                <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="Gambar/<?php echo $gbr['foto'];?>"></a>
                                            </td>

                                            <td class="product-name">
                                                <a href="single-product.html" style="display: block;
  width: 200px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;" title="<?php echo $data['nama'];?>"><?php echo $data['nama'];?></a> 
                                            </td>

                                            <td class="product-price">
                                                <span class="amount"><?php echo $barang->rupiah($data['harga']);?></span> 
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="number" size="4" class="input-text qty text" title="Qty" value="<?php echo $data['jumlah'];?>" min="0" step="1">
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount"><?php echo $barang->rupiah($data['subtotal']);?></span> 
                                            </td>
                                        <?php }?>
                                        </tr>
                                        <tr>
                                            <td class="actions" colspan="6">
                                                <input type="submit" value="Update Cart" name="update_cart" class="button">
                                                <input type="submit" value="Checkout" name="proceed" class="checkout-button button alt wc-forward">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>

                            <div class="cart-collaterals">
                            <div class="cart_totals">
                                <h2>Cart Totals</h2>

                                <table cellspacing="0">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount"><?php echo $barang->rupiah($total['total']);?></span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>Free Shipping</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount"><?php echo $barang->rupiah($total['total']);?></span></strong> </td>
                                        </tr>
                                    </tbody>
                                </table>
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
    </div> <!-- End footer bottom area -->
   
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