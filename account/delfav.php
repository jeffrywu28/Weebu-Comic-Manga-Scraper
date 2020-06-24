<?php
  $con=mysqli_connect("localhost","root","","proyek");
  
  $postData = file_get_contents("php://input");
  if($postData){
    $dataxml = simplexml_load_string($postData);

    $id=$dataxml->id;
    
    $result=mysqli_query($con, "DELETE FROM `account_wishlist` WHERE account_wishlist.id_wishlist= $id");

    if($result){
      echo "Sukses";
    }
  }
?>