<?php
session_start();
$var=$_SESSION["name"];
require_once("database.php");

$sql = "SELECT id_wishlist,wish_comic_name,link_komik FROM account_user INNER JOIN account_wishlist ON account_user.id=account_wishlist.id_account WHERE account_user.user_name = '$var'";
$sql = mysqli_query($link, $sql);

$arr=[];
while ($res = mysqli_fetch_assoc($sql)){
    array_push($arr, $res);
}

echo json_encode($arr)
?>