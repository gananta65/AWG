<?php
  require_once("../includes/transaksi.php");
  require_once("../includes/barang.php");
  $transaksi = new transaksi();
  $barang = new barang();
  $gambar = new barang();
  session_start();

  if(! $_SESSION['login']){
      header('Location: ../login.php');
  }
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }else{
    header('location:orderan.php');
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
  <h2>Data Belanjaan</h2>
  <?php 
    if($transaksi->tampilDetail($id) == False){
        ?><h1><center>Belum ada Transaksi!</center></h1>
        <?php
        }else{
        foreach ($transaksi->tampilDetail($id) as $data) {
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
        <h5 class="card-title"><?php echo $data['nama'];?></h5>
        <p class="card-text"><?php echo $data['jumlah'];?>pc(s)</p>
        <p class="card-text"><small class="text-muted"><?php echo $barang->rupiah($data['subtotal']);?></small></p>
      </div>
    </div>
  </div>
</div>
<?php }}?>
    <br>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong">
    Kirim
    </button>
    <a href="../includes/prosesTransaksi.php?id=<?php echo $data['kode_transaksi'];?>&aksi=batal" onclick="return confirm('Yakin Menolak Pesanan?')" class="btn btn-danger">Tolak</a>
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
                <form action="../includes/prosesTransaksi.php?aksi=kirim" method="POST" enctype="multipart/form-data">
                <input type="text" name="kode_transaksi" value="<?php echo $id;?>" hidden></input>
                <input type="text" name="resi" placeholder="no. resi" required></input>
                <input type="text" name="shipper" placeholder="nama shipper" required></input>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
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
