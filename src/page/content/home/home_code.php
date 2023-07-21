<?php
// yg punya home1
if (
    isset($_SESSION['npm']) &&
    isset($_SESSION['namaLengkap']) &&
    isset($_SESSION['tempatLahir']) &&
    isset($_SESSION['tanggalLahir']) &&
    isset($_SESSION['agama']) &&
    isset($_SESSION['angkatan']) &&
    isset($_SESSION['email']) &&
    isset($_SESSION['jurusan']) &&
    isset($_SESSION['jenisKelamin']) &&
    isset($_SESSION['hobby']) &&
    isset($_SESSION['alamat'])
) {
    $npm = $_SESSION['npm'];
    $namaLengkap = $_SESSION['namaLengkap'];
    $tempatLahir = $_SESSION['tempatLahir'];
    $tanggalLahir = $_SESSION['tanggalLahir'];
    $agama = $_SESSION['agama'];
    $angkatan = $_SESSION['angkatan'];
    $email = $_SESSION['email'];
    $jurusan = $_SESSION['jurusan'];
    $jenisKelamin = $_SESSION['jenisKelamin'];
    $hobby = $_SESSION['hobby'];
    $alamat = $_SESSION['alamat'];
} else {
    $npm = $namaLengkap = $tempatLahir = $tanggalLahir = $agama = $angkatan = $email = $jurusan = $jenisKelamin = $hobby = $alamat = '';
}

if (isset($_POST['hapus_data'])) {
    // Unset specific session variables
    unset($_SESSION['npm']);
    unset($_SESSION['namaLengkap']);
    unset($_SESSION['tempatLahir']);
    unset($_SESSION['tanggalLahir']);
    unset($_SESSION['agama']);
    unset($_SESSION['angkatan']);
    unset($_SESSION['email']);
    unset($_SESSION['jurusan']);
    unset($_SESSION['jenisKelamin']);
    unset($_SESSION['hobby']);
    unset($_SESSION['alamat']);

    header("Location: home");
    exit();
}

// end

if (isset($_SESSION['user'])) {
    if ($_SESSION['role'] == 'admin' && !isset($_SESSION['redirected'])) {
        $_SESSION['redirected'] = true;
        header('Location: home');
        exit;
    } elseif ($_SESSION['role'] == 'member' && !isset($_SESSION['redirected'])) {
        $_SESSION['redirected'] = true;
        header('Location: home');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $file = fopen('secret/locked/admin/data/registration_data', 'r');
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
            header('Location: home');
        } elseif ($role == 'member') {
            header('Location: home');
        }
        exit;
    } else {
        echo "Nama pengguna atau kata sandi salah. Silakan coba lagi.";
    }
}

$username = isset($_SESSION['user']) ? $_SESSION['user'] : '';
?>