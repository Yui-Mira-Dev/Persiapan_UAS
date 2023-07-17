<?php
// Check if the registration form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data registrasi dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Di sini, Anda dapat melakukan validasi tambahan dan sanitasi data

    // Simpan data registrasi dan peran ke dalam file lokal
    $file = fopen('registration_data.txt', 'a');
    $data = "Username: " . $username . ", Password: " . $password . ", Role: member" . PHP_EOL;
    fwrite($file, $data);
    fclose($file);

    // Alihkan pengguna ke halaman login setelah registrasi berhasil
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Registrasi</title>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username"><br><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
