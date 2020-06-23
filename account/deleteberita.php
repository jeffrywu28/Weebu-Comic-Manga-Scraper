<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Berita</title>
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
    $id = $judul = $isi = $tanggal = $gambar = "";
    $id_err = $judul_err = $isi_err = $tanggal_err = $gambar_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["id"])) {
            $id_err = "Please fill id";
        } else {
            $id = $_POST["id"];
        }

        // Check input errors before inserting in database
        if (empty($id_err)) {

            $param_id = $id;

            echo '
                <script>
                    var id= "' . $param_id . '";
                    $.ajax({
                            url: "delete.php",
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function(res){
                                $("#id").val("");
                                alert("Sukses Menghapus Berita");
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
            margin: 0 auto;
        }

        .container {
            margin: 0 auto;
        }
    </style>
    <script>
        function refreshData(search) {
            $("div[id=databerita]").html("Loading data.. ");
            $.ajax({
                url: "../getberita.php",
                data: {
                    a: 1
                },
                dataType: "json",
                success: function(res) {
                    var data = res;
                    var dataDiv = $("#databerita");
                    var str = '';
                    //LOOP DATA
                    for (var i = 0; i < data.length; i++) {
                        str += '<div class="card bg-dark">';
                        str += '<div class="card-body" style="color:white;">';
                        var d = data[i];
                        str += '<h3 style="text-align:left;color:white;"><a href="isiberita.php?idberita=' + d.id + '" style="color:white;"><b>' + d.judul_berita + '</b></a></h3>';
                        str += "<div>";
                        str += '<span style="float:left;">' + d.id + '</span>';
                        str += '<span style="float:right;">' + d.tanggal_kirim + '</span>';
                        str += "</div>";
                        str += "</div>";
                        str += "</div>";
                    }
                    dataDiv.html(str);
                },
                error: function(a) {
                    alert("ERRORR");
                }
            })

        }

        var timer;
        window.onload = function() {
            refreshData("");
            var s = $("input[id=search]");
            clearTimeout(timer);
            timer = setTimeout(function() {
                refreshData(s.val());
            });
        }
    </script>
</head>

<body>
<?php
    require_once('../navbar/navlogin'); 
    ?>
    <div class="wrapper mt-5" style="color:white;">
        <h2>Delete Berita</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group <?php echo (!empty($id_err)) ? 'has-error' : ''; ?>">
                <label>id</label>
                <input type="text" name="id" id="id" class="form-control" value="<?php echo $id; ?>">
                <b><span class="help-block"><?php echo $id_err; ?></span></b>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" id="tambah">
            </div>
        </form>
    </div>

    <div class="container" style="margin-top:3%; margin-bottom: 3%;">
        <h1 style="color:white;"><b>List Announcement : </b></h1>
        <div id="databerita">
        </div>
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