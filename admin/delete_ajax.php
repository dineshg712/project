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
if(isset($_SESSION['action'])) {
    $action = $_SESSION['action'];
}
if(isset($_SESSION['t_id'])) {
    $t_id = $_SESSION['t_id'];
}
if(isset($_SESSION['te_id'])) {
    $te_id = $_SESSION['te_id'];
}
if ($action == 'to_delete') {
    $sql = "UPDATE tournament SET `status`= 1 WHERE `tournament_id`='$t_id'";
    $res = mysqli_query($conn ,$sql);
}
if ($action == 'te_delete') {
    $sql = "UPDATE team SET `status`= 1 WHERE `team_id`='$te_id'";
    $res = mysqli_query($conn ,$sql);
}
?>