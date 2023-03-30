<?php
include_once('admin/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Score - Live Cricket Score</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/icons/icons.css">
    <script src="assets/js/sweetalert.min.js"></script>
</head>

<body>
    <?php
    include_once("header.php");
    ?>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="flex-wrap">
                <div class="col-12">
                    <h2 class="text-center">Cricket News</h2>
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
                            <img src="<?php echo "assets/images/$ne_id/$ne_image" ?>" style="aspect-ratio: 3/2;object-fit:cover" class="img-fluid" />
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
    <?php
    include_once("footer.php");
    ?>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>