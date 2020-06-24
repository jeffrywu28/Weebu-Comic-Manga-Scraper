<?php
  $con=mysqli_connect("localhost","root","","proyek");
  
  $postData = file_get_contents("php://input");
  if($postData){
    $dataxml = simplexml_load_string($postData);

    $id_usr=$dataxml->iduser;
    $manga=$dataxml->namakomik;
    $result=mysqli_query($con, "DELETE FROM `account_like` WHERE account_like.id_account= $id_usr AND account_like.liked_comic_name='$manga'");

    if($result){
      echo "Sukses";
    }
  }
?>