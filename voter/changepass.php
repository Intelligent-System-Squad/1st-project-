<?php
session_start();
require('connection.php');

//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['member_id'])){
 header("location:access-denied.php");
} 
//retrive student details from the tbmembers table
$result=mysqli_query($con, "SELECT * FROM tbMembers WHERE member_id = '$_SESSION[member_id]'");
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);
if($row)
 {
 // get data from db
 $stdId = $row['member_id']; 
  $encpass= $row['password'];
}
?>
<?php
// updating sql query
if (isset($_POST['changepass'])){
$myId =  $_REQUEST['id'];
$oldpass = md5($_POST['oldpass']);
$newpass = $_POST['newpass'];
$conpass = $_POST['conpass'];
if($encpass == $oldpass)
{
  if($newpass == $conpass)
  {
    $newpassword = md5($newpass); //This will make your password encrypted into md5, a high security hash
    $sql = mysqli_query($con,"UPDATE tbmembers SET password='$newpassword' WHERE member_id = '$myId'" );
    echo "<script>alert('Password Change')</script>";
  }
  else
  {
    echo "<script>alert('New and Confirm Password Not Match')</script>";
  }

}
else
{
    echo "<script>alert('Old password not match')</script>";
}


// redirect back to profile
// header("Location: manage-profile.php");
}
?>

<html><head>
<style>
    .mainnav {
      background-color: #0C0C1C;
      overflow: hidden;
      margin-left: 10cm;
      margin-left: 30px;
      display: inline-block;
     
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
#buttons {
            background-color: #D49FE7;
            border-radius: 5px;
            margin-top: 8px;
            padding: 10px 35px;
            font-weight: bolder;
            font-size: 18px;
        }

        .space {
            width: 20px;
            height: auto;
            display: inline-block;
        }

        .text1 {
            font-size: 25px;
            font-weight: bolder;
            text-align: center;
        }

     
        .space {
            width: 20px;
            height: auto;
            display: inline-block;
        }

        #box {
            background-color: #D49FE7;
            height: 400px;
            width: 500px;
            border-radius: 20px;            
            position: absolute;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
            margin:0;                     
         

        }

        input {
            margin-left: 20%;
            width: 300px;
            border-color: #DDBEBE;
            height: 25px;
            background-color: #0C0C1C;
            color:#FFFF;
        }

        label {
            margin-left: 20%;
        }      

        .form {
            background-color: #0C0C1C;
            padding: 15px;
            height: 350px;           
            color: #DDBEBE;
            border-radius: 0px 0px 20px 20px;
           
        }

        #box2 {
            margin-left: 200px;
        }

        .registerbtn {
            background-color: #D49FE7;
            padding: 10px 35px;
            font-weight: bolder;
            font-size: 18px;
            border-radius: 8px;
            height: 40px;
        }

</style>
</head>
<script language="JavaScript" src="js/admin.js">
</script>
<body> 
<body >
<div style="background-color: #0C0C1C;">

<div class="mainnav">
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="student.php">Home</a>
  <a href="vote.php">Current Polls</a>
  <a href="manage-profile.php">Manage My Profile</a>
  <a href="changepass.php">Change Password</a>
  
  
</div>
<span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px" onclick="openNav()">&#9776; </span>
<?php
  $query= mysqli_query($con,"SELECT * FROM tbmembers WHERE member_id ='$_SESSION[member_id]'") or die (mysqli_error());
  $fetch = mysqli_fetch_array($query);
 
				echo "<h1 style='margin-left:500px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";
  ?>

 
<a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>

</div>

</div>
<div style="background-color: #B6AAAA; height: 700px; position: relative;">
        
        

        <div id="box">
            <p class="text1" style="text-align:center ;">CHANGE PASSWORD</p>

            <form class="form" action="changepass.php?id=<?php echo $_SESSION['member_id']; ?>" method="post">
                <br>
                <label for="oldpass">Old Password</label><br>
                <input type="password" id="oldpass" name="oldpass" value="<?php echo $firstName ?>"><br><br>
                <label for="newpass">New Password</label><br>
                <input type="password" id="newpass" name="newpass"value="<?php echo $lastName ?>"><br><br>
                <label for="conpass">Confirm Password</label><br>
                <input type="password" id="conpass" name="conpass" value="<?php echo $email?>"><br><br>                    
                <input type="submit" value="Update Profile" class="registerbtn" name="changepass">
            </form>
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
</body></html>