<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <?php
    // Initialize the session
    session_start();

    // Check if the user is logged in, if not then redirect him to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["status"] !== "adminwibu") {
        header("location: index.php");
        exit;
    }
    require_once "database.php";

    // Define variables and initialize with empty values
    $judul = $isi = $tanggal = $gambar = "";
    $judul_err = $isi_err = $tanggal_err = $gambar_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["judul"])) {
            $judul_err = "Please fill judul";
        } else {
            $judul = $_POST["judul"];
        }

        if (empty($_POST["isi"])) {
            $isi_err = "Please fill isi";
        } else {
            $isi = $_POST["isi"];
        }

        if (empty($_POST["tanggal"])) {
            $tanggal_err = "Please fill tanggal";
        } else {
            $tanggal = $_POST["tanggal"];
        }

        if (empty($_FILES["gambar"]["tmp_name"])) {
            $gambar_err = "Please choose gambar";
        } else {
            move_uploaded_file($_FILES["gambar"]["tmp_name"], "uploads/" . $_FILES["gambar"]["name"]);
            $gambar = $_FILES["gambar"]["name"];
        }

        // Check input errors before inserting in database
        if (empty($judul_err) && empty($isi_err) && empty($tanggal_err) && empty($gambar_err)) {

            $param_judul = $judul;
            $param_isi = $isi;
            $param_tanggal = $tanggal;
            $param_gambar = $gambar;
            echo '
            <script>
                var judul = "' . $param_judul . '";
                var isi = "' . $param_isi . '";
                var tanggal= "' . $param_tanggal . '";
                var gambar= "' . $param_gambar . '";
                $.ajax({
                        url: "add.php",
                        type: "POST",
                        data: {
                            judul:judul,
                            isi:isi,
                            tanggal: tanggal,
                            gambar: gambar
                        },
                        success: function(res){
                            $("#judul").val("");
                            $("#isi").val("");
                            $("#tanggal").val("");
                            $("#gambar").val("");
                            alert("Sukses Menambah Berita");
                        },
                        error: function(res){
                            alert("data inputan kurang benar!");
                        }
                    });

            </script>';
        }

        // Close connection
        mysqli_close($link);
    }

    ?>
    <style type="text/css">
        body {
            margin: 0 px;
            background-color: black;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
    <script>
    </script>
</head>

<body>
<?php
    require_once('../navbar/navlogin'); 
    ?>

    <div class="wrapper" style="color:white; margin: 0 auto;">
        <h2>Add Berita</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group <?php echo (!empty($judul_err)) ? 'has-error' : ''; ?>">
                <label>Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" value="<?php echo $judul; ?>">
                <b><span class="help-block"><?php echo $judul_err; ?></span></b>
            </div>
            <div class="form-group <?php echo (!empty($isi_err)) ? 'has-error' : ''; ?>">
                <label>Isi</label>
               <textarea type="text" name="isi" id="isi" class="form-control" value="<?php echo $isi; ?>"></textarea>
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
            </div>
        </form>
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