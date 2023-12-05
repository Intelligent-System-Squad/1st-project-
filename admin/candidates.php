  <?php
  session_start();
  require('../connection.php');
  //This query checks whether your session is valid, if not asks you to login
  if(empty($_SESSION['admin_id'])){
  header("location:access-denied.php");
  } 
  //This query gets the candidate details from the tbcandidates table and order it according to the candidate position
  $result=mysqli_query($con,"SELECT * FROM tbCandidates ORDER BY candidate_position");
  if (mysqli_num_rows($result)<1){
      $result = null;
  }
  ?>
  <?php
  //This query gets all the positions from the tbpositions  
  $positions_retrieved=mysqli_query($con, "SELECT * FROM tbPositions");
  ?>

  <?php 
  // This inserts all the values typed in the add candidate form into the database after the button with the name submit is clicked  
  if (isset($_POST['Submit']))//POST method is used to retrieve form data and send it to the server as a HTTP request 
  {
  $newCandidateName = addslashes( $_POST['name'] ); //prevents from SQL injection types
  $newCandidatePosition = addslashes( $_POST['position'] ); //prevents from SQL injection types
  if($_FILES["image"]["error"] == 4){ // error code 4 is where the image is not uploaded
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["image"]["name"];//Gets the original file name
    $fileSize = $_FILES["image"]["size"];//Gets the original file size
    $tmpName = $_FILES["image"]["tmp_name"];//Gets the temporary file name the server assigned to the uploaded file

    $validImageExtension = ['jpg', 'jpeg', 'png'];//The array containing valid image file extensions
    $imageExtension = explode('.', $fileName); //To get the file extension of the file. It splits the filename into an array using '.'
    $imageExtension = strtolower(end($imageExtension));//Gets last element of the array and converts it to lowercase
    if ( !in_array($imageExtension, $validImageExtension) ){//If extracted extension is not in valid extension array
      echo      
      "<script>
        alert('Invalid Image Extension');
      </script>
      ";
    }
    else if($fileSize > 1000000){//if uploaded image size is greater than 1000000 bytes 
      echo
      "<script>
        alert('Image Size Is Too Large');
      </script>
      ";
    }
    else{
      $newImageName = uniqid(); //creates a new unique identifier by appending the valid extension with a new name
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/' . $newImageName); //Move the uploaded temporary file to the img directory with the unique new filename.
      // Insert the values into the database of candidates
      $query = "INSERT INTO tbCandidates(candidate_name,candidate_position,image) VALUES ('$newCandidateName','$newCandidatePosition','$newImageName')";
      mysqli_query($con, $query);
      header("Location: candidates.php");
      echo
      "<script>
        alert('Successfully Added');        
      </script>
      ";
    }
  }
  }
  ?>

  <?php
  //Check whether id parameter is set in the URL
  if (isset($_GET['id']))
  {
  //If 'id' parameter is present, it stores that value in this variable  
  $id = $_GET['id'];
  
  // delete the candidate details from database connected to the stored value
  $result = mysqli_query($con, "DELETE FROM tbCandidates WHERE candidate_id='$id'");
  
  // redirect back to candidates.php
  header("Location: candidates.php");
  }
  else
  // do nothing   
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        #addbutton:hover{
          background-color: #0C0C1C;
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
        .oneline{
          display: flex;
          background: rgb(201,104,195);
          background: linear-gradient(90deg, rgba(201,104,195,1) 57%, rgba(212,159,231,1) 79%, rgba(201,181,203,1) 100%);
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);  
          justify-content:center;
          align-items: center;
          text-align: center; 
          margin: 0 auto;
          font-size:20px;
          font-weight:bolder;  
          color:#0C0C1C; 
        }
        .space1{
          height: 30px;
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
    <a href="results.php">Poll Results</a>
    <a href="manage-admins.php">Manage Account</a>
    <a href="change-pass.php">Change Password</a>
    </div>
    <span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px;margin-left:20px" onclick="openNav()">&#9776; </span>
    <?php
    //fetching the details of the admin who is logged in 
    $query= mysqli_query($con,"SELECT * FROM tbadministrators WHERE admin_id ='$_SESSION[admin_id]'") or die (mysqli_error());
    $fetch = mysqli_fetch_array($query);//To fetch the row as an array

    // Displaying the name of the admin whose logged , in the top bar 
    echo "<h1 style='margin-left:500px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";
    ?>

    <!--logout button-->
    <a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>

    </div>
    <div style="position: relative;">
    <div class="space1"></div>
  <table width="500" align="center">
  <CAPTION><div class="oneline"><p class>ADD NEW CANDIDATE</p></div></CAPTION>
  <!--form for adding candidates-->
  <form name="fmCandidates" id="fmCandidates" action="candidates.php" method="post" onsubmit="return candidateValidate(this)" enctype="multipart/form-data"><!--Encoding form data before sending it to the server-->
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
  <CAPTION><div class ="oneline"><p>AVAILABLE CANDIDATES</p></div></CAPTION>

  <th>Candidate Name</th>
  <th>Candidate Position</th>
  <th>Candidate Photo</th>
  <th colspan="2" align="center">Action</th>
  </tr>

  <?php
  //loop through all the tbale rows of the tbcandidate table and show their information
  $inc=1;
  //Result is not false and no of rows is greater than 0
  if ($result && mysqli_num_rows($result) > 0) {
  while ($row=mysqli_fetch_array($result)){
      
  echo "<tr>";
  echo "<td>" . $row['candidate_name']."</td>";
  echo "<td>" . $row['candidate_position']."</td>";
  ?>
  <td> <img src="img/<?php echo $row["image"]; ?>"class='imagee' width = '100px' height = '80px' title="<?php echo $row['image']; ?>"> </td>


  <?php
  // edit candidate button
  echo "<td><a href='edit-candidate.php?id=$row[candidate_id]'><button class='delete'><img src='assets/edit.png' height='20px' width='20px' style='margin-right:10px'; />Edit Candidate</a></button></td>";
  // delete candidate button
  echo "<td><a href='candidates.php?id=$row[candidate_id]'><button class='delete'><img src='assets/bin.png' height='20px' width='30px' style='margin-right:10px'; />Delete Candidate</a></button></td>";
  echo "</tr>";
  $inc++;
  }
  mysqli_free_result($result); //Free the space allocated for the result set
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