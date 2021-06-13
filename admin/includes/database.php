<?php
    class database{

        public $koneksi;
        
        //Fungsi Koneksi Database
        public function __construct(){
            $this->koneksi = mysqli_connect("localhost", "root", "", "awg_electronics");
            if($this->koneksi){
            } else{
                echo "Koneksi Gagal";
            }
        }
        //Fungsi Login Sebagai Petugas
        public function loginadmin($email,$password){
            $sql = "SELECT * from tb_admin where email='$email' AND password='$password'";
            $query = mysqli_query($this->koneksi, $sql);
            $rows = mysqli_num_rows($query);
            if($rows < 1){
                echo "<script>alert('Username atau Password Salah!');window.location.href='../login.php';</script>";
                exit();
            } else{
                if($data = mysqli_fetch_assoc($query)){
                    session_start();
                    
                    $_SESSION['login'] = true;
                    $_SESSION['nama'] = $data['nama'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['password'] = $data['password'];

                    echo "<script>alert('Login Sukses');window.location.href='../login.php';</script>";
                    header('Location: ../index.php');
                    exit();
                }
            }
        }

        //Fungsi Login Sebagai Peminjam    
        public function loginpeminjam($nip,$password){
            $sql = "SELECT * FROM pegawai WHERE nip='$nip' AND password='$password'";
            $query = mysqli_query($this->koneksi, $sql);
            $rows = mysqli_num_rows($query);
            if($rows < 1){
                echo "<script>alert('NIP, Password, atau Level Salah!');window.location.href='../login.php';</script>";
                exit();
            } else{
                if($data = mysqli_fetch_assoc($query)){
                    session_start();

                    $_SESSION['login'] = true;
                    $_SESSION['nama'] = $data['nama_pegawai'];
                    $_SESSION['nip'] = $data['nip'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['id_pegawai'] = $data['id_pegawai'];
                    $_SESSION['akses'] = "peminjam";
                    
                    echo "<script>alert('Login Sukses');window.location.href='../login.php';</script>";
                    header('Location: ../index.php');
                    exit();
                }
            }
        }

        //Fungsi Logout
        public function logout(){
            session_start();
            session_unset();
            session_destroy();
            header('Location: ../login.php');
        }
    }
?>