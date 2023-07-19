<?php
session_start();

// Periksa apakah pengguna sudah login
if (isset($_SESSION['user'])) {
    // Alihkan pengguna ke halaman yang sesuai berdasarkan peran mereka
    if ($_SESSION['role'] == 'admin' && !isset($_SESSION['redirected'])) {
        $_SESSION['redirected'] = true;
        header('Location: home_admin.php');
        exit;
    } elseif ($_SESSION['role'] == 'member' && !isset($_SESSION['redirected'])) {
        $_SESSION['redirected'] = true;
        header('Location: home.php');
        exit;
    }
}

// Periksa apakah form login telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi kredensial login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Baca data registrasi dari file
    $file = fopen('../utils/login/registration_data.txt', 'r');
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

    if ($validLogin) {
        if (isset($_SESSION['user']) && $_SESSION['user'] !== $username) {
            $welcomeMessage = "Selamat datang, " . $username . "!";
        } else {
            $welcomeMessage = "Selamat datang kembali, " . $username . "!";
        }
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['redirected'] = true;

        if ($role == 'admin') {
            header('Location: home_admin.php');
        } elseif ($role == 'member') {
            header('Location: home.php');
        }
        exit;
    } else {
        echo "Invalid username or password. Please try again.";
    }
}

$username = isset($_SESSION['user']) ? $_SESSION['user'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Member</title>
    <script>
        window.onload = function() {
            var username = "<?php echo $username; ?>";
            var welcomeMessage = "";

            if (username !== "") {
                <?php if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user'] !== $username)) : ?>
                    welcomeMessage = "Selamat datang, " + username + "!";
                <?php else : ?>
                    welcomeMessage = "Selamat datang kembali, " + username + "!";
                <?php endif; ?>
                alert(welcomeMessage);
            }
        };
    </script>
</head>
<body>
    <?php if ($username): ?>
        <h2>Selamat datang, <?php echo $username; ?>!</h2>
        <p>Ini adalah halaman member.</p>
        <a href="../utils/login/logout.php">Logout</a>
    <?php else: ?>
        <h2>Warning!</h2>
        <p>Please login to access this page.</p>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <input type="submit" value="Login">
        </form>
    <?php endif; ?>
</body>
</html>
