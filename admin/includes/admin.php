<?php
    require_once('database.php');

    class admin extends database{
        public function tampil(){
            $sql = "Select * from tb_admin";
            $query = mysqli_query($this->koneksi, $sql);
            while($d = mysqli_fetch_assoc($query)){
                $data[] = $d;
            }
            return $data;
        }
        public function searchById($kode){
            $sql = "Select * from tb_admin where kode_admin = '$kode'";
            $query = mysqli_query($this->koneksi, $sql);
            $data = mysqli_fetch_assoc($query);

            return $data;
        }
        public function tampilAlamat($kode){
            $sql = "Select * from tb_alamat where kode_customer = '$kode'";
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
        public function generateKodeAdmin(){
            $sql = "SELECT max(kode_admin) as kodeTerbesar FROM tb_admin";
            $query = mysqli_query($this->koneksi, $sql);
            $data = mysqli_fetch_array($query);
            $kode = $data['kodeTerbesar'];
            $urutan = (int) substr($kode, 3, 3);
            // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
            $urutan++;
            // membentuk kode barang baru
            // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
            // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
            // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
            $huruf = "ADM";
            $kode = $huruf . sprintf("%03s", $urutan);
            return $kode;
        }
        public function tambah($kode,$email,$nama,$password,$jk,$no_telp){
            $sql = "INSERT INTO `tb_admin` (`kode_admin`, `email`, `password`, `nama`, `jenis_kelamin`, `no_telp`) VALUES ('$kode','$email','$password','$nama','$jk','$no_telp')";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                echo "<script>alert('Berhasil Menambahkan Data');window.location.href='../pages/daftar-admin.php';</script>";
            } else{
                echo "<script>alert('Gagal Menambahkan Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode;
                exit();
            }
        }
        public function update($kode,$email,$nama,$password,$jk,$no_telp){
            $sql = "CALL SPupdateAdmin('$kode','$email','$password','$nama','$jk','$no_telp')";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                echo "<script>alert('Berhasil Mengubah Data');window.location.href='../pages/daftar-admin.php';</script>";
            } else{
                echo "<script>alert('Gagal Mengubah Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode;
                exit();
            }
        }
        public function hapus($kode){
            $sql = "Delete from tb_admin where kode_admin='$kode'";
            $query = mysqli_query($this->koneksi,$sql);
            if($query){
                echo "<script>alert('Berhasil Menghapus Data');window.location.href='../pages/daftar-admin.php';</script>";
                exit();
            } else{
                echo "<script>alert('Gagal Menghapus Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode;
                exit();
            }
        }
        
    }