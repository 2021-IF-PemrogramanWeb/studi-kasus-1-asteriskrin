<?php
    $real_username = 'garnet.19051@mhs.its.ac.id';
    $real_password = 'e10adc3949ba59abbe56e057f20f883e'; // md5 of '123456'

    $input_username = $_POST['username'];
    $input_password = md5($_POST['password']);

    if ($input_username == $real_username && $input_password == $real_password)
        echo("Login berhasil.");
    else echo("Login gagal.");
?>