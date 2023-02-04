<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Score</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/icons/icons.css">
</head>

<body>
    <div id="preloader"></div>
    <?php
    include_once("header.php");
    ?>
    <div class="container">
        <div id="load-content"></div>
    </div>
    <?php
    include_once("footer.php");
    ?>
    <script>
        document.body.onload = function() {
            $("#load-content").load('home.php');
        }
    </script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.min.js"></script>
</body>

</html>