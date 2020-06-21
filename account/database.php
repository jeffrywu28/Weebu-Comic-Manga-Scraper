<?php
/* Format konek ke mysql database dengan php adalah ("alamat ip server", "username admin", "password admin", "nama database")  */

$link = mysqli_connect("localhost", "root", "", "proyek");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Print host information
// echo "Connect Successfully. Host info: " . mysqli_get_host_info($link);
?>