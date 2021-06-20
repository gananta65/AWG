<?php
  require_once("../includes/barang.php");
  $barang = new barang();
  $merk = new barang();
  $kategori = new barang();
  $gambar = new barang();
  $kode = $_GET['id'];
  session_start();

  if(! $_SESSION['login']){
      header('Location: ../login.php');
  }
  if (!is_null($kode)) {
    $brg = $barang->editBarang($kode);
  }else{
    header('location:daftar-barang.php');
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>Daftar Barang</title>
  <?php include "../header.php";?>

</head>
<body>
<?php include "sidebar.php"; ?>
<div class="sidebar">
  <h2>Data Barang</h2>
   <!-- Pop up Tambah Barang -->
 <div class="container" aria-hidden="true">
        <div class="w-100" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Barang</h5>
            </div>
            <div class="modal-body">
                <div class="p-3 mb-2 bg-light text-dark">
                  <h1>Gambar</h1>
                  
                  <?php 
                  if ($gambar->tampilGambar($kode) == false) {
                    echo "Belum ada Data!";
                  }else{
                    foreach ($gambar->tampilGambar($kode) as $data) {
                  ?>
                  <div class="mb-2">
                  <a href="/AWG/admin/includes/prosesBarang.php?kode=<?php echo $kode;?>&id=<?php echo $data['id_foto_barang'];?>&aksi=hapusgambar" onclick="return confirm('Hapus Gambar?')">
                    <img class="rounded" src="/AWG/Gambar/<?php echo $data['foto'];?>" alt="" style="width:25%;height:25%;">
                  </a>
                  </div>
                  <?php }}?>
                  </div>
                <form action="../includes/prosesBarang.php?aksi=tambahgambar" method="POST" enctype="multipart/form-data">
                <input type="text" name="kode"  hidden value="<?php echo $kode;?>">
                <label>Tambah Foto Barang</label>
                <br>
                <input type="file" name="foto" onchange="PreviewImage();" required>
                <br>
                <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
                </div>
                <form action="../includes/prosesBarang.php?aksi=update" method="POST" enctype="multipart/form-data">
                <input type="text" name="kode_barang"  hidden value="<?php echo $kode;?>">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="<?php echo $brg['nama'];?>">
                <label>Merk</label>
                <select name="merk" id="merk" class="selectpicker form-control" data-live-search="true">
                <?php
                  foreach($merk->tampilMerk() as $data) {
                  if($data['kode_merk'] == $brg['kode_merk']){
                    $select = "selected";
                  }else{
                    $select = "";
                  }
                ?>
                <option value="<?php echo $data['kode_merk']?>" <?php echo " ".$select.""?>><?php echo $data['merk']?></option>
                <?php
                  }
                ?>
                </select>
                <label>Kategori</label>
                <select name="kategori" id="kategori" class="selectpicker form-control" data-live-search="true">
                <?php
                  foreach($kategori->tampilKategori() as $data) {
                  if($data['kode_kategori'] == $brg['kode_kategori']){
                    $select = "selected";
                  }else{
                    $select = "";
                    }
                ?>
                <option value="<?php echo $data['kode_kategori']?>" <?php echo " ".$select.""?>><?php echo $data['kategori']?></option>
                <?php
                  }
                ?>
                </select>
                <label>Harga</label>
                <input type="number" name="harga" id="harga" value="<?php echo $brg['harga'];?>">
                <label>Stok</label>
                <input type="number" name="stok" id="stok" value="<?php echo $brg['stok'];?>">
                <label>Deskripsi</label>
                <textarea name="deskripsi" id="deskrisi" rows="30"><?php echo $brg['deskripsi'];?></textarea>
                <label>Lokasi</label>
                <select name="lokasi" id="lokasi" class="selectpicker form-control" data-live-search="true" required>
                <option value="<?php echo $brg['lokasi'];?>"><?php echo $brg['lokasi'];?></option>
                  <option value="Kota Denpasar">Kota Denpasar</option>
                  <option value="Kabupaten Gianyar">Kabupaten Gianyar</option>
                  <option value="Kabupaten Buleleng">Kabupaten Buleleng</option>
                </select>
            </div>
            <div class="modal-footer">
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
