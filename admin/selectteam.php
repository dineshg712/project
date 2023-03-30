<?php
include_once('config.php');
if(isset($_POST['selected_value'])){
    $selected_value = $_POST['selected_value'];
    $sql = "SELECT * from team WHERE `tournament_id`='$selected_value' AND `status`= 0";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $options .= "<option value='".$row['team_id']."'>".$row['team_name']."</option>";
    }
    echo $options;
}
?>