<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Invalid LogIn</title>
<style>
.topic{
  color: #FFFFFF; 
  text-align:center;
  
}
.container{
    position: absolute;
    
}
#logo{
            
            position: absolute;
            margin-top: 100px; 
            margin-left:150px;         
           
        }
        #box{
            background-color: #D49FE7;
            height: 450px;
            width: 500px;            
            margin-left:700px;
            position:relative;
            margin-top:70px;
              
        }
        .form{
            background-color: #0C0C1C;
            position:absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
            margin:0;        
            height: 400px;
            width:450px;           
            color: #DDBEBE;
            text-align:center;
            font-size: 20px;
                      
        }
        .box1{
          float:left;
        }

</style>
</head>
<body style="background-color: #B6AAAA; ">
<div style="background-color: #0C0C1C; height:60px;position:relative;">
<div class="topic"><h2>Electoral Poll</h2></div>
</div>


<div>
<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);

ob_start();
session_start();
require('../connection.php');

$tbl_name="tbAdministrators"; // Table name


// Defining your login details into variables
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

$encrypted_mypassword=md5($mypassword); //MD5 Hash for security

// MySQL injection protections
$myusername = stripslashes($myusername);
$mypassword = stripslashes($encrypted_mypassword);

//$myusername = mysqli_real_escape_string($myusername);
//$mypassword = mysqli_real_escape_string($mypassword);

//echo $mypassword." ".$myusername;

$sql=mysqli_query($con, "SELECT * FROM tbadministrators WHERE email='$myusername' and password='$mypassword'");
// Checking table row
$count = mysqli_num_rows($sql);

// If username and password is a match, the count will be 1
if($count)
{
// If everything checks out, you will now be forwarded to admin.php

  $user=mysqli_fetch_assoc($sql); 
  $_SESSION['admin_id'] = $user['admin_id'];
  header("location:admin.php");
}
//If the username or password is wrong, you will receive this message below.
else {
  echo 
  "<div class='container' >
  <div id='logo' class='box1'>
                      
                      <img src='assets/logoo.jpeg' width='300px' height='380px'>
                      </div>
                      <div id='box' class='box1'>
                       
                      
                      
                      <div class='form'>
                      <p style='margin-top:60px'>Dear User, <br><br><br>
                        You have entered a wrong email<br><br>
                         or password. Please re-enter<br><br>
                         your email or password correctly.<br><br>
                         Return to <a href='logIn.php'>LogIn</a><br><br>
                         Visit <a href='../homepage.html'> Home</a></p>
  
                      </div>
      </div>
  
                      
                        
  </div>"
;  }
  
ob_end_flush();
?> 
</div>

</body>
</html>