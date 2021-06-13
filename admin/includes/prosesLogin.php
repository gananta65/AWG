<?php
    require_once('database.php');

    $db = new database();

    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($db->koneksi, $_POST['username']);
        $password = mysqli_real_escape_string($db->koneksi, $_POST['password']);

        if(empty($username) || empty($password)){
            echo "<script>alert('Data Tidak Boleh Kosong');window.location.href='../login.php';</script>";
            exit();
        } else{
            $db->loginadmin($username,$password);
        }
    }
?>