<?php
require '../koneksi.php';
require "../function.php";



$sql = "INSERT INTO riwayat_transaksi (tanggal_transaksi) VALUES ('" . date("Y-m-d") . "')";

$query = mysqli_query($conn, $sql);
$id_riwayat_transaksi = mysqli_insert_id($conn);

foreach ($_SESSION["cart"] as $cart => $val) {
    $sql = "INSERT INTO detail_transaksi(`id_riwayat_transaksi`,`id_produk`,`jumlah`) VALUES(" . $id_riwayat_transaksi . "," . $cart . "," . $val["jumlah"] . ")";

    $query = mysqli_query($conn, $sql);
}

if ($_SESSION["cart"] > 1) {
    echo "<script> 
                alert('Data Berhasil Diubah');
                </script>
                ";
    unset($_SESSION["cart"]);
}

header("Location:../cart.php");
