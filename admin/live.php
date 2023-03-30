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
$innings = "1st inning";
$sql = "SELECT * from toss WHERE `match_id`= '$match_id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$toss_won = $row['toss_won'];
if($toss_won == $row['team1']) {
    $toss_loss = $row['team2'];
}
else {
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

        .card {
            border-radius: 0px;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card my-4">
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
                        echo "<h6>" . $g2['short_name'] . " vs " . $g3['short_name'] . ", $innings</h6>";
                        $r4 = mysqli_query($conn, "SELECT * FROM team WHERE `team_id`='$toss_won'");
                        $g4 = mysqli_fetch_assoc($r4);
                        echo "<h6 class='text-danger ps-3'>" . $g4['team_name'] . " opt to " . $row['choose'] . "</h6>";
                        ?>
                        <div class="row my-2">
                            <div class="col-md-8">
                                <div class="team team-active">
                                    <?php echo $bat_res['short_name']; ?> - 0 / 0
                                </div>
                                <div class="team">
                                    <?php echo $bowl_res['short_name']; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="pt-2">Overs : 0.0</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card my-4">
                    <div class="card-header">
                        Batsman & Bowler
                    </div>
                    <div class="card-body">

                    </div>
                    <div class="card-footer">
                        
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
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="sel_tour" class="form-label">Stricker :</label>
                                <select name="sel_tour" id="sel_tour" class="form-select" required>
                                    <option value=""></option>
                                    <?php
                                    $sql1 = "SELECT * from player WHERE `team_id`= '$bat' AND `status`= 0";
                                    $res1 = mysqli_query($conn, $sql1);
                                    while ($row1 = mysqli_fetch_assoc($res1)) {
                                        echo "<option value='" . $row1['player_id'] . "''>" . $row1['player_name'] . "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;" . $row1['role'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="sel_team" class="form-label">Non-Stricker :</label>
                                <select name="sel_team" id="sel_team" class="form-select" required>
                                    <option value=""></option>
                                    <?php
                                    $sql1 = "SELECT * from player WHERE `team_id`= '$bat' AND `status`= 0";
                                    $res1 = mysqli_query($conn, $sql1);
                                    while ($row1 = mysqli_fetch_assoc($res1)) {
                                        echo "<option value='" . $row1['player_id'] . "''>" . $row1['player_name'] . "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;" . $row1['role'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="sel_team" class="form-label">Opening Bowler :</label>
                                <select name="sel_team" id="sel_team" class="form-select" required>
                                    <option value=""></option>
                                    <?php
                                    $sql1 = "SELECT * from player WHERE `team_id`= '$bowl' AND `status`= 0";
                                    $res1 = mysqli_query($conn, $sql1);
                                    while ($row1 = mysqli_fetch_assoc($res1)) {
                                        echo "<option value='" . $row1['player_id'] . "''>" . $row1['player_name'] . "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;" . $row1['role'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#openingModal').modal('show');
        })
    </script>
</body>

</html>
<?php //} else {
//echo "<script>window.alert('This match no longer been active');
//window.location.href='fixtures.php';</script>";
//  } 
?>