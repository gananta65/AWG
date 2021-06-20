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
  <title>Daftar Admin</title>
  <?php include "../header.php";?>
  </head>
<body>
<?php include "sidebar.php"; ?>
<div class="sidebar">
  <h2>Data Admin</h2>
  <button type="button" style="float:right;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
 Tambah Data Baru
</button>
    <table class="table">
      <tr>
        <th>Email</th>
        <th>Nama</th>
        <th>Aksi</th>
      </tr>
      <?php
    foreach ($admin->tampil() as $data) {
    ?>
      <tr>
          <td><?php echo $data['email']?></td>
          <td><?php echo $data['nama']?></td>
          <td>
            <a href="editAdmin.php?id=<?php echo $data['kode_admin'] ;?>&aksi=edit" class="btn btn-edit">Edit</a>
          </td>
      </tr>
    <?php
    }
    ?>
    </table>
     <!-- Pop up Tambah Barang -->
 <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../includes/prosesAdmin.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                <br>
                <label>Email</label>
                <input type="text" name="email" required>
                <label>Password</label>
                <input type="password" name="password" id="password" required>
                <label>Nama</label>
                <input type="text" name="nama" id="nama" required>
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="selectpicker form-control" data-live-search="true" required>
                  <option value="">Pilih</option>
                  <option value="Pria">Pria</option>
                  <option value="Wanita">Wanita</option>
                </select>
                <label>Nomor Telepon</label>
                <input type="text" name="no_telp" required>
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
