<?php
// Data pengguna yang telah didaftarkan
$registeredUsers = array();

// Tangani permintaan POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Terima data yang dikirimkan melalui form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cek apakah username sudah ada
    $isUsernameExists = false;
    foreach ($registeredUsers as $user) {
        if ($user['username'] == $username) {
            $isUsernameExists = true;
            break;
        }
    }

    if ($isUsernameExists) {
        // Username sudah ada, tampilkan pesan kesalahan
        echo '<script>alert("Username sudah terdaftar!");</script>';
    } else {
        // Tambahkan username dan password ke dalam array pengguna terdaftar
        $newUser = array('username' => $username, 'password' => $password);
        $registeredUsers[] = $newUser;

        // Tampilkan pesan berhasil
        echo '<script>alert("Registrasi berhasil!");</script>';

        // Alihkan ke halaman login
        header("Location: ../../index.php");
        exit();
    }
}
?>
