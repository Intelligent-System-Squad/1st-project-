    <?php
    session_start();
    require('../connection.php');

    //This checks whether the session is valid or not, that is whether the admin is logged or not
    if(empty($_SESSION['admin_id'])){
    header("location:access-denied.php");
    }
    ?>
    <html>
      <head>
        <title>Electoral Poll: Admin Home Page</title>

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
      h1{
        color:#FFFF;
      }
      .line{
        float:left;
      }

  </style>
  </head>
  <body style="background-color: #B6AAAA;" >
  <div >
  <!-- Side navigation bar-->
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
  <!-- Top navigation bar-->
  <span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px;margin-left:20px" onclick="openNav()">&#9776; </span>
  <?php
  //Query for Getting the details of the admin who is logged in 
  $query= mysqli_query($con,"SELECT * FROM tbadministrators WHERE admin_id ='$_SESSION[admin_id]'") or die (mysqli_error());
  $fetch = mysqli_fetch_array($query);

  // Displaying the name of the admin whose logged, in the top navigation bar
  echo "<h1 style='margin-left:500px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";
  ?>

  <!--logout button-->
  <a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>

  </div>
  <div style="position: relative;">
  <div id="container">
    <div id="logo" class="box1">                      
      <img src="assets/logoo.jpeg" width="300px" height="380px">
    </div>
    <div id="box" class="box1">    
      <div class="form">
        <p style="margin-top:60px">Dear Admin, <br><br><br>
          Create a voting poll of your own<br><br>
          choice by adding positions and<br><br>
          candidates and let your voters cast their<br><br>
          vote to choose a good leader to bring a<br><br>
          productive change.
        </p>
      </div>
    </div>              
  </div>
  </div>
  <footer>
  <p>Created by Electoral Poll. © 2023</p>
  </footer>
        
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