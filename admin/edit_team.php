<?php
include 'config.php';
if(isset($_POST['submit'])) {
    $te_id = $_POST['te_id'];
    $te_name = $_POST['te_name'];
    $sql = "UPDATE team SET `team_name`='$te_name' WHERE `team_id`='$te_id'";
    $res = mysqli_query($conn ,$sql);
    header('Location: manageteam.php');
}
?>