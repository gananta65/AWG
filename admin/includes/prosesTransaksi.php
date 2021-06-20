<?php
    
    session_start();

    require_once('barang.php');
    require_once('transaksi.php');
    $barang = new barang();
    $transaksi = new transaksi();
    $aksi = $_GET['aksi'];
    if($aksi == "batal"){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        $transaksi->batal($id);
    }else if($aksi == "kirim"){
        $kode_transaksi = $_POST['kode_transaksi'];
        $resi           = htmlspecialchars($_POST['resi']);
        $shipper        = htmlspecialchars($_POST['shipper']);
        $transaksi->kirim($kode_transaksi,$shipper,$resi);
    }else{
        echo "<script>alert('Anda Belum Login!');window.location.href='../index.php';</script>";
    }