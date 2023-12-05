<?php
session_start();
require('../connection.php');
//If the sesion is not valid, it will send you back to the login screen
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
}
//This is to get all the positions from the tbPositions table
$result=mysqli_query($con, "SELECT * FROM tbPositions");
if (mysqli_num_rows($result)<1){
    $result = null;
}
?>
<?php
//inserting positions
if (isset($_POST['Submit']))
{
//gets the position inserted through form
$newPosition =mysqli_real_escape_string( $con, $_POST['position'] ); //prevents SQL injection
//setting the starting and ending date of the position elections
$starting_date = mysqli_real_escape_string($con, $_POST['starting_date']);//prevents SQL injection
$ending_date = mysqli_real_escape_string($con, $_POST['ending_date']);//prevents SQL injection
$inserted_on = date("Y-m-d");

$date1=date_create($inserted_on);//date the position is inserted on is put into a variable
$date2=date_create($starting_date);
$diff=date_diff($date1,$date2);//finds the difference between current date and starting date
        
//setting whether the election is active or inactive
if((int)$diff->format("%R%a") > 0)//checks sign and the absolute value obtained by diff variable and checks whether it's greater than zero 
{
    $status = "InActive";
}else {
    $status = "Active";
}
//Insert all the values entered in form into position table
$sql = mysqli_query($con, "INSERT INTO tbpositions (position_name,starting_date, ending_date, status, inserted_on) VALUES ('$newPosition', '$starting_date', '$ending_date', '$status', '$inserted_on')");

// go to positions page
header("Location: positions.php");
}
?>

<?php 
   
   require('../connection.php');
    $fetchingElections = mysqli_query($con, "SELECT * FROM tbpositions") OR die(mysqli_error($con));
    while($data = mysqli_fetch_assoc($fetchingElections))
    {
        $stating_date = $data['starting_date'];
        $ending_date = $data['ending_date'];
        $curr_date = date("Y-m-d");
        $position_id = $data['position_id'];
        $status = $data['status'];

        //setting if the election date is expired   

        if($status == "Active")
        {
            $date1=date_create($curr_date);
            $date2=date_create($ending_date);
            $diff=date_diff($date1,$date2);
            
            if((int)$diff->format("%R%a") < 0)
            {
                // Updating election status 
                mysqli_query($con, "UPDATE tbpositions SET status = 'Expired' WHERE position_id = '". $position_id ."'") OR die(mysqli_error($con));
            }
        }
        //setting inactive elections to active according to starting date
        else if($status == "InActive")
        {
            $date1=date_create($curr_date);
            $date2=date_create($stating_date);
            $diff=date_diff($date1,$date2);
            

            if((int)$diff->format("%R%a") <= 0)
            {
               //Updating election status 
                mysqli_query($con, "UPDATE tbpositions SET status = 'Active' WHERE position_id = '". $position_id ."'") OR die(mysqli_error($con));
            }
        }
        

    }
?>


<?php
// deleting a position
 if (isset($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 //sql query to delete the position
 $result = mysqli_query($con, "DELETE FROM tbPositions WHERE position_id='$id'");
 
 // comeback again to the positions page 
 header("Location: positions.php");
 }
 else

    
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Electoral Poll: Manage Positions</title>

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
    #addbutton:hover{
      background-color: #0C0C1C;
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
    footer{
        background-color: #0C0C1C;
        width: 100%;
        text-align:center;
        color:#FFFFFF;
        display: inline-block;
        margin-top:80px;
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
    hr.line1{
      border-top: 2px solid #0C0C1C;
    }
    hr.line2{
      border-top: 2px solid #0C0C1C;
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
<div style="background-color: #0C0C1C;">
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
<span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px" onclick="openNav()">&#9776; </span>
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
<div style="background-color: #B6AAAA; height: 800px; position: relative;">
<div id="container">
<div class="space1"></div>
<!--Add position form-->
<table width="460px" align="center">
<CAPTION><div class="oneline"><p>ADD NEW POSITION</p></div></CAPTION>
<form name="fmPositions" id="fmPositions" action="positions.php" method="post" onsubmit="return positionValidate(this)">
<tr>
    <td><p>Position Name<p></td>
    <td><input type="text" name="position" required/></td>    
</tr>
<tr>
    <td><p>Starting Date<p></td>
    <td><input type="Date" name="starting_date" required/></td>    
</tr>
<tr>
    <td><p>Ending Date<p></td>
    <td><input type="Date" name="ending_date" required/></td>    
</tr>
<tr>
<td><button type="submit" name="Submit" id="addbutton">Add</button></td>   
</tr>
</table>

<hr class="hr1">
<!--Table showing added positions-->
<table class="maintbl" width="760px" align="center">
<CAPTION><div class="oneline"><p>POSITION LIST</p></div></CAPTION>
<tr>

<th>Position Name</th>
<th>Action</th>
<th>Starting Date</th>
<th>Ending Date</th>
<th>Status</th>
</tr>

<?php
//loop through all table rows
$inc=1;
if ($result && mysqli_num_rows($result) > 0) {
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['position_name']."</td>";
echo '<td ><a href="positions.php?id=' . $row['position_id'] . '"><button class="delete"><img src="assets/bin.png" height="20px" width="30px" style="margin-right:10px"; />Delete Position</a></button></td>';
echo "<td>" . $row['starting_date']."</td>";
echo "<td>" . $row['ending_date']."</td>";
echo "<td>" . $row['status']."</td>";
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