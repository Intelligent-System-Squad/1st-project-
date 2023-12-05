<html>
<head>
  <script language="JavaScript" src="js/admin.js"></script>
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
      
      .small_circle {
          border-radius: 50%;
          width: 30px;
          height: 30px;
          float: left;
          margin-left: 100px;
      }
      .navi {
          float: left;
      }

      .form h2 {
        text-align: center;
        letter-spacing: 1px;
        margin-bottom: 2rem;
        color: white;
      }

      .login-wrapper {
        height: 100vh;
        width: 100vw;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .form {
        position: relative;
        width: 100%;
        max-width: 380px;
        padding: 80px 40px 40px;
        background: #0C0C1C;
        border-radius: 20px;
        color: #DDBEBE;
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.5);
      }

      .form::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 50%;
        height: 100%;
        background: #0C0C1C;
        transform: skewX(-26deg);
        transform-origin: bottom left;
        border-radius: 20px;
        pointer-events: none;
      }

      .form .input-group {
        position: relative;
      }

      .form .input-group input {
        width: 100%;
        padding: 10px 0;
        font-size: 1rem;
        letter-spacing: 1px;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #DDBEBE;
        outline: none;
        background-color: transparent;
        color: inherit;
      }

      .form .input-group label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 1rem;
        pointer-events: none;
        transition: 0.3s ease-out;
      }

      .form .input-group input:focus+label,
      .form .input-group input:valid+label {
        transform: translateY(-18px);
        color: white;
        font-size: 0.8rem;
      }

      .submit-btn {
        display: block;
        margin-left: auto;
        border: none;
        outline: none;
        background: #D49FE7;
        padding: 10px 35px;
        font-weight: bolder;
        font-size: 18px;
        border-radius: 8px;
        height: 40px;
        cursor: pointer;
      }
</style>
</head>

<body>
<div style="background-color: #0C0C1C; ">
<!--Side navigation bar-->
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
  <!--logIn form-->
<div style="background-color: #B6AAAA; height: 800px; position: relative;">
  <div style="position: absolute;width: 100%;">
    <div style="text-align:center ;background-color: #0C0C1C; color: #FFFFFF; ">
      <P style=" font-size: 25px;
font-weight: bolder; 
text-align: center;"> ADMIN LOGIN</P>
    </div>
  
    <div style="background-color: #D49FE7; height: 400px; width: 500px; display: flex;
justify-content: center;
align-items: center; margin-left: 480px; margin-top: 100px; border-radius: 20px;">

      <div class="login-wrapper">
      <form name="form1" method="post" action="checklogin.php" onSubmit="return loginValidate(this)" class="form">

          <div class="input-group">
            <input type="text" name="myusername" name="myusername" required />
            <label for="username">User Name or Email</label>
          </div>
          <div class="input-group">
            <input type="password" name="mypassword" name="mypassword"  />
            <label for="psw">Password</label>
          </div>
          <input type="submit" name="Submit" value="Login" class="submit-btn" />
        </form>
      </div>
    </div>
  </div>
</div>


</div>

</body>
</html>