<?php
session_start();
include_once('config.php');
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
if (isset($_POST['submit']) && $_POST['randcheck'] == $_SESSION['rand']) {
    unset($_SESSION['rand']);
    $sql = "SELECT `player_id` from player ORDER BY `player_id` DESC LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        if ($res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
            $player = $row['player_id'];
        } else {
            $player = "P000";
        }
    }
    $value2 = substr($player, 1);
    $value2 = $value2 + 1;
    $value2 = sprintf('%03s', $value2);
    $player_id = "P" . $value2;
    $team_id = $_POST['sel_team'];
    $player_name = $_POST['player_name'];
    $role = $_POST['sel_role'];
    $sql = "INSERT INTO player(`team_id`,`player_id`,`player_name`,`role`) VALUES ('$team_id','$player_id','$player_name','$role') ";
    $res = mysqli_query($conn, $sql);
    if($res) {
        echo "<script>window.location.href=location.href;</script>";
    }
}
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
</head>

<body>
    <?php
    include_once("header.php");
    ?>
    <div class="container">
        <div class="row mt-3">
            <div class="flex-wrap">
                <div class="col-12">
                    <button type="button" class="login-btn float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="width:200px;">Add Player</button>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="flex-wrap">
                <div class="card">
                    <div class="card-header">
                        <h2 align="center">Players</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        $sql = "SELECT * from team WHERE `status`= 0";
                        $res = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                            $t_id = $row['team_id'];
                        ?>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-7">
                                            <?php
                                            $sql1 = "SELECT * from tournament WHERE `tournament_id`='" . $row['tournament_id'] . "' AND `status`= 0";
                                            $res1 = mysqli_query($conn, $sql1);
                                            if ($row1 = mysqli_fetch_assoc($res1)) {
                                                echo "<h6>" . $row1['tournament_name'] . "</h6>";
                                            }
                                            ?>
                                        </div>
                                        <div class="col-5">
                                            <h6>No. of Players</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-7">
                                            <?php echo $row['team_name']; ?>
                                        </div>
                                        <div class="col-5">
                                            <?php
                                            $sql2 = "SELECT COUNT(`player_id`) AS total FROM `player` WHERE `team_id`='$t_id'";
                                            $res2 = mysqli_query($conn, $sql2);
                                            $row2 = mysqli_fetch_assoc($res2);
                                            echo $row2['total'];
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer mx-2">
                                    <a href="" onclick="openModal('<?php echo $t_id; ?>');" data-bs-toggle="modal" id="openModal">View Players</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function openModal(t_id) {
                $.ajax({
                    url: 'viewplayers.php',
                    type: 'post',
                    data: {
                        t_id: t_id
                    },
                    success: setTimeout(function() {
                        $("#view-players").load('viewplayers.php');
                    }, 200)
                })
            }
        </script>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Player</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <?php
                        $rand = rand();
                        $_SESSION['rand'] = $rand;
                        ?>
                        <input type="hidden" name="randcheck" value="<?php echo $rand; ?>">
                        <div class="modal-body">
                            <div class="row mx-3 mb-2">
                                <div class="form-group">
                                    <label for="sel_tour" class="form-label">Select Tournament :</label>
                                    <select name="sel_tour" id="sel_tour" class="form-select" onchange="tour_id(this.value);" required>
                                        <option value="">- - SELECT - -</option>
                                        <?php
                                        $sql = "SELECT * from tournament WHERE `status`= 0";
                                        $res = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                            <option value="<?php echo $row['tournament_id'] ?>"><?php echo $row['tournament_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mx-3 mb-2">
                                <div class="form-group">
                                    <label for="sel_team" class="form-label">Select Team :</label>
                                    <select name="sel_team" id="sel_team" class="form-select" required>
                                        <option value="">- - SELECT - -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mx-3 mb-2">
                                <div class="form-group">
                                    <label for="player_name" class="form-label">Player Name :</label>
                                    <input type="text" class="form-control" id="player_name" name="player_name" placeholder="Enter Player Name" required>
                                </div>
                            </div>
                            <div class="row mx-3 mb-2">
                                <div class="form-group">
                                    <label for="sel_role" class="form-label">Select Role :</label>
                                    <select name="sel_role" id="sel_role" class="form-select" required>
                                        <option value="">- - SELECT - -</option>
                                        <option value="Batsman">Batsman</option>
                                        <option value="Bowler">Bowler</option>
                                        <option value="Allrounder">Allrounder</option>
                                        <option value="Bat & Wkt">Bat & Wkt</option>
                                        <option value="Batsman (C)">Batsman (C)</option>
                                        <option value="Bowler (C)">Bowler (C)</option>
                                        <option value="Allrounder (C)">Allrounder (C)</option>
                                        <option value="Bat & Wkt (C)">Bat & Wkt (C)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="view-players"></div>
        <script>
            function tour_id(to_id) {
                if (to_id != '') {
                    $('#sel_team').empty();
                    $.ajax({
                        url: 'selectteam.php',
                        type: 'post',
                        data: {
                            selected_value: to_id
                        },
                        success: function(response) {
                            $('#sel_team').html(response);
                        }
                    });
                } else {
                    $('#sel_team').empty();
                    $('#sel_team').html("<option value=''>- - SELECT - -</option>");
                }
            }
        </script>
    </div>
    <?php
    include_once("footer.php");
    ?>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>