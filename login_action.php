<?php
    require_once 'src/Classes.php';
    use Garnet\App\Model\User as User;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // If logged in
    if (isset($_SESSION['user'])) {
        echo 'Anda sudah login.<br><a href="index.php">Pergi ke halaman index</a>';
    }
    else {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
    
            $user = User::login($username, $password);
            if ($user) {
                echo 'Login berhasil<br><a href="index.php">Pergi ke halaman index</a>';
            }
            else echo 'Login gagal<br><a href="login.php">Kembali ke halaman login</a>';
        }
        else echo 'Username dan password kosong.';
    }
?>