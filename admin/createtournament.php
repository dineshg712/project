<?php
if(isset($_POST['submit']) && $_POST['randcheck'] == $_SESSION['rand']) {
    unset($_SESSION['rand']);
    $sql = "SELECT `tournament_id` from tournament ORDER BY `tournament_id` DESC LIMIT 1";
    $res = mysqli_query($conn,$sql);
    if($res) {
        $row = mysqli_fetch_assoc($res);
        $tour = $row['tournament_id'];
    }
    $value2=substr($tour,1);
    $value2=$value2+1;
    $value2=sprintf('%03s',$value2);
    $tournament_id = "T".$value2;
    $t_name=$_POST['t_name'];
    $s_date=$_POST['s_date'];
    $sql = "INSERT INTO tournament(`tournament_id`,`tournament_name`,`start_date`) VALUES ('$tournament_id','$t_name','$s_date') ";
    $res = mysqli_query($conn,$sql);
}
?>

<div class="row mt-3">
    <div class="flex-wrap">
        <div class="col-12">
            <button type="button" class="login-btn float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="width:200px;">Create Tournament</button>
        </div>
    </div>
</div>
<div class="row mt-4 mb-4">
    <div class="flex-wrap">
        <div class="card">
            <div class="card-header">
                <h2 align="center">Tournaments</h2>
            </div>
            <div class="card-body">
                <?php
                    $sql = "SELECT * from tournament";
                    $res = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($res)) {
                ?>
                <div class="card mb-4">
                    <div class="row">
                        <div class="col-7">
                            <div class="card-header">
                                <h6>Tournament Name</h6>
                            </div>
                            <div class="card-body">
                                <?php echo $row['tournament_name']; ?>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="card-header">
                                <h6>Start Date</h6>
                            </div>
                            <div class="card-body">
                            <?php echo $row['start_date']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Tournament</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <?php
                    $rand=rand();
                    $_SESSION['rand']=$rand;
                ?>
                <input type="hidden" name="randcheck" value="<?php echo $rand; ?>">
                <div class="modal-body">
                    <div class="row mx-3 mb-2">
                        <div class="form-group">
                            <label for="t_name" class="form-label">Tournament Name :</label>
                            <input type="text" class="form-control" id="t_name" name="t_name"  value="" required>
                        </div>
                    </div>
                    <div class="row mx-3">
                        <div class="form-group">
                            <label for="s_date" class="form-label">Starting Date :</label>
                            <input type="date" class="form-control" id="s_date" value="" placeholder="Starting Date" name="s_date" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>