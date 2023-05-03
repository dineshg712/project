<div class="header">
    <header>
        <div class="logo">Go Score</div>
        <div id="hamburger" class="hamburger"></div>
        <nav id="nav-bar" class="nav-bar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <ul id="nav-link" class="nav-link">
                <li><a href="index.php">Home</a></li>
                <li class="dropdown"><a href="#" id="dropdown-link"><span>Create</span><i id="dropdown-link" class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="addtournament.php">Tournament</a></li>
                        <li><a href="addteam.php">Team</a></li>
                        <li><a href="addplayer.php">Player</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#" id="dropdown-link"><span>Manage</span><i id="dropdown-link" class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="managetournament.php">Tournament</a></li>
                        <li><a href="manageteam.php">Team</a></li>
                        <li><a href="manageplayer.php">Player</a></li>
                    </ul>
                </li>
                <li><a href="fixtures.php">Fixtures</a></li>
                <li><a href="result.php">Result</a></li>
                <li><a href="news.php">News</a></li>
                <li class="dropdown"><a href="#" id="dropdown-link"><span><?php echo $_SESSION['username']; ?></span><i id="dropdown-link" class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="javascript:void(0)" onclick="openModal1();">Change Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
</div>
<script type="text/javascript">
    function openModal1() {
        $('#changePassModal').modal('show');
    }
</script>
<div class="modal fade" id="changePassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="row mx-3 mb-2">
                        <div class="form-group">
                            <label for="n_pass" class="form-label">New Password :</label>
                            <input type="password" class="form-control" id="n_pass" name="n_pass" placeholder="New Password" value="" required>
                        </div>
                    </div>
                    <div class="row mx-3">
                        <div class="form-group">
                            <label for="c_pass" class="form-label">Confirm Password :</label>
                            <input type="password" class="form-control" id="c_pass" value="" placeholder="Confirm Password" name="c_pass" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="change" class="btn btn-primary">Change</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
if(isset($_POST['change'])) {
    $id = $_SESSION['id'];
    $n_pass = md5($_POST['n_pass']);
    $c_pass = md5($_POST['c_pass']);
    if($n_pass == $c_pass) {
        $sql = "UPDATE admin SET `password`='$n_pass' WHERE `id`='$id'";
        $res = mysqli_query($conn,$sql);
        if($res) {
            echo "<script>swal('Changed!','','success')
            .then(() => {window.location.href=location.href;});</script>";
        }
    }
    else {
        echo "<script>swal('Failed!','','error')
        .then(() => {window.location.href=location.href;});</script>";
    }
}
?>