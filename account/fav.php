<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Favorite Manga</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <style type="text/css">
        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            font: 14px sans-serif;
        }

        .bg {
            background-image: url("uploads/background3.jpg");
            background-size: cover;
            box-shadow: inset 120px 100px 250px #000000, inset -120px -100px 250px #000000;
        }

        .wrapper {
            margin-top: 2%;
        }
    </style>
    <script>
        function refreshData(){
            $.getJSON("getfav.php", function(data) {
                for (var i = 0; i < data.length; i++) {
                    $("#tabelwish tbody").append('<tr><td>' + (i + 1) + '</td><td><a style="color:white;" href="' + data[i].link_komik + '">' + data[i].wish_comic_name + '</a></td><td><button type="button" class="btn btn-danger" onclick="myFunction(' + data[i].id_wishlist + ')">Delete</button></td></tr>');
                }
            });
        }
        function myFunction(x) {
            $.ajax({
                type: "POST",
                url: "delfav.php",
                data: "<data><id>" + x + "</id></data>",
                contentType: "text/xml",
                dataType: "text",
                success: function(res) {
                    alert("SUKSES MENGHAPUS DATA");
                    $("#tabelwish tbody").html("");
                    refreshData();
                    
                }
            });
        }
        $(document).ready(function() {
           refreshData();
        });
    </script>
</head>

<body class="bg">
    <?php require_once('../navbar/navlogin'); ?>
    <div class="container" style="text-align:center; color:white;">
        <div class="wrapper">
            <h2>My Favorite Manga</h2>
            <table class="table table-dark" id="tabelwish">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Manga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</body>

</html>