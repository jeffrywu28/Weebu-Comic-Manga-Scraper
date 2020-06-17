<?php
include('simple_html_dom.php');

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
echo $element;
}


?>