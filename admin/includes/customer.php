<?php
    require_once('database.php');

    class customer extends database{
        public function searchById($kode){
            $sql = "Select * from tb_customer where kode_customer = '$kode'";
            $query = mysqli_query($this->koneksi, $sql);
            $data = mysqli_fetch_assoc($query);

            return $data;
        }
        public function getAlamat($kode){
            $sql = "Select alamat from tb_customer where kode_customer = '$kode'";
            $query = mysqli_query($this->koneksi, $sql);
            $data = mysqli_fetch_assoc($query);
            $hasil = $data['alamat'];
            return $hasil;
        }
        
        public function generateKodeCustomer(){
            $sql = "SELECT max(kode_customer) as kodeTerbesar FROM tb_customer";
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
            $huruf = "CUS";
            $kodeBarang = $huruf . sprintf("%03s", $urutan);
            return $kodeBarang;
        }
        public function tambah($kode,$email,$nama,$password,$jk,$no_telp,$alamat){
            $sql = "INSERT INTO tb_customer (`kode_customer`,`kode_level`,`nama`,`email`,`password`,`no_telp`,`jenis_kelamin`,`alamat`) VALUES ('$kode','LVL001','$nama','$email','$password','$no_telp','$jk','$alamat')";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                $_SESSION['customer'] = $kode;
                $_SESSION['nama']     = $nama;
                echo "<script>alert('Berhasil Menambahkan Data');window.location.href='../../index.php';</script>";
            } else{
                echo "<script>alert('Gagal Menambahkan Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode;
                exit();
            }
        }
        public function login($email,$password){
            $username   = mysqli_real_escape_string($this->koneksi, $email);
            $pass       = mysqli_real_escape_string($this->koneksi, $password);
            $sql        = "SELECT * from tb_customer where email='$username' AND password='$pass'";
            $query      = mysqli_query($this->koneksi, $sql);
            $rows       = mysqli_num_rows($query);
            if($rows < 1){
                echo "<script>alert('Username atau Password Salah!');window.location.href='../../index.php';</script>";
                exit();
            } else{
                if($data = mysqli_fetch_assoc($query)){
                    session_start();
                    
                    $_SESSION['login']      = true;
                    $_SESSION['customer']   = $data['kode_customer'];
                    $_SESSION['nama']       = $data['nama'];
                    $_SESSION['email']      = $data['email'];
                    header('Location: ../../index.php');
                    exit();
                }
            }
        }
        public function updateNoPass($kode,$email,$nama,$jk,$no_telp,$alamat){
            $sql = "CALL SPupdateCustomer('$kode','$email','$nama','$jk','$no_telp','$alamat')";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                $_SESSION['customer']   = $kode;
                $_SESSION['nama']       = $nama;
                $_SESSION['email']      = $email;
                echo "<script>alert('Berhasil Mengubah Data');window.location.href='../../dataCustomer.php';</script>";
            } else{
                echo "<script>alert('Gagal Mengubah Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode;
                exit();
            }
        }
        public function update($kode,$email,$nama,$password,$jk,$no_telp,$alamat){
            $sql = "CALL SPupdateCustomerP('$kode','$email','$nama','$password  ','$jk','$no_telp','$alamat')";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                $_SESSION['customer']   = $kode;
                $_SESSION['nama']       = $nama;
                $_SESSION['email']      = $email;
                echo "<script>alert('Berhasil Mengubah Data');window.location.href='../../dataCustomer.php';</script>";
            } else{
                echo "<script>alert('Gagal Mengubah Data');</script>";
                echo mysqli_error($this->koneksi);
                echo $kode;
                exit();
            }
        }
        
        public function logout(){
            session_start();
            session_unset();
            session_destroy();
            header('Location: ../../index.php');
        }
    }