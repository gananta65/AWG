<?php
       session_start();

       require_once('admin.php');
       $admin = new admin();
       $aksi = $_GET['aksi'];
       if($aksi == "tambah"){ 
        $kode           = $admin->generateKodeAdmin();
        $nama           = htmlspecialchars($_POST['nama']); 
        $email          = htmlspecialchars($_POST['email']);
        $password       = htmlspecialchars($_POST['password']);
        $jk             = htmlspecialchars($_POST['jenis_kelamin']);
        $no_telp        = htmlspecialchars($_POST['no_telp']);
        $admin->tambah($kode,$email,$nama,$password,$jk,$no_telp);
       }else if($aksi == "update"){ 
              $kode           = htmlspecialchars($_POST['kode_admin']);
              $nama           = htmlspecialchars($_POST['nama']); 
              $email          = htmlspecialchars($_POST['email']);
              $password       = htmlspecialchars($_POST['password']);
              $jk             = htmlspecialchars($_POST['jenis_kelamin']);
              $no_telp        = htmlspecialchars($_POST['no_telp']);
              $admin->update($kode,$email,$nama,$password,$jk,$no_telp);
       }else if($aksi == "hapus"){
              $kode = $_GET['id'];
              $admin->hapus($kode);
       }
?>