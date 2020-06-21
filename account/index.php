<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
require_once "database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <style type="text/css">
        body {
      margin: 0 px;
      background-color: black;
    }
    #active-page {
      font-weight: bold;
    }
    .container{
        margin: 0 auto;
        margin-top: 3%;
    }
    .hello{
        text-align: center;
    }
    </style>
</head>
<!-- class="bg-secondary" -->

<body>
    <?php
    require_once('../navbar/navlogin'); 
    ?>

    <div class="container">
        <div class="container bg-dark">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="uploads/no1.jpg" class="rounded mx-auto d-block" alt="A" height="500px" max-width="100%">
                    </div>
                    <div class="carousel-item ">
                        <img src="uploads/no2.jpg" class="rounded mx-auto d-block" alt="B" height="500px" max-width="100%">
                    </div>
                    <div class="carousel-item">
                        <img src="uploads/no3.jpg" class="rounded mx-auto d-block" alt="C" height="500px" max-width="100%">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 style="color:white; text-align:center;"><b>Announcement : </b></h1>
        <?php
        $data = mysqli_query($link, "SELECT * FROM berita_website");
        while ($res = mysqli_fetch_assoc($data)) {
            $show_id = $res["id"];
            $show_judul = $res["judul_berita"];
            $show_isi = $res["isi_berita"];
            $show_tanggal = $res["tanggal_kirim"];
        ?>
            <div class="card bg-dark">
                <div class="card-body" style="color:white;">
                    <h3 style="text-align:left;"><a href="isiberita.php?idberita=<?php echo $show_id; ?>" style="color:white;"><b><?php echo $show_judul; ?></b></a></h3>
                    <div style="text-align:right;">
                        <?php echo $show_tanggal; ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    
    <div class="hello">
    <div class="page-header">
        <h1 style="color:white;">Hi, <b><?php echo htmlspecialchars($_SESSION["name"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="change-password.php" class="btn btn-warning">Change Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    </div>
    <?php

    if (htmlspecialchars($_SESSION["status"]) == "adminwibu") {
        echo "<script>document.getElementById('secret').style.visibility = 'visible'</script>";
    } else {
        echo "<script>document.getElementById('secret').style.visibility = 'hidden'</script>";
    }
    ?>
</body>

</html>