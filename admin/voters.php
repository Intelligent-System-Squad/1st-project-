<?php
session_start();
require('../connection.php');
 //This check whether your session is valid, if not asks you to login
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
} 
//Gets all the voters from the tbcandidates table
$result=mysqli_query($con,"SELECT * FROM tbmembers");
if (mysqli_num_rows($result)<1){
    $result = null;
}
?>

<?php
//This will insert all the details filled in the voter adding form into the database if the button with name submit is clicked
if (isset($_POST['Submit']))
{
$newVoterFName = addslashes( $_POST['fname'] ); //prevents types of SQL injection
$newVoterLName = addslashes( $_POST['lname'] ); //prevents types of SQL injection
$email = addslashes( $_POST['email'] ); //prevents types of SQL injection
$password = addslashes($_POST['password']); //prevents SQL injection
$newpass = md5($password); //This will make your password encrypted into md5 which is secure hash
$emailCheckQuery = "SELECT COUNT(*) as count FROM tbmembers WHERE email = '$email'";
    $emailCheckResult = mysqli_query($con, $emailCheckQuery);
    $emailCount = mysqli_fetch_assoc($emailCheckResult)['count'];
    if ($emailCount > 0) {
      // Email is not unique      
      echo "<script>alert('Email address is not unique. Please choose a different email.');</script>";     
  } else {
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
  $imageExtension = explode('.', $fileName);//To get the file extension of the file. It splits the filename into an array using '.'
  $imageExtension = strtolower(end($imageExtension));//Gets last element of the array and converts it to lowercase
  if ( !in_array($imageExtension, $validImageExtension) ){//If extracted extension is not in valid extension array
    echo
    "
    <script>
      alert('Invalid Image Extension');
    </script>
    ";
  }
  else if($fileSize > 1000000){//if uploaded image size is greater than 1000000 bytes 
    echo
    "
    <script>
      alert('Image Size Is Too Large');
    </script>
    ";
  }
  else{
    $newImageName = uniqid();//creates a new unique identifier by appending the valid extension with a new name
    $newImageName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, 'img/' . $newImageName);//Move the uploaded temporary file to the img directory with the unique new filename.
    // Insert the values into the database of candidates
    $query = "INSERT INTO tbmembers(first_name,last_name,email,password,image) VALUES ('$newVoterFName','$newVoterLName','$email','$newpass','$newImageName')";
    mysqli_query($con, $query);
    header("Location: voters.php");
    echo
    "
    <script>
      alert('Successfully Added');
      
    </script>
    ";
  }
}
}
}
?>

<?php
// It will delete the particular voter after clicking the delete button with the id. The variable id should be set as url 
 if (isset($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 $preresult = mysqli_query($con, "DELETE FROM tblvotes WHERE voter_id='$id'");
 // delete the voter details from database
 $result = mysqli_query($con, "DELETE FROM tbmembers WHERE member_id='$id'");
 
 // redirect back to voters.php page
 header("Location: voters.php");
 }
 else
 // do nothing   
?>
<!DOCTYPE html>
<html lang ="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Electoral Poll: Manage Voters</title>
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
    .inputt{
      height:18px;
      width:240px;

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
    .imagee{
      transition: transform .2s;
    }
    .imagee:hover{
      transform:scale(2.5);
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
  $fetch = mysqli_fetch_array($query);

  // Displaying the name of the admin whose logged , in the top bar 
  echo "<h1 style='margin-left:500px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";
  ?>

  <!--logout button-->
  <a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>

  </div>
  <div style="position: relative;">
  <div class="space1"></div>
<table width ="900" align="center">
  <!--Add new voter form-->
<CAPTION><div class="oneline"><p>ADD NEW VOTER</p></div></CAPTION>
<form name="fmCandidates" id="fmCandidates" action="voters.php" method="post" onsubmit="return voterValidate(this)" enctype="multipart/form-data">
<tr>
    <td><p class="labels">Voter First Name</p>
    <input type="text" name="fname" class="inputt" required /></td>
    <td><p class="labels">Voter Last Name</p>
    <input type="text" name="lname" class="inputt" required /></td>
    <td><p class="labels">Voter Email</p>
    <input type="text" name="email" class="inputt" required/></td>
</tr>
<tr>
<td><p class="labels">Password</p>
    <input type="text" name="password" class="inputt" required/></td>
    <td>  
	<label class="labels"  for="photo">Image:</label>
    
	<input style="font-weight:bold;" type="file" name="image" > 
  

  </td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><button type="submit" name="Submit" id="addbutton">Add</button></td>
</tr>
</table>
<hr class="hr1">
<table class="maintbl" align="center">
<CAPTION><div class="oneline"><p>AVAILABLE VOTERS</p></div></CAPTION>

<th>Voter First Name</th>
<th>Voter Last Name</th>
<th>Image</th>
<th>Email</th>
<th colspan="2" align="center">Action</th>
</tr>

<?php
//loop through all tbmembers table rows
$inc=1;
if ($result && mysqli_num_rows($result) > 0) {
while ($row=mysqli_fetch_array($result)){
    
echo "<tr>";

echo "<td>" . $row['first_name']."</td>";
echo "<td>" . $row['last_name']."</td>";
?>
<td> <img src="img/<?php echo $row["image"]; ?>"class='imagee' width = '100px' height =' 80px' title="<?php echo $row['image']; ?>"> </td>


<?php
echo "<td>" . $row['email']."</td>";
echo "<td><a href='edit-voter.php?id=$row[member_id]'><button class='delete'><img src='assets/edit.png' height='20px' width='20px' style='margin-right:10px'; />Edit Voter</a></button></td>";
echo "<td><a href='voters.php?id=$row[member_id]'><button class='delete'><img src='assets/bin.png' height='20px' width='30px' style='margin-right:10px'; />Delete Voter</a></button></td>";
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