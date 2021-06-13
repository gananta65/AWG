<html>
<head>
    <title>Laporan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel = "icon" href = "https://media.geeksforgeeks.org/wp-content/cdn-uploads/gfg_200X200.png" type = "image/x-icon">
</head>
<body>
<?php include "sidebar.php"; ?>
    <div class="sidebar">
    <h1>Laporan</h1>
        <form action="laporan.php" method="GET"></form>
                <label>Tanggal Awal</label>
                <input type="date" name="tglawal"></input>
                <label>Tanggal Akhir</label>
                <input type="date" name="tglakhir"></input>

                <button type="submit" class="btn btn-primary"name="submit">Cari</button>
        </form>
        <br>
        <div class="print">
        <h2>Hasil Laporan</h2>
            <table class="table" style="width:100%;">
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status Transaksi</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </table>
        </div>
        <br>        
        <button onClick="window.print();" style="width: 20%; margin-left: 40%;">Print</button>
    </div>
</body>
</html>