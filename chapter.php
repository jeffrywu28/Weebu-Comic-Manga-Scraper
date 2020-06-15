<?php
session_start();
include('simple_html_dom.php');

//get chapt
$chapter=strtolower($_GET['ch']);
$str = substr($chapter, 0, 4); //memisah chap
$num=explode(" ",$chapter); //memisah string per spasi

if ($num[0] != "chapter") {
    $url=$_SESSION["url"]."-".substr($num[1], 0, 4)."-".str_replace(":","",$num[2]);
}else {
    $url=$_SESSION["url"]."-".$str."-".str_replace(":","",$num[1]);
}

$result=file_get_html($url);
session_unset();
session_destroy();
//prepare ajax manga
//  echo $url."<br>";
// foreach($result->find('div.container-chapter-reader img') as $element)
//        echo $element->src . '<br>';

foreach($result->find('div.container-chapter-reader img') as $element)
       echo $element . '<br>';
?>