<?php
session_start(); // Memulai sesi PHP. Diperlukan untuk mengakses atau menyimpan data sesi pengguna.
session_destroy(); // Menghancurkan semua data sesi yang tersimpan. Penggunaan ini menghapus data sesi dari server.
header('location:login.php'); // Mengarahkan pengguna ke halaman login.php setelah sesi dihancurkan.
