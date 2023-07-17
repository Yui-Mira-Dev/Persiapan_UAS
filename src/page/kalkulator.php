<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Kalkulator Sederhana</title>
</head>
<body>
    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="#">Kalkulator</a>
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
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="home.php#profile">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kalkulator.php">Kalkulator</a>
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
    <div class="container">
        <form class="mt-3" method="POST" action="">
            <div class="row">
                <div class="col-3">
                    <input class="form-control" type="text" name="angka1" placeholder="Angka 1" required>
                </div>
                <div class="col-2">
                    <select class="form-select" name="operator">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="*">*</option>
                        <option value="/">/</option>
                    </select>
                </div>
                <div class="col-3">
                    <input class="form-control" type="text" name="angka2" placeholder="Angka 2" required>
                </div>
                <div class="col-3">
                    <button class="btn btn-info" type="submit" name="hitung" value="Hitung">hitung</button>
                    <a class="btn btn-success" href="../page/home.php">Back</a>
                </div>
            </div>
        </form>
        <!-- Hasil -->
        <div class="m-3">
            <?php
            if (isset($_POST['hitung'])) {
                $angka1 = $_POST['angka1'];
                $angka2 = $_POST['angka2'];
                $operator = $_POST['operator'];

                function hitung($angka1, $angka2, $operator)
                {
                    switch ($operator) {
                        case '+':
                            $hasil = $angka1 + $angka2;
                            break;
                        case '-':
                            $hasil = $angka1 - $angka2;
                            break;
                        case '*':
                            $hasil = $angka1 * $angka2;
                            break;
                        case '/':
                            $hasil = $angka1 / $angka2;
                            break;
                        default:
                            $hasil = "Operator yang Anda masukkan tidak valid!";
                    }
                    return $hasil;
                }

                $hasil = hitung($angka1, $angka2, $operator);
                echo "<h3>Hasil dari ". $angka1 . $operator. $angka2 ."= ". $hasil . "</h3>";
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>