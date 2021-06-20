<?php
  require_once("../includes/barang.php");
  $barang = new barang();
  $merk = new barang();
  $kategori = new barang();

  session_start();

  if(! $_SESSION['login']){
      header('Location: ../login.php');
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
  <button type="button" style="float:right;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
 Tambah Data Baru
</button>
    <table class="table">
      <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Merk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Terakhir Diubah</th>
        <th>Aksi</th>
      </tr>
      <?php
    foreach ($barang->tampil() as $data) {
    ?>
      <tr>
          <td><?php echo $data['kode_barang']?></td>
          <td><?php echo $data['nama']?></td>
          <td><?php echo $data['kategori']?></td>
          <td><?php echo $data['merk']?></td>
          <td><?php echo $barang->rupiah($data['harga'])?></td>
          <td><?php echo $data['stok']?></td>
          <td><?php echo $data['tgl_perubahan']?></td>
          <td>
            <a href="editBarang.php?id=<?php echo $data['kode_barang'];?>&aksi=edit" class="btn btn-edit">Edit</a>
            <a href="../includes/prosesBarang.php?id=<?php echo $data['kode_barang'];?>&aksi=hapus" onclick="return confirm('Hapus Data?')" class="btn btn-danger">Hapus</a>
          </td>
      </tr>
    <?php
    }
    ?>
    </table>
    <?php
      include "tambahBarang.php";
    ?>
</body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
</html>
