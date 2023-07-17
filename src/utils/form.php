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

        header("Location: ../page/home.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../event/main.css">
    <title>Form</title>
</head>
<body>
    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="#">Form Personal Information</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../page/home.php">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../page/home.php#profile">About</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../page/kalkulator.php">Kalkulator</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../../index.php">login</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Contact
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="https://wa.me/+6282186403388" target="_blank">
                                <i class="bi bi-whatsapp"></i> Whatsapp</a></li>
                            <li><a class="dropdown-item" href="https://www.facebook.com/profile.php?id=100010604971777" target="_blank"><i class="bi bi-facebook"></i> Facebook</a></li>
                            <li><a class="dropdown-item" href="https://www.instagram.com/adeilhamw/" target="_blank"><i class="bi bi-instagram"></i> Instagram</a>
                            </li>
                        </ul>
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
            </nav>
    </header>
    <main style="overflow: auto;">
        <section id="about">
            <div class="container text-center text-justify m-5 mt-3">
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
                                <a class="btn btn-primary" href="../page/home.php">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
