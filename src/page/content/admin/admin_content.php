<?php
$baseUrl = 'admin';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
    } elseif (isset($_POST['editUser'])) {
        $oldUsername = $_POST['oldUsername'];
        $newUsername = $_POST['newUsername'];
        $newRole = $_POST['newRole'];
        editUser($oldUsername, $newUsername, $newRole);
    } elseif (isset($_POST['editRole'])) {
        $username = $_POST['username'];
        $newRole = $_POST['newRole'];
        editUserRole($username, $newRole);
    } elseif (isset($_POST['searchUser'])) {
        $searchUsername = $_POST['searchUsername'];
        searchUser($searchUsername);
    } elseif (isset($_POST['showAll'])) {
        unset($_SESSION['searchResults']);
        header('Location: ' . $baseUrl);
    }
}

$username = isset($_SESSION['user']) ? $_SESSION['user'] : '';

// Pagination
$perPage = 10;
$userList = getUsersFromFile();
$totalUsers = count($userList);
$totalPages = ceil($totalUsers / $perPage);
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($currentPage < 1 || $currentPage > $totalPages) {
    $currentPage = 1;
}
$start = ($currentPage - 1) * $perPage;
$end = $start + $perPage;
$displayedUsers = array_slice($userList, $start, $perPage);

function getUsersFromFile()
{
    $file = fopen('../utils/login/registration_data.txt', 'r');
    $userList = array();
    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        $credentials = explode(", ", $line);
        $storedUsername = explode(": ", $credentials[0])[1];
        $storedRole = explode(": ", $credentials[2])[1];
        $userList[] = array('username' => $storedUsername, 'role' => $storedRole);
    }
    fclose($file);
    return $userList;
}

function showSearchResults()
{
    $searchResults = $_SESSION['searchResults'];
    echo "<h2>Hasil Pencarian</h2>";
    echo "<table class='table table-bordered'>";
    echo "<thead><tr><th>Username</th><th>Role</th><th>Edit</th></tr></thead>";
    echo "<tbody>";
    foreach ($searchResults as $user) {
        echo "<tr>";
        echo "<td>{$user['username']}</td>";
        echo "<td>{$user['role']}</td>";
        echo "<td><a href='?editUser={$user['username']}'>Edit User</a></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

function searchUser($searchUsername)
{
    $file = fopen('../utils/login/registration_data.txt', 'r');
    $searchResults = array();
    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        $credentials = explode(", ", $line);
        $storedUsername = explode(": ", $credentials[0])[1];
        $storedRole = explode(": ", $credentials[2])[1];
        if (strcasecmp($storedUsername, $searchUsername) === 0) {
            $searchResults[] = array('username' => $storedUsername, 'role' => $storedRole);
        }
    }
    fclose($file);

    if (empty($searchResults)) {
        echo "<p>Username tidak ditemukan.</p>";
    } else {
        $_SESSION['searchResults'] = $searchResults;
        header('Location: ' . $GLOBALS['baseUrl']);
    }
}

function editUser($oldUsername, $newUsername, $newRole)
{
    $file = fopen('../utils/login/registration_data.txt', 'r');
    $tempData = '';

    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        $credentials = explode(", ", $line);
        $storedUsername = explode(": ", $credentials[0])[1];
        $storedRole = explode(": ", $credentials[2])[1];

        if ($storedUsername === $oldUsername) {
            $line = str_replace($storedUsername, $newUsername, $line);
            $line = str_replace($storedRole, $newRole, $line);
        }
        $tempData .= $line . "\n";
    }

    fclose($file);

    $file = fopen('../utils/login/registration_data.txt', 'w');
    fwrite($file, $tempData);
    fclose($file);

    echo "Data pengguna berhasil diubah.";
    header('Location: ' . $GLOBALS['baseUrl']);
}

function editUserRole($username, $newRole)
{
    $file = fopen('../utils/login/registration_data.txt', 'r');
    $tempData = '';

    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        $credentials = explode(", ", $line);
        $storedUsername = explode(": ", $credentials[0])[1];
        $storedRole = explode(": ", $credentials[2])[1];

        if ($storedUsername === $username) {
            $line = str_replace($storedRole, $newRole, $line);
        }
        $tempData .= $line . "\n";
    }

    fclose($file);

    $file = fopen('../utils/login/registration_data.txt', 'w');
    fwrite($file, $tempData);
    fclose($file);

    echo "Role pengguna berhasil diubah.";
    header('Location: ' . $GLOBALS['baseUrl']);
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

<!--Content-->
<section class="">
    <div class="container-fluid" role="search">
        <form class="m-2 d-flex " action="" method="POST">
            <label for="searchUsername"></label>
            <input class="form-control me-2" type="search" placeholder="Cari Username" aria-label="Search" name="searchUsername" id="searchUsername" required>
            <input class="btn btn-success " type="submit" name="searchUser" value="Cari">
            <input class="btn btn-primary mx-2" type="submit" name="showAll" value="Tampilkan Semua">
        </form>
    </div>

    <?php
    if (isset($_SESSION['searchResults'])) {
        showSearchResults();
    } else {
    ?>
        <h4>Daftar Pengguna</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($displayedUsers as $user) {
                    echo "<tr>";
                    echo "<td>{$user['username']}</td>";
                    echo "<td>{$user['role']}</td>";
                    echo "<td><a href='?editUser={$user['username']}'>Edit User</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tampilkan pagination -->
        <?php
        if ($totalPages > 1) { // Tampilkan pagination hanya jika lebih dari satu halaman
        ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?php echo ($i === $currentPage) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php
        }
        ?>
    <?php } ?>

    <!-- Tampilkan form edit user -->
    <?php if (isset($_GET['editUser'])) : ?>
        <?php
        $usernameToEdit = $_GET['editUser'];
        $file = fopen('../utils/login/registration_data.txt', 'r');
        $foundUser = null;
        while (($line = fgets($file)) !== false) {
            $line = trim($line);
            $credentials = explode(", ", $line);
            $storedUsername = explode(": ", $credentials[0])[1];
            $storedRole = explode(": ", $credentials[2])[1];
            if ($storedUsername === $usernameToEdit) {
                $foundUser = array('username' => $storedUsername, 'role' => $storedRole);
                break;
            }
        }
        fclose($file);
        ?>

        <?php if ($foundUser) : ?>
            <h4>Edit User: <?php echo $foundUser['username']; ?></h4>
            <form action='<?php echo $baseUrl; ?>' method='POST' class="row g-3">
                <input type='hidden' name='oldUsername' value='<?php echo $foundUser['username']; ?>'>

                <div class="col-md-3">
                    <label for="newUsername" class="form-label">New Username:</label>
                    <input class="form-control" type='text' name='newUsername' id="newUsername" required>
                </div>

                <div class="col-md-3">
                    <label for="newRole" class="form-label">Role:</label>
                    <select class="form-select" aria-label=".form-select-lg example" name='newRole' id="newRole">
                        <option value='admin'>Admin</option>
                        <option value='member'>Member</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <input class="btn btn-success mt-2" type='submit' name='editUser' value='Simpan'>
                </div>
            </form>
        <?php else : ?>
            <p>Username tidak ada.</p>
        <?php endif; ?>
    <?php endif; ?>
</section>
