<?php
    require_once('pengembalian.php');

    $pengembalian = new pengembalian();

    $id = $_GET['id'];
    $jumlah = $_GET['jumlah'];
    $id_inventaris = $_GET['id_inventaris'];

    $kembali = $pengembalian->pengembalianBarang($id, $jumlah, $id_inventaris);

?>