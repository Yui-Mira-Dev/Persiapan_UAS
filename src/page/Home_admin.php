<?php
session_start();

if (isset($_SESSION['user'])) {
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $file = fopen('../utils/login/registration_data.txt', 'r');
    $validLogin = false;
    $role = '';

    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        $credentials = explode(", ", $line);
        $storedUsername = explode(": ", $credentials[0])[1];
        $storedPassword = explode(": ", $credentials[1])[1];
        $storedRole = explode(": ", $credentials[2])[1];

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
    <title>Halaman Admin</title>
    <script>
        window.onload = function() {
            if (performance.navigation.type !== 1) {
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
            }
        };
    </script>
</head>
<body>
    <?php if ($username && $_SESSION['role'] === 'admin') : ?>
        <h2>Selamat datang, <?php echo $username; ?>!</h2>
        <p>Ini adalah halaman Admin.</p>
        <a href="../utils/login/logout.php">Logout</a>
    <?php elseif ($username && $_SESSION['role'] === 'member') : ?>
        <h2>Warning!</h2>
        <p>Anda tidak memiliki akses ke halaman ini.</p>
        <a href="../utils/login/logout.php">Logout</a>
    <?php else : ?>
        <h2>Warning!</h2>
        <p>Anda tidak memiliki akses ke halaman ini.</p>
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
