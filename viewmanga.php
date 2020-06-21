<?php
include('simple_html_dom.php');

// $chapter=strtolower($_GET['chap']);
// $url= $_GET['url'];
// $ar_judul = explode (" ",$chapter);

// if (substr($chapter,0,4) != "chap"){
//     $baca=$url.'-'.substr($ar_judul[1],0,4).'-'.str_replace(':', '', $ar_judul[2]);
// } else {
//     $baca=$url.'-'.substr($chapter,0,4).'-'.str_replace(':', '', $ar_judul[1]);
// }
// $html = file_get_html($baca);

// //gambar di loop berikut
// foreach ($html->find('div.container-chapter-reader img') as $element) {
// echo $element;
// }


?>

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

    #active-page {
      font-weight: bold;
    }

    .manga{
        margin: 0 auto;
        text-align: center;
    }
    .isimanga{
        margin: 10px;
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
          <a class="navbar-brand" href="index.php" id="active-page">Home</a>
        </li>
        <li class="nav-item">
          <a class="navbar-brand" href="genre/viewallgenre.php">Genre</a>
        </li>
        <li class="nav-item">
          <a class="navbar-brand" href="account/isiberita.php">News</a>
        </li>
      </ul>
    </div>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
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

  <div class="manga">
      <?php
      $chapter=strtolower($_GET['chap']);
      $url= $_GET['url'];
      $ar_judul = explode (" ",$chapter);
      
      if (substr($chapter,0,4) != "chap"){
          $baca=$url.'-'.substr($ar_judul[1],0,4).'-'.str_replace(':', '', $ar_judul[2]);
      } else {
          $baca=$url.'-'.substr($chapter,0,4).'-'.str_replace(':', '', $ar_judul[1]);
      }
      $html = file_get_html($baca);
      
      //gambar di loop berikut
      foreach ($html->find('div.container-chapter-reader img') as $element) {
      echo "<div class='isimanga'>".$element."</div>";
      }
      ?>
  </div>
</body>

</html>