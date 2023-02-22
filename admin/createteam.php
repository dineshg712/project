<?php
if (isset($_POST['submit']) && $_POST['randcheck'] == $_SESSION['rand']) {
    unset($_SESSION['rand']);
    $sql = "SELECT `team_id` from team ORDER BY `team_id` DESC LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        if ($res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
            $team = $row['team_id'];
        } else {
            $team = "TE000";
        }
    }
    $value2 = substr($team, 2);
    $value2 = $value2 + 1;
    $value2 = sprintf('%03s', $value2);
    $team_id = "TE" . $value2;
    $tour_id = $_POST['sel_tour'];
    $te_name = $_POST['te_name'];
    $sql = "INSERT INTO team(`tournament_id`,`team_id`,`team_name`) VALUES ('$tour_id','$team_id','$te_name') ";
    $res = mysqli_query($conn, $sql);
}
?>

<div class="row mt-3">
    <div class="flex-wrap">
        <div class="col-12">
            <button type="button" class="login-btn float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="width:200px;">Create Team</button>
        </div>
    </div>
</div>
<div class="row mt-4 mb-4">
    <div class="flex-wrap">
        <div class="card">
            <div class="card-header">
                <h2 align="center">Tournaments</h2>
            </div>
            <div class="card-body">
                <?php
                $sql = "SELECT * from tournament WHERE `status`= 0";
                $res = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    $t_id = $row['tournament_id'];
                ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-7">
                                    <h6>Tournament Name</h6>
                                </div>
                                <div class="col-5">
                                    <h6>No. Of Teams</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <?php echo $row['tournament_name']; ?>
                                </div>
                                <div class="col-5">
                                    <?php
                                    $sql1 = "SELECT COUNT(`team_id`) AS total FROM `team` WHERE `tournament_id`='$t_id'";
                                    $res1 = mysqli_query($conn, $sql1);
                                    $row1 = mysqli_fetch_assoc($res1);
                                    echo $row1['total'];
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mx-2">
                            <form action="" id="myform">
                                <input type="hidden" name="to_id" id="t_id" value="">
                            </form>
                            <a href="" onclick="openModal('<?php echo $t_id; ?>');" data-bs-toggle="modal" id="openModal">View Teams</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>
    function openModal(to_id) {
        $.ajax({
            url: 'viewteams.php',
            type: 'post',
            data: {to_id:to_id},
            success: setTimeout(function(){
                    $("#view-teams").load('viewteams.php');
                },200)
        })
    }
</script>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Team</h5>
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
                            <select name="sel_tour" id="sel_tour" class="form-select" required>
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
                    <div class="row mx-3">
                        <div class="form-group">
                            <label for="te_name" class="form-label">Team Name :</label>
                            <input type="text" class="form-control" id="te_name" name="te_name" placeholder="Enter Team Name" required>
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
<div id="view-teams"></div>