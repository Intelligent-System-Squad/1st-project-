<?php
session_start();
require('../connection.php');
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
} 
//retrive candidates from the tbcandidates table
$result=mysqli_query($con,"SELECT * FROM tbCandidates ORDER BY candidate_position");
if (mysqli_num_rows($result)<1){
    $result = null;
}
?>
<?php
// retrieving positions sql query
$positions_retrieved=mysqli_query($con, "SELECT * FROM tbPositions");
/*
$row = mysqli_fetch_array($positions_retrieved);
 if($row)
 {
 // get data from db
 $positions = $row['position_name'];
 }
 */
?>
<?php
$status = $statusMsg = ''; 
// inserting sql query
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
  

// redirect back to candidates


?>


  	

<?php
// deleting sql query
// check if the 'id' variable is set in URL
 if (isset($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 // delete the entry
 $result = mysqli_query($con, "DELETE FROM tbCandidates WHERE candidate_id='$id'");
 
 // redirect back to candidates
 header("Location: candidates.php");
 }
 else
 // do nothing   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration Control Panel:Positions</title>

<script language="JavaScript" src="js/admin.js">
</script>
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
    #addbutton{
      background-color: #504F4F;
      border-radius: 5px;     
      padding: 6px 25px;
      font-weight: bold;
      font-size: 14px;
      color:#FFFF;
    }
    input{
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
p{
  font-size:18px;
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

</style>
</head>
<body >
<div style="background-color: #0C0C1C;">

<div class="mainnav">
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="admin.php">Home</a>
  <a href="positions.php">Manage Positions</a>
  <a href="candidates.php">Manage Candidates</a>
  <a href="refresh.php">Poll Results</a>
  <a href="manage-admins.php">Manage Account</a>
  <a href="change-pass.php">Change Password</a>
</div>
<span style="font-size:30px;cursor:pointer;color:#FFFF" onclick="openNav()">&#9776; </span>

<a href="logout.php"><button id="buttons" style="margin-left:1000px ;">Log Out</button></a>

</div>

</div>
<div style="background-color: #B6AAAA; height: auto; position: relative;">
<div id="container">
<table width="500" align="center">
<CAPTION><p class="topic">ADD NEW CANDIDATE</p></CAPTION>
<form name="fmCandidates" id="fmCandidates" action="candidates.php" method="post" onsubmit="return candidateValidate(this)" enctype="multipart/form-data">
<tr>
    <td><p>Candidate Name</p></td>
    <td><input type="text" name="name" /></td>
</tr>
<tr>
    <td><p>Candidate Position</p></td>
    <!--<td><input type="combobox" name="position" value="<?php echo $positions; ?>"/></td>-->
    <td><SELECT NAME="position" id="position">select
    <OPTION VALUE="select">select
    <?php
    //loop through all table rows
    while ($row=mysqli_fetch_array($positions_retrieved)){
    echo "<OPTION VALUE=$row[position_name]>$row[position_name]";
    //mysql_free_result($positions_retrieved);
    //mysql_close($link);
    }
    ?>
    </SELECT>
    </td>
    <td>  
	<label class="control-label" for="photo">Image:</label>
    
	<input type="file" name="image" > 
  

  </td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><button type="submit" name="Submit" id="addbutton">Add</button></td>
</tr>
</table>
<hr>
<table class="maintbl" width="700px" align="center">
<CAPTION><p class="topic">AVAILABLE CANDIDATES</p></CAPTION>

<th>Candidate Name</th>
<th>Candidate Position</th>
<th>Candidate Photo</th>
<th>Action</th>
</tr>

<?php
//loop through all table rows
$inc=1;
while ($row=mysqli_fetch_array($result)){
    
echo "<tr>";

echo "<td>" . $row['candidate_name']."</td>";
echo "<td>" . $row['candidate_position']."</td>";
?>
<td> <img src="img/<?php echo $row["image"]; ?>" width = 100 height = 100 title="<?php echo $row['image']; ?>"> </td>


<?php
echo '<td><a href="candidates.php?id=' . $row['candidate_id'] . '"><button class="delete"><img src="bin.png" height="20px" width="30px" style="margin-right:10px"; />Delete Candidate</a></button></td>';
echo "</tr>";
$inc++;
}

mysqli_free_result($result);
mysqli_close($con);
?>
</table>
<hr>
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