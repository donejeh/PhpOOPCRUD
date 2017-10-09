<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title><?php echo $page_title; ?></title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/mycss.css" rel="stylesheet">
    <script src="bootstrap/js/jquery-2.1.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/myJs.js"></script>
    <link rel="icon" type="image/png"  href="images/fav.jpg" />

 
</head>
<body>
    <div class="loader"></div>
    <!-- container -->
    <div class="container">
 
        <?php
        // show page header
        echo "<div class='page-header' style='background:black;margin-top:-20px;margin-bottom:-40px;color:white '>";
            echo "<h1>{$page_title}</h1>
                <h3>Create, Retrieve, Update, Delete.</h3>
            ";
        echo "</div>";
        ?>

