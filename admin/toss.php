<?php
session_start();
include_once('config.php');
if (isset($_POST['m_id'])) {
    $_SESSION['m_id'] = $_POST['m_id'];
}
$m_id = $_SESSION['m_id'];
if(isset($_POST['submit'])) {
    $m_id=$_POST['m_id'];
    $team1=$_POST['team1'];
    $team2=$_POST['team2'];
    $won_toss=$_POST['toss'];
    $choose=$_POST['choose'];
    $overs=$_POST['overs'];
    $sql = "INSERT INTO toss(`match_id`,`team1`,`team2`,`toss_won`,`choose`,`overs`) VALUES ('$m_id','$team1','$team2','$won_toss','$choose','$overs') ";
    $res = mysqli_query($conn, $sql);
    if($res) {
        $sql1 = "UPDATE schedule SET `status`= 2 WHERE `match_id`='$m_id'";
        $res1 = mysqli_query($conn, $sql1);
        if($res1) {
            header("Location: live.php?matchid=$m_id");
        }
    }
}
?>
<div class="modal fade" id="mymodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Start Match</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="toss.php" method="post">
                <?php
                $sql = "SELECT * FROM schedule WHERE `match_id`='$m_id' AND `status`= 0";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res)
                ?>
                <input type="hidden" name="m_id" value="<?php echo $m_id; ?>">
                <input type="hidden" name="team1" value="<?php echo $row['team1']; ?>">
                <input type="hidden" name="team2" value="<?php echo $row['team2']; ?>">
                <div class="modal-body">
                    <div class="row mx-3 mb-2">
                        <h6>Toss won by :</h6>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <?php
                                $sql1 = "SELECT * FROM team WHERE `team_id`='" . $row['team1'] . "'";
                                $res1 = mysqli_query($conn, $sql1);
                                $row1 = mysqli_fetch_assoc($res1)
                                ?>
                                <input class="form-check-input" type="radio" name="toss" id="team1" value="<?php echo $row['team1']; ?>" checked>
                                <label class="form-check-label" for="team1">
                                    <?php echo $row1['team_name']; ?>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <?php
                                $sql1 = "SELECT * FROM team WHERE `team_id`='" . $row['team2'] . "'";
                                $res1 = mysqli_query($conn, $sql1);
                                $row1 = mysqli_fetch_assoc($res1)
                                ?>
                                <input class="form-check-input" type="radio" name="toss" id="team2" value="<?php echo $row['team2']; ?>">
                                <label class="form-check-label" for="team2">
                                    <?php echo $row1['team_name']; ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-3 mb-2">
                        <h6>Choose to :</h6>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="choose" id="bat" value="bat" checked>
                                <label class="form-check-label" for="bat">
                                    Bat
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="choose" id="bowl" value="bowl">
                                <label class="form-check-label" for="bowl">
                                    Bowl
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-3 mb-2">
                        <div class="form-group">
                            <h6>No. of Overs :</h6>
                            <input type="number" class="form-control" id="overs" name="overs" value="" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Start</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#mymodal').modal('show');
</script>