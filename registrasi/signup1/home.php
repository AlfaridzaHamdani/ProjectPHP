<?php
session_start(); // Memulai sesi PHP. Diperlukan untuk mengakses data sesi pengguna.

// Memeriksa apakah pengguna sudah login. Jika tidak, redirect ke halaman login.php.
if (!isset($_SESSION["username"])) {
    header("location:login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Welcome Page</title>
</head>

<body>
    <!-- Menampilkan pesan selamat datang dengan nama pengguna dari data sesi -->
    <h1 class="text-center text-warning mt-5">Welcome <?php echo $_SESSION["username"]; ?></h1>

    <div class="container">
        <!-- Tombol logout yang mengarahkan pengguna ke halaman logout.php saat diklik -->
        <a href="logout.php" class="btn btn-primary mt-5">Logout</a>
    </div>

</body>

</html>