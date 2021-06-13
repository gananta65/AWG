<?php
    require_once('../includes/pengembalian.php');

    session_start();

    $pengembalian = new pengembalian();

    if(! $_SESSION['login']){
        header('Location: ../login.php');
    }
?>
<html>
<head>
    <title>INVENTARIO|pengembalian</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <ul>
        <a href="../index.php"><img src="../assets/images/logo.png"></a>
        <center><p class="session"><?= $_SESSION['akses']; ?></p></center>
        <?php
            if($_SESSION['akses']  == 'admin'){
        ?>
        <li><a href="inventaris.php">Inventarisir</a></li>
        <?php
            }
        ?> 
        <li><a href="peminjaman.php">Peminjaman</a></li>
        <?php
            if($_SESSION['akses']  == 'admin' || $_SESSION['akses'] == 'operator'){
        ?>
        <li><a class="active" href="pengembalian.php">Pengembalian</a></li>
        <?php
            }
        ?>
        <?php
            if($_SESSION['akses']  == 'admin'){
        ?>
        <li><a href="laporan.php">Laporan</a></li>
        <?php
            }
        ?>
        <li><a href="../includes/prosesLogout.php" onclick="return confirm('Anda Ingin Logout?')">Logout</a></li>
    </ul>
    <div class="sidebar">
        <h2>Data Sedang Dipinjam</h2>
            <table class="table">
                <tr>
                    <th>Kode Peminjaman</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                    <?php
                        $pending = $pengembalian->getAllPeminjaman();
                        if($pending < 1){
                            echo "<td colspan='6'>Tidak Ada Data</td>";
                        } else{
                            foreach($pending as $p){
                    ?>
                <tr>
                    <td><?php echo $p['kode_peminjaman'] ?></td>
                    <td><?php echo $p['nama'] ?></td>
                    <td><?php echo $p['jumlah'] ?></td>
                    <td><?php echo $p['tanggal_pinjam'] ?></td>
                    <td><?php echo $p['status_peminjaman'] ?></td>
                    <td>
                        <a href="../includes/prosesPengembalian.php?id=<?php echo $p['id_peminjaman']; ?>&jumlah=<?php echo $p['jumlah']; ?>&id_inventaris=<?php echo $p['id_inventaris']; ?>"
                        class="btn-hapus" onclick="return confirm('Yakin Ingin Mengembalikan Barang?')">Kembalikan</a>
                    </td>
                </tr>  
                    <?php
                            }
                        }
                    ?>  
            </table>
        <br>
        <br>
        <h2>Data Sudah Dikembalikan</h2>
            <table class="table">
                <tr>
                    <th>Kode Peminjaman</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                </tr>
                    <?php
                        $sukses = $pengembalian->getAllSuccessPeminjaman();
                        if($sukses < 1){
                            echo "<td colspan='6'>Tidak Ada Data</td>";
                        } else{
                            foreach($sukses as $s){
                    ?>
                <tr>
                    <td><?php echo $s['kode_peminjaman'] ?></td>
                    <td><?php echo $s['nama'] ?></td>
                    <td><?php echo $s['jumlah'] ?></td>
                    <td><?php echo $s['tanggal_pinjam'] ?></td>
                    <td><?php echo $s['tanggal_kembali'] ?></td>
                    <td><?php echo $s['status_peminjaman'] ?></td>
                </tr>
                    <?php
                            }
                        }
                    ?>
            </table>
    </div>
</body>
</html>