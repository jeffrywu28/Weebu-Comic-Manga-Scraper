<?php
session_start();
require_once("database.php");
$val = $_SESSION["name"];
$manga=$_GET["m"];

$id_user = mysqli_query($link, "SELECT id FROM `account_user` WHERE '$val' = user_name");
$id_user = mysqli_fetch_array($id_user)[0];
$checklike = mysqli_query($link, "SELECT like_status FROM account_user INNER JOIN account_like ON account_user.id=account_like.id_account WHERE $id_user =id AND account_like.liked_comic_name = '$manga'");
$checklike = mysqli_fetch_array($checklike)[0];
echo $checklike;
?>