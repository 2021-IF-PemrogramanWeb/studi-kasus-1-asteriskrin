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
            <img src="img/logo_cat.jpg" class="img-fluid mb-4" style="max-height:150px;">
            <form method="POST" action="login_action.php" id="login_form">
                <label for="username" class="fw-bold mt-4">User</label>
                <input type="email" class="form-control" id="username" name="username" required>
                <label for="password" class="fw-bold">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <button type="submit" class="btn btn-dark mt-4">LOGIN</button>
            </form>
        </div>
    </div>
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#login_form").submit(function(e) {
                e.preventDefault();
                $.post("login_action.php", {
                    username: $("#username").val(),
                    password: $("#password").val()
                }).done(function (data) {
                    let response = JSON.parse(data);
                    switch (response.STATUS) {
                        case "INVALID_USERNAME_OR_PASSWORD":
                            alert("Username dan Password tidak valid.");
                            break;
                        case "INVALID_USERNAME":
                            alert("Format username tidak sesuai.");
                            break;
                        case "LOGIN_FAILED":
                            alert("Username atau password salah.");
                            break;
                        case "LOGIN_SUCCESSFUL":
                            alert("Login berhasil.\nAnda akan dialihkan ke halaman dashboard sesaat lagi.");
                            window.location.replace("index.php");
                            break;
                        default:
                            alert("Username atau password tidak valid.");
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php } ?>