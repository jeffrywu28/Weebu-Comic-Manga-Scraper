<?php
session_start();
require('account/database.php');
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $login = 'y';
    $val = $_SESSION["name"];
    //get id user
    $id_user = mysqli_query($link, "SELECT id FROM `account_user` WHERE '$val' = user_name");
    $id_user = mysqli_fetch_array($id_user)[0];
} else {
    $login = 'n';
}
include('simple_html_dom.php');
$html = file_get_html($_GET['manga']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weebu Comic</title>
    <script>
        $(".fa-heart").css("color", "red");

        function reloadData() {
            var j = $.ajax({
                type: "GET",
                data: {
                    n: window.location.href
                },
                url: "account/checkmanga.php",
                dataType: "text",
                async: false
            });
            return j.responseText;
        }
    </script>
    <style>
        body {
            margin: 0 px;
        }

        .card {
            margin: 0 auto;
            float: none;
            margin-bottom: 10px;
        }

        .card-body>img {
            max-height: 40%;
            max-width: 40%;
        }

        .chaptername {
            float: left;
        }

        .uploaded {
            float: right;
        }

        td {
            overflow: hidden;
            padding: 0;
        }

        #fixed_header {
            display: block;
            width: 100%;
            overflow: auto;
            height: 500px;
        }

        .fa {
            font-size: 36px;
            padding: 10px;
        }
    </style>

</head>

<body style="background-color: black;">

    <?php
    if ($login == 'y') {
        require('navbar/navlogin');
    } else {
        require('navbar/navbar');
    } ?>

    <!-- main page -->
    <div style="margin: 5em;">
        <div class="card">
            <div class="row no-gutters">
                <div class="col-md-auto" style="width: 200px; margin-top: 1em; margin-left: 1em;">
                    <span><img src="<?php echo $html->find('div.story-info-left', 0)->first_child()->first_child()->src; ?>" class="card-img" alt="..." style="width: 200px;"></span>
                </div>
                <div class="col-md-auto">
                    <?php foreach ($html->find('div.story-info-right') as $element) { ?>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $element->children(0)->plaintext . '</h3>';
                                                    if (is_null($element->children(1)->first_child()->children(3))) {
                                                        echo '<table>';
                                                        echo '<tr>';
                                                        echo '<th>Author(s): ' . $element->children(1)->first_child()->children(0)->last_child()->plaintext . '</th>';
                                                        echo '</tr>';
                                                        echo '<tr>';
                                                        echo '<th>Status :' . $element->children(1)->first_child()->children(1)->last_child()->plaintext . '</th>';
                                                        echo '</tr>';
                                                        echo '<tr>';
                                                        echo '<th>Genres:' . $element->children(1)->first_child()->children(2)->last_child()->plaintext . '</th>';
                                                        echo '</tr>';
                                                    } else {
                                                        echo '<table>';
                                                        echo '<tr>';
                                                        echo '<th>Author(s): ' . $element->children(1)->first_child()->children(1)->last_child()->plaintext . '</th>';
                                                        echo '</tr>';
                                                        echo '<tr>';
                                                        echo '<th>Status :' . $element->children(1)->first_child()->children(2)->last_child()->plaintext . '</th>';
                                                        echo '</tr>';
                                                        echo '<tr>';
                                                        echo '<th>Genres:' . $element->children(1)->first_child()->children(3)->last_child()->plaintext . '</th>';
                                                        echo '</tr>';
                                                    }
                                                }
                                                foreach ($html->find('div.story-info-right-extent') as $element) { ?>
                                </tr>
                                <tr>
                                    <th>First Chapter: <?php echo $element->children(2)->last_child()->plaintext; ?></th>
                                </tr>
                                <tr>
                                    <th>Last Chapter: <?php echo $element->children(3)->last_child()->plaintext; ?></th>
                                </tr> <?php } ?>
                            <tr>
                                <form method="post">
                                    <th><span><i class="fa fa-heart btn" style="color: red;" id="wish" name="wish"></i>
                                            <p id="pesan"></p>
                                        </span><span><i class="fa fa-thumbs-o-up btn" id="like"></i>
                                            <p id="pesanlike"></p>
                                        </span></th>

                                </form>
                            </tr>
                            <script>
                                var y = $(".card-title").text();

                                function reloadlike() {
                                    var k = $.ajax({
                                        type: "GET",
                                        data: {
                                            m: y
                                        },
                                        url: "account/checklike.php",
                                        dataType: "text",
                                        async: false
                                    });
                                    return k.responseText;
                                }

                                if (reloadlike() == '1') {
                                    $("#pesanlike").text("Liked");
                                    $("#like").click(function() {
                                        var id_user = '<?php echo $id_user; ?>';
                                        var nama_komik = $(".card-title").text();
                                        $.ajax({
                                            type: "POST",
                                            url: "account/unlike.php",
                                            data: "<data><iduser>" + id_user + "</iduser><namakomik>" + nama_komik + "</namakomik></data>",
                                            contentType: "text/xml",
                                            dataType: "text",
                                            success: function(res) {
                                                alert("Unlike sukses");
                                                $("#pesanlike").html("Do you like this manga?");
                                                reloadlike();
                                            }
                                        });
                                    })
                                } else {
                                    $("#pesanlike").text("Do you like this manga?");
                                    $("#like").click(function() {
                                        var id_user = '<?php echo $id_user; ?>';
                                        var nama_komik = $(".card-title").text();
                                        $.ajax({
                                            type: "POST",
                                            url: "account/like.php",
                                            data: "<data><iduser>" + id_user + "</iduser><namakomik>" + nama_komik + "</namakomik></data>",
                                            contentType: "text/xml",
                                            dataType: "text",
                                            success: function(res) {
                                                alert("like sukses");
                                                $("#pesanlike").html("Liked");
                                                reloadlike();
                                            }
                                        });
                                    })
                                }
                                //WISHLIST
                                if (reloadData() == '1') {
                                    $("#pesan").text("Berada di Wishlist");
                                    $("#wish").click(function() {
                                        var id_user = '<?php echo $id_user; ?>';
                                        var nama_komik = $(".card-title").text();
                                        $.ajax({
                                            type: "POST",
                                            url: "account/unwish.php",
                                            data: "<data><namauser>" + id_user + "</namauser><namakomik>" + nama_komik + "</namakomik></data>",
                                            contentType: "text/xml",
                                            dataType: "text",
                                            success: function(res) {
                                                alert("batal wishlist sukses");
                                                $("#pesan").html("Belum di Wishlist");
                                                reloadData();
                                            }
                                        });
                                    })

                                } else {
                                    $("#pesan").text("Belum Di Wishlist");
                                    $("#wish").click(function(e) {
                                        var nama_komik = $(".card-title").text();
                                        var nama_user = '<?php echo $_SESSION["name"]; ?>';
                                        var link = window.location.href;
                                        e.preventDefault();
                                        alert(nama_komik);
                                        $.ajax({
                                            type: "POST",
                                            url: "account/wishlist.php",
                                            data: "<data><namakomik>" + nama_komik + "</namakomik><namauser>" + nama_user + "</namauser><hal>" + link + "</hal></data>",
                                            contentType: "text/xml",
                                            dataType: "text",
                                            success: function(res) {
                                                alert("wishlist sukses");
                                                $("#pesan").html("Wishlished");
                                                reloadData();
                                            }
                                        });
                                    });
                                    $(document).ready(function() {
                                        reloadData();
                                        reloadlike();
                                    });
                                }
                            </script>
                            <?php
                            if ($login != 'y') {
                                echo "<script>
                                  $('#like').click(function(){
                                    alert('Login Terlebih dahulu jika ingin menyukai komik ini.');
                                  });
                                  $('#wish').click(function(){
                                    alert('Login Terlebih dahulu jika ingin menyimpan wishlist komik ini.');
                                  });
                                  </script>";
                            }
                            ?>
                            </table>
                        </div>
                </div>
            </div>
            <div class="col" style="margin-top: 1em; margin-bottom: 1em; text-align: center;">
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Summary</button>
                <div id="demo" class="collapse" style="text-align: left;">
                    <?php echo $html->find('div#panel-story-info-description', 0); ?>
                </div>
            </div>
        </div>
        <div class="card" style="margin-top: 10px;" id="fixed_header">
            <div class="card-body">
                <div style="border-bottom: 5px solid red;" id="chapter_name">
                    <span>Chapter Name</span> <span style="float: right;">Uploaded</span>
                </div>
                <table class="table table-borderless">
                    <tbody>
                        <?php
                        foreach ($html->find('ul.row-content-chapter li') as $chapter) {
                            echo '<tr> 
                            <td class="chaptername"> <a href="viewmanga.php?chap=' . $chapter->find('a', 0)->plaintext . '&url=' . $_GET['manga'] . '">' . $chapter->find('a', 0)->plaintext . '</a></td>
                            <td class="uploaded">' . $chapter->find('span', 0)->plaintext . '</td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</body>

</html>