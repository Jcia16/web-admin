<?php
require 'function.php';
require 'cek.php';

// Initialize total_masuk
$total_masuk = 0;

// Check if the form is submitted
$date_filter = "";
if (isset($_POST['filter_masuk'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    if ($start_date && $end_date) {
        $date_filter = "AND t.tanggal BETWEEN '$start_date' AND '$end_date'";
    }
}

// Calculate total masuk
$ambilsemuadatatransaksi_masuk = mysqli_query($conn, "
    SELECT SUM(t.kuantitas * p.hargasatuan) AS total_masuk
    FROM transaction t
    JOIN produk p ON t.idproduk = p.idproduk
    JOIN kategori k ON t.idkategori = k.idkategori
    WHERE k.tipekategori = 'masuk' AND t.kuantitas > 0
");

$data_masuk = mysqli_fetch_assoc($ambilsemuadatatransaksi_masuk);
$total_masuk = $data_masuk['total_masuk'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Aplikasi Stock Barang | Kelompok 01</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<div class="container">
    <h2>Stock Barang</h2>
    <div class="data-tables datatable-dark">
        <table id="datatablesSimple" class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Produk</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Harga Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data with date filter
                $ambilsemuadatatransaksi_keluar = mysqli_query($conn, "
                    SELECT 
                        t.idtransaksi, 
                        p.namaproduk, 
                        k.tipekategori, 
                        t.kuantitas, 
                        p.hargasatuan, 
                        t.tanggal
                    FROM 
                        transaction t
                    JOIN 
                        produk p ON t.idproduk = p.idproduk
                    JOIN 
                        kategori k ON t.idkategori = k.idkategori
                    WHERE
                        k.tipekategori = 'keluar' AND t.kuantitas > 0
                        $date_filter
                ");

                $total_keluar = 0; // Initialize total harga for keluar
                $total_kuantitaskeluar = 0;

                while ($data = mysqli_fetch_array($ambilsemuadatatransaksi_keluar)) {
                    $idtransaksi = $data['idtransaksi'];
                    $namaproduk = $data['namaproduk'];
                    $kuantitas = $data['kuantitas'];
                    $total_kuantitaskeluar += $kuantitas; // Update total kuantitas keluar
                    $hargasatuan = number_format($data['hargasatuan'], 0, ',', '.'); // Format harga satuan with commas
                    $totalharga = $kuantitas * $data['hargasatuan'];
                    $total_keluar += $totalharga; // Accumulate total keluar
                    $totalharga_formatted = number_format($totalharga, 0, ',', '.'); // Format total harga with commas
                    $tanggal = $data['tanggal'];

                    ?>
                    <tr>
                        <td><?= $idtransaksi; ?></td>
                        <td><?= $namaproduk; ?></td>
                        <td><?= $tanggal; ?></td>
                        <td><?= $kuantitas; ?></td>
                        <td><?= $hargasatuan; ?></td>
                        <td><?= $totalharga_formatted; ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="5"></td>
                    <td><strong>Total Keluar: <?= number_format($total_keluar, 0, ',', '.'); ?></strong></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td><strong>Nilai Inventory Saat ini: <?= number_format($total_masuk - $total_keluar, 0, ',', '.'); ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
            $('#datatablesSimple').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
</script>

</body>
</html>
