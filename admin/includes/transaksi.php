<?php
    require_once('database.php');

    class transaksi extends database{
        public function generateKodeTransaksi(){
            $sql = "SELECT max(kode_transaksi) as kodeTerbesar FROM tb_transaksi";
            $query = mysqli_query($this->koneksi, $sql);
            $data = mysqli_fetch_array($query);
            $kodeBarang = $data['kodeTerbesar'];
            $urutan = (int) substr($kodeBarang, 3, 3);
            // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
            $urutan++;
            // membentuk kode barang baru
            // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
            // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
            // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
            $huruf = "TRX";
            $kodeBarang = $huruf . sprintf("%03s", $urutan);
            return $kodeBarang;
        }
        public function tampilJumlahTransaksiMenunggu(){
            $sql = "Select COUNT(*) as total from tb_transaksi where status_transaksi = 'Menunggu Konfirmasi'";
            $query = mysqli_query($this->koneksi, $sql);
            while($d = mysqli_fetch_assoc($query)){
                $data[] = $d;
            }
            return $data;
        }
        public function tampilJumlahTransaksiDikirim(){
            $sql = "Select COUNT(*) as total from tb_transaksi where status_transaksi = 'Dikirim'";
            $query = mysqli_query($this->koneksi, $sql);
            while($d = mysqli_fetch_assoc($query)){
                $data[] = $d;
            }
            return $data;
        }
        public function tambah($kode_transaksi,$kode_customer,$total,$alamat,$jenis_transaksi,$status_transaksi){
            $sql = "CALL SPtambahTransaksi('$kode_transaksi','$kode_customer','$total','$alamat','$jenis_transaksi','$status_transaksi')";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                $this->transfer($kode_customer,$kode_transaksi);
            } else{
                echo "<script>alert('Gagal Menambah Transaksi');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode_customer;
                exit();
            }
        }
        public function transfer($kode_customer,$kode_transaksi){
            $sql = "CALL SPtransferBarang('$kode_customer','$kode_transaksi')";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                echo "<script>alert('Berhasil Menambah Transaksi');window.location.href='../../transaction.php';</script>";
            } else{
                echo "<script>alert('Gagal Menambah Transaksi');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode_customer;
                exit();
            }
        }
        public function tampil($id){
            $sql = "select * from tb_transaksi where kode_customer = '$id'";
            $query = mysqli_query($this->koneksi, $sql);
            if(mysqli_num_rows($query) > 0){
                while($d = mysqli_fetch_assoc($query)){
                    $data[] = $d;
                }
                return $data;
            }else{
                return false;
            }
        }
        public function tampilSemua(){
            $sql = "SELECT tb_transaksi.*,tb_customer.nama from tb_transaksi JOIN tb_customer ON tb_transaksi.kode_customer = tb_customer.kode_customer WHERE status_transaksi = 'Menunggu Konfirmasi' ORDER BY tgl_transaksi ASC";
            $query = mysqli_query($this->koneksi, $sql);
            if(mysqli_num_rows($query) > 0){
                while($d = mysqli_fetch_assoc($query)){
                    $data[] = $d;
                }
                return $data;
            }else{
                return false;
            }
        }
        public function tampilDikirim(){
            $sql = "SELECT tb_transaksi.*,tb_customer.nama from tb_transaksi JOIN tb_customer ON tb_transaksi.kode_customer = tb_customer.kode_customer WHERE status_transaksi = 'Dikirim' ORDER BY tgl_transaksi ASC";
            $query = mysqli_query($this->koneksi, $sql);
            if(mysqli_num_rows($query) > 0){
                while($d = mysqli_fetch_assoc($query)){
                    $data[] = $d;
                }
                return $data;
            }else{
                return false;
            }
        }
        public function tampilAll(){
            $sql = "SELECT tb_transaksi.*,tb_customer.nama from tb_transaksi JOIN tb_customer ON tb_transaksi.kode_customer = tb_customer.kode_customer ORDER BY tgl_transaksi ASC";
            $query = mysqli_query($this->koneksi, $sql);
            if(mysqli_num_rows($query) > 0){
                while($d = mysqli_fetch_assoc($query)){
                    $data[] = $d;
                }
                return $data;
            }else{
                return false;
            }
        }
        public function tampilDetail($id){
            $sql = "select tb_detail_transaksi.*,tb_barang.nama from tb_detail_transaksi JOIN tb_barang ON tb_detail_transaksi.kode_barang = tb_barang.kode_barang where kode_transaksi = '$id'";
            $query = mysqli_query($this->koneksi, $sql);
            if(mysqli_num_rows($query) > 0){
                while($d = mysqli_fetch_assoc($query)){
                    $data[] = $d;
                }
                return $data;
            }else{
                return false;
            }
        }
        public function batal($id){
            $sql = "UPDATE tb_transaksi SET status_transaksi = 'Dibatalkan' WHERE kode_transaksi='$id'";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                echo "<script>alert('Berhasil Membatalkan Transaksi');window.location.href='../pages/orderan.php';</script>";
            } else{
                echo "<script>alert('Gagal Membatalkan Transaksi');</script>";
                echo mysqli_error($this->koneksi);
                echo $id;
                exit();
            }
        }
        public function kirim($id,$shipper,$resi){
            $sql = "UPDATE tb_transaksi SET status_transaksi = 'Dikirim' WHERE kode_transaksi='$id'";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                $this->shipping($id,$shipper,$resi);
                exit();
            } else{
                echo "<script>alert('Gagal Menerima Transaksi');</script>";
                echo mysqli_error($this->koneksi);
                echo $id;
                exit();
            }
        }
        public function shipping($kode_transaksi,$shipper,$resi){
            $sql = "INSERT into tb_shipping (`kode_transaksi`, `nama_shipper`, `no_resi`)  VALUES ('$kode_transaksi','$shipper','$resi')";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                echo "<script>alert('Berhasil Membuat Pengiriman');window.location.href='../pages/orderan.php';</script>";
            } else{
                echo "<script>alert('Gagal Membuat Pengiriman');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode_transaksi;
                exit();
            }
        }
}