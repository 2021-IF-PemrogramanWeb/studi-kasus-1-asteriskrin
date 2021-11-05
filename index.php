<?php
    require_once 'src/Classes.php';
    use Garnet\App\Model\Interlock as Interlock;
    use Garnet\App\Traits\BahasaDay as BahasaDay;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // If not logged in
    if (!isset($_SESSION['user'])) {
        echo 'Anda belum login.<br><a href="login.php">Pergi ke halaman login</a>';
    }
    else {
        $interlocks = Interlock::all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Page 1</title>
</head>
<body>
    <div class="d-flex flex-column p-4 content">
        <div class="d-flex">
            <img src="img/logo.png" class="flex-grow-0">
            <div class="flex-grow-1">
                <button class="btn btn-dark float-end"><?= date('Y/m/d') ?></button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-12 col-md-3">
                <div class="d-flex flex-column h-100">
                    <div class="d-flex flex-row flex-md-column flex-grow-1 align-self-center">
                        <div class="rounded bg-blue" style="width:50px;">&nbsp;</div>
                        <p class="m-0">Mobil 1</p>
                        <div class="rounded bg-green" style="width:50px;">&nbsp;</div>
                        <p class="m-0">Mobil 2</p>
                    </div>
                    <div class="mt-4 align-self-center d-flex flex-row flex-md-column justify-content-center gap-4">
                        <a href="grafik.php" class="btn bg-yellow">Graph</a>
                        <a class="btn bg-blue-2">Export</a>
                        <a href="logout.php" class="btn bg-red">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 mt-2">
                <div class="table-responsive">
                    <table class="table table-bordered border-dark">
                        <thead>
                            <tr style="background-color: rgb(168, 209, 141);">
                                <th>No</th>
                                <th>On</th>
                                <th>Off</th>
                                <th>Ack by</th>
                                <th>Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($interlocks as $interlock) { ?>
                            <tr>
                                <td><?php echo $interlock->i_id; ?></td>
                                <td>
                                    <?php 
                                        $dayName = date('D', strtotime($interlock->i_timeon));
                                        echo BahasaDay::getDayName($dayName).", ".date('d/m/y, h:i:s', strtotime($interlock->i_timeon)); 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $dayName = date('D', strtotime($interlock->i_timeoff));
                                        echo BahasaDay::getDayName($dayName).", ".date('d/m/y, h:i:s', strtotime($interlock->i_timeoff)); 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $act = $interlock->ack_user();
                                        if ($act != NULL) echo "Act: ".$act->u_name."<br>";
                                    ?>
                                    <?php
                                        $interlock_disses = $interlock->disses();
                                        if ($interlock_disses != NULL) {
                                            echo "Dis: ";
                                            $size = count($interlock_disses);
                                            for ($i = 0; $i < $size - 1; $i++) {
                                                echo $interlock_disses[$i]->user()->u_name;
                                                echo ', ';
                                            }
                                            echo $interlock_disses[$size-1]->user()->u_name;
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $interlock->i_reasonid.'. '.Interlock::getReason($interlock->i_reasonid); ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>