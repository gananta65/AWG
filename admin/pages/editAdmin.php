<?php
  require_once("../includes/admin.php");
  $admin = new admin();
  $kode = $_GET['id'];
  session_start();

  if(! $_SESSION['login']){
      header('Location: ../login.php');
  }
  if (!is_null($kode)) {
    $data = $admin->searchById($kode);
  }else{
    header('location:daftar-admin.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
  <link rel = "icon" href = "https://media.geeksforgeeks.org/wp-content/cdn-uploads/gfg_200X200.png" type = "image/x-icon">
  </head>
<body>
<?php include "sidebar.php"; ?>
<div class="sidebar">
<div class="container" aria-hidden="true">
            <div class="w-100" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../includes/prosesAdmin.php?aksi=update" method="POST" enctype="multipart/form-data">
                <br>
                <input type="text" hidden value="<?php echo $kode;?>" name="kode_admin">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $data['email'];?>" required>
                <label>Password</label>
                <input type="password" name="password" value="<?php echo $data['password'];?>" id="password" required>
                <label>Nama</label>
                <input type="text" name="nama" value="<?php echo $data['nama'];?>" id="nama" required>
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="selectpicker form-control" data-live-search="true" required>
                  <?php if($data['jenis_kelamin'] == 'Pria'){
                        echo "<option value='Pria' selected>Pria</option><option value='Wanita'>Wanita</option>";
                  }else{
                        echo "<option value='Wanita' selected>Pria</option><option value='Pria'>Wanita</option>";
                  }?>
                </select>
                <label>Nomor Telepon</label>
                <input type="text" name="no_telp" value="<?php echo $data['no_telp'];?>" required>
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
