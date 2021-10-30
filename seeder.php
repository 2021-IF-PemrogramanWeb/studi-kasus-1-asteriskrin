<?php
    // Script PHP ini digunakan untuk men-generate data dummy untuk keperluan testing.
    if (!isset($_GET['password']) || $_GET['password'] !== "1230654") die ("Password salah.");
    require_once 'src/Classes.php';

    use Garnet\App\Model\User as User;
    use Garnet\App\Model\Interlock as Interlock;
    use Garnet\App\Model\InterlockDis as InterlockDis;

    function createUser($username, $password, $name) {
        return User::create([
            'u_username' => "'".$username."'",
            'u_password' => "'".$password."'",
            'u_name' => "'".$name."'"
        ]);
    }

    $audiyatra = createUser("audiyatra@domain.net", md5("qwerty123"), "Audiyatra");
    $rizaldy = createUser("rizaldy@domain.net", md5("rizaldy123"), "Rizaldy");
    $gathot = createUser("gathot.kaca@domain.net", md5("gathotKACA"), "Gathot");

    function createInterlock($timeon, $timeoff, $ack, $reasonid) {
        return Interlock::create([
            'i_timeon' => "'".$timeon."'",
            'i_timeoff' => "'".$timeoff."'",
            'i_ack' => $ack,
            'i_reasonid' => $reasonid
        ]);
    }

    $interlock1 = createInterlock("2021/02/25 19:41:50", "2021/02/25 21:00:50", $audiyatra->u_id, 1);
    createInterlock("2021/03/01 19:41:50", "2021/03/01 22:41:50", "NULL", 2);
    createInterlock("2021/03/01 23:30:00", "2021/03/01 00:30:00", "NULL", 3);
    createInterlock("2021/03/03 08:30:30", "2021/03/03 09:30:30", "NULL", 4);
    createInterlock("2021/03/05 08:30:30", "2021/03/05 10:30:30", "NULL", 9);
    createInterlock("2021/03/06 08:30:30", "2021/03/06 08:45:30", "NULL", 10);
    createInterlock("2021/03/08 08:30:30", "2021/03/08 08:30:30", "NULL", 15);
    createInterlock("2021/03/16 08:30:30", "2021/03/16 08:30:30", "NULL", 16);

    function createInterlockDis($i_id, $u_id) {
        return InterlockDis::create([
            'i_id' => $i_id,
            'u_id' => $u_id
        ]);
    }
    createInterlockDis($interlock1->i_id, $rizaldy->u_id);
    createInterlockDis($interlock1->i_id, $gathot->u_id);

    echo "Migration has been ran successfully.";
?>