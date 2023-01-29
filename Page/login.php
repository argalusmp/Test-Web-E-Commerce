<?php

session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


require 'koneksi.php';
require 'function.php';



if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if (mysqli_num_rows($result) == 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (
            password_verify($password, $row["password"])
        ) {

            //Cek session
            $_SESSION["login"] = true;

            header("Location: tambah.php");
            exit;
        }
    }

    $error = true;
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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


    <style>
        /* login-box */
        .form-container {
            background: linear-gradient(#e9374c, #d31128);
            font-family: "Roboto", sans-serif;
            font-size: 0;
            padding: 0 15px;
            margin-top: 20px;
            border: 1px solid #dc2036;
            border-radius: 15px;
            box-shadow: 10px 10px 20px #e9374c;
        }

        .form-container .form-icon {
            color: #fff;
            font-size: 13px;
            text-align: center;
            text-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 50%;
            padding: 70px 0;
            vertical-align: top;
            display: inline-block;
        }

        .form-container .form-icon i {
            font-size: 124px;
            margin: 0 0 15px;
            display: block;
        }

        .form-container .form-icon .signup a {
            color: #fff;
            text-transform: capitalize;
            transition: all 0.3s ease;
        }

        .form-container .form-icon .signup a:hover {
            text-decoration: underline;
        }

        .form-container .form-horizontal {
            background: rgba(255, 255, 255, 0.99);
            width: 50%;
            padding: 60px 30px;
            margin: -10px 0;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            display: inline-block;
        }

        .form-container .title {
            color: #454545;
            font-size: 23px;
            font-weight: 900;
            text-align: center;
            text-transform: capitalize;
            letter-spacing: 0.5px;
            margin: 0 0 30px 0;
        }

        .form-horizontal .form-group {
            background-color: rgba(255, 255, 255, 0.15);
            margin: 0 0 15px;
            border: 1px solid #b5b5b5;
            border-radius: 20px;
        }

        .form-horizontal .input-icon {
            color: #b5b5b5;
            font-size: 15px;
            text-align: center;
            line-height: 38px;
            height: 35px;
            width: 40px;
            vertical-align: top;
            display: inline-block;
        }

        .form-horizontal .form-control {
            color: black;
            background-color: transparent;
            font-size: 14px;
            letter-spacing: 1px;
            width: calc(100% - 55px);
            height: 33px;
            padding: 2px 10px 0 0;
            box-shadow: none;
            border: none;
            border-radius: 0;
            display: inline-block;
            transition: all 0.3s;
        }

        .form-horizontal .form-control:focus {
            box-shadow: none;
            border: none;
        }

        .form-horizontal .form-control::placeholder {
            color: #b5b5b5;
            font-size: 13px;
            text-transform: capitalize;
        }

        .form-horizontal .btn {
            color: rgba(255, 255, 255, 0.8);
            background: #e9374c;
            font-size: 15px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            margin: 0 0 10px 0;
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .form-horizontal .btn:hover,
        .form-horizontal .btn:focus {
            color: #fff;
            background-color: #d31128;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .form-horizontal .forgot-pass {
            font-size: 12px;
            text-align: center;
            display: block;
        }

        .form-horizontal .forgot-pass a {
            color: #999;
            transition: all 0.3s ease;
        }

        .form-horizontal .forgot-pass a:hover {
            color: #777;
            text-decoration: underline;
        }

        @media only screen and (max-width: 576px) {
            .form-container {
                padding-bottom: 15px;
            }

            .form-container .form-icon {
                width: 100%;
                padding: 20px 0;
            }

            .form-container .form-horizontal {
                width: 100%;
                margin: 0;
            }
        }

        /* close login */
    </style>
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
                </ul>

            </div>
        </div>
    </nav>
    <!-- ----------Close NavBar-------- -->
    <div class="form-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8">
                    <div class="form-container">
                        <div class="form-icon">
                            <i class="fa fa-user-circle"></i>
                            <span class="signup"><a href="registrasi.php">Don't have account? Signup</a></span>
                        </div>
                        <form class="form-horizontal" action="" method="POST">
                            <h3 class="title">Member Login</h3>
                            <?php if (isset($error)) : ?>
                                <p style="color: red; font-style:italic;font-size:12px" class="title"> Username / Password salah</p>

                            <?php endif; ?>
                            <div class="form-group">

                                <span class="input-icon"><i class="fa-solid fa-user-secret"></i></span>
                                <label for="username" class="form-control-label">USERNAME</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <span class="input-icon"><i class="fa fa-lock"></i></span>
                                <label for="password" class="form-control-label">PASSWORD</label>
                                <input type="password" name="password" id="password" class="form-control" require placeholder="password">
                            </div>
                            <button name="login" class="btn signin">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>