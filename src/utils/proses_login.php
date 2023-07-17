<?php
// Data pengguna yang telah didaftarkan
$registeredUsers = array(
    array('username' => 'admin', 'password' => 'admin'),
    // Tambahkan pengguna lain di sini
);

// Tangani permintaan POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Terima data yang dikirimkan melalui form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cek kecocokan username dan password dengan data yang didaftarkan
    $isMatch = false;
    foreach ($registeredUsers as $user) {
        if ($user['username'] == $username && $user['password'] == $password) {
            $isMatch = true;
            break;
        }
    }

    if ($isMatch) {
        // Login berhasil, alihkan ke halaman beranda
        header("Location: ../page/home.php");
        exit();
    } else {
        // Tampilkan pesan kesalahan menggunakan JavaScript
        echo '<script>alert("Username atau password salah! username:admin password: admin"); window.location.href = "../../index.php";</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>