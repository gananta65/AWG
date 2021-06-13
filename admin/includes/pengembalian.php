<?php
    require_once('database.php');

    class pengembalian extends database{

        //Fungsi Mengambil Data Peminjaman
        public function getAllPeminjaman(){
            $sql = "SELECT peminjaman.*, detail_pinjam.jumlah, inventaris.nama, inventaris.id_inventaris FROM peminjaman, detail_pinjam, inventaris WHERE peminjaman.id_peminjaman=detail_pinjam.id_peminjaman AND inventaris.id_inventaris = detail_pinjam.id_inventaris AND peminjaman.status_peminjaman='Pinjam'";
            $query = mysqli_query($this->koneksi, $sql);
            $rows = mysqli_num_rows($query);
            if($rows >= 1) {
                while($d = mysqli_fetch_assoc($query)){
                    $data[] = $d;
                }
                return $data;
            }
        }

        //Fungsi Mengambil Data Sukses Peminjaman
        public function getAllSuccessPeminjaman(){
            $sql = "SELECT peminjaman.*, detail_pinjam.jumlah, inventaris.nama, inventaris.id_inventaris FROM peminjaman, detail_pinjam, inventaris WHERE peminjaman.id_peminjaman=detail_pinjam.id_peminjaman AND inventaris.id_inventaris=detail_pinjam.id_inventaris AND peminjaman.status_peminjaman='Selesai' ORDER BY tanggal_kembali DESC";
            $query = mysqli_query($this->koneksi, $sql);
            $rows = mysqli_num_rows($query);
            if($rows >= 1){
                while($d = mysqli_fetch_assoc($query)){
                    $data[] = $d;
                }
                return $data;
            }
        }

        //Fungsi Mengembalikan Barang
        public function pengembalianBarang($id, $jumlah, $id_inventaris){
            $sql = "UPDATE peminjaman SET tanggal_kembali=NOW(), status_peminjaman='Selesai' WHERE id_peminjaman='$id'";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                $sqlStok = "UPDATE inventaris SET jumlah=jumlah+$jumlah WHERE id_inventaris=$id_inventaris";
                $queryStok = mysqli_query($this->koneksi, $sqlStok);
                if($queryStok){
                    echo "<script>alert('Barang Berhasil Dikembalikan');window.location.href='../pages/pengembalian.php';</script>";
                    exit();
                }                
            } else {
                echo "<script>alert('Barang Gagal Dikembalikan');window.location.href='../pages/pengembalian.php';</script>";
                exit();
            }
        }
    }
    
?>