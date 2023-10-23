<?php
$success = 0; // Inisialisasi variabel $success dengan nilai 0, menandakan registrasi belum berhasil
$user = 0;    // Inisialisasi variabel $user dengan nilai 0, menandakan pengguna belum terdaftar

// Memeriksa apakah metode permintaan adalah POST (data formulir telah dikirim)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php'; // Mengimpor file koneksi database

    // Mengambil nilai username dan password dari formulir yang dikirim
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengecek apakah pengguna dengan username yang sama sudah terdaftar dalam database
    $sql = "SELECT * FROM `registrasi` WHERE username = '$username'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            // Jika pengguna sudah terdaftar, set variabel $user menjadi 1
            $user = 1;
        } else {
            // Jika pengguna belum terdaftar, lakukan operasi registrasi
            $sql = "INSERT INTO `registrasi` (`username`, `password`) VALUES ('$username', '$password')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                // Jika registrasi berhasil, set variabel $success menjadi 1 dan redirect ke halaman login
                $success = 1;
                header('location:login.php');
            } else {
                // Jika registrasi gagal, hentikan eksekusi skrip dan tampilkan pesan error database
                die(mysqli_error($con));
            }
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

    <title>Signup Page</title>
</head>

<body>
    <?php
    // Menampilkan pesan kesalahan jika variabel $user bernilai 1 (pengguna sudah terdaftar)
    if ($user) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Oh no sorry</strong> User already exist
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    // Menampilkan pesan sukses jika variabel $success bernilai 1 (registrasi berhasil)
    if ($success) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong> You are successfully signed up.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
    ?>

    <h1 class="text-center">Sign Up page</h1>
    <div class="container mt-5">
        <!-- Formulir registrasi -->
        <form action="sign.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your username" name="username">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>
    </div>

</body>

</html>
