<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
extract($_REQUEST);

require('../connection.php');
$q="SELECT * FROM tbadministrators WHERE email='$email'";
$result=mysqli_query($con,$q);
if(mysqli_num_rows($result)){
    echo"This email has already been registered. Please try another";
}else{
    echo"";
}
?>