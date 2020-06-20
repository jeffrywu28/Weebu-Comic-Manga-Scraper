<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["status"] !== "adminwibu"){
    header("location: index.php");
    exit;
}
require_once "database.php";

// Define variables and initialize with empty values
$id = $judul = $isi = $tanggal = $gambar = "";
$id_err = $judul_err = $isi_err = $tanggal_err = $gambar_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(empty($_POST["id"])){
        $id_err = "Please fill id";     
    } else {
        $id = $_POST["id"];
    }

    if(empty($_POST["judul"])){
        $judul_err = "Please fill judul";     
    } else {
        $judul = $_POST["judul"];
    }

    if(empty($_POST["isi"])){
        $isi_err = "Please fill isi";     
    } else {
        $isi = $_POST["isi"];
    }
    
    if(empty($_POST["tanggal"])){
        $tanggal_err = "Please fill tanggal";     
    } else {
        $tanggal = $_POST["tanggal"];
    }
    
    if(empty($_FILES["gambar"]["tmp_name"])){
        $gambar_err = "Please choose gambar";     
    } else {
        foreach ($_FILES["gambar"] as $key => $value) {
            echo $key." = ".$value."<br>";
        }
        move_uploaded_file($_FILES["gambar"]["tmp_name"], "uploads/".$_FILES["gambar"]["name"]);
        $gambar = $_FILES["gambar"]["name"];
    }
    
    // Check input errors before inserting in database
    if(empty($id_err) && empty($judul_err) && empty($isi_err) && empty($tanggal_err) && empty($gambar_err)){
        
        // Prepare an update statement
        $sql = "UPDATE berita_website SET judul_berita = ?, isi_berita = ?, tanggal_kirim = ?, gambar_berita = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_judul, $param_isi, $param_tanggal, $param_gambar, $param_id);
            
            $param_id = $id;
            $param_judul = $judul;
            $param_isi = $isi;
            $param_tanggal = $tanggal;
            $param_gambar = $gambar;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                header("location: welcome.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        
    }
    
    // Close connection
    mysqli_close($link);
}

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
        .wrapper{ width: 350px; padding: 20px;}
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
                    <a class="nav-link active" href="welcome.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="features.html">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Pricing</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
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
                        <a href="" class="dropdown-item btn btn-dark" style="color:grey">Profile</a>
                        <a href="" class="dropdown-item btn btn-dark" style="color:grey">Favorite</a>
                        <a href="change-password.php" class="dropdown-item btn btn-warning">Change Password</a>
                        <a href="logout.php" class="dropdown-item btn btn-danger">Sign Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top:3%; margin-bottom: 3%;">
        <h1 style="color:white;"><b>List Announcement : </b></h1>
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
                    <h3 style="text-align:left;color:white;"><a href="isiberita.php?idberita=<?php echo $show_id;?>" style="color:white;"><b><?php echo $show_judul; ?></b></a></h3>
                    <div style="text-align:right;">
                        <?php echo $show_tanggal; ?>
                    </div>
                    <?php echo $show_id; ?>
                </div>
            </div>
		<?php
			}
		?>
	</div>
    
    <div class="wrapper" style="color:white;">
        <h2>Edit Berita</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group <?php echo (!empty($id_err)) ? 'has-error' : ''; ?>">
                <label>id</label>
                <input type="text" name="id" id="id" class="form-control" value="<?php echo $id; ?>">
                <b><span class="help-block"><?php echo $id_err; ?></span></b>
            </div>
            <div class="form-group <?php echo (!empty($judul_err)) ? 'has-error' : ''; ?>">
                <label>Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" value="<?php echo $judul; ?>">
                <b><span class="help-block"><?php echo $judul_err; ?></span></b>
            </div>    
            <div class="form-group <?php echo (!empty($isi_err)) ? 'has-error' : ''; ?>">
                <label>Isi</label>
                <input type="text" name="isi" id="isi" class="form-control" value="<?php echo $isi; ?>">
                <b><span class="help-block"><?php echo $isi_err; ?></span></b>
            </div>
            <div class="form-group <?php echo (!empty($tanggal_err)) ? 'has-error' : ''; ?>">
                <label>Tanggal Kirim</label>
                <input type="text" name="tanggal" id="tanggal" class="form-control" value="<?php echo $tanggal; ?>">
                <b><span class="help-block"><?php echo $tanggal_err; ?></span></b>
            </div>
            <div class="form-group <?php echo (!empty($gambar_err)) ? 'has-error' : ''; ?>">
                <label>Gambar</label>
                <input type="file" name="gambar" id="gambar">
                <b><span class="help-block"><?php echo $gambar_err; ?></span></b>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" id="tambah">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
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