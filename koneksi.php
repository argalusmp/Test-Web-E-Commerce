 <?php

  if (!isset($_SESSION)) {
    session_start();
  }

  //DEKLARASIIN VARIABEL
  // $host = "sql311.epizy.com";
  // $user = "epiz_32171582";
  // $pass = 'YFzFE1bDQI';
  // $database = "epiz_32171582_ecommerce";
  //Deklarasi Variabel 
  $host = "localhost";
  $user = "root";
  $pass = '';
  $database = "e_commerce";

  //Connect
  $conn = mysqli_connect($host, $user, $pass, $database);

  if (mysqli_connect_errno()) {
    echo "KONEKSI GAGAL : " . mysqli_connect_error();
  }


  ?> 