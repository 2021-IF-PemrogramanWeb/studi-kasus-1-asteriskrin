<?php
    require_once 'src/Classes.php';
    use Garnet\App\Model\User as User;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $response = [];
    // If logged in
    if (isset($_SESSION['user'])) {
        $response['STATUS'] = 'ALREADY_LOGGED_IN';
    }
    else {
        if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
            // Filter username to prevent SQL Injection
            // Password will be hashed to md5 string (impossible for SQL Injection)
            if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
                $username = $_POST['username'];
                $password = md5($_POST['password']);
        
                $user = User::login($username, $password);
                if ($user) {
                    $response['STATUS'] = 'LOGIN_SUCCESSFUL';
                }
                else $response['STATUS'] = 'LOGIN_FAILED';
            }
            else $response['STATUS'] = 'INVALID_USERNAME';
        }
        else $response['STATUS'] = 'INVALID_USERNAME_OR_PASSWORD';
    }

    echo json_encode($response);
?>