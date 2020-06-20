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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
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

        .container {
            width: 100%;
            padding: 3%;
            color: white;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <!--NavBar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item disabled">
                    <div class="navbar-brand">Wibu Comic</div>
                </li>
                <li class="nav-item active">
                    <a class="navbar-brand" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="#">Genre</a>
                </li>
            </ul>
        </div>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ml-auto" id="active-page">
            <li class="nav-item dropdown" id="secret">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item btn btn-dark" style="color:grey" href="#">Login</a>
                    <a class="dropdown-item btn btn-dark" style="color:grey" href="register.php">Register</a>
                </div>
            </li>
        </ul>
        </div>
    </nav>

    <div class="container">
    	<?php
    		$data = mysqli_query($link, "SELECT * FROM berita_website");
    		while($res = mysqli_fetch_assoc($data)){
                $show_id = $res["id"];
                if($_GET["idberita"] == $show_id){
    				$show_judul = $res["judul_berita"];
                    $show_isi = $res["isi_berita"];
                    $show_tanggal = $res["tanggal_kirim"];
                    $show_gambar = $res["gambar_berita"];
    	?>
	    	<h5 style="text-align:right; color:white;"><?php echo $show_tanggal; ?></h5>
            <h1 style="text-align:center; color:white;"><b><?php echo $show_judul; ?></b></h1>
            <img src="uploads/<?php echo $show_gambar; ?>" class="card-img" alt="fotooo" style="height: 50%; width: 50%;">
            <p style="color:white"><?php echo $show_isi; ?></p>
		<?php
                }
			}
		?>
        <button class="btn btn-dark" style="position:absolute; left:0; right:0; margin:auto;"><a href="index.php" style="color:white;">Back</a></button>
	</div>

    <?php
    if(htmlspecialchars($_SESSION["status"]) == "adminwibu"){
         echo "<script>document.getElementById('secret').style.visibility = 'visible'</script>";
    } else {
        echo "<script>document.getElementById('secret').style.visibility = 'hidden'</script>";
    }
    ?>
</body>
</html>