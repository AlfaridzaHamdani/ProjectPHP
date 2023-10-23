<?php
$HOSTNAME = 'localhost'; // Nama host MySQL (biasanya 'localhost' jika berjalan secara lokal)
$USERNAME = 'root'; // Nama pengguna MySQL
$PASSWORD = '280105'; // Kata sandi pengguna MySQL
$DATABASE = 'signupforms'; // Nama basis data yang ingin diakses

// Membuat koneksi ke database menggunakan fungsi mysqli_connect
$con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

// Memeriksa apakah koneksi berhasil. Jika gagal, tampilkan pesan error dan hentikan eksekusi skrip.
if (!$con) {
    die(mysqli_connect_error()); // mysqli_connect_error() memberikan pesan error koneksi MySQL terakhir
}
