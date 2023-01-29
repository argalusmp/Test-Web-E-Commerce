<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}



require 'koneksi.php';
require 'function.php';

//ambil data di URL
$id = $_GET["id"];

//query data berdasarkan id
$data = query("SELECT * FROM catalog WHERE id = $id")[0];

if (isset($_POST["submit"])) {

    // Cek apakah data berhasil di diubah / tidak
    if (ubah($_POST) > 0) {
        echo "<script> 
                alert('Data Berhasil Diubah');
                document.location.href = 'tambah.php';
                </script>
                ";
    } else {
        echo "<script> 
        alert('Data Gagal Diubah');
        document.location.href = 'tambah.php';
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Bootstrap -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</head>

<body>
    <!----------------  Membuat NavBar ------------->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Blotters</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambah.php">Catalog</a>
                    </li>

                </ul>
                <form class="d-flex" role="search" action="" method="post">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword" autocomplete="off">

                    <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                </form>

            </div>
        </div>
    </nav>
    <!-- ----------Close NavBar-------- -->
    <!-- Pembungkus Content -->
    <div class="container-all">

        <h1>Edit Catalog</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?= $data["id"]; ?>">
                    </td>
                    <td><input type="hidden" name="gambarLama" value="<?= $data["gambar"]; ?>"></td>
                </tr>

                <tr>
                    <td><label for="nama">Nama Barang </label></td>
                    <td><input type="text" name="nama" id="nama" placeholder="Nama Barang" require autocomplete="off" value="<?= $data["nama"]; ?>"></td>
                </tr>
                <tr>
                    <td><label for="kategori">Kategori Barang </label></td>
                    <td><input type="text" name="kategori" id="kategori" placeholder="Kategori" require value="<?= $data["kategori"]; ?>"></td>
                </tr>
                <tr>
                    <td><label for="deskripsi">Deskripsi </label></td>
                    <td><textarea name="deskripsi" id="deskripsi" placeholder="deskripsi" require value="<?= $data["deskripsi"]; ?>"> </textarea></td>
                </tr>
                <tr>
                    <td><label for="harga">Harga Rp</label></td>
                    <td><input type="text" name="harga" id="harga" placeholder="harga" require value="<?= $data["harga"]; ?>"></td>
                </tr>
                <tr>
                    <td><label for="gambar">Gambar Produk </label></td>
                    <td><img src="image/<?= $data['gambar']; ?>" width="45px" height="45px"></td>
                    <td><input type="file" name="gambar" id="gambar">
                    </td>

                </tr>
                <tr>
                    <td><button type="submit" name="submit" require>Ubah</button></td>
                </tr>
            </table>

        </form><br>





    </div>
    <!-- Close Card Content -->



    <script src="script.js">

    </script>
</body>

</html>