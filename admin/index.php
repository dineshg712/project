<?php
    session_start();
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
    <title>Live Score</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/icons/icons.css">
    <style>
        .card {
            background-color: #fff;
            z-index: -1;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            /* border-radius: 20px */
        }
        button {
            height: 40px;
        }
    </style>
</head>
<body>
    <div id="preloader"></div>
    <?php
        include_once("header.php");
    ?>
    <div class="container">
        <?php
            include_once("createtournament.php");
        ?>
    </div>
    <?php
        include_once("footer.php");
    ?>
    <script src="../assets/js/main.js"></script>
</body>
</html>