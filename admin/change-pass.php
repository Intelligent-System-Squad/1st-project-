  <?php
  session_start();
  require('../connection.php');
  //This check whether your session is valid, That is whether the admin is logged or not 
  if(empty($_SESSION['admin_id'])){
  header("location:access-denied.php");
  } 
  ?>
  <html>
    <head>
      <style>
        .mainnav {
          background-color: #0C0C1C;
          overflow: hidden;
          display: inline-block;
          width: 100%;    
        }
        footer{
          background-color: #0C0C1C;
          width: 100%;
          text-align:center;
          color:#FFFFFF;
          display: inline-block;
          margin-top:80px;
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
          height: 300px;
          width: 500px;
          border-radius: 20px;            
          position: absolute;        
          top: 30%;
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
            color:#0C0C1C
        }
        h1{
          color:#FFFF;
        }    
        .line{
          float:left;
        }
        .hr1{
          background-color: #0C0C1C;
          height: 3px;
        }  

    </style>
  </head>
    <title>Ekectoral Poll: Change Admin Password</title>
    <body style="background-color: #B6AAAA;" >
    <div >
    <!--Side navigation bar-->
    <div class="mainnav">
    <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="admin.php">Home</a>
    <a href="voters.php">Manage Voters</a>
    <a href="positions.php">Manage Positions</a>
    <a href="candidates.php">Manage Candidates</a>
    <a href="results.php">Poll Results</a>
    <a href="manage-admins.php">Manage Account</a>
    <a href="change-pass.php">Change Password</a>
    </div>
    <span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px;margin-left:20px" onclick="openNav()">&#9776; </span>
    <?php
    //fetching the details of the admin who is logged in 
    $query= mysqli_query($con,"SELECT * FROM tbadministrators WHERE admin_id ='$_SESSION[admin_id]'") or die (mysqli_error());
    $fetch = mysqli_fetch_array($query);

    // Displaying the name of the admin whose logged , in the top bar 
    echo "<h1 style='margin-left:500px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";
    ?>

    <!--logout button-->
    <a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>

    </div>    
  <?php
  //Get the information about the admin who is logged in.
  $result=mysqli_query($con, "SELECT * FROM tbadministrators WHERE admin_id = '$_SESSION[admin_id]'");
  if (mysqli_num_rows($result)<1){
      $result = null;
  }
  $row = mysqli_fetch_array($result);
  if($row)
  {
  // gets the password of the admin from the database.
  $encPass = $row['password'];
  }

  // This inserts all the values typed in the edit password form into the database after the button with the name 'update' is clicked  
  if (isset($_GET['id']) && isset($_POST['update']))
  {
      $myId = addslashes( $_GET['id']);
      $mypassword = md5($_POST['oldpass']);
      $newpass= $_POST['newpass'];
      $confpass= $_POST['confpass'];
      if($encPass==$mypassword)//checking whether the typed old password matches the old password in the database 
      {
          if($newpass==$confpass) //checking whether the new password matches the confirm password
          {
          $newpass = md5($newpass); //Encyting the new password 
          $sql = mysqli_query($con, "UPDATE tbadministrators SET password='$newpass' WHERE admin_id = '$myId'" );
          echo "<script>alert('Your password has been changed.');</script>";// Successfully updating password if new and confirm password matches
          }
          else
          {
              echo "<script>alert('Your new password and confirm password does not match.');</script>";// Not updating the password if new and confirm password does not match 
          }    
      }
      else
      {
          echo "<script>alert('Old password is not correct.');</script>";//Not updating the password if old password does not match the password given in the database 
      }
      
  }
  ?>
  <div style="background-color: #B6AAAA; height: 700px; position: relative;"> 
    <div id="box">
      <!--Change password form-->
      <p class="text1" style="text-align:center;">CHANGE PASSWORD</p>
        <form class="form" action="change-pass.php?id=<?php echo $_SESSION['admin_id']; ?>" method="post" onSubmit="return updateProfile(this)">
          <br>
            <label for="oldpass">Old Password</label><br>
            <input type="password" id="oldpass" name="oldpass" required><br><br>
            <label for="newpass">New Password</label><br>
            <input type="password" id="newpass" name="newpass" required><br><br>
            <label for="confpass">Confirm Password</label><br>
            <input type="password" id="confpass" name="confpass" required><br><br>                    
            <input type="submit" value="Update Password" class="registerbtn" name="update">
        </form>
    </div>        

  <br><br> 
  
        
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