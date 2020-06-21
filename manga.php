<?php
session_start();
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
    </script>
    <style>
        body {
            margin: 0 px;
        }

        .card {
            margin: 0 auto;
            /* Added */
            float: none;
            /* Added */
            margin-bottom: 10px;
            /* Added */
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
                    <a class="navbar-brand" id="active-page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="genre/index.php">Genre</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="topmanga.php" >Top Manga of All Time</a>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown" id="secret">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item btn btn-dark" style="color:grey" href="account/login.php">Login</a>
                    <a class="dropdown-item btn btn-dark" style="color:grey" href="account/register.php">Register</a>
                </div>
            </li>
        </ul>
        </div>
    </nav>

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
                            
                                <!-- like & wish -->
                                <!-- "like.php?nama=<hp echo $html->find('div.story-info-right')->children(0)->plaintext;?>"><i class="fa fa-heart btn" -->
                            <tr>
                            <form method="post">
                            <th><span><i class="fa fa-heart btn"></i></span><span><button class="btn" name="check"><i class="fa fa-thumbs-o-up"></i></button></span></th>
                            </form>
                        </tr>
                                <!-- END like & wish -->
                               
                                <?php
                                
                                $nama='lala';
                                // Check if the user is already logged in, if yes then redirect him to welcome page
                                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                                    header("location: ../account/like.php?n=$nama");
                                    exit;
                                }else{
                                    if(isset($_POST['check'])){
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Login terlebih dahulu untuk like & wishlist.Silahkan Login disini : <a href="account/login.php">Login</a>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>';
                                    }
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