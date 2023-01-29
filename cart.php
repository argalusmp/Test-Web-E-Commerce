<?php

require "koneksi.php";
require "function.php";




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

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
                        <a class="nav-link active" aria-current="page" href="cart.php">Cart</a>
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
    <a href="index.php"> Ayo Tambah Produk Ke Keranjang</a><br>

    <div class="keranjang_belanja">
        <?php
        if (!empty($_SESSION["cart"])) {
        ?>
            <table class="table table-bordered table-responsive table-sm">
                <thead class="table-success">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $total = 0;
                    foreach ($_SESSION["cart"] as $cart => $val) {
                        $subtotal = $val["harga"] * $val["jumlah"];
                    ?>
                        <tr>
                            <td scope="row"><?php echo $no++; ?></td>
                            <td><?php echo $val["nama"]; ?></td>
                            <td><?php echo $val["harga"]; ?></td>
                            <td><?php echo $val["jumlah"]; ?></td>
                            <td><?php echo $subtotal; ?></td>
                            <td>
                                <a href="proses/hapus_cart.php?id=<?php echo $cart ?>">Batal</a>
                            </td>
                        </tr>
                    <?php
                        $total += $subtotal;
                    }
                    ?>

                    <tr>
                        <th colspan="5">Total</th>
                        <th colspan="2"><?php echo $total ?></th>
                    </tr>
                </tbody>
            </table>

            <a href="proses/tambah_transaksi.php"><button class="button-cart" type="submit" name="submit">Beli </button></a>
        <?php

        } else {
            echo "Produk belum ada di keranjang";
        }
        ?>
    </div>

</body>

</html>