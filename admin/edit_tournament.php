<?php
include 'config.php';
if(isset($_POST['submit'])) {
    $t_id = $_POST['t_id'];
    $t_name = $_POST['t_name'];
    $s_date = $_POST['s_date'];
    $sql = "UPDATE tournament SET `tournament_name`='$t_name',`start_date`='$s_date' WHERE `tournament_id`='$t_id'";
    $res = mysqli_query($conn ,$sql);
    header('Location: managetournament.php');
}
?>