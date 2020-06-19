<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body class="bg-secondary">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="welcome.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="http://localhost/proyek/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown" id="secret">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin Settings
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item btn btn-dark" style="color:grey" href="addberita.php">Add New Announcement</a>
                        <a class="dropdown-item btn btn-dark" style="color:grey" href="editberita.php">Edit Announcement</a>
                        <a class="dropdown-item btn btn-dark" style="color:grey" href="deleteberita.php">Delete Announcement</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav nav-pills" style="float:right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo htmlspecialchars($_SESSION["name"]); ?>
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                        <a href="welcome.php" class="dropdown-item btn btn-dark" style="color:grey">Profile</a>
                        <a href="" class="dropdown-item btn btn-dark" style="color:grey">Favorite</a>
                        <a href="change-password.php" class="dropdown-item btn btn-warning">Change Password</a>
                        <a href="logout.php" class="dropdown-item btn btn-danger">Sign Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

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
                        <img src="uploads/no2.jpg" class="rounded mx-auto d-block" alt="B" height="500px" max-width="100%" >
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

    <div class="container" style="margin-top:3%; margin-bottom: 3%;">
        <h1 style="color:white;"><b>Announcement : </b></h1>
    	<?php
    		$data = mysqli_query($link, "SELECT * FROM berita_website");
    		while($res = mysqli_fetch_assoc($data)){
                $show_id = $res["id"];
    			$show_judul = $res["judul_berita"];
    			$show_isi = $res["isi_berita"];
    			$show_tanggal = $res["tanggal_kirim"];
    	?>
	        <div class="card bg-dark">
                <div class="card-body" style="color:white;">
                    <h3 style="text-align:left;"><a href="isiberita.php?idberita=<?php echo $show_id;?>" style="color:white;"><b><?php echo $show_judul; ?></b></a></h3>
                    <div style="text-align:right;">
                        <?php echo $show_tanggal; ?>
                    </div>
                </div>
            </div>
		<?php
			}
		?>
	</div>

    <div class="page-header">
        <h1 style="color:white;">Hi, <b><?php echo htmlspecialchars($_SESSION["name"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="change-password.php" class="btn btn-warning">Change Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <?php

    if(htmlspecialchars($_SESSION["status"]) == "adminwibu"){
         echo "<script>document.getElementById('secret').style.visibility = 'visible'</script>";
    } else {
        echo "<script>document.getElementById('secret').style.visibility = 'hidden'</script>";
    }
    ?>
</body>
</html>