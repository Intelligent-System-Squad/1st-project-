<?php
require('connection.php');

session_start();
//This checks whether session is valid or not/ whether the user is logged in or not.
if(empty($_SESSION['member_id'])){
 header("location:access-denied.php");
}

// Getting all the positions where the status of the position is active. This means the voter can view only the active positions. 
$positions=mysqli_query($con, "SELECT * FROM tbPositions WHERE status ='Active'");

//This is used to check whether the button with name 'submit' is clicked.
 if (isset($_POST['Submit']))
 {
// gets the value of position selected by the voter.
 $position = addslashes( $_POST['position'] ); 

 // query to get the details of the selected position.
 $posit = mysqli_query($con, "SELECT * FROM tbPositions WHERE position_name = '$position'");
 $posi = mysqli_fetch_array($posit);
 
 // it gets the data of the candidates whose position value matches the positon value which the voter selected.
 $result = mysqli_query($con,"SELECT * FROM tbCandidates WHERE candidate_position='$position'");
 }

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Electoral Poll-Current Polls</title>
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
      border:none;
      font-size: 14px;
      color:#FFFF;
      }
     #candidatebutton:hover{
      background-color: #0C0C1C;
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
  
    .lin{
      font-size:21px;
      font-weight:bolder;  
      color:#0C0C1C;
      float:left;
      text-transform: uppercase;
    }  


</style>

<script language="JavaScript" src="js/user.js">
</script>
<script type="text/javascript">
function getVote(candname)
{
  //To interact with the server and make asynchronous requests
if (window.XMLHttpRequest)//Checks whether the browser supports the standard XMLHttpRequest object 
  {
  xmlhttp=new XMLHttpRequest();//If so it creates the instance of the XMLHttpRequest
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");//If it does not support it goes to older version ActiveXobject 
  }

	if(confirm("Your vote is for "+candname))//Alert to confirm vote 
	{
    //If vote is confirmed
  var votedposition=document.getElementById("str").value;//The hidden stored position selected by user
  var id=document.getElementById("hidden").value;//The hidden logged in voter id
  xmlhttp.open("GET","save.php?vote="+candname+"&voter_id="+id+"&position="+votedposition,true);//sets and sends asynchronous GET request to the server-side script save.php
  xmlhttp.send();

  xmlhttp.onreadystatechange =function()//Callback function to handle server's response
{
	if(xmlhttp.readyState ==4 && xmlhttp.status==200)//Check whether if the request is complete and successful
	{ 
	document.getElementById("error").innerHTML=xmlhttp.responseText;//Updates the element with the id error with the response received from the save.php server 
	}
}

  }
	else
	{
	alert("Choose another candidate ");//If user clicks cancel in the confirm dialog
	}
	
}

function getPosition(String)
{
if (window.XMLHttpRequest)//Checks whether the browser supports the standard XMLHttpRequest object 
  {
  xmlhttp=new XMLHttpRequest();//If so it creates the instance of the XMLHttpRequest
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");//If it does not support it goes to older version ActiveXobject 
  }

xmlhttp.open("GET","vote.php?position="+String,true);//open a get request to be sent to vote.php where the position is set to string
xmlhttp.send();
}
</script>
</head>
<body style="background-color: #B6AAAA;">
<!--side navigation bar-->
<div class="mainnav">
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="voter.php">Home</a>
  <a href="vote.php">Current Polls</a>
  <a href="manage-profile.php">Manage My Profile</a>
  <a href="changepass.php">Change Password</a>  
</div>
<span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px; margin-left:20px;" onclick="openNav()">&#9776; </span>
<!--to get information about the voter who has logged in and to display their name and image in top-->
<?php
  $query= mysqli_query($con,"SELECT * FROM tbmembers WHERE member_id ='$_SESSION[member_id]'") or die (mysqli_error());
  $fetch = mysqli_fetch_array($query);
 ?>
  <div class="line" id ="propic"><img src="../admin/img/<?php echo $fetch["image"]; ?>" width = 80 height =80 style ='border-radius : 50%;' title="<?php echo $fetch['image']; ?>"></div>
  <?php 
    echo "<h1 style='margin-left:300px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";  
  ?>
  <!--logout button-->
  <a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>
  </div>

<div style="background-color: #B6AAAA; height: 700px; position: relative;"> 
  <div class="container">
    <div class="space1"></div>
      <table width="460px" align="center">
      <CAPTION><div class="oneline"><p>CHOOSE POSITION</p></div></CAPTION>
      <!--form to view candidates to vote-->
        <form name="fmNames" id="fmNames" method="post" action="vote.php" onSubmit="return positionValidate(this)">  
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>    
          <td><SELECT class="labels" NAME="position" id="position" onclick="getPosition(this.value)">
          <OPTION VALUE="select" >select
            <?php 
              //loop through all rows of the table
              while ($row=mysqli_fetch_array($positions)){
              echo "<OPTION VALUE=$row[position_name]>$row[position_name]";     
              }
              ?>
            </SELECT></td>

          <td><input type="hidden" id="hidden" value="<?php echo $_SESSION['member_id']; ?>" /></td><!-- Hidden and stores the voter id whose performing the vote-->  
          <td><input type="hidden" id="str" value="<?php echo $_REQUEST['position']; ?>" /></td><!-- Hidden and stores the position for which the vite is performed-->
          <td><button type="submit" name="Submit" id="candidatebutton">See Candidates</button></td>
        </tr>
        <tr>
            <td>&nbsp;</td> 
            <td>&nbsp;</td>
        </tr>
        </form> 
      </table>
      <hr class="hr1">

      <div class="oneline"> <p class='lin' >
              Candidates&nbsp<?php if(isset($_POST['Submit'])){ echo "<p class='lin'> of " . $posi['position_name'] . "&nbspPosition</p>"; }?>
      </p>
      </div>

      <center><span id="error"></span></center>
  
      <?php
      //loop through all table rows
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

      }
      else
      //Do nothing
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