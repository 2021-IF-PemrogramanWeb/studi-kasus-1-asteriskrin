<?php
    include 'action/class/Interlock.php';
    include 'action/class/InterlockDis.php';
    $interlocks = new Interlock();
    $interlock_datas = $interlocks->getData();
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
                <button class="btn btn-dark float-end">Tgl Hari ini</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-12 col-md-3">
                <div class="d-flex flex-column h-100">
                    <div class="flex-grow-1 align-self-center">
                        <div class="rounded bg-blue">&nbsp;</div>
                        Mobil 1
                        <div class="rounded bg-green">&nbsp;</div>
                        Mobil 2
                    </div>
                    <div class="align-self-center d-flex flex-column justify-content-center gap-4">
                        <a href="grafik.html" class="btn bg-yellow">Graph</a>
                        <a class="btn bg-blue-2">Export</a>
                        <a class="btn bg-red">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9">
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
                        <?php foreach ($interlock_datas as $d) { ?>
                        <tr>
                            <td><?php echo $d['i_id']; ?></td>
                            <td><?php echo $d['i_timeon']; ?></td>
                            <td><?php echo $d['i_timeoff']; ?></td>
                            <td>
                                Act: <?php echo $d['u_name']; ?><br>
                                Dis: <?php foreach (InterlockDis::getDisses($d['i_id']) as $interlock_dis) { echo $interlock_dis->u_name.', '; } ?>
                            </td>
                            <td>
                                <?php echo $d['i_reasonid'].'. '.$interlocks->getReason($d['i_reasonid']); ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="bootstrap/bootstrap.min.js"></script>
</body>
</html>