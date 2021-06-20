<?php
    session_start();
    require_once('keranjang.php');
    require_once('barang.php');
    require_once('database.php');
    $db = new database();
    $keranjang = new keranjang();
    $barang    = new barang();
    if(isset($_SESSION['customer'])){
        if(!isset($_GET['id'])){
            header('Location: ../../index.php');
        }
        $id = $_GET['id'];
        $aksi = $_GET['aksi'];
        $kode_customer= $_SESSION['customer'];
        if($aksi == "tambah"){
            $harga = $barang->cekHarga($id);
            if($keranjang->cekBarang($id,$kode_customer) == false){
                $keranjang->tambah($id,$kode_customer,'1',$harga);
            }else{
                $keranjang->tambahJumlah($id,$kode_customer);
            }
        }
    }else{
        echo "<script>alert('Anda Belum Login!');window.location.href='../../index.php';</script>";
    }