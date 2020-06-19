<?php
include('simple_html_dom.php');
$html = file_get_html("https://myanimelist.net/topmanga.php?type=favorite");
foreach ($html->find('div.pb12 table.top-ranking-table tr.ranking-list td.title div.detail') as $element) {
    echo $element->plaintext."<br>";
    }
?>