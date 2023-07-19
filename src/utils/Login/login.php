<?php
session_start();

if (isset($_SESSION['user'])) {
    if ($_SESSION['role'] == 'admin') {
        header('Location: ../../../admin');
        exit;
    } else {
        header('Location: ../../../home');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../../event/main.css">
    <title>Login</title>
    <style>
        body {
            background-color: #1d2630;
        }
        a{
            text-decoration: none;
            color: azure;
        }
    </style>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
        echo '<script>alert("Username or password is invalid");</script>';
    }
    ?>
</head>
<body>
    <div class="container mb-5" style="margin-top: 125px;">
        <div class="row justify-content-center">
            <div class="card border-light mb-3 bg-primary p-2 text-dark bg-opacity-25 col-6 mx-auto" style="max-width: 29rem;">
                <h2 class="card-header text-center">Login</h2>
                <div class="card-body">
                    <form ACTION="proses_login" METHOD="POST" NAME="input">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username">
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" value="" id="exampleCheckbox">
                            <label class="form-check-label" for="exampleCheckbox">
                                remember Me
                            </label>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success mt-2" name="Login">Login</button>
                            <!-- <a href="src/utils/back_page/register.php"><button type="btn" class="btn btn-info mt-2">Login</button></a> -->
                        </div>
                        <div>
                        <p>Belum punya akun? <a href="/php1/register" class="text-success">Daftar</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>