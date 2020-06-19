<?php
include('../simple_html_dom.php');
$html = file_get_html("https://m.mangabat.com/");
foreach ($html->find('div.panel-category p.pn-category-row a') as $element) {
    if(is_string($element->title)){
        if($element->title == "Adult Manga" ||$element->title == "Ecchi Manga"||$element->title == "Yaoi Manga"||$element->title == "Yuri Manga"||$element->title == "Doujinshi Manga" )
            continue;
        //echo $element->title."<br>";
        echo "<a href=viewgenre.php?g=".$element->href.">".$element->title."</a>"."<br>";
    }
    
    }
?>