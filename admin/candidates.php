  <?php
  session_start();
  require('../connection.php');
  //This check whether your session is valid, if not asks you to login
  if(empty($_SESSION['admin_id'])){
  header("location:access-denied.php");
  } 
  //This gets the candidate details from the tbcandidates table and order it according to candidate position
  $result=mysqli_query($con,"SELECT * FROM tbCandidates ORDER BY candidate_position");
  if (mysqli_num_rows($result)<1){
      $result = null;
  }
  ?>
  <?php
  //This gets all the positions from the tbpositions  
  $positions_retrieved=mysqli_query($con, "SELECT * FROM tbPositions");

  ?>
  <?php
  $status = $statusMsg = ''; 
  // This inserts all the values typed in the add candidate form into the database after the button with the name submit is clicked  
  if (isset($_POST['Submit']))
  {
  $newCandidateName = addslashes( $_POST['name'] ); //prevents types of SQL injection
  $newCandidatePosition = addslashes( $_POST['position'] ); //prevents types of SQL injection
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
    }
    else if($fileSize > 1000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/' . $newImageName);
      // Insert into database
      $query = "INSERT INTO tbCandidates(candidate_name,candidate_position,image) VALUES ('$newCandidateName','$newCandidatePosition','$newImageName')";
      mysqli_query($con, $query);
      header("Location: candidates.php");
      echo
      "
      <script>
        alert('Successfully Added');
        
      </script>
      ";
    }
  }
  }
  ?>

  <?php
  //
  if (isset($_GET['id']))
  {
  // It will delete the particular candidate after clicking the delete button with the id. The variable id should be set as url
  $id = $_GET['id'];
  
  // delete the candidate details from database
  $result = mysqli_query($con, "DELETE FROM tbCandidates WHERE candidate_id='$id'");
  
  // redirect back to candidates.php
  header("Location: candidates.php");
  }
  else
  // do nothing   
  ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Electoral Poll:Manage Candidates</title>

  <script language="JavaScript" src="js/admin.js">
  </script>
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
      #addbutton{
        background-color: #504F4F;
        border-radius: 5px;     
        padding: 6px 25px;
        font-weight: bold;
        font-size: 14px;
        color:#FFFF;
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
  .topic{
    font-size:20px;
    font-weight:bold;
    background-color:#504F4F;
    color:#FFFF;
    
  }
  .labels{
    font-size:18px;
    font-weight:bold;
  }

  .maintbl  {  
    border: 1px solid #504F4F;
    text-align: left;
    background-color:#FFFF;
    
  }


  .maintbl {
    border-collapse: collapse;
    
  }
  .maintbl th, .maintbl td{  
    padding: 10px;
    border: 1px solid #504F4F;
  }
  .delete{
    background-color: #D49FE7;
        border-radius: 5px;     
        padding: 6px 22px;
        font-weight: bold;
        font-size: 14px;
        color:#0C0C1C;

  }
  a{
    text-decoration:none;
    color:#0C0C1C;
    
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
  input[type="file"]::file-selector-button {
      border: 2px solid ;
      padding: 0.3em 0.5em;
      border-radius: 0.2em;
      background-color: #D49FE7;
      transition: 1s;
      font-size:14px;
      font-weight:bold;
    }

    input[type="file"]::file-selector-button:hover {
      background-color: #D49FE7;
      border: 2px solid ;
      font-size:16px;
      font-weight:bold;
    } 
    .inputt{
      height:18px;
      width:240px;
    }
    .imagee{
      transition: transform .2s;
    }
    .imagee:hover{
      transform:scale(2.5);
    }

    </style>
    </head>
    <body style="background-color: #B6AAAA;" >
    <div >
    <!--navigation bar-->
    <div class="mainnav">
    <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="admin.php">Home</a>
    <a href="voters.php">Manage Voters</a>
    <a href="positions.php">Manage Positions</a>
    <a href="candidates.php">Manage Candidates</a>
    <a href="refresh.php">Poll Results</a>
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
    <div style="position: relative;">
  <table width="500" align="center">
  <CAPTION><p class="topic">ADD NEW CANDIDATE</p></CAPTION>
  <form name="fmCandidates" id="fmCandidates" action="candidates.php" method="post" onsubmit="return candidateValidate(this)" enctype="multipart/form-data">
  <tr>
      <td><p class="labels">Candidate Name</p></td>
      <td><input type="text" name="name" class="inputt" /></td>
  </tr>
  <tr>
      <td><p class="labels">Candidate Position</p></td>   
      <td><SELECT class="labels" name="position" id="position">select
      <OPTION VALUE="select">select
      <?php
      //It shows all the positions available
      while ($row=mysqli_fetch_array($positions_retrieved)){
      echo "<OPTION VALUE=$row[position_name]>$row[position_name]";
      }
      ?>
      </SELECT>
      </td>
      <td>  
    <label class="labels" for="photo">Image:</label>
      
    <input style="font-weight:bold;" type="file" name="image"> 
    

    </td>
  </tr>
  <tr>
      <td>&nbsp;</td>
      <td><button type="submit" name="Submit" id="addbutton">Add</button></td>
  </tr>
  </table>
  <hr class="hr1">
  <table class="maintbl" align="center">
  <CAPTION><p class="topic">AVAILABLE CANDIDATES</p></CAPTION>

  <th>Candidate Name</th>
  <th>Candidate Position</th>
  <th>Candidate Photo</th>
  <th colspan="2" align="center">Action</th>
  </tr>

  <?php
  //loop through all the tbale rows of the tbcandidate table and show their information
  $inc=1;
  if ($result && mysqli_num_rows($result) > 0) {
  while ($row=mysqli_fetch_array($result)){
      
  echo "<tr>";

  echo "<td>" . $row['candidate_name']."</td>";
  echo "<td>" . $row['candidate_position']."</td>";
  ?>
  <td> <img src="img/<?php echo $row["image"]; ?>"class='imagee' width = '100px' height = '80px' title="<?php echo $row['image']; ?>"> </td>


  <?php
  echo "<td><a href='edit-candidate.php?id=$row[candidate_id]&cn=$row[candidate_name]&cp=$row[candidate_position]'><button class='delete'><img src='assets/edit.png' height='20px' width='20px' style='margin-right:10px'; />Edit Candidate</a></button></td>";
  echo "<td><a href='candidates.php?id=$row[candidate_id]'><button class='delete'><img src='assets/bin.png' height='20px' width='30px' style='margin-right:10px'; />Delete Candidate</a></button></td>";
  echo "</tr>";
  $inc++;
  }
  mysqli_free_result($result);
}
  mysqli_close($con);
  ?>
  </table>
  <br><br>
  <hr class="hr1">
  <footer>
      <p>Created by Electoral Poll. © 2023</p>
    </footer>        
      
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