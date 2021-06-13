<?php
    require_once('database.php');

    class laporan extends database{

        //Fungsi Menampilkan Data Per Bulan
        public function tampilBulan($bulan){
            $sql = "SELECT peminjaman.*, inventaris.nama, inventaris.kode_inventaris, detail_pinjam.jumlah, pegawai.nama_pegawai
                    FROM peminjaman, inventaris, detail_pinjam, pegawai
                    WHERE peminjaman.id_peminjaman = detail_pinjam.id_peminjaman
                    AND inventaris.id_inventaris = detail_pinjam.id_inventaris
                    AND pegawai.id_pegawai = peminjaman.id_pegawai
                    AND peminjaman.status_peminjaman = 'Selesai'
                    AND MONTH(tanggal_kembali) = '$bulan'";
            $query = mysqli_query($this->koneksi, $sql);
            $rows = mysqli_num_rows($query);
            if($rows >= 1){
                while($d = mysqli_fetch_assoc($query)){
                    $data[] = $d;
                }
                return $data;
            }        
        }

        //Fungsi Mendeklarasikan Variabel No
        public function tampil(){
            $sql = "SELECT peminjaman.*, inventaris.nama, inventaris.kode_inventaris, detail_pinjam.jumlah, pegawai.nama_pegawai
                    FROM peminjaman, inventaris, detail_pinjam, pegawai
                    WHERE peminjaman.id_peminjaman = detail_pinjam.id_peminjaman
                    AND inventaris.id_inventaris = detail_pinjam.id_inventaris
                    AND pegawai.id_pegawai = peminjaman.id_pegawai
                    AND peminjaman.status_peminjaman = 'Selesai'
                    ORDER BY id_peminjaman DESC";
            $query = mysqli_query($this->koneksi, $sql);
            $rows = mysqli_num_rows($query);
            if($rows >= 1){
                while($d = mysqli_fetch_assoc($query)){
                    $data[] = $d;
                }
                return $data;
            }
        }
    }
?>