<html><head>
<script language="JavaScript" src="js/user.js">
</script>
<title>
            Voter Registration
        </title>
        <style>
          .mainnav {
            background-color: #0C0C1C;
            overflow: hidden;
            margin-left: 30px;
            display: inline-block;
        }

        .nav{
            float: left;
            color: #FFFFFF;
            text-align: center;
            padding: 20px 40px;
            text-decoration: none;
            font-size: 18px;
        }

        .nav:hover {
            background-color: #504F4F;
            color: #FFFFFF;
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
        
    
        .navi {
          float: left;
        }
        #buttons{                
            background-color: #D49FE7;
            border-radius: 5px;                            
            margin-top: 8px;
            padding: 10px 35px;
            font-weight: bolder;
            font-size: 18px;
        }
        .space{
            width:20px;
            height:auto;
            display:inline-block;
        }
       
        .text1{
            font-size: 25px;
            font-weight: bolder; 
            text-align: center;
        }
        .logo{
            
            position: absolute;
            margin-top: 100px;          
           
        }
       
        .space{
                width:20px;
                height:auto;
                display:inline-block;
        }
        #box{
            background-color: #D49FE7;
            height: 450px;
            width: 500px;
            border-radius:20px ;
            margin-left: 400px;              
        }
        input{
            margin-left: 20%;
            width: 300px;
            border-color:  #DDBEBE;
            height: 25px;
            background-color: #0C0C1C;
            color: #FFFF;
        } 
        label {
            margin-left: 20%;
        }  

        
        .box1{
            float: left;
            
        }
        .form{
            background-color: #0C0C1C;
            padding: 15px;
            height: 450px;
            margin-top: 20px;
            color: #DDBEBE; 
            border-radius: 0px 0px 20px 20px;               
        }
        #box2{
            margin-left: 200px;
        }
        .registerbtn{
            background-color: #D49FE7;
            padding: 10px 35px;
            font-weight: bolder;
            font-size: 18px;
            border-radius: 8px;
            height: 40px;
        }
        #pp{
            background-color:#DDBEBE;
            color:#0C0C1C;
        }
        #logo{
        
        position: absolute;
        margin-top: 100px; 
        margin-left:150px;         
        
    }
    #bo{
        background-color: #D49FE7;
        height: 450px;
        width: 500px;            
        margin-left:700px;
        position:relative;
        margin-top:70px;
            
    }
    .formm{
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
    .bo1{
        float:left;
    }

        
        
        </style>
    </head>
    <body>
    <div style="background-color: #0C0C1C; ">
        <div class="mainnav">
            <div class="navi" style="margin-top: 8px;"><img src="assets/logoo.jpeg" style="height:40px ; margin-left: 60px;">
            </div>
            <div class="space"></div>
            <div class="navi">
                <a class="nav" href="../homepage.html" target="_blank">Home</a>                
                <a class="nav"href="../services.html" target="_blank">Services</a>
                <a class="nav"href="../contact.html">Contact</a>
                <a class="but"href="../logbutt.html"><button id="buttons" style="margin-left:250px ;">LogIn</button></a>
                <div class="space"></div>
                <a class="but"href="../regbutt.html"><button id="buttons">SignUp</button></a>
            </div>

        </div>
    </div>

<div id="container">
<?php
require('connection.php');
//Process
if (isset($_POST['submit']))
{

$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
$myEmail = $_POST['email'];
$myPassword = $_POST['password'];

$newpass = md5($myPassword); //This will make your password encrypted into md5, a high security hash

$sql = mysqli_query($con, "INSERT INTO tbMembers(first_name, last_name, email,password) 
VALUES ('$myFirstName','$myLastName', '$myEmail', '$newpass') ");

die( "<body bgcolor=#B6AAAA><div class='container' >
<div id='logo' class='box1'>
                
                <img src='assets/logoo.jpeg' width='300px' height='380px'>
                </div>
                <div id='bo' class='bo1'>
                    
                
                
                <div class='formm'>
                <p style='margin-top:60px'>Dear User, <br><br><br>
                    You have successfully created<br><br>
                    an admin account. Please <a href='logIn.php'>login</a><br><br>
                    to get access to your privileges.<br><br>
                    </p>

                </div>
</div>

                
                    
</div></body>" );
}
?>
            <div  style="background-color: #B6AAAA; height: 800px; position: relative;">
                <div class="logo" >
                    <div class="box1" id="box2">
                    
                    <p class="text1" >
                        GET REGISTERED <br>
                        AND JOIN US NOW!    
                    </p>
                    <img src="assets/logoo.jpeg" width="300px" height="380px">
                    </div>
                   
                    <div id="box"
                    class="box1" >
                    <p class="text1" style="text-align:center ;">VOTER REGISTRATION</p>
                    
                    <form action="registeracc.php" method="post" onsubmit="return registerValidate(this)" class="form">
                        <br>
                        <label for="firstname" >First Name</label><br>
                        <input type="text" id="firstname" name="firstname" maxlength='15'><br><br>
                        <label for="lastname">Last Name</label><br>
                        <input type="text" id="lastname" name="lastname" maxlength='15'><br><br>
                        <label for="email">Email Address</label><br>
                        <input type="email" id="email" name="email" maxlength='100'><br> 
                        <span id='result' style='color:red; margin-left:90px;'></span><br>                   
                        <label for="password">Password</label><br>
                        <input type="password" id="password" name="password" maxlength='15'><br><br>
                        <label for="password">Confirm Password</label><br>                        
                        <input type="password" id="ConfirmPassword" name="ConfirmPassword" maxlength='15'><br><br>
                        <input type="submit" name='submit' value='Register Account' class="registerbtn">
                    </form>
                    </div>

                    
                </div>
            </div>
                



 




</div>
</body>
<script src="js/jquery-1.2.6.min.js"></script>
    <script>
    $(document).ready(function(){
      
        $('#email').blur(function(event){
         
            event.preventDefault();
            var emailId=$('#email').val();
                                $.ajax({                     
                            url:'checkuser.php',
                            method:'post',
                            data:{email:emailId},  
                            dataType:'html',
                            success:function(message)
                            {
                            $('#result').html(message);
                            }
                      });
                    
           

        });

    });
   
    </script>
</html>