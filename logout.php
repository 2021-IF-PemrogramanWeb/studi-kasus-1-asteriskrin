<?php
    $request_method = strtoupper($_SERVER['REQUEST_METHOD']);

    if ($request_method !== 'GET') {
        header($_SERVER['SERVER_PROTOCOL'] . ' 403 Method Not Allowed');
        exit;
    }

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // If logged in
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
        echo 'Anda telah berhasil logout.<br><a href="login.php">Pergi ke halaman login</a>';
    }
    else {
        echo 'Anda belum login.<br><a href="login.php">Pergi ke halaman login</a>';
    }
?>