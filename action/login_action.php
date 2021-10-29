<?php
    include 'conn.php';
    $real_username = 'garnet.19051@mhs.its.ac.id';
    $real_password = 'e10adc3949ba59abbe56e057f20f883e'; // md5 of '123456'

    $input_username = $_POST['username'];
    $input_password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT u_username, u_password FROM users WHERE u_username = ? AND u_password = ?");
    $stmt->bind_param("ss", $input_username, $input_password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_array(MYSQLI_ASSOC);
    if ($user) {
        echo("Login berhasil.");
    }
    else {
        echo("Login gagal.");
    }
    $conn->close();
?>