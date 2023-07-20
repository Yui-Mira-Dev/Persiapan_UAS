<?php
session_start();

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
        header('Location: admin');
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
            header('Location: admin');
        } elseif ($role == 'member') {
            header('Location: home');
        }
        exit;
    } else {
        echo "Invalid username or password. Please try again.";
    }
}

$username = isset($_SESSION['user']) ? $_SESSION['user'] : '';
?>

<section>
    <?php if ($username): ?>
        <main style="overflow: auto;">
        <section id="about">
            <div class="container text-center text-justify mt-3">
                <div class="border-bottom">
                    <h3 class="">Pengisian Data</h3>
                </div>
                <div class="info-list justify-content-center row row-cols-xxl-3 row-cols-xl-2 row-cols-1 mt-3">
                    <div class="col mt-3">
                        <h5>Personal Information</h5>
                        <form method="POST" action="">
                            <div class="info-list-row">
                                <div class="category">NPM</div>
                                <input type="text" name="npm" class="detail" value="<?php echo $npm; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Nama Lengkap</div>
                                <input type="text" name="nama_lengkap" class="detail" value="<?php echo $namaLengkap; ?>" />
                            </div>
                            <div class="info-list-row">
                            <div class="category">Email</div>
                                <input type="email" name="email" class="detail" value="<?php echo $email; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Tempat Lahir</div>
                                <input type="text" name="tempat_lahir" class="detail" value="<?php echo $tempatLahir; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Tanggal Lahir</div>
                                <input type="date" name="tanggal_lahir" class="detail" value="<?php echo $tanggalLahir; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Agama</div>
                                <input type="text" name="agama" class="detail" value="<?php echo $agama; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Jurusan</div>
                                <select name="jurusan" class="detail">
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="Manajemen Informatika" <?php echo $jurusan === 'Manajemen Informatika' ? 'selected' : ''; ?>>Manajemen Informatika</option>
                                    <option value="Teknik Komputer" <?php echo $jurusan === 'Teknik Komputer' ? 'selected' : ''; ?>>Teknik Komputer</option>
                                    <option value="Akuntansi" <?php echo $jurusan === 'Akuntansi' ? 'selected' : ''; ?>>Akuntansi</option>
                                    <option value="Teknik Mesin" <?php echo $jurusan === 'Teknik Mesin' ? 'selected' : ''; ?>>Teknik Mesin</option>
                                    <option value="Bahasa Inggris" <?php echo $jurusan === 'Bahasa Inggris' ? 'selected' : ''; ?>>Bahasa Inggris</option>
                                </select>
                            </div>
                            <div class="info-list-row">
                                <div class="category">Angkatan</div>
                                <input type="text" name="angkatan" class="detail" value="<?php echo $angkatan; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Jenis Kelamin</div>
                                <div class="detail">
                                    <input type="radio" name="jenis_kelamin" value="Laki-Laki" <?php echo $jenisKelamin === 'Laki-Laki' ? 'checked' : ''; ?>> Laki-Laki
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" <?php echo $jenisKelamin === 'Perempuan' ? 'checked' : ''; ?>> Perempuan
                                </div>
                            </div>
                            <div class="info-list-row">
                                <div class="category">Hobby</div>
                                <input type="text" name="hobby" class="detail" value="<?php echo $hobby; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Alamat</div>
                                <textarea name="alamat" class="detail"><?php echo $alamat; ?></textarea>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <input class="btn btn-primary" type="reset" value="Reset">
                                <a class="btn btn-primary" href="home">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php else: ?>
        <div class="d-flex justify-content-center align-items-center overflow-y-hidden" style="min-height: 80vh; flex-direction:column;">
            <h2>Warning!</h2>
            <p>Please login to access this page.</p>
            <form action="" method="POST">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required><br>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required><br>
                <input type="submit" value="Login">
            </form>
        </div>
    <?php endif; ?>    
</section>