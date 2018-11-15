<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'tchat');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   $error ="";
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      if ((isset($_POST['username']) && !empty($_POST['username'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = md5(mysqli_real_escape_string($db,$_POST['password']));  

      
      $sql = "SELECT id FROM users WHERE email = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
     
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
        header("location: HomePhp.php");
          
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   } else {
          $error = "Your email or your password are missing";
      }
      mysqli_free_result($result);
}
mysqli_close($db);

?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "margin-top:20%;width:500px; height:200px; border: solid 3px #333333;border-radius: 10px;
         padding: 10px; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box" value="<?php $_SESSION['email']?>"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" name = "submit" value = " Submit "/><br />
               </form>
               <?php $_SESSION['email']?>
               <a href="SigninPhp.php"><button>Inscrivez vous</button></a>
               <div style = "font-size:14px;font-weight:bold;
         color:#FFF; margin-top:10px;background-color:#cc0000;"> <?php echo "$error"; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
