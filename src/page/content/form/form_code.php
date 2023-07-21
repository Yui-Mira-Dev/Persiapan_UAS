<?php
$npm = $namaLengkap = $tempatLahir = $tanggalLahir = $agama = $angkatan = $email = $jurusan = $jenisKelamin = $hobby = $alamat = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $npm = $_POST['npm'];
    $namaLengkap = $_POST['nama_lengkap'];
    $tempatLahir = $_POST['tempat_lahir'];
    $tanggalLahir = $_POST['tanggal_lahir'];
    $agama = $_POST['agama'];
    $angkatan = $_POST['angkatan'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];
    $jenisKelamin = $_POST['jenis_kelamin'];
    $hobby = isset($_POST['hobby']) ? $_POST['hobby'] : [];
    $alamat = $_POST['alamat'];

    $errors = [];

    if (empty($npm)) {
        $errors[] = 'NPM harus diisi.';
    }

    if (empty($namaLengkap)) {
        $errors[] = 'Nama Lengkap harus diisi.';
    }

    if (empty($tempatLahir)) {
        $errors[] = 'Tempat Lahir harus diisi.';
    }

    if (empty($tanggalLahir)) {
        $errors[] = 'Tanggal Lahir harus diisi.';
    }

    if (empty($agama)) {
        $errors[] = 'Agama harus diisi.';
    }

    if (empty($email)) {
        $errors[] = 'Email harus diisi.';
    }

    if (empty($jurusan)) {
        $errors[] = 'Jurusan harus diisi.';
    }

    if (empty($jenisKelamin)) {
        $errors[] = 'Jenis Kelamin harus dipilih.';
    }

    if (empty($hobby) && empty($_POST['hobby_manual'])) {
        $errors[] = 'Hobby harus dipilih.';
    }

    if (empty($alamat)) {
        $errors[] = 'Alamat harus diisi.';
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<div class="error">' . $error . '</div>';
        }
    } else {
        $_SESSION['npm'] = $npm;
        $_SESSION['namaLengkap'] = $namaLengkap;
        $_SESSION['tempatLahir'] = $tempatLahir;
        $_SESSION['tanggalLahir'] = $tanggalLahir;
        $_SESSION['agama'] = $agama;
        $_SESSION['angkatan'] = $angkatan;
        $_SESSION['email'] = $email;
        $_SESSION['jurusan'] = $jurusan;
        $_SESSION['jenisKelamin'] = $jenisKelamin;
        $_SESSION['hobby'] = $hobby;
        $_SESSION['alamat'] = $alamat;

        header("Location: home");
        exit();
    }
}

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