<?php
  $con=mysqli_connect("localhost","root","","proyek");
  
  $postData = file_get_contents("php://input");
  if($postData){
    $dataxml = simplexml_load_string($postData);

    $nama_komik=$dataxml->namakomik;
    $id_user=$dataxml->iduser;

    $q="INSERT INTO account_like VALUES(0, $id_user,'$nama_komik',TRUE)";
    
    $result=mysqli_query($con, $q);

    if($result){
      echo "Sukses";
    }else
    {
      die(mysqli_error($con));
    }
 }
?>