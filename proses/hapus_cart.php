<?php
require '../Page/koneksi.php';
require '../Page/function.php';

$id = $_GET["id"];
unset($_SESSION["cart"][$id]);



header("Location:../cart.php");
