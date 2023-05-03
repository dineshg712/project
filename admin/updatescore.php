<?php
include_once('config.php');
$one = 0;
$two = 0;
$three = 0;
$sql = "SELECT * FROM batsman WHERE `player_id`='" . $_POST['striker'] . "' AND `match_id`='" . $_POST['matchid'] . "'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$sql2 = "SELECT * FROM batsman WHERE `status`=0 AND `match_id`='" . $_POST['matchid'] . "' ORDER BY `sno` ASC";
$res2 = mysqli_query($conn, $sql2);
$arr = array();
while ($row2 = mysqli_fetch_assoc($res2)) {
    array_push($arr, $row2['player_id']);
}
if($arr[0] == $_POST['striker']) {
    $striker = $arr[0];
    $nonstriker = $arr[1];
}
else {
    $nonstriker = $arr[0];
    $striker = $arr[1];
}
$run = $row['runs'] + $_POST['run'];
$ball = $row['balls'] + $_POST['ball'];
if ($_POST['run'] == 1) {
    $one = $row['1'] + 1;
}
if ($_POST['run'] == 2) {
    $two = $row['2'] + 2;
}
if ($_POST['run'] == 3) {
    $three = $row['3'] + 3;
}
$four = $row['4'] + $_POST['four'];
$six = $row['6'] + $_POST['six'];
(float)$str_rate = ($run / $ball) * 100;
$sql1 = "UPDATE batsman SET `runs`=$run,`balls`=$ball,`1`=$one,`2`=$two,`3`=$three,`4`=$four,`6`=$six,`strike_rate`='" . number_format($str_rate, 2, '.', '') . "' WHERE `player_id`='" . $striker . "' AND `match_id`='" . $_POST['matchid'] . "'";
$res1 = mysqli_query($conn, $sql1);

$sql3 = "SELECT * FROM bowler WHERE `match_id`='" . $_POST['matchid'] . "' AND `status`=0 ORDER BY `sno` DESC LIMIT 1";
$res3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($res3);
$overs = $row3['overs'] + ($_POST['ball'] / 10);
$extra = $row3['extras'] + $_POST['extra'];
$bow_run = $_POST['run'] + $_POST['extra'];
$bow_tot = $row3['total'] + $_POST['run'] + $_POST['extra'];
$wicket = $row3['wicket'] + $_POST['out'];
$ov = explode('.',$overs);
(float)$eco_rate = (($bow_tot / ($ov[0] * 6 + $ov[1])) * 6);
$match_id = $_POST['matchid'];
$bowler_id = $row3['player_id'];
$sql4 = "INSERT INTO `bowler`(`match_id`, `player_id`, `overs`, `extras`, `runs`,`total`, `wicket`, `economy_rate`) VALUES ('$match_id','$bowler_id','$overs','$extra','$bow_run','$bow_tot','$wicket','".number_format($eco_rate, 2, '.', '')."')";
$res4=mysqli_query($conn,$sql4);

$sql5 = "SELECT * FROM live WHERE `match_id`='" . $_POST['matchid'] . "' AND `status`=0";
$res5 = mysqli_query($conn, $sql5);
$row5 = mysqli_fetch_assoc($res5);
$extra = $row5['extras'] + $_POST['extra'];
$total = $row5['total'] + $_POST['run'] + $_POST['extra'];
$wicket = $row5['wicket'] + $_POST['out'];
if($ov[1]==1){
    $div=$ov[0]+0.16;
}else if($ov[1]==2) {
    $div=$ov[0]+0.33;
}else if($ov[1]==3) {
    $div=$ov[0]+0.5;
}else if($ov[1]==4) {
    $div=$ov[0]+0.66;
}else if($ov[1]==5) {
    $div=$ov[0]+0.83;
}else if($ov[1]==6) {
    $div=$ov[0];
}
$run_rate = $total / $div;
if($_POST['run'] == 1 || $_POST['run'] == 3 || $_POST['run'] == 5) {
    $sql6 = "UPDATE live SET `overs`='$overs',`striker`='$nonstriker',`extras`='$extra',`total`='$total',`wicket`='$wicket',`run_rate`='$run_rate' WHERE `match_id`='$match_id' AND `status`=0";
}
else {
    $sql6 = "UPDATE live SET `overs`='$overs',`striker`='$striker',`extras`='$extra',`total`='$total',`wicket`='$wicket',`run_rate`='$run_rate' WHERE `match_id`='$match_id' AND `status`=0";
}
$res6 = mysqli_query($conn,$sql6);