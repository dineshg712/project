<?php
include_once('admin/config.php');
error_reporting(0);
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
    <div id="preloader"></div>
    <?php
    include_once("header.php");
    ?>
    <div class="container-fluid">
        <div class="row mt-4 mb-4">
            <h4 align="left">Live Matches</h4>
            <?php
            $sql = "SELECT * FROM schedule WHERE `status`= 2";
            $res = mysqli_query($conn, $sql);
            if ($res->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $match_id = $row['match_id'];
            ?>
                    <div class="col-md-4 col-12">
                        <div class="card mt-3" style="max-height: 196px;">
                            <div class="card-header">
                                <?php
                                $sql7 = "SELECT * from toss WHERE `match_id`= '$match_id'";
                                $res7 = mysqli_query($conn, $sql7);
                                $row7 = mysqli_fetch_assoc($res7);
                                $toss_won = $row7['toss_won'];
                                if ($toss_won == $row7['team1']) {
                                    $toss_loss = $row7['team2'];
                                } else {
                                    $toss_loss = $row7['team1'];
                                }
                                if ($row7['choose'] == 'bat') {
                                    $bat = $toss_won;
                                    $bowl = $toss_loss;
                                } else if ($row7['choose'] == 'bowl') {
                                    $bat = $toss_loss;
                                    $bowl = $toss_won;
                                }
                                $bat_team = mysqli_query($conn, "SELECT * from team WHERE `team_id`= '$bat'");
                                $bat_res = mysqli_fetch_assoc($bat_team);
                                $bowl_team = mysqli_query($conn, "SELECT * from team WHERE `team_id`= '$bowl'");
                                $bowl_res = mysqli_fetch_assoc($bowl_team);
                                $live_sql = mysqli_query($conn, "SELECT * from live WHERE `match_id`='$match_id' AND `status`= 0");
                                $live_res = mysqli_fetch_assoc($live_sql);
                                $r = mysqli_query($conn, "SELECT * FROM schedule WHERE `match_id`='$match_id'");
                                $g = mysqli_fetch_assoc($r);
                                $to_id = $g['tournament'];
                                $r1 = mysqli_query($conn, "SELECT * FROM tournament WHERE `tournament_id`='$to_id'");
                                $g1 = mysqli_fetch_assoc($r1);
                                echo "<h6>" . $g1['tournament_name'] . "</h6>";
                                ?>
                            </div>
                            <div class="card-body mx-3">
                                <?php
                                $t1 = $g['team1'];
                                $t2 = $g['team2'];
                                $r2 = mysqli_query($conn, "SELECT * FROM team WHERE `team_id`='$t1'");
                                $g2 = mysqli_fetch_assoc($r2);
                                $r3 = mysqli_query($conn, "SELECT * FROM team WHERE `team_id`='$t2'");
                                $g3 = mysqli_fetch_assoc($r3);
                                echo "<h6>" . $g2['short_name'] . " vs " . $g3['short_name'] . ", ";
                                echo ($live_res['innings'] == 1) ? "1st innings" : "2nd innings" . "</h6>";
                                $r4 = mysqli_query($conn, "SELECT * FROM team WHERE `team_id`='$toss_won'");
                                $g4 = mysqli_fetch_assoc($r4);
                                echo "<h6 class='text-danger ps-3'>" . $g4['team_name'] . " opt to " . $row7['choose'] . "</h6>";
                                ?>
                                <div class="row mt-2">
                                    <div class="col-md-8 col-6">
                                        <div class="team1 team-active">
                                            <?php echo $bat_res['short_name'] . " - " . $live_res['total'] . " / " . $live_res['wicket']; ?>
                                        </div>
                                        <div class="team2">
                                            <?php echo $bowl_res['short_name']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <h6 class="pt-1 fs-5">Overs : <?php echo $live_res['overs']; ?></h6>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 5px;font-size: 14px;">
                                    <div class="col-4">CRR : <?php echo $live_res['run_rate']; ?></div>
                                    <div class="col-8"><?php echo ($live_res['innings'] == 1) ? "" : "Required RR : " . $live_res['req_run_rate']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<br><h5 align='center'>No live matches.</h5>";
            }
            ?>
        </div>
        <div class="row">
            <?php
            include("news.php");
            ?>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.min.js"></script>
</body>

</html>