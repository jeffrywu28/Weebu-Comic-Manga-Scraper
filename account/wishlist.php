<?php
  $con=mysqli_connect("localhost","root","","proyek");
  
  $postData = file_get_contents("php://input");
  if($postData){
    $dataxml = simplexml_load_string($postData);

    $nama_komik=$dataxml->namakomik;
    $nama_user=$dataxml->namauser;
    $link_komik=$dataxml->hal;
    //get id user
    $id_user = mysqli_query($con, "SELECT id FROM `account_user` WHERE '$nama_user' = user_name");
    $id_user = mysqli_fetch_array($id_user)[0];
    $q="INSERT INTO account_wishlist VALUES(0, $id_user, '".addslashes($nama_komik)."',TRUE,'$link_komik')";
    $result=mysqli_query($con, $q);

    if($result){
      echo "Sukses";
    }else
    {
      die(mysqli_error($con));
    }
  }
?>