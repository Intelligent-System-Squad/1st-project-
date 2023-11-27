<?php
require('connection.php');

session_start();
//This checks whether session is valid or not.
if(empty($_SESSION['member_id'])){
 header("location:access-denied.php");
}

?>
<?php
// Getting all the positions where the status of the position is active. This means the voter can view only the active positions. 
$positions=mysqli_query($con, "SELECT * FROM tbPositions WHERE status ='Active'");
?> 
<?php
//This is used to check whether the button with name 'submit' is clicked.
 if (isset($_POST['Submit']))
 {
// gets the value of position selected by the voter.
 $position = addslashes( $_POST['position'] ); 
 
 // it get the data of the candidate whose position value matches the positon value which the voter selected.
 $result = mysqli_query($con,"SELECT * FROM tbCandidates WHERE candidate_position='$position'");
  }

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Current Polls - Electoral Poll</title>
<style>
    .mainnav {
      background-color: #0C0C1C;
      overflow: hidden;
      display: inline-block;
      width: 100%;
     
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
#candidatebutton{
      background-color: #504F4F;
      border-radius: 5px;     
      padding: 6px 25px;
      font-weight: bold;
      font-size: 14px;
      color:#FFFF;
    }
  .card {
  background-color: #0C0C1C;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 250px;
  margin: auto;
  text-align: center;  
  margin-left: 40px; 
  margin-top: 40px;
  float:left;
 
}

.title {
  color: grey;
  font-size: 18px;
}
.votes {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: #000000;
  font-weight:bold;
  background-color: #D49FE7;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
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
.boxxx{
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
}
#propic{
 justify:center;
  margin-left: 200px;
}
#error{
  font-weight: bold;
}
.hr1{
      background-color: #0C0C1C;
      height: 3px;
    } 


</style>

<script language="JavaScript" src="js/user.js">
</script>
<script type="text/javascript">
function getVote(candname)
{
if (window.XMLHttpRequest)
  {// This will work for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// This will work for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

	if(confirm("Your vote is for "+candname))
	{
  var votedposition=document.getElementById("str").value;
  var id=document.getElementById("hidden").value;
  xmlhttp.open("GET","save.php?vote="+candname+"&voter_id="+id+"&position="+votedposition,true);
  xmlhttp.send();

  xmlhttp.onreadystatechange =function()
{
	if(xmlhttp.readyState ==4 && xmlhttp.status==200)
	{
  //  alert("dfdfd");
	document.getElementById("error").innerHTML=xmlhttp.responseText;
	}
}

  }
	else
	{
	alert("Choose another candidate ");
	}
	
}

function getPosition(String)
{
if (window.XMLHttpRequest)
  {// This will work for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// This will work for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.open("GET","vote.php?position="+String,true);
xmlhttp.send();
}
</script>
<script type="text/javascript">
$(document).ready(function(){
   var j = jQuery.noConflict();
    j(document).ready(function()
    {
        j(".refresh").everyTime(1000,function(i){
            j.ajax({
              url: "admin/refresh.php",
              cache: false,
              success: function(html){
                j(".refresh").html(html);
              }
            })
        })
        
    });
   j('.refresh').css({color:"green"});
});
</script>
</head>

<body style="background-color: #B6AAAA;">

<div class="mainnav">
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="voter.php">Home</a>
  <a href="vote.php">Current Polls</a>
  <a href="manage-profile.php">Manage My Profile</a>
  <a href="changepass.php">Change Password</a>
  
  
</div>
<span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px; margin-left:20px;" onclick="openNav()">&#9776; </span>
<?php
  $query= mysqli_query($con,"SELECT * FROM tbmembers WHERE member_id ='$_SESSION[member_id]'") or die (mysqli_error());
  $fetch = mysqli_fetch_array($query);
      ?>
      <div class="line" id ="propic"><img src="../admin/img/<?php echo $fetch["image"]; ?>" width = 80 height =80 style ='border-radius : 50%;' title="<?php echo $fetch['image']; ?>"></div>
      <?php 
				echo "<h1 style='margin-left:300px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";
  
  ?>

 
<a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>

</div>



<div style="background-color: #B6AAAA; height: 700px; position: relative;">
 <div class="refresh">
</div> 
<div class="container">
<table width="460px" align="center">
<CAPTION><p class="topic">CHOOSE POSITION</p></CAPTION>
<form name="fmNames" id="fmNames" method="post" action="vote.php" onSubmit="return positionValidate(this)">
<tr>
    
    <td><SELECT class="labels" NAME="position" id="position" onclick="getPosition(this.value)">
    <OPTION VALUE="select" >select
    <?php 
    //loop through all table rows
    while ($row=mysqli_fetch_array($positions)){
    echo "<OPTION VALUE=$row[position_name]>$row[position_name]"; 
    //mysql_free_result($positions_retrieved);
    //mysql_close($link);
    }
    ?>
    </SELECT></td>
    <td><input type="hidden" id="hidden" value="<?php echo $_SESSION['member_id']; ?>" /></td>
    <td><input type="hidden" id="str" value="<?php echo $_REQUEST['position']; ?>" /></td>
    <td><button type="submit" name="Submit" id="candidatebutton">See Candidates</button></td>
</tr>
<tr>
    <td>&nbsp;</td> 
    <td>&nbsp;</td>
</tr>
</form> 
</table>
<hr class="hr1">

<p class= "topic"style="text-align:center;background-color:#504F4F;color:#FFFF;">CANDIDATES</p>

<center><span id="error"></span></center>
  
<?php
//loop through all table rows
//if (mysql_num_rows($result)>0){
  if (isset($_POST['Submit']))
  {
while ($row=mysqli_fetch_array($result)){
echo "<div class='card'>";?>
<img src="../admin/img/<?php echo $row["image"]; ?>" width = 250 height = 200 title="<?php echo $row['image']; ?>">
<?php
echo "<h3 style='color:#FFFF';>" . $row['candidate_name']."</h3>";
echo "<button class='votes' name='vote' value='$row[candidate_name]' onclick='getVote(this.value)'> Vote </button>";
echo "</div>";
}
mysqli_free_result($result);
mysqli_close($con);
//}
 }
else
// do nothing
?>


</div>
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