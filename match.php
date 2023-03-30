<?php
include_once('admin/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Score - Live Cricket Score</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/icons/icons.css">
</head>

<body>
    <?php
    include_once("header.php");
    ?>
    <div class="container">
        <div class="row mt-3">
            <div class="flex-wrap">
                <div class="col-12">
                    <h2 class="text-center">Upcoming matches</h2>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="flex-wrap">
                <?php
                $sql = "SELECT * from schedule WHERE `status`= 0 ORDER BY `date&time` ASC";
                $res = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    $m_id = $row['match_id'];
                ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <?php
                                    $sql1 = "SELECT * from tournament WHERE `tournament_id`='" . $row['tournament'] . "' AND `status`= 0";
                                    $res1 = mysqli_query($conn, $sql1);
                                    if ($row1 = mysqli_fetch_assoc($res1)) {
                                        echo "<h6>" . $row1['tournament_name'] . "</h6>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <?php
                                        $sql2 = "SELECT `team_name` FROM team WHERE `team_id`='" . $row['team1'] . "' AND `status`=0";
                                        $res2 = mysqli_query($conn, $sql2);
                                        if ($row2 = mysqli_fetch_assoc($res2)) {
                                            echo $row2['team_name'];
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="d-flex justify-content-center">
                                        <h6>vs</h6>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <?php
                                        $sql2 = "SELECT `team_name` FROM team WHERE `team_id`='" . $row['team2'] . "' AND `status`=0";
                                        $res2 = mysqli_query($conn, $sql2);
                                        if ($row2 = mysqli_fetch_assoc($res2)) {
                                            echo $row2['team_name'];
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mx-2">
                            <div class="row">
                                <div class="col-4">
                                    <div class="d-flex flex-row">
                                        <?php
                                        echo "<h6>" . date('F j , g:i a', strtotime($row['date&time'])) . "</h6>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    include_once("footer.php");
    ?>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.min.js"></script>
</body>

</html>