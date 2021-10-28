<?php
    // init mysql connection
    include("conn.php");

    $sql = "SELECT u_id, u_username FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["u_id"]. " - Username: " . $row["u_username"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    // close mysql connection
    $conn->close();
?>