<?php
  $con=mysqli_connect("localhost","root","","proyek");
  
  $postData = file_get_contents("php://input");
  if($postData){
    $dataxml = simplexml_load_string($postData);

    $nama_usr=$dataxml->namauser;
    $nama_komik=$dataxml->namakomik;
    $result=mysqli_query($con, "DELETE FROM `account_wishlist` WHERE account_wishlist.id_account=$nama_usr AND account_wishlist.wish_comic_name = '$nama_komik'");

    if($result){
      echo "Sukses";
    }
  }
?>