<?php
session_start();

//membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","dbaja");

//menambah barang baru 

if(isset($_POST['addnewsupplier'])) {
    $idsupplier = $_POST['idsupplier'];
    $namasupplier = $_POST['namasupplier'];
    $alamat = $_POST['alamat'];

    $addtotable = mysqli_query($conn,"INSERT INTO supplier (idsupplier, namasupplier, alamat) values('$idsupplier','$namasupplier','$alamat')");
    
    if($addtotable){
        header('location:supplier.php');
    } else {
        echo 'Input Gagal';
        header('location:supplier.php');
    }
}

if (isset($_POST['editSupplier'])) {
    $idsupplier = $_POST['idsupplier'];
    $namasupplier = $_POST['namasupplier'];
    $alamat = $_POST['alamat'];

    $updateQuery = "UPDATE supplier SET namasupplier='$namasupplier', alamat='$alamat' WHERE idsupplier='$idsupplier'";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}


if (isset($_POST['deleteSupplier'])) {
    $idsupplier = $_POST['idsupplier'];

    $delete = mysqli_query($conn, "DELETE FROM supplier WHERE idsupplier='$idsupplier'");

    if ($delete) {
        echo "<script>alert('Data berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}

if(isset($_POST['addnewproduk'])){
    $idproduk = $_POST['idproduk'];
    $namaproduk = $_POST['namaproduk'];
    $hargasatuan = $_POST['hargasatuan'];
    $idsupplier = $_POST['idsupplier'];


    $addtotable = mysqli_query($conn,"INSERT INTO produk (idproduk, namaproduk, hargasatuan, idsupplier) values ('$idproduk','$namaproduk','$hargasatuan','$idsupplier')");
    if($addtotable){
        echo "<script>alert('Data berhasil diinput');</script>";
        header('location:produk.php');
    } else {
        echo 'Input Gagal';
        header('location:produk.php');
    }
}
if (isset($_POST['editProduk'])) {
    $idproduk = $_POST['idproduk'] ?? '';
    $namaproduk = $_POST['namaproduk'] ?? '';
    $hargasatuan = $_POST['hargasatuan'] ?? 0;

    $update = mysqli_query($conn, "UPDATE produk SET namaproduk='$namaproduk', hargasatuan='$hargasatuan' WHERE idproduk='$idproduk'");

    if ($update) {
        echo "<script>alert('Data berhasil diupdate');</script>";
    } else {
        echo 'Update Gagal: ' . mysqli_error($conn);
    }
}
if (isset($_POST['deleteProduk'])) {
    $idproduk = $_POST['idproduk'] ?? '';

    $delete = mysqli_query($conn, "DELETE FROM produk WHERE idproduk='$idproduk'");

    if ($delete) {
        echo "<script>alert('Data berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}

if(isset($_POST['addnewtransaction'])){
    $idtransaksi = $_POST['idtransaksi'];
    $idproduk = $_POST['idproduk'];
    $idkategori = $_POST['idkategori'];
    $kuantitas = $_POST['kuantitas'];
    $tanggal = $_POST['tanggal'];

    $addtotable = mysqli_query($conn,"INSERT INTO transaction (idtransaksi, idproduk, idkategori, kuantitas, tanggal) values ('$idtransaksi','$idproduk','$idkategori','$kuantitas','$tanggal')");
    if($addtotable){
        header('location:transaksi.php');
    } else {
        echo 'Input Gagal';
        header('location:transaksi.php');
    }
}

?>