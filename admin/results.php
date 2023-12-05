<?php
require('../connection.php');
// Getting the candidate details for the selected position
if (isset($_POST['Submit'])){   

  $position = addslashes( $_POST['position'] );
  $posit = mysqli_query($con, "SELECT * FROM tbPositions where position_name= '$position'");
  $posi = mysqli_fetch_array($posit);  
  $results = mysqli_query($con, "SELECT * FROM tbCandidates where candidate_position='$position' ORDER BY candidate_cvotes DESC");   
   
}  
//If export button is clicked 
if (isset($_POST['export'])){   

  $position = addslashes( $_POST['position'] );  
  $details = mysqli_query($con, "SELECT * FROM tbCandidates where candidate_position='$position' ORDER BY candidate_cvotes DESC");    
   
}    
if (isset($_POST['export'])) {
  $position = addslashes($_POST['position']);
  $details = mysqli_query($con, "SELECT * FROM tbCandidates where candidate_position='$position' ORDER BY candidate_cvotes DESC");

  // Set the header for Excel file
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="results.xls"');
  header('Cache-Control: max-age=0');

  echo "<table border='1'>";
  echo "<tr>
          <th>Candidate Name</th>
          <th>Candidate Position</th>          
          <th>Votes</th>
        </tr>";

  while ($candidate = mysqli_fetch_array($details)) {
      echo "<tr>";
      echo "<td>" . $candidate['candidate_name'] . "</td>";
      echo "<td>" . $candidate['candidate_position'] . "</td>";
      echo "<td>" . $candidate['candidate_cvotes'] . "</td>";
      echo "</tr>";
  }
  echo "</table>";
  exit();
}
?>
<?php
// sql query to get all the positions
$positions=mysqli_query($con, "SELECT * FROM tbPositions");
?>
<?php
session_start();
//It will go back to the login page and avoids access if the session is not valid
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
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
    .topic{
      font-size:20px;
      font-weight:bold;
      background: rgb(201,104,195);
      background: linear-gradient(90deg, rgba(201,104,195,1) 57%, rgba(212,159,231,1) 79%, rgba(201,181,203,1) 100%);
      color:#0C0C1C;  
    }
    .lin{
      font-size:23px;
      font-weight:bolder;  
      color:#0C0C1C;
      float:left;
      text-transform: uppercase;  
    }
    .labels{
      font-size:18px;
      font-weight:bold;
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
    #buttons{
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
    .space {
      width: 20px;
      height: auto;
      display: inline-block;
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
    .hr1{
      background-color: #0C0C1C;
      height: 3px;
    } 
    footer{
      background-color: #0C0C1C;
      width: 100%;
      text-align:center;
      color:#FFFFFF;
      display: inline-block;
      margin-top:80px;
      }
    .button-container{
      display:flex;
      justify-content:center;
      align-items: center;
      gap:30px;
    }
    .oneline{
      display: flex;
      background: rgb(201,104,195);
      background: linear-gradient(90deg, rgba(201,104,195,1) 57%, rgba(212,159,231,1) 79%, rgba(201,181,203,1) 100%);
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      width:700px;
      justify-content:center;
      align-items: center;
      text-align: center; 
      margin: 0 auto;
    }
    .space1{
      height: 30px;
    }
</style>
<script language="JavaScript" src="js/admin.js">
</script>
<title> Electoral Poll: Poll Results </title>
</head>
<body style="background-color: #B6AAAA;"><div style="background-color: #0C0C1C;">
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
<span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px" onclick="openNav()">&#9776; </span>
<?php
//sql query to retrieve admin details of the admin who has logged in
  $query= mysqli_query($con,"SELECT * FROM tbadministrators WHERE admin_id ='$_SESSION[admin_id]'") or die (mysqli_error());
  $fetch = mysqli_fetch_array($query);
 // displaying the admin details 
echo "<h1 style='margin-left:500px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";
 ?>

<!--logout button--> 
<a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>
</div>
</div>
<div style="position: relative;">
<table width="420" align="center">
<br>
<!--form to choose position to view results and export it-->
<form name="fmNames" id="fmNames" method="post" action="results.php" onSubmit="return positionValidate(this)">
<tr>
    <td class="labels">Choose Position</td>
    <td><SELECT class="labels" name="position" id="position">
    <OPTION VALUE="select">select
    <?php 
    //loop through all table rows and display the position names
    while ($row=mysqli_fetch_array($positions)){
    echo "<OPTION VALUE=$row[position_name]>$row[position_name]";     
    }
    ?>
    </SELECT></td>
   
   
</tr>
  </table>
  <br>
 <div class="button-container"> 
 <center> <input class="sidebyside" type="submit" name="Submit" id="addbutton" value="See Results" /></center>
 <center> <input class="sidebyside" type="submit" name="export" id="addbutton" value="export Results" onclick="return confirm('Are you sure you want to export the results?');" /></center>
  </div>
 
  </form>
  <div class="space1"></div>
 


<table class="maintbl" width="700px" align="center">
 <!-- display the results of the selected position--> 
 <CAPTION>
  <div class="oneline">
    <p class='lin' >
        Results&nbsp<?php if(isset($_POST['Submit'])){ echo "<p class='lin'> of " . $posi['position_name'] . " Poll</p>"; }?>
    </p>
  </div>
</CAPTION>
<div class="space1"></div>

<th>Candidate Name</th>
<th>Candidate Position</th>
<th>Candidate Photo</th>
<th>Votes</th>
</tr>
<?php if(isset($_POST['Submit'])){
 $inc=1;
while ($row=mysqli_fetch_array($results)){  
      
echo "<tr>";
echo "<td>" . $row['candidate_name']."</td>";
echo "<td>" . $row['candidate_position']."</td>";
?>
<td> <img src="img/<?php echo $row["image"]; ?>" width = 100 height = 80 title="<?php echo $row['image'];?>"> </td>

<?php
echo "<td>". $row['candidate_cvotes']."</td>";
echo "</tr>";
$inc++;
}
}

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
</body></html>