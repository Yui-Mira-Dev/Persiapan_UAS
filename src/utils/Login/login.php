<?php
session_start();

// Periksa apakah pengguna sudah login
if (isset($_SESSION['user'])) {
    // Alihkan pengguna ke halaman yang sesuai berdasarkan peran mereka
    if ($_SESSION['role'] == 'admin') {
        header('Location: ../../page/home_admin.php');
        exit;
    } else {
        header('Location: ../../page/home.php');
        exit;
    }
}

// Periksa apakah form login telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi kredensial login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Baca data registrasi dari file
    $file = fopen('registration_data.txt', 'r');
    $validLogin = false;
    $role = '';

    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        $credentials = explode(", ", $line);
        $storedUsername = explode(": ", $credentials[0])[1];
        $storedPassword = explode(": ", $credentials[1])[1];
        $storedRole = explode(": ", $credentials[2])[1];

        // Periksa apakah kredensial yang dimasukkan cocok dengan data yang tersimpan
        if ($username === $storedUsername && $password === $storedPassword) {
            $validLogin = true;
            $role = $storedRole;
            break;
        }
    }

    fclose($file);

    if ($validLogin) {
        // Tetapkan variabel sesi
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $role;

        // Alihkan pengguna ke halaman yang sesuai berdasarkan peran mereka
        if ($role == 'admin') {
            header('Location: ../../page/home_admin.php');
            exit;
        } else {
            header('Location: ../../page/home.php');
            exit;
        }
    } else {
        // Tampilkan pesan kesalahan untuk kredensial yang tidak valid
        $error = "Username atau password tidak valid";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
</head>
<body>
    <h2>Form Login</h2>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username"><br><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
