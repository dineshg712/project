<?php
session_start();
include_once('config.php');
if (isset($_POST['batsman1'])) {
    $_SESSION['matchid'] = $_POST['matchid'];
    $sql = "INSERT INTO batsman(`match_id`,`player_id`) VALUES('" . $_POST['matchid'] . "','" . $_POST['batsman1'] . "'),
    ('" . $_POST['matchid'] . "','" . $_POST['batsman2'] . "')";
    $res = mysqli_query($conn, $sql);
    $sql = "INSERT INTO bowler(`match_id`,`player_id`) VALUES('" . $_POST['matchid'] . "','" . $_POST['bowler'] . "')";
    $res = mysqli_query($conn, $sql);
    $sql = "INSERT INTO live(`match_id`,`team_id`,`innings`,`striker`) VALUES('" . $_POST['matchid'] . "','" . $_POST['bat_team'] . "','" . $_POST['innings'] . "','" . $_POST['batsman1'] . "')";
    $res = mysqli_query($conn, $sql);
}
