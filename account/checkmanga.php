<?php
session_start();
require_once("database.php");
$val = $_SESSION["name"];
$manga=$_GET["n"];

$id_user = mysqli_query($link, "SELECT id FROM `account_user` WHERE '$val' = user_name");
$id_user = mysqli_fetch_array($id_user)[0];
$checkwish = mysqli_query($link, "SELECT wish_status FROM account_user INNER JOIN account_wishlist ON account_user.id=account_wishlist.id_account WHERE $id_user =id AND account_wishlist.link_komik = '$manga'");
$checkwish = mysqli_fetch_array($checkwish)[0];
echo $checkwish;
?>