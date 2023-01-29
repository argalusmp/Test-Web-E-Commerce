<?php
//Menghubungkan koneksi
require "koneksi.php";

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);

    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }



    // query insert data 

    $query = "INSERT INTO catalog VALUES
     ( '','$nama','$kategori','$deskripsi','$harga','$gambar')";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];



    //cek apakah ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    //cek apakah yang diupload gambar
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
    $esktensiGambar = explode('.', $namaFile);
    $esktensiGambar = strtolower(end($esktensiGambar));
    if (!in_array($esktensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Anda mengupload bukan gambar');
            </script>";
        return false;
    }

    //Ukuran gambar
    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('Ukuran Gambar Terlalu Besar');
            </script>";
        return false;
    }

    //Gambar yang siap diupload
    //Generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $esktensiGambar;
    move_uploaded_file($tmpName, 'image/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM catalog WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // query insert data 

    $query = "UPDATE `catalog` SET 
                nama = '$nama',
                kategori = '$kategori',           
                harga = '$harga',
                deskripsi = '$deskripsi',
                gambar = '$gambar'
                WHERE id = '$id'
                ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $query = "SELECT * FROM catalog
                WHERE
                nama LIKE '%$keyword%' OR
                kategori LIKE '%$keyword%'
                ";

    return query($query);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    //Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah ada')
        </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai')
        </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    //tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username' , '$password') ");

    return mysqli_affected_rows($conn);
}
