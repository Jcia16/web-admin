<?php
require 'function.php';
require 'cek.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Aplikasi Stock Barang | Kelompok 01</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
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
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Total Barang</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all products
            $ambilsemuadatatransaksi = mysqli_query($conn, "
            SELECT 
                p.idproduk, 
                p.namaproduk
            FROM 
                produk p
            ");

            while ($data = mysqli_fetch_array($ambilsemuadatatransaksi)) {
                $idproduk = $data['idproduk'];
                $namaproduk = $data['namaproduk'];

                // Calculate current stock quantity for each product
                $masuk = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(t.kuantitas) as total_masuk FROM transaction t WHERE t.idproduk = '$idproduk' AND t.idkategori = (SELECT idkategori FROM kategori WHERE tipekategori = 'masuk')"))['total_masuk'];
                $keluar = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(t.kuantitas) as total_keluar FROM transaction t WHERE t.idproduk = '$idproduk' AND t.idkategori = (SELECT idkategori FROM kategori WHERE tipekategori = 'keluar')"))['total_keluar'];
                $current_quantity = $masuk - $keluar;

                ?>
                <tr>
                    <td><?= $idproduk; ?></td>
                    <td><?= $namaproduk; ?></td>
                    <td><?= number_format($current_quantity, 0, ',', '.'); ?></td>
                </tr>
            <?php
            }
            ?>
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
    $('#datatablesSimple').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );
</script>

</body>
</html>