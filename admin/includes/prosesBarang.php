<?php
    
    session_start();

    require_once('barang.php');
    require_once('foto.php');
    $barang = new barang();

    $aksi = $_GET['aksi'];
    if($aksi == "tambah"){ 
        $kode_barang = $barang->generateKodeBarang();
        $nama       = htmlspecialchars($_POST['nama_barang']); 
        $merk       = htmlspecialchars($_POST['merk']);
        $kategori   = htmlspecialchars($_POST['kategori']);
        $harga      = htmlspecialchars($_POST['harga']);
        $stok       = htmlspecialchars($_POST['stok']);
        $deskripsi  = htmlspecialchars($_POST['deskripsi']);
        $lokasi = htmlspecialchars($_POST['lokasi']);
        // Gambar
        $gambar     = $_FILES['foto']['name'];
        $ekstensi_diperbolehkan	= array('png','jpg');
        $x          = explode(".",$gambar);
        $extension  = strtolower(end($x));
        $ukuran     = $_FILES['foto']['size'];
        $file_tmp   = $_FILES['foto']['tmp_name'];
        $format_gambar = $kode_barang.' - '.$gambar;		
		move_uploaded_file($file_tmp, '../../Gambar/'.$format_gambar);
        $barang->tambahBarang($kode_barang, $nama, $merk, $kategori, $deskripsi,$harga,$stok,$format_gambar,$lokasi);

    }
    else if($aksi == "update"){ 
        $kode_barang = htmlspecialchars($_POST['kode_barang']);
        $nama       = htmlspecialchars($_POST['nama_barang']); 
        $merk       = htmlspecialchars($_POST['merk']);
        $kategori   = htmlspecialchars($_POST['kategori']);
        $harga      = htmlspecialchars($_POST['harga']);
        $stok       = htmlspecialchars($_POST['stok']);
        $deskripsi  = htmlspecialchars($_POST['deskripsi']);
        $lokasi = htmlspecialchars($_POST['lokasi']);
        $barang->updateBarang($kode_barang, $nama, $merk, $kategori, $deskripsi,$harga,$stok,$lokasi);

    }else if($aksi == "hapus"){
        $kode = $_GET['id'];
        $barang->hapus($kode);
    }
    else if($aksi == "tambahgambar"){
        $kode       = $_POST['kode'];
        $gambar     = $_FILES['foto']['name'];
        $ekstensi_diperbolehkan	= array('png','jpg');
        $x          = explode(".",$gambar);
        $extension  = strtolower(end($x));
        $ukuran     = $_FILES['foto']['size'];
        $file_tmp   = $_FILES['foto']['tmp_name'];
        $format_gambar = $kode.' - '.$gambar;		
		move_uploaded_file($file_tmp, '../../Gambar/'.$format_gambar);
        $barang->tambahFoto2($kode,$format_gambar);
    }
    else if($aksi == "hapusgambar"){
        $id         = $_GET['id'];
        $kode       = $_GET['kode'];
        $barang->hapusGambar($kode,$id);
    }

    else if($aksi == "update"){
        $id = $_POST['id_inventaris'];
        $kode = $_POST['kode_inventaris'];
        $nama = $_POST['nama'];
        $kondisi = $_POST['kondisi'];
        $jumlah = $_POST['jumlah'];
        $jenis = $_POST['jenis'];
        $tanggal = $_POST['tanggal_register'];
        $ruang = $_POST['ruang'];
        $petugas = $_SESSION['id_petugas'];
        $keterangan = $_POST['keterangan'];
        
        if(empty($kode) || empty($nama) || empty($kondisi) || empty($jumlah) || empty($jenis) || 
        empty($tanggal) || empty($ruang) || empty($petugas) || empty($keterangan)){
            echo "<script>alert('Data Tidak Boleh Kosong');window.location.href='../pages/inventaris.php';</script>";
            exit();
        } else{
            $inventaris->updateInventaris($id, $kode, $nama, $kondisi, $jumlah, $jenis, $tanggal, $ruang, $petugas, $keterangan);
        }
    }

?>