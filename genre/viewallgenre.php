<?php 
require_once('../simple_html_dom.php');
$html = file_get_html("https://m.mangabat.com/");
?>
<!DOCTYPE html>
<html>
<head>
   <title>Search</title>
</head>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
 #result {
   position: absolute;
   width: 100%;
   max-width:870px;
   cursor: pointer;
   overflow-y: auto;
   max-height: 400px;
   box-sizing: border-box;
   z-index: 1001;
}
.link-class:hover{
   background-color:#f1f1f1;
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
              console.log(count++);
           }
        });   
         });
      });
   });
</script>

<body>
 <br /><br />
 <div class="container" style="width:900px;">
   <h2 align="center">Find Your Favorite Genre</h2>
   <br /><br />
   <div align="center">
     <input type="text" name="search" id="search" placeholder="Search Employee Details" class="form-control" />
  </div>
  <ul class="list-group" id="result"></ul>
  <br />
  <?php
foreach ($html->find('div.panel-category p.pn-category-row a') as $element) {
    if(is_string($element->title)){
        if($element->title == "Adult Manga" ||$element->title == "Ecchi Manga"||$element->title == "Yaoi Manga"||$element->title == "Yuri Manga"||$element->title == "Doujinshi Manga" )
            continue;
        //echo $element->title."<br>";
        echo "<a href=viewgenre.php?g=".$element->href.">".$element->title."</a>"."<br>";
    }
    
    }
?>
</div>
</body>
</html>