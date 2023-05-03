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
    <div class="row mt-4">
            <h6 align="left">Indian Premiere League</h6>
    </div>
        <div class="table-responsive my-2">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Teams</th>
                        <th scope="col">P</th>
                        <th scope="col">W</th>
                        <th scope="col">L</th>
                        <th scope="col">Pts</th>
                        <th scope="col">Nrr</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">RR</th>
                        <td>3</td>
                        <td>2</td>
                        <td>1</td>
                        <td>4</td>
                        <td>+1.588</td>
                    </tr>
                    <tr>
                        <th scope="row">CSK</th>
                        <td>3</td>
                        <td>2</td>
                        <td>1</td>
                        <td>4</td>
                        <td>+1.018</td>
                    </tr>
                    <tr>
                        <th scope="row">KKR</th>
                        <td>3</td>
                        <td>2</td>
                        <td>1</td>
                        <td>4</td>
                        <td>+0.562</td>
                    </tr>
                    <tr>
                        <th scope="row">GT</th>
                        <td>3</td>
                        <td>1</td>
                        <td>2</td>
                        <td>2</td>
                        <td>+1.018</td>
                    </tr>
                    <tr>
                        <th scope="row">PBKS</th>
                        <td>3</td>
                        <td>1</td>
                        <td>2</td>
                        <td>2</td>
                        <td>+0.432</td>
                    </tr>
                    <tr>
                        <th scope="row">RCB</th>
                        <td>3</td>
                        <td>1</td>
                        <td>2</td>
                        <td>2</td>
                        <td>-0.075</td>
                    </tr>
                    <tr>
                        <th scope="row">MI</th>
                        <td>3</td>
                        <td>0</td>
                        <td>3</td>
                        <td>0</td>
                        <td>-2.078</td>
                    </tr>
                </tbody>
            </table>
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