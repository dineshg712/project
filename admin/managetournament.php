<?php
session_start();
include_once('config.php');
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Score - Live Cricket Score</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/icons/icons.css">
    <script src="../assets/js/sweetalert.min.js"></script>
</head>

<body>
    <?php
    include_once("header.php");
    ?>
    <div class="container">
        <div class="flex-wrap">
            <div class="card my-4">
                <div class="card-header">
                    <h2 align="center">Manage Tournament</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Sno</th>
                                    <th scope="col">Tournament Name</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * from tournament WHERE `status`= 0";
                                $res = mysqli_query($conn, $sql);
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $t_id = $row['tournament_id'];
                                    $i++;
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $row['tournament_name']; ?></td>
                                        <td><?php echo $row['start_date']; ?></td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="openModal('<?php echo $t_id; ?>','to_edit');">
                                                <div class="btn btn-primary">Edit</div>
                                            </a>
                                            <a href="javascript:void(0)" onclick="openModal('<?php echo $t_id; ?>','to_delete');">
                                                <div class="btn btn-danger">Delete</div>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                                $i = 0; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="ajax"></div>
    <?php
    include_once("footer.php");
    ?>
    <script>
        function openModal(t_id, action) {
            if (action == 'to_edit') {
                $.ajax({
                    url: 'manage_ajax.php',
                    type: 'post',
                    data: {
                        t_id: t_id,
                        action: action
                    },
                    success: setTimeout(function() {
                        $("#ajax").load('manage_ajax.php');
                    }, 200)
                })
            }
            if (action == 'to_delete') {
                if(confirm('Are you sure to delete this record?')){
                    $.ajax({
                    url: 'delete_ajax.php',
                    type: 'post',
                    data: {
                        t_id: t_id,
                        action: action
                    },
                    success: setTimeout(function() {
                        window.location.reload();
                    }, 100)
                })
                }
            }
        }
    </script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>