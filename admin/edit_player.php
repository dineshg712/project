<?php
include 'config.php';
if(isset($_POST['submit'])) {
    $p_id = $_POST['p_id'];
    $p_name = $_POST['p_name'];
    $role = $_POST['sel_role'];
    $sql = "UPDATE player SET `player_name`='$p_name',`role`='$role' WHERE `player_id`='$p_id'";
    $res = mysqli_query($conn ,$sql);
    header('Location: manageplayer.php');
}
?>