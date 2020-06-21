<?php
require_once("database.php");

$sql = "SELECT * FROM berita_website";
$sql = mysqli_query($link, $sql);

$arr=[];
while ($res = mysqli_fetch_assoc($sql)){
    array_push($arr, $res);
}

echo json_encode($arr)
?>