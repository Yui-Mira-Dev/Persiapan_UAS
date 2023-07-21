<?php
session_start();

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    unset($_SESSION['role']);
}

header('Location: login');
exit();
?>