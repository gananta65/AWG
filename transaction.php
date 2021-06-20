<?php include "header.php";
?>
<br>
<div class="container" aria-hidden="true">  
            <div class="w-100" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle"><b>Transaction Data</h2>
            </div>
            <div class="modal-body">
            <table class="table">
            <tr>
                <th>Transaction Code</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php 
            if($transaksi->tampil($_SESSION['customer']) == False){
                ?><td colspan='3'><center>No Transaction!</center></td>
                <?php
                }else{
                foreach ($transaksi->tampil($_SESSION['customer']) as $data) {
                ?>
            <tr>
                <td><?php echo $data['kode_transaksi'];?></td>
                <td><?php echo $barang->rupiah($data['total']);?></td>
                <td><?php echo $data['status_transaksi'];?></td>    
                <td>
                    <a href="lihat-order.php?aksi=edit" class="btn btn-primary">Details</a>
                </td>
            </tr>
            <?php }}?>
            </table>
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