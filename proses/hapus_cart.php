<?php
require '../koneksi.php';
require '../function.php';

$id = $_GET["id"];
unset($_SESSION["cart"][$id]);



header("Location:../cart.php");
