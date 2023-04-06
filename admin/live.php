<?php
session_start();
include_once('config.php');
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
$match_id = $_GET['matchid'];
// $sql = "SELECT * FROM schedule WHERE `match_id`='$match_id' AND `status`= 2";
// $res = mysqli_query($conn, $sql);
// if ($res -> num_rows > 0) {
$innings = 1;
$sql = "SELECT * from toss WHERE `match_id`= '$match_id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$toss_won = $row['toss_won'];
if ($toss_won == $row['team1']) {
    $toss_loss = $row['team2'];
} else {
    $toss_loss = $row['team1'];
}
if ($row['choose'] == 'bat') {
    $bat = $toss_won;
    $bowl = $toss_loss;
} else if ($row['choose'] == 'bowl') {
    $bat = $toss_loss;
    $bowl = $toss_won;
}
$bat_team = mysqli_query($conn, "SELECT * from team WHERE `team_id`= '$bat'");
$bat_res = mysqli_fetch_assoc($bat_team);
$bowl_team = mysqli_query($conn, "SELECT * from team WHERE `team_id`= '$bowl'");
$bowl_res = mysqli_fetch_assoc($bowl_team);
$live_sql = mysqli_query($conn, "SELECT * from live WHERE `match_id`='$match_id' AND `status`= 0");
$live_res = mysqli_fetch_assoc($live_sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Score - Live Cricket Score</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/icons/icons.css">
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #d1d1d1;
        }

        .team-active {
            font-size: 20px;
            font-weight: bolder;
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 40%;
            text-align: left;
        }

        th,
        td {
            min-width: 40px;
            text-align: center;
        }

        .card {
            border-radius: 10px 10px 10px 10px;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card mt-3" style="max-height: 196px;">
                    <div class="card-header">
                        <?php
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
                        echo "<h6>" . $g2['short_name'] . " vs " . $g3['short_name'] . ", ";echo ($innings==1)?"1st innings":"2nd innings"."</h6>";
                        $r4 = mysqli_query($conn, "SELECT * FROM team WHERE `team_id`='$toss_won'");
                        $g4 = mysqli_fetch_assoc($r4);
                        echo "<h6 class='text-danger ps-3'>" . $g4['team_name'] . " opt to " . $row['choose'] . "</h6>";
                        ?>
                        <div class="row mt-2">
                            <div class="col-md-8 col-6">
                                <div class="team1 team-active">
                                    <?php echo $bat_res['short_name']." - ".$live_res['total']." / ".$live_res['wicket']; ?>
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
                            <div class="col-8"><?php echo ($innings==1)?"":"Required RR : ".$live_res['req_run_rate']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card mt-3" style="max-height: fit-content;">
                    <?php
                    $sql3 = "SELECT * FROM batsman WHERE `match_id`='$match_id' AND `status`= 0 ORDER BY `sno` ASC";
                    $res3 = mysqli_query($conn, $sql3);
                    $sql4 = "SELECT * FROM bowler WHERE `match_id`='$match_id' AND `status`= 0";
                    $res4 = mysqli_query($conn, $sql4);
                    $row4 = mysqli_fetch_assoc($res4);
                    $arr = array();
                    while ($row3 = mysqli_fetch_array($res3)) {
                        array_push($arr, $row3['player_id']);
                    }
                    $batsman['striker'] = $arr[0];
                    $batsman['non-striker'] = $arr[1];
                    $bowler = $row4['player_id'];
                    if (empty($batsman['striker']) && empty($batsman['non-striker']) && empty($bowler)) {
                    ?>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                $('#openingModal').modal('show');
                            })
                        </script>
                    <?php
                    }
                    ?>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-sm table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Batsman</th>
                                        <th scope="col">R</th>
                                        <th scope="col">B</th>
                                        <th scope="col">4s</th>
                                        <th scope="col">6s</th>
                                        <th scope="col">SR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $sql2 = "SELECT `player_name` FROM player WHERE `player_id`='" . $batsman['striker'] . "'";
                                        $res2 = mysqli_query($conn, $sql2);
                                        $row2 = mysqli_fetch_assoc($res2);
                                        $sql5 = "SELECT * FROM batsman WHERE `player_id`='" . $batsman['striker'] . "' AND `match_id`='$match_id'";
                                        $res5 = mysqli_query($conn, $sql5);
                                        $row5 = mysqli_fetch_assoc($res5);
                                        echo "<td scope='col'>" . $row2['player_name'] . "</td>"; ?>
                                        <td><?php echo $row5['runs'] ?></td>
                                        <td><?php echo $row5['balls'] ?></td>
                                        <td><?php echo $row5['4'] ?></td>
                                        <td><?php echo $row5['6'] ?></td>
                                        <td><?php echo $row5['strike_rate'] ?></td>
                                    </tr>
                                    <tr>
                                        <?php
                                        $sql2 = "SELECT `player_name` FROM player WHERE `player_id`='" . $batsman['non-striker'] . "'";
                                        $res2 = mysqli_query($conn, $sql2);
                                        $row2 = mysqli_fetch_assoc($res2);
                                        $sql5 = "SELECT * FROM batsman WHERE `player_id`='" . $batsman['non-striker'] . "' AND `match_id`='$match_id'";
                                        $res5 = mysqli_query($conn, $sql5);
                                        $row5 = mysqli_fetch_assoc($res5);
                                        echo "<td scope='col'>" . $row2['player_name'] . "</td>"; ?>
                                        <td><?php echo $row5['runs'] ?></td>
                                        <td><?php echo $row5['balls'] ?></td>
                                        <td><?php echo $row5['4'] ?></td>
                                        <td><?php echo $row5['6'] ?></td>
                                        <td><?php echo $row5['strike_rate'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-sm table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Bowler</th>
                                        <th scope="col">O</th>
                                        <th scope="col">M</th>
                                        <th scope="col">R</th>
                                        <th scope="col">W</th>
                                        <th scope="col">ER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $sql2 = "SELECT `player_name` FROM player WHERE `player_id`='$bowler'";
                                        $res2 = mysqli_query($conn, $sql2);
                                        $row2 = mysqli_fetch_assoc($res2);
                                        $sql5 = "SELECT * FROM bowler WHERE `player_id`='" . $bowler . "' AND `match_id`='$match_id'";
                                        $res5 = mysqli_query($conn, $sql5);
                                        $row5 = mysqli_fetch_assoc($res5);
                                        echo "<td scope='col'>" . $row2['player_name'] . "</td>";
                                        ?>
                                        <td><?php echo $row5['overs'] ?></td>
                                        <td><?php echo $row5['maiden'] ?></td>
                                        <td><?php echo $row5['runs'] ?></td>
                                        <td><?php echo $row5['wicket'] ?></td>
                                        <td><?php echo $row5['economy_rate'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="margin-bottom: -15px;">
                        <p class="fw-bold">This Over :</p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal-->
    <div class="modal fade" id="openingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Opening Players</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" id="form1">
                    <input type="hidden" name="matchid" value="<?php echo $match_id ?>">
                    <input type="hidden" name="bat_team" value="<?php echo $bat ?>">
                    <input type="hidden" name="innings" value="<?php echo $innings ?>">
                    <div class="modal-body">
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="batsman1" class="form-label">Stricker :</label>
                                <select name="batsman1" id="batsman1" class="form-select" required>
                                    <option value=""></option>
                                    <?php
                                    $sql1 = "SELECT * from player WHERE `team_id`= '$bat' AND `status`= 0";
                                    $res1 = mysqli_query($conn, $sql1);
                                    while ($row1 = mysqli_fetch_assoc($res1)) {
                                        echo "<option value='" . $row1['player_id'] . "''>" . $row1['player_name'] . "&emsp;&emsp;&emsp;" . $row1['role'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="batsman2" class="form-label">Non-Stricker :</label>
                                <select name="batsman2" id="batsman2" class="form-select" required>
                                    <option value=""></option>
                                    <?php
                                    $sql1 = "SELECT * from player WHERE `team_id`= '$bat' AND `status`= 0";
                                    $res1 = mysqli_query($conn, $sql1);
                                    while ($row1 = mysqli_fetch_assoc($res1)) {
                                        echo "<option value='" . $row1['player_id'] . "''>" . $row1['player_name'] . "&emsp;&emsp;&emsp;" . $row1['role'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="bowler" class="form-label">Opening Bowler :</label>
                                <select name="bowler" id="bowler" class="form-select" required>
                                    <option value=""></option>
                                    <?php
                                    $sql1 = "SELECT * from player WHERE `team_id`= '$bowl' AND `status`= 0";
                                    $res1 = mysqli_query($conn, $sql1);
                                    while ($row1 = mysqli_fetch_assoc($res1)) {
                                        echo "<option value='" . $row1['player_id'] . "''>" . $row1['player_name'] . "&emsp;&emsp;&emsp;" . $row1['role'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="opening_submit" class="btn btn-primary">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#form1').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'batsman.php',
                type: 'post',
                data: $('#form1').serialize(),
                success: function() {
                    setTimeout(function() {
                        location.reload()
                    }, 100);
                }
            })
        })
    </script>
    <?php

    ?>
</body>

</html>
<?php //} else {
//echo "<script>window.alert('This match no longer been active');
//window.location.href='fixtures.php';</script>";
//  } 
?>