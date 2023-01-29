<?php

require '../koneksi.php';
require '../function.php';

$id = $_GET["id"];
$quantitytoadd = $_GET["jumlah"];
$sql = "SELECT * FROM catalog WHERE id =" . $id;
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_object($query);


$_SESSION["cart"][$id] = [
    "nama" => $data->nama,
    "harga" => $data->harga,
    "jumlah" =>  1

];






header("Location:../cart.php");
