<?php
session_start();
include_once('config.php');
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
if (isset($_POST['submit'])) {
    $sql = "SELECT `news_id` from news ORDER BY `news_id` DESC LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        if ($res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
            $news = $row['news_id'];
        } else {
            $news = "NE000";
        }
    }
    $value2 = substr($news, 2);
    $value2 = $value2 + 1;
    $value2 = sprintf('%03s', $value2);
    $news_id = "NE" . $value2;
    $heading = addslashes($_POST['heading']);
    $content = addslashes($_POST['content']);
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $_FILES['image']['name'] = "$news_id" . "." . $extension;
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    if ($_FILES['image']['size'] < 1048576) {
        $sql = "INSERT INTO news(`news_id`,`heading`,`content`,`image`,`time`) VALUES('$news_id','$heading','$content','$image',NOW())";
        $res = mysqli_query($conn, $sql);
        if ($res === TRUE) {
            mkdir("../assets/images/$news_id");
            $folder = "..\\assets\\images\\$news_id\\" . $image;
            move_uploaded_file($tempname, $folder);
            echo "<script>window.location.href=location.href;</script>";
        }
    }
    else{
        echo "<script>window.alert('Image size should below 1MB');window.location.href=location.href;</script>";
    }
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
        <div class="row mt-3">
            <div class="flex-wrap">
                <div class="col-12">
                    <button type="button" class="login-btn float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="width:200px;">Add Post</button>
                </div>
            </div>
        </div>
        <div class="row">
        <?php
            $sql = "SELECT * from news ORDER BY `time` DESC";
            $res = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($res)) {
                $ne_id = $row['news_id'];
                $ne_image = $row['image'];
        ?>
        <section class="mx-auto my-3" style="max-width: 19rem;">

            <div class="card" style="min-height: 80vh;max-height: 80vh;overflow:hidden">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="<?php echo "../assets/images/$ne_id/$ne_image" ?>" style="aspect-ratio: 3/2;object-fit:cover" class="img-fluid" />
                    <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold"><a><?php echo stripslashes($row['heading']); ?></a></h5>
                    <p class="card-text">
                        <?php echo stripslashes($row['content']); ?>
                    </p>
                </div>
            </div>

        </section>
        <?php } ?>
        </div>
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