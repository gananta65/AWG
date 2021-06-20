<?php
  require_once("../includes/admin.php");
  $admin = new admin();

  session_start();

  if(! $_SESSION['login']){
      header('Location: ../login.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Orderan</title>
  <?php include "../header.php";?>
</head>
<body>
<?php include "sidebar.php"; ?>
<div class="sidebar">
  <h2>Data Belanjaan Andra</h2>
  <div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-3">
      <img src="/AWG/smart-tv.jpg" class="card-img h-100" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Smart TV 18 Inch</h5>
        <p class="card-text">1pc(s)</p>
        <p class="card-text"><small class="text-muted">Rp 5.000.000,00</small></p>
      </div>
    </div>
  </div>
</div>
<div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-3">
      <img src="/AWG/stop-kontak-leona.jpg" class="card-img h-100" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Stop Kontak</h5>
        <p class="card-text">12pc(s)</p>
        <p class="card-text"><small class="text-muted">Rp 120.000,00</small></p>
      </div>
    </div>
  </div>
    </div>
    <br>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong">
    Kirim
    </button>
 <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Masukan nomor Resi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../includes/prosesBarang.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                <input type="text" name="resi" placeholder="no. resi"></input>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            </div>
        </div>
        </div>
</div>
</body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
</html>
