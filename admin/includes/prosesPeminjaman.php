<?php
    session_start();   

    require_once('peminjaman.php');
    $peminjaman = new peminjaman();

    $aksi = $_GET['aksi'];
    
    if($aksi == "tambah"){
        $id = $_POST['id_peminjaman'];
        $kode = $_POST['kode_peminjaman'];
        $barang = $_POST['barang'];
        $jumlah = $_POST['jumlah'];

        $stok = $peminjaman->getStok($barang);

        if(empty($kode) || empty($barang) || empty($jumlah)){
            echo "<script>alert('Data Tidak Boleh Kosong');window.location.href='../pages/peminjaman.php';</script>";
            exit();
        } else if($jumlah > $stok['jumlah']){
            echo "<script>alert('Maaf Stok Barang Kurang');window.location.href='../pages/peminjaman.php';</script>";
            exit();
        } else {
            if($_SESSION['akses'] == "admin" || $_SESSION['akses'] == "operator"){
                $peminjam1 = $_POST['peminjam'];
                $peminjaman->tambahPeminjaman($id,$kode,$barang,$jumlah,$peminjam1);
            } else if($_SESSION['akses'] == "peminjam"){
                $peminjam2 = $_SESSION['id_pegawai'];
                $peminjaman->tambahPeminjaman($id,$kode,$barang,$jumlah,$peminjam2);
            }
        }
    }

?>