<?php
    require_once('database.php');

    class foto extends database{
        public function tambahFoto($kode_barang,$foto){
            $sql = "CALL SPtambahFotoBarang($kode_barang,$foto)";
            $query = mysqli_query($this->koneksi,$sql);
            if($query){
                echo "<script>alert('Berhasil Menambahkan Data');window.location.href='../pages/daftar-barang.php';</script>";
                exit();
            } else{
                echo "<script>alert('Gagal Menambahkan Data');window.location.href='../pages/daftar-barang.php';</script>";
                exit();
            }
        }
    }
?>