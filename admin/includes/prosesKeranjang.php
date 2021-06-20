<?php
    session_start();
    require_once('keranjang.php');
    require_once('barang.php');
    require_once('database.php');
    require_once('transaksi.php');
    require_once('customer.php');
    $customer = new customer();
    $transaksi = new transaksi();
    $db = new database();
    $keranjang = new keranjang();
    $barang    = new barang();
    if(isset($_SESSION['customer'])){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        $aksi = $_GET['aksi'];
        $kode_customer= $_SESSION['customer'];
        if($aksi == "tambah"){
            $harga = $barang->cekHarga($id);
            if($keranjang->cekBarang($id,$kode_customer) == false){
                $keranjang->tambah($id,$kode_customer,'1',$harga);
            }else{
                $keranjang->tambahJumlah($id,$kode_customer);
            }
        }else if($aksi == "tambahBanyak"){
            $id     = $_POST['kode_barang'];
            $jumlah = $_POST['jumlah'];
            $harga = $barang->cekHarga($id,$jumlah);
            if($keranjang->cekBarang($id,$kode_customer) == false){
                $keranjang->tambah($id,$kode_customer,$jumlah,$harga);
            }else{
                $keranjang->tambahJumlahB($id,$kode_customer,$jumlah);
            }
        }
        else if($aksi == "hapus"){
            $keranjang->hapus($id,$kode_customer);
        }else if($aksi == "cart"){
            if(isset($_POST['update_cart'])){
                foreach ($_POST['kode_barang'] as $key => $value) {
                    $jumlah = (int) $_POST['jumlah'][$key];
                    $kode   = $_POST['kode_barang'][$key];
                    if($jumlah == 0){
                        $keranjang->hapusArray($kode,$kode_customer);
                    }else{
                        $keranjang->updateArray($kode,$jumlah,$kode_customer);
                    }
                }
                echo "<script>alert('Berhasil Mengubah Data');window.location.href='../../cart.php';</script>";
            }else{
                $kode_transaksi = $transaksi->generateKodeTransaksi();
                $total          = $_POST['total'];
                $alamat         = $customer->getAlamat($kode_customer);
                $jenis          = "Transfer";
                $status         = "Menunggu Konfirmasi";
                $transaksi->tambah($kode_transaksi,$kode_customer,$total,$alamat,$jenis,$status);
            }
        }
    }else{
        echo "<script>alert('Anda Belum Login!');window.location.href='../../index.php';</script>";
    }