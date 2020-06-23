<?php session_start(); ?>
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

        .wrapper {
            width: 350px;
            margin: 0 auto;
            color: white;
        }

        .container {
            margin: 0 auto;
        }

        #databerita {
            margin: 0 auto;
            text-align: center;
            color: white;
        }
    </style>
    <script>
        function refreshData(search) {
            $("div[id=databerita]").html("Loading data.. ");
            $.ajax({
                url: "getberita.php",
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
  if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    require_once('navbar/navlogin');
  }else{
    require_once('navbar/navbar');
  }
  ?>

    <div class="container" style="margin-top:3%; margin-bottom: 3%;">
        <h1 style="color:white;" class="mb-3"><b>Berita Anime & Manga Terbaru : </b></h1>
        <div id="databerita">
        </div>
    </div>
</body>

</html>