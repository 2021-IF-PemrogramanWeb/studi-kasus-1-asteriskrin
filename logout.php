<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // If logged in
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
        echo 'Anda telah berhasil logout.<br><a href="index.php">Pergi ke halaman login</a>';
    }
    else {
        echo 'Anda belum login.<br><a href="login.php">Pergi ke halaman login</a>';
    }
?>