<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Electoral Poll: Access Denied</title>
<style>
    .mainnav {
      background-color: #0C0C1C;
      overflow: hidden;
      display: inline-block;
      width: 100%;
      height:75px;    
    }

    #buttons {
      background-color: #D49FE7;
      border-radius: 5px;
      margin-top: 8px;
      padding: 10px 35px;
      font-weight: bolder;
      font-size: 18px;
    }

    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #0C0C1C;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }

    .sidenav a {
      padding: 8px 8px 20px 32px;
      text-decoration: none;
      font-size: 20px;
      color: #FFFFFF;
      display: block;
      transition: 0.3s;
    }

    .sidenav a:hover {
      color: #f1f1f1;
    }

    .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }

    h1{
      color:#FFFF;
    }

    .line{
      float:left;
    }

    .space {
      width: 20px;
      height: auto;
      display: inline-block;
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
<!--side navbar-->
<div class="mainnav">
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="student.php">Home</a>
    <a href="vote.php">Current Polls</a>
    <a href="manage-profile.php">Manage My Profile</a>
    <a href="changepass.php">Change Password</a> 
  </div>
<!--logout button-->
    <span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px;margin-left:20px" onclick="openNav()">&#9776;</span>
    <a href="logout.php"><button class="line" id="buttons" style="margin-left:1000px ;margin-top:20px">Log Out</button></a>
  </div>
</div>
<div style="height: 700px; position: relative;">
  <div class="container">
    <div id="logo" class="box1">                    
      <img src="assets/logoo.jpeg" width="300px" height="380px">
    </div>
    <div id="box" class="box1">                   
      <div class="form">
        <h2 style="margin-top:60px"> ACCESS DENIED!</h2><br>
        <p>Dear Voter, <br><br>
        You are not currently logged in.<br><br>
        <a href="logIn.php">Click here </a> to login first<br><br>
        to get access to the privileges<br><br>
        of a voter.<br><br></p>
      </div>
    </div>                     
  </div>
</div>
</div>
 
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
</body>
</html>
