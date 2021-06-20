<?php include "header.php";?>
<br>
<div class="container" aria-hidden="true">  
            <div class="w-100" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle"><b>Register</h2>
            </div>
            <div class="modal-body">
                <form action="admin/includes/prosesCustomer.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                <br>
                <label>Email</label>
                <input type="email" class="form-control" name="email" required>
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <label>Name</label>
                <input type="text" class="form-control" name="nama" id="nama" required>
                <label>Phone</label>
                <input type="text" class="form-control" name="no_telp" required>
                <label>Gender</label>
                <select name="jenis_kelamin" class="selectpicker form-control" data-live-search="true" required>
                  <option value="">Choose</option>
                  <option value="Pria">Male</option>
                  <option value="Wanita">Female</option>
                </select>
                <label>Address</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="alamat" id="alamat" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Register</button>
                </form>
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