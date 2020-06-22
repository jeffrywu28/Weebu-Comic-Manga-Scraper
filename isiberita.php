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
        
        <script>
        // function refreshData(search) {
        //     $("div[id=databerita]").html("Loading data.. ");
        //     $.ajax({
        //         url: "getberita.php",
        //         data: {
        //             a: 1
        //         },
        //         dataType: "json",
        //         success: function(res) {
        //             var data = res;
        //             var dataDiv = $("#databerita");
        //             var str = '';
        //             //LOOP DATA
        //             for (var i = 0; i < data.length; i++) {
        //                 str += '<h5 style="text-align:right; color:white;">'.d.tanggal_kirim.'</h5>';
        //                 str += ' <h1 style="text-align:center; color:white;"><b>'.d.judul_berita.'</b></h1>';
        //                 var d = data[i];
        //                 str += '<img src="uploads/'.d.gambar_berita.'" class="card-img" alt="fotooo" style="height: 50%; width: 50%;">';
        //                 str += '<p style="color:white">'.d.isi_berita.'</p>';
        //             }
        //             dataDiv.html(str);
        //         },
        //         error: function(a) {
        //             alert("ERRORR");
        //         }
        //     });

        // }

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

        <div id="databerita">
        </div>
      
        <button class="btn btn-dark" style="position:absolute; left:0; right:0; margin:auto;"><a href="index.php" style="color:white;">Back</a></button>
    </div>

</body>

</html>