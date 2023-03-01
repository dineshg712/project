<?php
session_start();
include_once('config.php');
if (isset($_POST['t_id'])) {
    $_SESSION['t_id'] = $_POST['t_id'];
}
$t_id = $_SESSION['t_id'];
?>
<div class="modal fade" id="mymodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Players</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table" border="0" style="margin-top: -13px;">
                    <tr>
                        <th>Sno</th>
                        <th>Name</th>
                        <th>Role</th>
                    </tr>
                    <?php  
                        $sql = "SELECT * from player WHERE `team_id`='$t_id' AND `status`= 0";
                        $res = mysqli_query($conn, $sql);
                        $i=0;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $i++;
                    ?>
                        <?php echo "<tr><td>".$i." )</td><td>".$row['player_name']."</td>"; ?>
                        <?php echo "<td>".$row['role']."</td></tr>"; ?>
                <?php }$i=0; ?>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#mymodal').modal('show');
</script>