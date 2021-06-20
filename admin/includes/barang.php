<?php
    require_once('database.php');

    class barang extends database{

        //Fungsi Menampilkan Data Inventaris
        public function rupiah($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	        return $hasil_rupiah;
        }
        public function tampil(){
            $sql = "CALL SPtampilBarang()";
            $query = mysqli_query($this->koneksi, $sql);
            while($d = mysqli_fetch_assoc($query)){
                $data[] = $d;
            }
            return $data;
        }
        public function search($nama,$kode_brand){
            $sql = "SELECT * from tb_barang where nama LIKE '%$nama%' AND kode_merk = '$kode_brand'";
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
        public function tampilMerk(){
            $sql = "CALL SPtampilMerk()";
            $query = mysqli_query($this->koneksi, $sql);
            while($d = mysqli_fetch_assoc($query)){
                $data[] = $d;
            }
            return $data;
        }
        public function tampilKategori(){
            $sql = "CALL SPtampilKategori()";
            $query = mysqli_query($this->koneksi, $sql);
            while($d = mysqli_fetch_assoc($query)){
                $data[] = $d;
            }
            return $data;
        }
        public function tampilGambar($id){
            $sql = "select * from tb_foto_barang where kode_barang = '$id'";
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
        public function tampil1Gambar($id){
            $sql = "select * from tb_foto_barang where kode_barang = '$id' LIMIT 1";
            $query = mysqli_query($this->koneksi, $sql);
            if(mysqli_num_rows($query) > 0){
                $data = mysqli_fetch_assoc($query);
                return $data;
            }else{
                return false;
            }
        }
        public function tampilJumlahBarang(){
            $sql = "Select COUNT(*) as total from tb_barang";
            $query = mysqli_query($this->koneksi, $sql);
            while($d = mysqli_fetch_assoc($query)){
                $data[] = $d;
            }
            return $data;
        }
        public function cekHarga($kode){
            $sql = "SELECT harga FROM tb_barang WHERE kode_barang ='$kode'";
            $query = mysqli_query($this->koneksi, $sql);
            $data = mysqli_fetch_array($query);
            $harga = $data['harga'];
            return $harga;
        }
        public function generateKodeBarang(){
            $sql = "SELECT max(kode_barang) as kodeTerbesar FROM tb_barang";
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
            $huruf = "BRG";
            $kodeBarang = $huruf . sprintf("%03s", $urutan);
            return $kodeBarang;
        }
        public function tambahFoto($kode_barang,$foto){
            $sql = "CALL SPtambahFotoBarang('$kode_barang','$foto')";
            $query = mysqli_query($this->koneksi,$sql);
            if($query){
                echo "<script>alert('Berhasil Menambahkan Data');window.location.href='../pages/daftar-barang.php';</script>";
                exit();
            } else{
                echo "<script>alert('Gagal Menambahkan Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode_barang;
                exit();
            }
        }
        public function tambahFoto2($kode_barang,$foto){
            $sql = "CALL SPtambahFotoBarang('$kode_barang','$foto')";
            $query = mysqli_query($this->koneksi,$sql);
            if($query){
                echo "<script>alert('Berhasil Menambahkan Gambar');window.location.href='../pages/editBarang.php?id=".$kode_barang."&aksi=edit';</script>";
                exit();
            } else{
                echo "<script>alert('Gagal Menambahkan Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode_barang;
                exit();
            }
        }
        public function hapusGambar($kode_barang,$id){
            $sql = "Delete from tb_foto_barang where id_foto_barang='$id'";
            $query = mysqli_query($this->koneksi,$sql);
            if($query){
                echo "<script>alert('Berhasil Menghapus Data');window.location.href='../pages/editBarang.php?id=".$kode_barang."&aksi=edit';</script>";
                exit();
            } else{
                echo "<script>alert('Gagal Menghapus Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode_barang;
                exit();
            }
        }
        public function hapus($kode){
            $sql = "Delete from tb_barang where kode_barang='$kode'";
            $query = mysqli_query($this->koneksi,$sql);
            if($query){
                echo "<script>alert('Berhasil Menghapus Data');window.location.href='../pages/daftar-barang.php';</script>";
                exit();
            } else{
                echo "<script>alert('Gagal Menghapus Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode;
                exit();
            }
        }
         
        public function tambahBarang($kode, $nama, $merk, $kategori, $deskripsi,$harga,$stok,$foto,$lokasi){
            $sql = "INSERT INTO `tb_barang` (`kode_barang`, `kode_kategori`, `kode_merk`, `nama`, `deskripsi`, `harga`, `stok`, `lokasi`, `tgl_perubahan`) VALUES ('$kode','$kategori','$merk','$nama','$deskripsi','$harga','$stok', '$lokasi', current_timestamp())";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                $this->tambahFoto($kode,$foto);
                exit();
            } else{
                echo "<script>alert('Gagal Menambahkan Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode;
                exit();
            }
        }
        public function updateBarang($kode, $nama, $merk, $kategori, $deskripsi,$harga,$stok,$lokasi){
            $sql = "CALL SPupdateBarang('$kode','$nama','$merk','$kategori','$deskripsi','$harga','$stok','$lokasi')";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                echo "<script>alert('Berhasil Mengubah Data');window.location.href='../pages/daftar-barang.php';</script>";
                echo $kode;
                exit();
            } else{
                echo "<script>alert('Gagal Menambahkan Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode;
                exit();
            }
        }

        public function editBarang($kode_barang){
            $sql = "CALL SPtampilBarangID('$kode_barang')";
            $query = mysqli_query($this->koneksi, $sql);
            $data = mysqli_fetch_assoc($query);

            return $data;
        }
    }
?>