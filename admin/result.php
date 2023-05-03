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
    <div class="container-fluid">
        <section class="my-3">

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h6>Indian Premiere League, CSK vs MI</h6>
                        </div>
                        <div class="card-body">
                            <p class="fw-bold">CSK - 78/6</p>
                            <p class="fw-bold">MI - 64/9</p>
                            <p class="fw-bold" style="color:red">Chennai Super Kings won by 14 runs.</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="heading" class="form-label">Heading :</label>
                                <input type="text" class="form-control" id="heading" name="heading" placeholder="Maximum 50 characters" required>
                            </div>
                        </div>
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="content" class="form-label">Content :</label>
                                <textarea class="form-control" name="content" id="content" cols="30" rows="5" placeholder="Maximum 255 characters" required></textarea>
                            </div>
                        </div>
                        <div class="row mx-3 mb-2">
                            <div class="form-group">
                                <label for="image" class="form-label">Image : <span class="text-danger" style="font-size:14px;font-weight:bolder">Image should be below 1MB</span></label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include_once("footer.php");
    ?>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>