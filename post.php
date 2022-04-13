<!DOCTYPE html>
<html class="bg-black">
  <head>
    <meta charset="UTF-8">
    <title>HEDU IMS | Password reset</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
		<?php
	   
		//DEFINE VARIABLES
		$newpwd = $hash = $msg = $dbuser = "";
		
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
					
			$hash = $_POST["hash"];
			$newpwd = md5($_POST["pwd"]);
			$dbuser = $_POST["dbuser"];			
			
				
			//ESTABLISH CONNECT
			$con = mysqli_connect("localhost", "root", "");
					
			//CONNECT TO DB
			$db = mysqli_select_db($con, "heduis");
					

			//MAKE QUERY 3
			$rs1 = mysqli_query("UPDATE users SET password='$newpwd' WHERE user='$dbuser' ");
						
			//REMOVE LINKS
			$rs2 = mysqli_query("DELETE FROM activation_links WHERE hash='$hash' ");
			$rs3 = mysqli_query("DELETE FROM password_reset WHERE hash='$hash' ");
			
			if(!$con || !$db || !$rs1 || !$rs2 || !$rs3){
				
				echo '
				<div class="header">The server caught a boo boo <img src="dist/img/sad.png" width="20" height="20" /></div>
				<br/>		  
				<div class="body bg-gray">

						echo "Error: ".mysqli_error();	
						
				</div>
				<br/>		  
				<div class="footer">
					<p><a href="login.php">Sign in</a></p>
				</div>;
				';
			}
			else{
				echo '		 
				<div class="header">Success!</div>		  
				<div class="body bg-gray">
				<br/>
				<br/>
						Your password has been reset!	
				<br/>		
				<br/>			
				</div>	  
				<div class="footer">
					<p><a href="login.php">Sign in</a></p>
				</div>';
			}
			
			
			mysqli_close($con);
	
		}
	
?>
	
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>	

	