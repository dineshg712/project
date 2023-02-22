<?php
session_start();
include_once('config.php');
if (isset($_POST['to_id'])) {
    $_SESSION['to_id'] = $_POST['to_id'];
}
$to_id = $_SESSION['to_id'];
?>
<div class="modal fade" id="mymodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Teams</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                $sql = "SELECT * from team WHERE `tournament_id`='$to_id' AND `status`= 0";
                $res = mysqli_query($conn, $sql);
                $i=0;
                while ($row = mysqli_fetch_assoc($res)) {
                    $i++;
                    echo $i." )&emsp;".$row['team_name']."<hr>";
                }$i=0;
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#mymodal').modal('show');
</script>