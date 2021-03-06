<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre</title>
</head>
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
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
    }

    .card-body>img {
        max-height: 40%;
        max-width: 40%;
    }

    #active-page {
        font-weight: bold;
    }

    .table-genre {
        padding: 5%;
    }

    a {
        color: white;
    }

    a:hover {
        color: blue;
        text-decoration: none;
    }
    #result {
   position:absolute;
   width: 100%;
   display: block;
   max-width:200px;
   max-height: 200px;
   box-sizing: border-box;
   z-index: 2001;
}

.list-group-item {
  position: absolute;
}

.link-class:hover{
   background-color:#f1f1f1;
}
.link-class>a {
    color: black;
}
</style>
<script>
   var isLoading = false;
   $(document).ready(function(){
      if(isLoading === false) {
      isLoading = true
      }
      $.ajaxSetup({ cache: false });
      var count=1;
      $('#search').keyup(function(){
         $('#data').html('');
         $('#result').html('');
         var searchfield = $('#search').val();
         var expression = new RegExp(searchfield, "i");
         $.getJSON('data.json', function(data) {
            $.each(data, function(key, value){
             if (value.judul.search(expression) != -1)
             {
              $('#result').append('<li class="list-group-item link-class"><a href="'+value.url+'">'+value.judul+'</a></li>');
             }
        });   
         });
      });
   });
</script>
<body>
<?php
  if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    require_once('navgenlogin');
  }else{
    require_once('navgen');
  }
  ?>
  
  <br>
    <h1 style="color: white;">All Genre</h1>
    <?php
    include('../simple_html_dom.php');
    $counter = 0;
    $html = file_get_html("https://m.mangabat.com/");
    echo "<div class='table-genre'>";
    echo "<div class='table-responsive' >";
    echo "<table class='table table-borderless table-striped table-dark' ";
    echo "<tr>";
    foreach ($html->find('div.panel-category p.pn-category-row a') as $element) {
        if (is_string($element->title)) {
            if ($element->title == "Adult Manga" || $element->title == "Ecchi Manga" || $element->title == "Yaoi Manga" || $element->title == "Yuri Manga" || $element->title == "Doujinshi Manga" || $element->title == "Mature Manga")
                continue;
            //echo $element->title."<br>";
            echo "<td>";
            echo "<a href=viewgenre.php?g=" . $element->href . ">" . $element->title . "</a>" . "<br>";
            echo "</td>";
            $counter = $counter + 1;
        }
        if ($counter == 4) {
            echo "</tr>";
            echo "<tr>";
            $counter = 0;
        }
    }
    echo "</tr>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    ?>
</body>

</html>