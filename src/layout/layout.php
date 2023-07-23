<?php
    session_start();

    if (isset($code)) {
        echo isset($code);
    }

    $username = isset($_SESSION['user']) ? $_SESSION['user'] : '';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Judul Default'; ?></title>
</head>
<body>
    <div class="">
    <?php if ($username): ?>
            <header>
            <nav class="navbar bg-body-tertiary ">
                <div class="container">
                    <a class="navbar-brand" href="#"><?= isset($navbar) ? $navbar : 'Navbar'; ?></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Beranda</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home">Beranda</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#profile">Tentang</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="kalkulator.php">Kalkulator</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="logout">Keluar</a>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Kontak
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
        <main>
        <?php
        if (isset($content)) {
            require_once($content);
        } else {
            echo '<h3 class="d-flex justify-content-center align-items-center overflow-y-hidden" style="min-height: 80vh;">Halaman tidak ditemukan.</h3>';
        }
        ?>
        </main>
    <?php else: ?>
        <div class="d-flex justify-content-center align-items-center overflow-y-hidden" style="min-height: 80vh; flex-direction:column;">
            <h2>Peringatan!</h2>
            <p>Silakan login untuk mengakses halaman ini.</p>
            <a class="btn btn-success" href="login">Kembali ke Halaman Login</a>
        </div>
    <?php endif; ?>
    </div>	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
