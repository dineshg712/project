<?php
session_start();
include_once('config.php');
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
if (isset($_POST['submit']) && $_POST['randcheck'] == $_SESSION['rand']) {
    unset($_SESSION['rand']);
    $sql = "SELECT `match_id` from schedule ORDER BY `match_id` DESC LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        if ($res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
            $match = $row['match_id'];
        } else {
            $match = "M000";
        }
        $value2 = substr($match, 1);
        $value2 = $value2 + 1;
        $value2 = sprintf('%03s', $value2);
        $match_id = "M" . $value2;
        $tour_id = $_POST['sel_tour'];
        $team1 = $_POST['sel_team1'];
        $team2 = $_POST['sel_team2'];
        $location = $_POST['location'];
        $date = $_POST['m_date'];
        $sql = "INSERT INTO schedule(`match_id`,`tournament`,`team1`,`team2`,`location`,`date&time`) VALUES ('$match_id','$tour_id','$team1','$team2','$location','$date') ";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            echo "<script>window.location.href=location.href;</script>";
        }
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
                    <button type="button" class="login-btn float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="width:200px;">Create Match</button>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="flex-wrap">
                <div class="card">
                    <div class="card-header">
                        <h2 align="center">Fixtures</h2>
                    </div>
                    <div class="card-body">
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
                                        <div class="col-8">
                                            <div class="d-flex justify-content-end">
                                                <a href="javascript:void(0)" onclick="openmodal('<?php echo $m_id ?>','m_delete');" class="btn btn-danger mx-2"><i class="bi bi-trash"></i></a>
                                                <a href="javascript:void(0)" onclick="startmatch('<?php echo $m_id ?>');" class="btn btn-primary">Start Match</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="ajax"></div>
    <script>
        function startmatch(m_id) {
            $.ajax({
                url: 'toss.php',
                type: 'post',
                data: {
                    m_id: m_id,
                },
                success: setTimeout(function() {
                    $("#ajax").load('toss.php');
                }, 200)
            })
        }

        function openmodal(m_id, action) {
            if (action == 'm_delete') {
                if (confirm('Are you sure to delete this match?')) {
                    $.ajax({
                        url: 'delete_ajax.php',
                        type: 'post',
                        data: {
                            m_id: m_id,
                            action: action
                        },
                        success: setTimeout(function() {
                            window.location.reload();
                        }, 100)
                    })
                }
            }
        }
    </script>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Match</h5>
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
                                <label for="sel_tour" class="form-label">Tournament :</label>
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
                                <label for="sel_team1" class="form-label">Team 1 :</label>
                                <select name="sel_team1" id="sel_team1" class="form-select" required>
                                    <option value="">- - SELECT - -</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="sel_team2" class="form-label">Team 2 :</label>
                                <select name="sel_team2" id="sel_team2" class="form-select" required>
                                    <option value="">- - SELECT - -</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="location" class="form-label">Location :</label>
                                <input type="text" class="form-control" id="location" name="location" value="" required>
                            </div>
                        </div>
                        <div class="row mx-3">
                            <div class="form-group">
                                <label for="m_date" class="form-label">Date & Time :</label>
                                <input type="datetime-local" class="form-control" id="m_date" value="" name="m_date" required>
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
    <?php
    include_once("footer.php");
    ?>
    <script>
        function tour_id(to_id) {
            if (to_id != '') {
                $('#sel_team1').empty();
                $('#sel_team2').empty();
                $.ajax({
                    url: 'selectteam.php',
                    type: 'post',
                    data: {
                        selected_value: to_id
                    },
                    success: function(response) {
                        $('#sel_team1').html(response);
                        $('#sel_team2').html(response);
                    }
                });
            } else {
                $('#sel_team1').empty();
                $('#sel_team2').empty();
                $('#sel_team1').html("<option value=''>- - SELECT - -</option>");
                $('#sel_team2').html("<option value=''>- - SELECT - -</option>");
            }
        }
    </script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>