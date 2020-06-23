<?php
  $con=mysqli_connect("localhost","root","","proyek");
  
  $postData = file_get_contents("php://input");
  if($postData){
    $dataxml = simplexml_load_string($postData);

    $nama_komik=$dataxml->namakomik;
    $nama_user=$dataxml->namauser;

    //get id user
    $id_user = mysqli_query($con, "SELECT id FROM `account_user` WHERE '$nama_user' = user_name");
    $id_user = mysqli_fetch_array($id_user)[0];

    $result=mysqli_query($con, "INSERT INTO `account_like` VALUES(0, $id_user, '".$nama_komik."',TRUE)");

    if($result){
      echo "Sukses";
    }
  }
?>