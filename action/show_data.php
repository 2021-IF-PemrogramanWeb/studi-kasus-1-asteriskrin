<?php
    include "../src/Model/User.php";
    use Garnet\App\Model\User as User;
    $users = User::all();

    if (count($users) > 0) {
        // output data of each row
        foreach ($users as $user) {
            echo "id: " . $user["u_id"]. " - Username: " . $user["u_username"]. "<br>";
        }
    } else {
        echo "0 results";
    }
?>