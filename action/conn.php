<?php
    // credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pweb1";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>