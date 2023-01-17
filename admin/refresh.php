<?php
require('../connection.php');
// retrieving candidate(s) results based on position
if (isset($_POST['Submit'])){   
/*
$resulta = mysqli_query($con, "SELECT * FROM tbCandidates where candidate_name='Luis Nani'");

while($row1 = mysqli_fetch_array($resulta))
  {
  $candidate_1=$row1['candidate_cvotes'];
  }
  */
  $position = addslashes( $_POST['position'] );
  
    $results = mysqli_query($con, "SELECT * FROM tbCandidates where candidate_position='$position'");

    $row = mysqli_fetch_array($results); // for the first candidate
   
}
    
        // do nothing
?> 
<?php
// retrieving positions sql query
$positions=mysqli_query($con, "SELECT * FROM tbPositions");
?>
<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection
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
      </style>

<script language="JavaScript" src="js/admin.js">
</script>
</head>
<body style="background-color: #B6AAAA;"><div style="background-color: #0C0C1C;">

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
<span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px" onclick="openNav()">&#9776; </span>
<?php
  $query= mysqli_query($con,"SELECT * FROM tbadministrators WHERE admin_id ='$_SESSION[admin_id]'") or die (mysqli_error());
  $fetch = mysqli_fetch_array($query);
 
				echo "<h1 style='margin-left:500px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";
  ?>

 
<a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>

</div>

</div>
<div style="position: relative;">
<table width="420" align="center">
<form name="fmNames" id="fmNames" method="post" action="refresh.php" onSubmit="return positionValidate(this)">
<tr>
    <td>Choose Position</td>
    <td><SELECT name="position" id="position">
    <OPTION VALUE="select">select
    <?php 
    //loop through all table rows
    while ($row=mysqli_fetch_array($positions)){
    echo "<OPTION VALUE=$row[position_name]>$row[position_name]"; 
    //mysql_free_result($positions_retrieved);
    //mysql_close($link);
    }
    ?>
    </SELECT></td>
    <td><input type="submit" name="Submit" value="See Results" /></td>
</tr>
<tr>
    <td>&nbsp;</td> 
    <td>&nbsp;</td>
</tr>
</form> 
</table>
<table class="maintbl" width="700px" align="center">
<CAPTION><p class="topic">AVAILABLE CANDIDATES</p></CAPTION>

<th>Candidate Name</th>
<th>Candidate Position</th>
<th>Candidate Photo</th>
<th>Action</th>
</tr>
<?php if(isset($_POST['Submit'])){
$inc=1;
while ($row=mysqli_fetch_array($results)){
    
echo "<tr>";

echo "<td>" . $row['candidate_name']."</td>";
echo "<td>" . $row['candidate_position']."</td>";
?>
<td> <img src="img/<?php echo $row["image"]; ?>" width = 100 height = 100 title="<?php echo $row['image']; ?>"> </td>


<?php
echo "<td>". $row['candidate_cvotes']."</td>";
echo "</tr>";
$inc++;
}
}
?>


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