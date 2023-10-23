<?php
$login = 0; // Variabel untuk menandai apakah login berhasil
$invalid = 0; // Variabel untuk menandai apakah informasi login tidak valid

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php'; // Mengimpor file koneksi database
    $username = mysqli_real_escape_string($con, $_POST['username']); // Menghindari serangan SQL injection dengan membersihkan input username
    $password = mysqli_real_escape_string($con, $_POST['password']); // Menghindari serangan SQL injection dengan membersihkan input password

    // Membuat query SQL untuk memeriksa keberadaan pengguna dengan username dan password yang sesuai
    $sql = "SELECT * FROM `registrasi` WHERE `username` = '$username' AND `password` = '$password'";

    $result = mysqli_query($con, $sql); // Menjalankan query

    if ($result) {
        $num = mysqli_num_rows($result); // Mendapatkan jumlah baris hasil query
        if ($num > 0) {
            // Jika pengguna ditemukan, set variabel $login menjadi 1, mulai sesi, dan arahkan ke halaman home.php
            $login = 1;
            session_start(); // Memulai sesi PHP
            $_SESSION["username"] = $username; // Menyimpan nama pengguna dalam sesi
            header('location:home.php'); // Mengarahkan pengguna ke halaman home.php
        } else {
            // Jika pengguna tidak ditemukan, set variabel $invalid menjadi 1
            $invalid = 1;
        }
    } else {
        // Jika query tidak berhasil, hentikan eksekusi skrip dan tampilkan pesan error database
        die(mysqli_error($con));
    }
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

    <title>Login Page</title>
</head>

<body>
    <?php
    // Menampilkan pesan kesalahan jika variabel $invalid bernilai 1 (informasi login tidak valid)
    if ($invalid) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error</strong> Invalid.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    // Menampilkan pesan sukses jika variabel $login bernilai 1 (login berhasil)
    if ($login) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong> You are successfully logged in.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
    ?>

    <h1 class="text-center">Login to our website</h1>
    <div class="container mt-5">
        <!-- Formulir login -->
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your username" name="username">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>

</html>
