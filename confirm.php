<!--
Author: Khalil Greenidge
Email: khalilgreenidge16@gmail.com
Created: 30/04/2015
-->
<?php 
	
?> 

<!DOCTYPE html>
<html class="bg-black">
	  <head>
		<meta charset="UTF-8">
		<title>HEDU IMS | Confirmation</title>
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
			  <div class="header">Confirmation</div>
			  		  
				<div class="body bg-gray">
					
					<?php
						//IF LINK IS ACTIVATED OR EXPIRED --> SHOW ERROR. ELSE --> DISPLAY PAGE AND ADD USER TO DATABASE
						$hash = $dbendDate = $mkdate = $today = $dbuser = $dbpwd = $dbgender = $dbname = $dbemail = '';
						
						//GET TODAY'S DATE
						$today = strtotime("now");								
						
						if(isset($_GET['hash'])):
							//extract hash
							$hash = $_GET['hash'];
							//SANITIZE STRING
							$hash = filter_var($hash, FILTER_SANITIZE_STRING);
							
						endif;
						
						//ESTABLISH CONNECT
						$con = mysqli_connect("localhost", "root", "");
								
						//CONNECT TO DB
						$db = mysqli_select_db($con, "heduis");
								
						//MAKE QUERY 1
						$rs1 = mysqli_query($con, "SELECT * FROM activation_links WHERE hash='$hash' ");// or die('Error :'.mysqli_error());
						$rs2 = mysqli_query($con, "SELECT * FROM registration WHERE hash='$hash' "); // or die('Error :'.mysqli_error());
											
						if(!$con || !$db || !$rs1 || !$rs2){
							echo "Error: ".mysqli_error();
						}
						else{
							//IF LINK IS ACTIVATED OR EXPIRED --> SHOW ERROR. ELSE --> DISPLAY PAGE AND ADD USER TO DATABASE
							
							while($row = mysqli_fetch_array($rs1)){
								
								$dbendDate = $row["endDate"];
								
							}
							
							$dbendDate = strtotime($dbendDate);
							
							while($row = mysqli_fetch_array($rs2)){
								//ASSIGN VARIABLES TO ADD USER
								$dbuser = $row["user"];
								$dbpwd = $row["password"];
								$dbgender = $row["gender"];
								$dbname = $row["name"];
								$dbemail = $row["email"];
								
							}
							if($today >= $dbendDate || mysqli_num_rows($rs1) < 1 ){
								$rs = mysqli_query("DELETE FROM activation_links WHERE hash='$hash' ") or die('Error: '.mysqli_error());
							
								echo "<h2>Link Expired!</h2>";
								echo "<br/>";
								echo "He's dead jimmy!";
								echo '<img src="dist/img/sad.png" width="20" height="20" />';
								echo '<img src="dist/img/brokenlink.png" width="20" height="20" />';
								echo "<br/><br/>";
								$location = "login.php";
								echo '<META HTTP-EQUIV="Refresh" Content="15; URL='.$location.'">';
							}
							else{
								echo "<h2>User Accepted</h2>";
								echo "<br/>";
								echo "The user is now allowed to sign in";
								echo '';
								echo "<br/><br/>";
								$rs = mysqli_query("INSERT INTO users VALUES('$dbuser', '$dbpwd', '$dbgender', '$dbname', '$dbemail' )") or die('Error: '.mysqli_error());
								$rs = mysqli_query("DELETE FROM activation_links WHERE hash='$hash' ") or die('Error: '.mysqli_error());
								
							}
							
						}
						mysqli_close($con);
					
					?>
					
				</div>
				
			<div class="footer">
				  <p><a href="login.php">Click here to login.</a></p>
			</div>			  
		</div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
	</body>
</html>