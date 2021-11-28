<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // If logged in
    if (isset($_SESSION['user'])) {
        echo 'Anda sudah login.<br><a href="index.php">Pergi ke halaman index</a>';
    }
    else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body class="vh-100">
    <div class="d-flex justify-content-center align-items-center h-100 content">
        <div class="d-flex flex-column align-items-center">
            <img src="img/logo.png" class="img-fluid mb-4" width="90%">
            <form method="POST" action="login_action.php">
                <label for="username" class="fw-bold mt-4">User</label>
                <input type="email" class="form-control" id="username" name="username" required>
                <label for="password" class="fw-bold">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <button type="submit" class="btn btn-dark mt-4">LOGIN</button>
            </form>
        </div>
    </div>
    <script src="bootstrap/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>