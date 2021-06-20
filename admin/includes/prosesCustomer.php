<?php
       session_start();

       require_once('customer.php');
       require_once('database.php');
       $customer = new customer();
       $aksi = $_GET['aksi'];
       if($aksi == "tambah"){ 
        $kode           = $customer->generateKodeCustomer();
        $nama           = htmlspecialchars($_POST['nama']); 
        $email          = htmlspecialchars($_POST['email']);
        $password       = htmlspecialchars($_POST['password']);
        $jk             = htmlspecialchars($_POST['jenis_kelamin']);
        $alamat         = htmlspecialchars($_POST['alamat']);
        $no_telp        = htmlspecialchars($_POST['no_telp']);
        $customer->tambah($kode,$email,$nama,$password,$jk,$no_telp,$alamat);
       }else if($aksi == "update"){ 
              $kode           = htmlspecialchars($_POST['kode_customer']);
              $nama           = htmlspecialchars($_POST['nama']); 
              $email          = htmlspecialchars($_POST['email']);
              $password       = htmlspecialchars($_POST['password']);
              $jk             = htmlspecialchars($_POST['jenis_kelamin']);
              $alamat         = htmlspecialchars($_POST['alamat']);
              $no_telp        = htmlspecialchars($_POST['no_telp']);
            
            if($password == null){
                $customer->updateNoPass($kode,$email,$nama,$jk,$no_telp,$alamat);
            }else{
                $customer->update($kode,$email,$nama,$password,$jk,$no_telp,$alamat);
            }
       }else if($aksi == "login"){
        if(isset($_POST['login'])){
            $username = ($_POST['username']);
            $password = ($_POST['password']);
    
            if(empty($username) || empty($password)){
                echo "<script>alert('Data Tidak Boleh Kosong');window.location.href='../../index.php';</script>";
                exit();
            } else{
                $customer->login($username,$password);
            }
        }
       }
       else if($aksi == "logout"){
        $customer->logout();
       }
?>