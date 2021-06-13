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
        public function tampilJumlahBarang(){
            $sql = "Select COUNT(*) as total from tb_barang";
            $query = mysqli_query($this->koneksi, $sql);
            while($d = mysqli_fetch_assoc($query)){
                $data[] = $d;
            }
            return $data;
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
        //Fungsi Menambahkan Data Inventaris    
        public function tambahBarang($kode, $nama, $merk, $kategori, $deskripsi,$harga,$stok,$foto){
            $sql = "INSERT INTO `tb_barang` (`kode_barang`, `kode_kategori`, `kode_merk`, `nama`, `deskripsi`, `harga`, `stok`, `tgl_perubahan`) VALUES ('$kode','$kategori','$merk','$nama','$deskripsi','$harga','$stok', current_timestamp())";
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
        public function updateBarang($kode, $nama, $merk, $kategori, $deskripsi,$harga,$stok){
            $sql = "CALL SPupdateBarang('$kode','$nama','$merk','$kategori','$deskripsi','$harga','$stok')";
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

        //Fungsi Menghapus Data Inventaris
        public function hapusInventaris($id_inventaris){
            $sql = "DELETE FROM inventaris WHERE id_inventaris='$id_inventaris'";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                echo "<script>alert('Berhasil Menghapus Data');window.location.href='../pages/inventaris.php';</script>";
                exit();
            } else{
                echo "<script>alert('Gagal Menghapus Data');window.location.href='../pages/inventaris.php';</script>";
                exit();
            }
        }

        //Fungsi Mengedit Data Inventaris
        public function editBarang($kode_barang){
            $sql = "CALL SPtampilBarangID('$kode_barang')";
            $query = mysqli_query($this->koneksi, $sql);
            $data = mysqli_fetch_assoc($query);

            return $data;
        }

        //Fungsi Mengupdate Data Inventaris
        public function updateInventaris($id, $kode, $nama, $kondisi, $jumlah, $jenis, $tanggal, $ruang, $petugas, $keterangan){
            $sql = "UPDATE inventaris SET kode_inventaris='$kode', nama='$nama', kondisi='$kondisi', jumlah='$jumlah', id_jenis='$jenis',
            tanggal_register='$tanggal', id_ruang='$ruang', id_petugas='$petugas', keterangan='$keterangan' WHERE id_inventaris='$id'";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                echo "<script>alert('Berhasil Mengupdate Data');window.location.href='../pages/inventaris.php';</script>";
                exit();
            } else{
                echo "<script>alert('Gagal Mengupdate Data');window.location.href='../pages/inventaris.php';</script>";
                exit();
            }
        }

        //Fungsi Mengambil Data Jenis
        public function getJenis(){
            $sql = "SELECT id_jenis, nama_jenis FROM jenis";
            $query = mysqli_query($this->koneksi, $sql);
            while($d = mysqli_fetch_assoc($query)){
                $data[] = $d;
            }
            return $data;
        }

        //Fungsi Mengambil Data Ruang
        public function getRuang(){
            $sql = "SELECT id_ruang, nama_ruang FROM ruang";
            $query = mysqli_query($this->koneksi, $sql);
            while($d = mysqli_fetch_assoc($query)){
                $data[] = $d;
            }
            return $data;
        }

        //Fungsi Mengambil Id Inventaris
        public function getMaxIdInventaris(){
            $sql = "SELECT MAX(id_inventaris)+1 as id FROM inventaris";
            $query = mysqli_query($this->koneksi, $sql);
            $data = mysqli_fetch_assoc($query);

            return $data;
        }
    }
?>