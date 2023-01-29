<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'koneksi.php';
require 'function.php';


$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "<script> 
                alert('Data Berhasil Dihapus');
                document.location.href = 'tambah.php';
                </script>
                ";
} else {
    echo "<script> 
                alert('Data gagal dihapus');
                document.location.href = 'tambah.php';
                </script>
                ";
}
