<?php

session_start();



if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "koneksi.php";
require "function.php";



if (isset($_POST["submit"])) {



    // Cek apakah data berhasil di tambahkan / tidak
    if (tambah($_POST) > 0) {
        echo "<script> 
                alert('Data Berhasil Ditambahkan');
                document.location.href = 'tambah.php';
                </script>
                ";
    } else {
        echo "<script> 
        alert('Data Gagal Ditambahkan');
        document.location.href = 'tambah.php';
        </script>";
    }
}



// Ambil data dari table ecommcer / query 
$data = query("SELECT * FROM catalog");


// Tombol Search 
if (isset($_POST["search"])) {
    $data = search($_POST["keyword"]);
}

//Pagination
//konfigurasi
$jumlahCatalogPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM catalog"));
$jumlahHalaman = ceil($jumlahData / $jumlahCatalogPerHalaman);

$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahCatalogPerHalaman * $halamanAktif) - $jumlahCatalogPerHalaman;

// $data = query("SELECT * FROM catalog LIMIT $awalData, $jumlahCatalogPerHalaman");




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link rel="shortcut icon" href="image/logo himatik.png" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://kit.fontawesome.com/a543fba6bd.js" crossorigin="anonymous"></script>


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
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tambah.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="logut.php">Logout</a>
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
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <h5>Tambah Catalog</h5>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Catalog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td><label for="nama">Nama Barang </label></td>
                                    <td><input type="text" name="nama" id="nama" placeholder="Nama Barang" require autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <td><label for="kategori">Kategori Barang </label></td>
                                    <td><input type="text" name="kategori" id="kategori" placeholder="Kategori" require></td>
                                </tr>
                                <tr>
                                    <td><label for="harga">Harga Rp </label></td>
                                    <td><input type="text" name="harga" id="harga" require></td>
                                </tr>
                                <tr>
                                    <td><label for="deskripsi">Deskripsi</label></td>
                                    <td><textarea name="deskripsi" id="deskripsi" placeholder="deskripsi" require></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="gambar">Gambar Produk </label></td>
                                    <td><input type="file" name="gambar" id="gambar">
                                    </td>
                                </tr>


                                <tr>
                                    <td><button type="button" class="btn btn-outline-success" name="submit" require>Tambah</button></td>
                                </tr>
                                <tr>
                                <td>
                                    <p style="font-size: 8px;color:darkorange">Rekomendasi 500 x 500 pixel</p>
                                </td>
                                </tr>
                            </table>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Card Content -->
        <div class="card_catalog">

            <table class="table table-light table-responsive table-sm  table-hover">
                <thead class="table-success">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Action</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data as $row) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><a href="edit.php?id=<?= $row["id"]; ?>"><i class="fas fa-edit"></i></a> | <a href="hapus.php?id=<?= $row["id"]; ?> " onclick="return confirm('Are You Sure?');"><i class="fa-regular fa-trash-can"></i></a></td>
                            <td><?= $row["nama"]; ?></td>
                            <td><?= $row["kategori"]; ?></td>
                            <td><?= $row["harga"]; ?></td>
                            <td> <img src="image/<?= $row["gambar"]; ?> " width="50px" height="50px"> </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>


        <!-- pagination -->
        <div class="pagination1">
            <div class="page_number">
                <?php if ($halamanAktif > 1) : ?>
                    <a href="?halaman=<?= $halamanAktif - 1; ?>">&lt;</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                    <?php if ($i == $halamanAktif) : ?>
                        <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                        <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                    <a href="?halaman=<?= $halamanAktif + 1; ?>">&gt;</a>
                <?php endif; ?>
            </div>
        </div>



    </div>
    <!-- Close Card Content -->



    <script src="script.js">

    </script>
</body>

</html>