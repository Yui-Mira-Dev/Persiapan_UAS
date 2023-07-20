<?php
session_start();

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
            header('Location: home');
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
    <?php if ($username): ?>
        
    <main style="overflow: auto;">
        <section id="home" class="home bg-info-subtle text-center">
            <div class="rounded-circle p-3">
                <img class="rounded-circle rounded p-3" src="https://sisak1.polsri.ac.id/assets/images/avatar-1.jpg" width="30%" height="50%">
            </div>
        </section>
        <div class="container text-center text-justify m-5 mt-3">
        
        <section id="Profile">
            <div class="border-bottom">
                <h3 id="profile">Profile</h3>
            </div>
            <div class="info-list justify-content-center row mt-3">
            <div class="col mt-3">
                <h5>Personal Information</h5>
                <div class="info-list-row">
                    <div class="category">NPM</div>
                    <?php echo isset($npm) ? '<div class="detail">' . $npm . '</div>' : ''; ?>
                </div>
                <div class="info-list-row">
                    <div class="category">Nama Lengkap</div>
                    <?php echo isset($namaLengkap) ? '<div class="detail">' . $namaLengkap . '</div>' : ''; ?>
                </div>
                <div class="info-list-row">
                    <div class="category">Email</div> 
                    <?php echo isset($email) ? '<div class="detail">' . $email . '</div>' : ''; ?>
                </div>
                <div class="info-list-row">
                    <div class="category">Tempat Lahir</div>
                    <?php echo isset($tempatLahir) ? '<div class="detail">' . $tempatLahir . '</div>' : ''; ?>
                </div>
                <div class="info-list-row">
                    <div class="category">Tanggal Lahir</div>
                    <?php echo isset($tanggalLahir) ? '<div class="detail">' . $tanggalLahir . '</div>' : ''; ?>
                </div>
                <div class="info-list-row">
                    <div class="category">Agama</div>
                    <?php echo isset($agama) ? '<div class="detail">' . $agama . '</div>' : ''; ?>
                </div>
                <div class="info-list-row">
                    <div class="category">Jurusan</div>
                    <?php echo isset($jurusan) ? '<div class="detail">' . $jurusan . '</div>' : ''; ?>
                </div>
                <div class="info-list-row">
                    <div class="category">Angkatan</div>
                    <?php echo isset($angkatan) ? '<div class="detail">' . $angkatan . '</div>' : ''; ?>
                </div>
                <div class="info-list-row">
                    <div class="category">Jenis Kelamin</div>
                    <?php echo isset($jenisKelamin) ? '<div class="detail">' . $jenisKelamin . '</div>' : ''; ?>
                </div>
                <div class="info-list-row">
                    <div class="category">Alamat</div>
                    <?php echo isset($alamat) ? '<div class="detail">' . $alamat . '</div>' : ''; ?>
                </div>
                </div>
                </div>
                <div class="text-center mt-3">
                    <form method="post">
                        <button class="btn btn-primary" type="submit" name="hapus_data">Hapus Data</button>
                        <a href="../utils/form.php" class="btn btn-primary">Isi Data</a>
                    </form>
                </div>
            </div>
        </section>
        <section id="fiture">
            <div class="info-list justify-content-center row row-cols-xxl-2 row-cols-xl-2 row-cols-1 mt-3">
            <div class="accordion mt-3" id="accordionPanelsStayOpenExample">
                <h3>
                    <b>Fitur</b>
                </h3>
                <div class="accordion-item mt-3">
                    <h2 class="accordion-header">
                    <a href="kalkulator.php">
                        <button class="accordion-button" type="button" >
                            <span class="cone-teratas">1</span>
                            <div>
                            <img class="ms-5" sizes="(min-width: 100px) 100px, 100vw" src="https://cdn.discordapp.com/attachments/1103683129178325004/1127942433846591588/download_2.png" width="25%">
                            </div>
                            <div class="lcone">Kalkulator</div>
                        </button>
                    </a>
                    </h2>
                </div>
                <div class="accordion-item mt-2">
                    <h2 class="accordion-header">
                    <a href="form">
                        <button class="accordion-button" type="button" >
                            <span class="cone-teratas">2</span>
                            <div>
                            <img class="ms-5" sizes="(min-width: 100px) 100px, 100vw" src="https://cdn.discordapp.com/attachments/1103683129178325004/1127945351417040917/images.png" width="25%">
                            </div>
                            <div class="lcone">Form Pengisian Data</div>
                        </button>
                    </a>
                    </h2>
                </div>
            </div>
        </section>
    </main>

    <?php else: ?>
        <div class="d-flex justify-content-center align-items-center overflow-y-hidden" style="min-height: 80vh; flex-direction:column;">
            <h2>Warning!</h2>
            <p>Please login to access this page.</p>
            <button class="btn btn-success"><a href="login">Back To Login</a></button>
        </div>
    <?php endif; ?>
</section>