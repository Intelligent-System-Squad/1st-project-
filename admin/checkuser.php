<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
extract($_REQUEST);

require('../connection.php');
$q="SELECT * FROM tbadministrators WHERE email='$email'";
$result=mysqli_query($con,$q);
if(mysqli_num_rows($result)){
    echo"email already Registerd Please Try Another";
}else{
    echo"";
}
?>