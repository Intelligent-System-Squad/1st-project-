<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simple PHP Polling System Access Denied</title>
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

<body style="background-color: #B6AAAA;">
<div>
<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);

ob_start();
session_start();
require('../connection.php');


//We insert the login email and password into variables
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];
$encrypted_mypassword=md5($mypassword); //Encrypt password

// This protects from sql injections
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);


$sql=mysqli_query($con, "SELECT * FROM tbmembers WHERE email='$myusername' and password='$encrypted_mypassword'");

// Checking for a match in the member/voter table 
$count=mysqli_num_rows($sql);
// If the username and password matches a row in the table, the count will become 1

if($count==1){
// If count is 1, you will be directed to voter.php
$user = mysqli_fetch_assoc($sql);
$_SESSION['member_id'] = $user['member_id'];
header("location:voter.php");
}

//If the username or password is wrong or unmatching, error message will be shown
else {
  echo
  "<div class='container'>
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
                        
  </div>";
}

ob_end_flush();

?> 
</div>

</body>
</html>