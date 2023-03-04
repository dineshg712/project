<?php
session_start();
ob_start();
include_once('config.php');
if (isset($_POST['t_id'])) {
    $_SESSION['t_id'] = $_POST['t_id'];
    $_SESSION['action'] = $_POST['action'];
}
if (isset($_POST['te_id'])) {
    $_SESSION['te_id'] = $_POST['te_id'];
    $_SESSION['action'] = $_POST['action'];
}
if (isset($_SESSION['action'])) {
    $action = $_SESSION['action'];
}
if (isset($_SESSION['t_id'])) {
    $t_id = $_SESSION['t_id'];
}
if (isset($_SESSION['te_id'])) {
    $te_id = $_SESSION['te_id'];
}
if ($action == 'to_edit') {
?>
    <div class="modal fade" id="mymodal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tournament</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="edit_tournament.php" method="post">
                    <?php
                    $sql = "SELECT * FROM tournament WHERE `tournament_id`='$t_id'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res)
                    ?>
                    <input type="hidden" name="t_id" value="<?php echo $t_id; ?>">
                    <div class="modal-body">
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="t_name" class="form-label">Tournament Name :</label>
                                <input type="text" class="form-control" id="t_name" name="t_name" value="<?php echo $row['tournament_name'] ?>" required>
                            </div>
                        </div>
                        <div class="row mx-3">
                            <div class="form-group">
                                <label for="s_date" class="form-label">Starting Date :</label>
                                <input type="date" class="form-control" id="s_date" value="<?php echo $row['start_date'] ?>" name="s_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Ok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php }
if ($action == 'te_edit') {
?>
    <div class="modal fade" id="mymodal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="edit_team.php" method="post">
                    <?php
                    $sql = "SELECT * FROM team WHERE `team_id`='$te_id'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res)
                    ?>
                    <input type="hidden" name="te_id" value="<?php echo $te_id; ?>">
                    <div class="modal-body">
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="te_name" class="form-label">Team Name :</label>
                                <input type="text" class="form-control" id="te_name" name="te_name" value="<?php echo $row['team_name'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Ok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    $('#mymodal').modal('show');
</script>