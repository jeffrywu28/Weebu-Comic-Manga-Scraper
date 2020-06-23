<?php
  $con=mysqli_connect("localhost","root","","proyek");
  
  $postData = file_get_contents("php://input");
  if($postData){
    $dataxml = simplexml_load_string($postData);

    $nama_usr=$dataxml->namauser;

    $result=mysqli_query($con, "DELETE FROM `account_like` WHERE account_like.id_account= $nama_usr");

    if($result){
      echo "Sukses";
    }
  }
?>