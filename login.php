<?php 
	session_start();
	
	if(isset($_SESSION["login"])){
		header("Location: index.php");
	}
?> 

<!DOCTYPE html>
<html class="bg-black">
  <head>
    <meta charset="UTF-8">
    <title>HEDU IMS | Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="dist/img/logo.gif" />
	<link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="bg-black">
    <div class="form-box" id="login-box">
      <div class="header">Sign In</div>
	  
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="body bg-gray">
		
          <div class="form-group">
            <input type="text" name="user" class="form-control" placeholder="User" autocomplete="off" required />
          </div>
          <div class="form-group">
            <input type="password" name="pwd" class="form-control" placeholder="Password" autocomplete="off" required />
          </div>
		<div id="bubble" class="bubble" style="margin: 0 auto;">
			<p id="message" class="message" style="padding: 10px; text-align: center; color: white; border-radius: 15px" ></p>
		</div>
      </div>
        <div class="footer">
          <button type="submit" class="btn bg-olive btn-block">Sign me in</button>

          <p><a href="forget.php">I forgot my password</a></p> <p><a href="signup.php">Sign up</a></p>

        </div>
      </form>
	  
	  <?php
		//DEFINE VARIABLES
		$user = $pwd = $dbuser = $dbpwd = $dbemail = "";
		
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
			
			
					
			$user = strtolower($_POST["user"]);
			$pwd = md5($_POST["pwd"]);
			
			if( empty($user) && empty($pwd)){
				exit("Please login!");
			}
								
			//ESTABLISH CONNECT
			$con = mysql_connect("localhost", "root", "");
					
			//CONNECT TO DB
			$db = mysql_select_db("heduis");
					
			//MAKE QUERY 1
			$rs = mysql_query("SELECT * FROM users WHERE user=\"$user\" ");
								
			if(!$con || !$db || !$rs){
				echo "Error: ".mysql_error();
			}
			else{
				//GET DATA USERNAME AND PASSWORD FROM USERS TABLE
				while($row = mysql_fetch_array($rs)){
					$dbuser = $row["user"];
					$dbpwd = $row["password"];
					$dbgender = $row["gender"];
					$dbname = $row["name"];
					$dbemail = $row["email"];
				}
						
				//IF USER AND PWD IS CORRECT REDIRECT, ELSE --> ERROR
				if($user == $dbuser && $pwd == $dbpwd){
					
					$_SESSION["login"] = "yes";
					
					//CREATE SESSION FOR TYPE OF USER
					if($user == "techadmin"){
						
						$_SESSION["user"] = "admin";
					}
					else{
						$_SESSION["user"] = "limited";
					}
					
					if($dbgender == "female"){
						$_SESSION["avatar"] = "dist/img/avatar3.png";
					}
					else{
						$_SESSION["avatar"] = "dist/img/avatar04.png";
					}
					
					$_SESSION["name"] = $dbname;
					
					//CREATE SESSION TO DISPLAY USERNAME AND EMAIL
					$_SESSION["username"] = $user;
					
					$_SESSION["email"] = $dbemail;
					
					header("Location: index.php");
					
				}
				else{
					echo '<script>
							  function msg(){	
								var msg = document.getElementById("message");
								
								msg.style.backgroundColor = "#a94442";
								
								msg.innerHTML	= "Incorrect username or password"
							  }	
							  window.msg();
						  </script>
						 
						';
				}
				
			}
			
			mysql_close($con);
		}
	  ?>
	  
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>