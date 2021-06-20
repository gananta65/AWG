-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2021 pada 17.44
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `awg_electronics`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtambahBarang` (IN `kode` VARCHAR(20), IN `kategori` VARCHAR(20), IN `merk` VARCHAR(20), IN `nama` VARCHAR(50), IN `deskripsi` TEXT, IN `harga` INT, IN `stok` INT)  NO SQL
INSERT INTO `tb_barang` (`kode_barang`, `kode_kategori`, `kode_merk`, `nama`, `deskripsi`, `harga`, `stok`, `tgl_perubahan`) VALUES (@kode, @kategori, @merk, @nama, @deskripsi,@harga,@stok, current_timestamp())$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtambahFotoBarang` (IN `kode_barang` VARCHAR(20), IN `foto` VARCHAR(100))  NO SQL
INSERT INTO tb_foto_barang VALUES(NULL, kode_barang, foto)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtambahKeranjang` (IN `kode_brg` VARCHAR(20), IN `kode_cust` VARCHAR(20))  NO SQL
Update tb_keranjang set jumlah=jumlah+1, subtotal=(SELECT harga FROM tb_barang WHERE kode_barang=kode_brg)*jumlah WHERE kode_customer = kode_cust and kode_barang=kode_brg$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtambahKeranjangB` (IN `kode_brg` VARCHAR(20), IN `kode_cust` VARCHAR(20), IN `jml` INT)  NO SQL
Update tb_keranjang set jumlah=jumlah+jml, subtotal=(SELECT harga FROM tb_barang WHERE kode_barang=kode_brg)*jumlah WHERE kode_customer = kode_cust and kode_barang=kode_brg$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtambahTransaksi` (IN `kode_tr` VARCHAR(20), IN `kode_cust` VARCHAR(20), IN `tot` INT, IN `alm` TEXT, IN `jenis` VARCHAR(20), IN `stat` VARCHAR(20))  NO SQL
INSERT INTO `tb_transaksi` (`id_transaksi`, `kode_transaksi`, `kode_customer`, `total`, `alamat`, `jenis_transaksi`, `tgl_transaksi`, `status_transaksi`) VALUES (NULL, kode_tr, kode_cust, tot, alm, jenis, current_timestamp(), stat)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtampilBarang` ()  NO SQL
SELECT tb_barang.*,tb_kategori.kategori,tb_merk.merk from tb_barang JOIN tb_merk ON tb_barang.kode_merk = tb_merk.kode_merk JOIN tb_kategori ON tb_barang.kode_kategori = tb_kategori.kode_kategori$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtampilBarangID` (IN `kode` VARCHAR(20))  NO SQL
SELECT * FROM tb_barang WHERE kode_barang = kode$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtampilCustomer` ()  NO SQL
Select * from tb_customer$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtampilKategori` ()  NO SQL
SELECT * FROM tb_kategori$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtampilKeranjang` (IN `kode_cust` VARCHAR(20))  NO SQL
Select tb_keranjang.*,tb_barang.nama,tb_barang.harga FROM tb_keranjang JOIN tb_barang ON tb_keranjang.kode_barang = tb_barang.kode_barang JOIN tb_customer on tb_keranjang.kode_customer = tb_customer.kode_customer WHERE tb_keranjang.kode_customer = kode_cust$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtampilMerk` ()  NO SQL
SELECT * FROM tb_merk$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtransferBarang` (IN `kode` VARCHAR(20), IN `kode_trx` VARCHAR(20))  NO SQL
INSERT INTO tb_detail_transaksi (kode_barang,kode_transaksi,kode_customer,jumlah,subtotal)
SELECT kode_barang,kode_trx,kode_customer,jumlah,subtotal
FROM tb_keranjang WHERE tb_keranjang.kode_customer = kode$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPupdateAdmin` (IN `kode` VARCHAR(20), IN `email_baru` VARCHAR(30), IN `pass` VARCHAR(100), IN `nama_baru` VARCHAR(50), IN `jk` VARCHAR(10), IN `no_hp` VARCHAR(20))  NO SQL
UPDATE `tb_admin` SET `email` = email_baru, `password` = pass, `nama` = nama_baru, `jenis_kelamin` = jk, `no_telp` = no_hp WHERE `tb_admin`.`kode_admin` = kode$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPupdateBarang` (IN `kode` VARCHAR(20), IN `nama_baru` VARCHAR(255), IN `merk` VARCHAR(20), IN `kategori` VARCHAR(20), IN `deskripsi_baru` TEXT, IN `harga_baru` INT, IN `stok_baru` INT, IN `lok` VARCHAR(30))  NO SQL
UPDATE tb_barang SET kode_merk = merk,nama = nama_baru, deskripsi = deskripsi_baru, harga = harga_baru, stok = stok_baru, lokasi = lok, tgl_perubahan = CURRENT_TIMESTAMP() WHERE tb_barang.kode_barang = kode$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPupdateCustomer` (IN `kode` VARCHAR(20), IN `email_baru` VARCHAR(50), IN `nama_baru` VARCHAR(50), IN `jk` VARCHAR(10), IN `telp` VARCHAR(20), IN `alm_baru` TEXT)  NO SQL
UPDATE `tb_customer` SET `nama` = nama_baru, `email` = email_baru,`no_telp` = telp, `jenis_kelamin` = jk, `alamat` = alm_baru WHERE `tb_customer`.`kode_customer` = kode$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPupdateCustomerP` (IN `kode` VARCHAR(20), IN `email_baru` VARCHAR(30), IN `nama_baru` VARCHAR(50), IN `pass` VARCHAR(100), IN `jk` VARCHAR(10), IN `telp` VARCHAR(20), IN `alm_baru` TEXT)  NO SQL
UPDATE `tb_customer` SET `nama` = nama_baru, `email` = email_baru, `password` = pass, `no_telp` = telp, `jenis_kelamin` = jk, `alamat` = alm_baru WHERE `tb_customer`.`kode_customer` = kode$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPupdateKeranjang` (IN `jml` INT, IN `kode_brg` VARCHAR(20), IN `kode_cust` VARCHAR(20))  NO SQL
Update tb_keranjang set jumlah=jml, subtotal=(SELECT harga FROM tb_barang WHERE kode_barang=kode_brg)*jumlah WHERE kode_customer = kode_cust and kode_barang=kode_brg$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `kode_admin` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `kode_admin`, `email`, `password`, `nama`, `jenis_kelamin`, `no_telp`) VALUES
(1, 'ADM001', 'gananta11@gmail.com', 'aaaa1111', 'Gananta', 'Pria', '08993386346'),
(3, 'ADM002', 'gananta65@gmail.com', 'aa', 'gan', 'Pria', '21311');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alamat`
--

CREATE TABLE `tb_alamat` (
  `id_alamat` int(11) NOT NULL,
  `kode_customer` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `koordinat` varchar(20) NOT NULL,
  `postcode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `kode_kategori` varchar(20) NOT NULL,
  `kode_merk` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `tgl_perubahan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `kode_barang`, `kode_kategori`, `kode_merk`, `nama`, `deskripsi`, `harga`, `stok`, `lokasi`, `tgl_perubahan`) VALUES
(1, 'BRG001', 'KTG003', 'MRK007', 'ACER NITRO AN515-56 - i5-11300H DDR4 8GB SSD 512GB NVIDIA GTX1650 4GB 15.6&quot; IPS 144Hz W10 OHS', 'ACER PREDATOR NITRO AN515-56-5603 (NITRO TERBARU 2021)\r\n\r\nFREE\r\nOFFICE HOME &amp; STUDENT 2019 ORIGINAL PERMANEN\r\nTAS NITRO BACKPACK\r\n\r\nHighlights :\r\n- FPS lebih baik dengan display yang lebih smooth. Peningkatan 50% dr processor generasi sebelumnya. Dan meningkat up to 11.88% dengan menggunakan Nitro Sense.\r\n- Performance yang lebih stabil dan durabilitas yang lebih lama dengan +25% airflow yg lebih baik menggunakan Acer CoolBoost (quad exhaust fan).\r\n- Dual slot NVMe, dengan max 2TB SSD.\r\n- Smoother display 2x smoother dari 60Hz refresh rate.\r\n\r\nSpeksifikasi:\r\n- 11th Generation IntelÂ® Coreâ„¢ i5-11300H Processor (3.10 GHz, up to 4.40 GHz with Turbo Boost, 4 Cores, 8 Thread)\r\n- Memory 8 GB DDR4 3200MHZ ( UPTO 32GB )\r\n- Storage 512GB M.2 NVMeâ„¢ PCIeÂ® 3.0 SSD\r\n- Graphic nVidia GTX1650 with 4GB DDR6, VRAM\r\n- Display 15.6inch (16:9) FHD (1920x1080) 144Hz Anti-Glare IPS-level Panel\r\n- Keyboard Backlight keyboard with isolated numpad key\r\n- WebCam HD camera (Front)\r\n\r\n-Wi-Fi : Wireless Wi-Fi 6 AX201\r\nKillerTM Ethernet E2600\r\n\r\n-Bluetooth : BluetoothÂ® 5.0 The Version of BT may change as OS upgrades\r\nInterface :\r\n1x USB 3.2 Gen 2 port featuring power-off USB charging\r\n2x USB 3.2 Gen 1 ports\r\nHDMIÂ® 2.0 port with HDCP support\r\nEthernet (RJ-45) port\r\n\r\nUSB Type-C with Thunderbolt 4 port supporting:\r\nâ€¢ USB 3.2 Gen 2 (up to 10 Gbps)\r\nâ€¢ 3.5 mm headphone/speaker jack, supporting headsets with built-in', 13500000, 10, 'Kabupaten Buleleng', '2021-06-20 03:18:16'),
(2, 'BRG002', 'KTG003', 'MRK009', 'Apple MacBook Air (13 inci, M1 2020) 8GB RAM, 256GB SSD, Gold', 'Laptop Apple yang paling tipis dan ringan, bertenaga super dengan chip Apple M1. Tuntaskan berbagai proyek Anda dengan CPU 8-core super cepat. Tingkatkan aplikasi dan game kaya grafis ke level lebih tinggi dengan GPU hingga 8-core. Dan percepat tugas pembelajaran mesin dengan Neural Engine 16-core. Semua dengan desain senyap tanpa kipas dan kekuatan baterai paling tahan lama â€” hingga 18 jam. (2) MacBook Air. Tetap portabel yang sempurna. Jauh lebih bertenaga.\r\n\r\nChip M1 yang didesain Apple untuk lompatan besar dalam performa CPU, GPU, dan pembelajaran mesin\r\nLakukan lebih banyak hal dengan kekuatan baterai hingga 18 jam(2)\r\nCPU 8-core menghadirkan performa hingga 3,5x lebih cepat untuk menangani berbagai proyek lebih cepat(3)\r\nGPU hingga delapan core dengan grafis hingga 5x lebih cepat untuk aplikasi dan game kaya grafis(3)\r\nNeural Engine 16-core untuk pembelajaran mesin canggih\r\nMemori terintegrasi 8 GB menjadikan segala yang Anda lakukan terasa cepat dan lancar \r\nPenyimpanan SSD super cepat membuka aplikasi dan file dalam sekejap\r\nDesain tanpa kipas untuk pengoperasian yang senyap \r\nLayar Retina 13,3 inci dengan warna luas P3 untuk gambar yang cemerlang dan detail luar biasa3\r\nKamera FaceTime HD dengan prosesor sinyal gambar canggih untuk panggilan video yang lebih jelas dan tajam\r\nDeretan tiga mikrofon lebih mendengarkan Anda. Bukan sekeliling Anda.\r\nWi-Fi 6 generasi baru untuk konektivitas yang lebih cepat\r\nDua port Thunderbolt/USB 4 untuk pengisian daya dan aksesori\r\nMagic Keyboard dengan lampu latar dan Touch ID untuk membuka kunci dan melakukan pembayaran dengan aman\r\nmacOS Big Sur memperkenalkan desain baru yang tegas dan pembaruan aplikasi besar-besaran untuk Safari, Pesan, dan Peta\r\nTersedia dalam warna emas, abu-abu, dan perak\r\n\r\n\r\nLegal\r\nTersedia opsi yang dapat dikonfigurasi.\r\nKekuatan baterai bervariasi tergantung penggunaan dan konfigurasi. Lihat apple.com/batteries untuk informasi selengkapnya.\r\nDibandingkan dengan generasi sebelumnya\r\nLebar layar diukur secara diagonal\r\n', 17000000, 10, 'Kota Denpasar', '2021-06-20 03:20:54'),
(4, 'BRG004', 'KTG008', 'MRK010', 'OPPO Reno5 Limited Edition Duo Box Free 24 Months Viu Premium Access', 'OPPO Reno5 Limited Edition Duo Box terdiri dari:\r\n- 2 unit OPPO Reno5\r\n- 2 Viu premium subscription package\r\n- Limited Box yang dapat menjadi cardboard projector\r\n\r\nSpesifikasi:\r\nsize and weight: 7.7mm/7.8mm |171g]\r\nMemory: 8GB/128GB\r\nDisplay: 6.4&quot; AMOLED FHD+ (2400 x 1800), Single Punch Hole 90Hz (hidden fingerpoint 3.0)\r\nRear camera: main lens 64MP + wide angle 8MP + macro 2MP + mono 2MP\r\nfront camera 44MP\r\nProcessor: Qualcomm 720G (8nm) Octacore 2.3GHz\r\nBattery: 4310 mAh / High Voltage Fast Charge\r\nOS: Colos OS 11 on Android 11\r\nColor: Fantasy Silver, Starry Black\r\nNetwork : 2G/3G/4G\r\nNFC: Yes\r\n', 9998000, 10, 'Kota Denpasar', '2021-06-20 05:36:17'),
(5, 'BRG005', 'KTG010', 'MRK012', 'HUAWEI Band 6 Smart Band | Tampilan Layar Penuh AMOLED 1.47 Inci | 96 Mode Olahraga', 'HUAWEI Band 6 memiliki desain yang dinamis dan ringan, layar AMOLED 1,47 inci, dan masa pakai baterai selama 2 minggu, dengan pengisian daya magnetis cepat. Pendamping kesehatan dan kebugaran ideal Anda, ini memiliki 96 mode latihan, pemantauan detak jantung 24/7, pelacakan tidur 4-status, dan pemantauan SpO2 sepanjang hari. \r\n\r\nHUAWEI Band 6 memiliki layar AMOLED FullView 1,47 inci, dengan area pandanglebih besar 148% lebih besar , dan rasio layar-ke-tubuh 64% bezel rendah. Gabungkan dengan layar resolusi tinggi 194 x 368 dengan 282 PPI dan Anda memiliki sesuatu yang sangat mengesankan untuk dilihat di pergelangan tangan Anda.\r\nUkuran area tampilan meningkat 148%\r\nRasio layar-ke-tubuh meningkat 42%\r\n\r\nWork it all Out\r\nSaat Anda mengerahkan semua upaya Anda untuk berolahraga, biarkan HUAWEI Band 6 mengurus sisanya. Pilih dari hingga 96 mode olahraga yang berbeda, dan pantau detak jantung, kalori, dan lainnya. Semua data Anda dapat disimpan dan dianalisis dalam grafik yang mudah dibaca, sehingga Anda dapat memetakan perjalanan kebugaran Anda dan menetapkan tujuan yang menginspirasi Anda.   \r\n', 700000, 10, 'Kabupaten Buleleng', '2021-06-20 05:39:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_chatbox`
--

CREATE TABLE `tb_chatbox` (
  `id_chatbox` int(11) NOT NULL,
  `kode_chatbox` varchar(20) DEFAULT NULL,
  `kode_customer` varchar(20) DEFAULT NULL,
  `kode_barang` varchar(20) DEFAULT NULL,
  `kode_cs` varchar(20) DEFAULT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_cs`
--

CREATE TABLE `tb_cs` (
  `id_cs` int(11) NOT NULL,
  `kode_cs` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_customer` int(11) NOT NULL,
  `kode_customer` varchar(20) NOT NULL,
  `kode_level` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_customer`
--

INSERT INTO `tb_customer` (`id_customer`, `kode_customer`, `kode_level`, `nama`, `email`, `password`, `no_telp`, `jenis_kelamin`, `alamat`) VALUES
(1, 'CUS001', 'LVL001', 'Andra', 'andra231@gmail.com', 'aaaa1111', '088888888888', 'Pria', ''),
(2, 'CUS002', 'LVL001', 'Gananta Made', 'gananta65@gmail.com', 'aaaa1111  ', '123', 'Pria', 'Dalung'),
(3, 'CUS003', 'LVL001', 'aa', 'aa@a.a', 'aaaa1111', '123', 'Pria', 'aa'),
(4, 'CUS004', 'LVL001', 'amdra', 'andra@gmail.co', 'aaaa1111', '088888888888', 'Pria', 'Dalung\r\nDalung'),
(5, 'CUS005', 'LVL001', 'andra', 'dra@a.a', 'aaaa1111', '088888888', 'Pria', 'Dalung\r\nDalung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_cust_level`
--

CREATE TABLE `tb_cust_level` (
  `id_level` int(11) NOT NULL,
  `kode_level` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_cust_level`
--

INSERT INTO `tb_cust_level` (`id_level`, `kode_level`, `level`) VALUES
(1, 'LVL001', '1'),
(2, 'LVL002', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id_keranjang` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `kode_customer` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_keranjang`, `kode_barang`, `kode_transaksi`, `kode_customer`, `jumlah`, `subtotal`) VALUES
(16, 'BRG005', 'TRX001', 'CUS002', 4, 2800000),
(17, 'BRG001', 'TRX001', 'CUS002', 1, 13500000),
(19, 'BRG005', 'TRX002', 'CUS002', 1, 700000),
(20, 'BRG004', 'TRX003', 'CUS002', 1, 9998000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_foto_barang`
--

CREATE TABLE `tb_foto_barang` (
  `id_foto_barang` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_foto_barang`
--

INSERT INTO `tb_foto_barang` (`id_foto_barang`, `kode_barang`, `foto`) VALUES
(1, 'BRG001', 'BRG001 - Acer Nitro part 1.jpg'),
(2, 'BRG001', 'BRG001 - Acer Nitro part 2.jpg'),
(3, 'BRG002', 'BRG002 - Apple MacBook Air part 1.jpg'),
(4, 'BRG002', 'BRG002 - Apple MacBook Air part 2.jpg'),
(6, 'BRG004', 'BRG004 - Oppo Reno 5 part 1.jpg'),
(7, 'BRG005', 'BRG005 - Huawei Band 6 part 1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` varchar(20) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `kode_kategori`, `kategori`) VALUES
(3, 'KTG003', 'Laptop'),
(8, 'KTG008', 'Smartphone'),
(9, 'KTG009', 'Smart TV'),
(10, 'KTG010', 'Smart Watch');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `kode_customer` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id_keranjang`, `kode_barang`, `kode_customer`, `jumlah`, `subtotal`) VALUES
(29, 'BRG004', 'CUS001', 1, 9998000),
(31, 'BRG004', 'CUS002', 1, 9998000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int(11) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_merk`
--

CREATE TABLE `tb_merk` (
  `id_merk` int(11) NOT NULL,
  `kode_merk` varchar(20) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_merk`
--

INSERT INTO `tb_merk` (`id_merk`, `kode_merk`, `merk`, `foto`) VALUES
(4, 'MRK004', 'Samsung', 'Samsung.png'),
(7, 'MRK007', 'Acer', 'Acer.png'),
(8, 'MRK008', 'Xiaomi', 'Xiaomi.png'),
(9, 'MRK009', 'Apple', 'Apple.png'),
(10, 'MRK010', 'Oppo', 'Oppo.png'),
(11, 'MRK011', 'Nikon', 'Nikon.png'),
(12, 'MRK012', 'Huawei', 'Huawei.png'),
(13, 'MRK013', 'Sony', 'Sony.png'),
(14, 'MRK014', 'Realme', 'Realme.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_shipping`
--

CREATE TABLE `tb_shipping` (
  `id_shipping` int(11) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `nama_shipper` varchar(50) NOT NULL,
  `no_resi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_shipping`
--

INSERT INTO `tb_shipping` (`id_shipping`, `kode_transaksi`, `nama_shipper`, `no_resi`) VALUES
(1, 'TRX002', 'jne', 'dasdas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `kode_customer` varchar(20) NOT NULL,
  `total` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_transaksi` varchar(20) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_transaksi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `kode_transaksi`, `kode_customer`, `total`, `alamat`, `jenis_transaksi`, `tgl_transaksi`, `status_transaksi`) VALUES
(3, 'TRX001', 'CUS002', 16300000, 'Dalung', 'Transfer', '2021-06-20 14:17:45', 'Dibatalkan'),
(4, 'TRX002', 'CUS002', 700000, 'Dalung', 'Transfer', '2021-06-20 14:18:40', 'Dikirim'),
(5, 'TRX003', 'CUS002', 9998000, 'Dalung', 'Transfer', '2021-06-20 14:19:12', 'Menunggu Konfirmasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ulasan`
--

CREATE TABLE `tb_ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `kode_customer` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `kode_admin` (`kode_admin`);

--
-- Indeks untuk tabel `tb_alamat`
--
ALTER TABLE `tb_alamat`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `kode_customer` (`kode_customer`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_kategori` (`kode_kategori`),
  ADD KEY `kode_merk` (`kode_merk`);

--
-- Indeks untuk tabel `tb_chatbox`
--
ALTER TABLE `tb_chatbox`
  ADD PRIMARY KEY (`id_chatbox`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_cs` (`kode_cs`),
  ADD KEY `kode_customer` (`kode_customer`);

--
-- Indeks untuk tabel `tb_cs`
--
ALTER TABLE `tb_cs`
  ADD PRIMARY KEY (`id_cs`),
  ADD KEY `kode_admin` (`kode_cs`);

--
-- Indeks untuk tabel `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `kode_customer` (`kode_customer`),
  ADD KEY `kode_level` (`kode_level`);

--
-- Indeks untuk tabel `tb_cust_level`
--
ALTER TABLE `tb_cust_level`
  ADD PRIMARY KEY (`id_level`),
  ADD KEY `kode_level` (`kode_level`);

--
-- Indeks untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `tb_foto_barang`
--
ALTER TABLE `tb_foto_barang`
  ADD PRIMARY KEY (`id_foto_barang`),
  ADD KEY `kode_level` (`kode_barang`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `kode_level` (`kode_kategori`);

--
-- Indeks untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_customer` (`kode_customer`);

--
-- Indeks untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `kode_transaksi` (`kode_transaksi`);

--
-- Indeks untuk tabel `tb_merk`
--
ALTER TABLE `tb_merk`
  ADD PRIMARY KEY (`id_merk`),
  ADD KEY `kode_level` (`kode_merk`);

--
-- Indeks untuk tabel `tb_shipping`
--
ALTER TABLE `tb_shipping`
  ADD PRIMARY KEY (`id_shipping`),
  ADD KEY `kode_transaksi` (`kode_transaksi`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `kode_customer` (`kode_customer`);

--
-- Indeks untuk tabel `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `kode_customer` (`kode_customer`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_alamat`
--
ALTER TABLE `tb_alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_chatbox`
--
ALTER TABLE `tb_chatbox`
  MODIFY `id_chatbox` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_cs`
--
ALTER TABLE `tb_cs`
  MODIFY `id_cs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_cust_level`
--
ALTER TABLE `tb_cust_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_foto_barang`
--
ALTER TABLE `tb_foto_barang`
  MODIFY `id_foto_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_merk`
--
ALTER TABLE `tb_merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_shipping`
--
ALTER TABLE `tb_shipping`
  MODIFY `id_shipping` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_alamat`
--
ALTER TABLE `tb_alamat`
  ADD CONSTRAINT `tb_alamat_ibfk_1` FOREIGN KEY (`kode_customer`) REFERENCES `tb_customer` (`kode_customer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`kode_kategori`) REFERENCES `tb_kategori` (`kode_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_barang_ibfk_2` FOREIGN KEY (`kode_merk`) REFERENCES `tb_merk` (`kode_merk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_chatbox`
--
ALTER TABLE `tb_chatbox`
  ADD CONSTRAINT `tb_chatbox_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_chatbox_ibfk_2` FOREIGN KEY (`kode_customer`) REFERENCES `tb_customer` (`kode_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_chatbox_ibfk_3` FOREIGN KEY (`kode_cs`) REFERENCES `tb_cs` (`kode_cs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD CONSTRAINT `tb_customer_ibfk_1` FOREIGN KEY (`kode_level`) REFERENCES `tb_cust_level` (`kode_level`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_foto_barang`
--
ALTER TABLE `tb_foto_barang`
  ADD CONSTRAINT `tb_foto_barang_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD CONSTRAINT `tb_keranjang_ibfk_1` FOREIGN KEY (`kode_customer`) REFERENCES `tb_customer` (`kode_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_keranjang_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD CONSTRAINT `tb_laporan_ibfk_1` FOREIGN KEY (`kode_transaksi`) REFERENCES `tb_transaksi` (`kode_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_shipping`
--
ALTER TABLE `tb_shipping`
  ADD CONSTRAINT `tb_shipping_ibfk_1` FOREIGN KEY (`kode_transaksi`) REFERENCES `tb_transaksi` (`kode_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`kode_customer`) REFERENCES `tb_customer` (`kode_customer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  ADD CONSTRAINT `tb_ulasan_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_ulasan_ibfk_2` FOREIGN KEY (`kode_customer`) REFERENCES `tb_customer` (`kode_customer`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
