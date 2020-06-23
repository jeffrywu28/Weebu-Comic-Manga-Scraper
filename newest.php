<?php
include('simple_html_dom.php');
$html = file_get_html('https://m.mangabat.com/manga-list-all?type=newest');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latest Comic</title>
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
  <!--NavBar-->
  <?php
  if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    require_once('navbar/navlogin');
  }else{
    require_once('navbar/navbar');
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
          <a class="card-block stretched-link text-decoration-none" style="margin: 0 auto;" href="manga.php?manga=<?php echo $element->href; ?>">
            <img src="<?php echo $element->children(0)->src; ?>" class="card-img-top" width="60px" height="300px">
            <h5 class="mt-1"style="font-size: 15px;"><?php echo $element->title; ?></h5>
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