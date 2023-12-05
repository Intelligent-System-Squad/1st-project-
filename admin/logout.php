<html><head>
    <style>
        .container{
            position: absolute;    
        }

        #logo{            
            position: absolute;
            margin-top: 100px; 
            margin-left:150px;         
           
        }
        #box{
            background-color: #D49FE7;
            height: 450px;
            width: 500px;            
            margin-left:700px;
            position:relative;
            margin-top:70px;
              
        }
        .form{
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

        .box1{
            float:left;
        }

        a{
            color:#D49FE7;
        }
</style>
<title>Electoral Poll: Admin LogOut</title>
</head>
<body style="background-color: #B6AAAA; auto;">
    <div style="position: relative;">
        <div class="container" >
            <div id="logo" class="box1">                    
                <img src="assets/logoo.jpeg" width="300px" height="380px">
            </div>
            <div id="box" class="box1">
                <div class="form">
                    <p style="margin-top:80px">You have been successfully <br><br>
                    logged out of your account.<br><br>
                    Click here to <a href=<?php header("Location: logIn.php");?>>Login</a><br><br>
                    or return to <a href="../homepage.html">Home</a><br><br></p>
                </div>
            </div>                    
        </div>
    </div>
<?php
session_start();
session_destroy();
?>

</body>
</html>