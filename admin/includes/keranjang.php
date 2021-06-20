<?php
    require_once('database.php');

    class keranjang extends database{
    public function jumlahBarang($kode){
        $sql = "Select COUNT(*) as jml from tb_keranjang WHERE kode_customer = '$kode'";
        $query = mysqli_query($this->koneksi, $sql);
            $data = mysqli_fetch_assoc($query);

            return $data;
    }
    public function cekBarang($kode_barang,$kode_customer){
        $sql = "Select * from tb_keranjang WHERE kode_customer = '$kode_customer' AND kode_barang = '$kode_barang'";
        $query = mysqli_query($this->koneksi, $sql);
        $rows = mysqli_num_rows($query);
        if($rows == 0){
            return false;
        }else{
            return true;
        }
    }
    public function totalBelanja($kode){
        $sql = "Select SUM(subtotal) as total from tb_keranjang WHERE kode_customer = '$kode'";
        $query = mysqli_query($this->koneksi, $sql);
            if(mysqli_num_rows($query) > 0){
             $data = mysqli_fetch_assoc($query);

            return $data;
            }else{
                return false;
            }
        }
        public function tambah($kode_barang,$kode_customer,$jumlah,$subtotal){
            $sql = "INSERT into tb_keranjang (kode_barang,kode_customer,jumlah,subtotal) Values ('$kode_barang','$kode_customer','$jumlah','$subtotal')";
            $query = mysqli_query($this->koneksi, $sql);
                if($query){
                    echo "<script>alert('Berhasil Menambahkan ke Keranjang');window.location.href='../../shop.php';</script>";
                    exit();
                } else{
                    echo "<script>alert('Gagal Menambahkan ke Keranjang');</script>";
                    echo mysqli_error($this->koneksi);
                    echo $kode_barang;
                    exit();
                }
        }
        public function tambahJumlah($kode_barang,$kode_customer){
            $sql = "CALL SPtambahKeranjang('$kode_barang','$kode_customer')";
            $query = mysqli_query($this->koneksi, $sql);
                if($query){
                    echo "<script>alert('Berhasil Menambahkan ke Keranjang');window.location.href='../../shop.php';</script>";
                    exit();
                } else{
                    echo "<script>alert('Gagal Menambahkan ke Keranjang');</script>";
                    echo mysqli_error($this->koneksi);
                    echo $kode_barang;
                    exit();
                }   
            }
            public function tampil($kode){
                $sql = "CALL SPtampilKeranjang('$kode')";
                $query = mysqli_query($this->koneksi, $sql);
                while($d = mysqli_fetch_assoc($query)){
                    $data[] = $d;
                }
                return $data;
            }
            public function hapus($id,$kode_customer){
                $sql = "DELETE FROM tb_keranjang where kode_barang = '$id' AND kode_customer ='$kode_customer'";
                $query = mysqli_query($this->koneksi, $sql);
                if($query){
                    echo "<script>alert('Berhasil Menghapus Data');window.location.href='../../cart.php';</script>";
                    exit();
                } else{
                    echo "<script>alert('Gagal Menghapus Data');</script>";
                    echo mysqli_error($this->koneksi);
                    echo $kode_barang;
                    exit();
                }
            }
            public function hapusArray($id,$kode_customer){
                $sql = "DELETE FROM tb_keranjang where kode_barang = '$id' AND kode_customer ='$kode_customer'";
                mysqli_query($this->koneksi, $sql);
            }
            public function updateArray($kode_barang,$jumlah,$kode_customer){
                $sql = "CALL SPupdateKeranjang('$jumlah','$kode_barang','$kode_customer')";
                mysqli_query($this->koneksi, $sql);
            }
}
