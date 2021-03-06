<?php
session_start();
include('../simple_html_dom.php');
$html = file_get_html($_GET['g']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weebu Comic</title>
  <!-- CSS only -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <style>
    body {
      margin: 0 px;
      background-color: black;
    }

    .card {
      margin: 0 auto;
      float: none;
      margin-bottom: 10px;
      height: 360px;
    }

    #active-page {
      font-weight: bold;
    }
  </style>
</head>

<body>
<?php
  if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item disabled">
                    <div class="navbar-brand">Wibu Comic</div>
                </li>
                <li class="nav-item active">
                    <a class="navbar-brand" id="active-page" href="http://localhost/proyek/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="http://localhost/proyek/genre/index.php">Genre</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="http://localhost/proyek/latest.php">Latest Release</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="http://localhost/proyek/newest.php">New Manga Arrival</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="http://localhost/proyek/topmanga.php" >Top Manga of All Time</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="http://localhost/proyek/berita.php">Manga News</a>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav nav-pills" style="float:right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.htmlspecialchars($_SESSION["name"]).'
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="http://localhost/proyek/account/index.php" class="dropdown-item btn btn-dark">Profile</a>
                        <a href="http://localhost/proyek/account/fav.php" class="dropdown-item btn btn-dark">Favorite</a>
                        <a href="http://localhost/proyek/account/change-password.php" class="dropdown-item btn">Change Password</a>
                        <a href="http://localhost/proyek/account/logout.php" class="dropdown-item btn">Sign Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>';
  }else{
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item disabled">
                <div class="navbar-brand">Wibu Comic</div>
            </li>
            <li class="nav-item active">
                <a class="navbar-brand" id="active-page" href="http://localhost/proyek/index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand" href="http://localhost/proyek/genre/index.php">Genre</a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand" href="http://localhost/proyek/latest.php">Latest Release</a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand" href="http://localhost/proyek/newest.php">New Manga Arrival</a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand" href="http://localhost/proyek/topmanga.php" >Top Manga of All Time</a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand" href="http://localhost/proyek/berita.php">Manga News</a>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown" id="secret">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Account
            </a>
            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item btn btn-dark" style="color:grey" href="http://localhost/proyek/account/login.php">Login</a>
                <a class="dropdown-item btn btn-dark" style="color:grey" href="http://localhost/proyek/account/register.php">Register</a>
            </div>
        </li>
    </ul>
    </div>
</nav>';
  }
  ?>

  <!--Isi memakai card dalam container-->
  <div class="container-fluid" style="padding: 0 20% 0 20%;">
    <?php
    $count = 1;
    echo '<div class="row" style="margin-top: 1em;" style="margin: 0 auto;">';
    foreach ($html->find('a.item-img') as $element) {
    ?>
      <div class="col-md-3" style="margin: 0 auto;">
        <div class="card text-center" style="width: 200px; margin: 0 auto;">
          <a class="card-block stretched-link text-decoration-none" style="margin: 0 auto;" href="http://localhost/proyek/manga.php?manga=<?php echo $element->href; ?>">
            <img src="<?php echo $element->children(0)->src; ?>" class="card-img-top" width="60px" height="300px">
            <h5 class="mt-1" style="font-size: 15px;"><?php echo $element->title; ?></h5>
          </a>
        </div>
      </div>

    <?php
      if ($count % 4 == 0) {
        echo '</div><div class="row" style="margin-top: 1em;" style="margin: auto;">';
      }
      $count++;
    }
    ?>

  </div>
</body>

</html>