<?php
//Menghubungkan koneksi
require "koneksi.php";
require "function.php";

// Ambil data dari table ecommcer / query 
$data = query("SELECT * FROM catalog");

//Pagination
//konfigurasi
$jumlahCatalogPerHalaman = 9;
$jumlahData = count(query("SELECT * FROM catalog"));
$jumlahHalaman = ceil($jumlahData / $jumlahCatalogPerHalaman);

$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahCatalogPerHalaman * $halamanAktif) - $jumlahCatalogPerHalaman;

$data = query("SELECT * FROM catalog LIMIT $awalData, $jumlahCatalogPerHalaman");


// Tombol Search 
if (isset($_POST["search"])) {
    $data = search($_POST["keyword"]);
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
    <title >Blotters</title>
    <link rel="shortcut icon" href="image/logo himatik.png" />

    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


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
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambah.php">Admin</a>
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

        <!-- ------ SlideSHow----- ------>
        <div id="carouselExampleIndicators" class="carousel carousel-dark slide " data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button " data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner w-50 mx-auto ">
                <div class="carousel-item active ">
                    <img src="image/mouse-logitech.png" class="d-block w-100 " alt="">
                </div>
                <div class="carousel-item">
                    <img src="image/Keyboar-dragon.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="image/JBL-Headset.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <!----------- Close SlideShow------- -->

        <!-- Card Content -->
        <div class="card_content">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($data as $row) : ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="image/<?= $row["gambar"]; ?>" class="card-img-top img-fluid " alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["nama"]; ?></h5>
                                <p class="card-text"><?= $row["deskripsi"]; ?></p>
                            </div>
                            <div class="card-footer" style="justify-content:space-between; display:flex; ">
                                <div class="harga">
                                    <h6>Rp.<?= $row["harga"]; ?></h6>
                                </div>
                                <a href="proses/tambah_cart.php?id=<?= $row["id"]; ?>">
                                    <button class="button-cart">
                                        <img src="image/shooping-cart.png" alt="">
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <!-- Close Card Content -->


        <!---Pagination---->
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

    <!-- CLose Pembungkus Content -->

    <!-- foooter -->
    <footer class="text-center text-white" style="background-color: #c2d9e8 ;">
        <!-- Grid container -->
        <div class="about">
            <div class="deskripsi">
                <h3>About</h3>
                <p>Hi, This is one of the results of my simple web project. This project is a simple project catalog that I built using HTML, CSS, assisted with Bootstrap and also using PHP. This website is still in dire need of development. Thanks</p>
            </div>
            <div class="more">
                <h3>Info</h3>
                <ul>
                    <li><a href="aboutme.html" target="_blank">About Us</a></li>
                </ul>
            </div>

        </div>
        <hr style="color:black;width:50%;text-align:center;margin-left:auto;margin-right:auto;">
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
                <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998;" href="https://www.instagram.com/vidim_159" target="_blank" role="button"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac;" href="#!" role="button"><i class="fab fa-facebook"></i></a>
                <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="#!" role="button"><i class="fab fa-github"></i></a>
                <a class="btn btn-primary btn-floating m-1" style="background-color: #ac8bca;" href="#!" role="button"><i class="fab fa-spotify"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: #000;">
            © 2020 Copyright
        </div>
        <!-- Copyright -->
    </footer>




    <script src="script.js">

    </script>
</body>

</html>