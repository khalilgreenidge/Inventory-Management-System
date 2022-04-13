<!--
Author: Khalil Greenidge
Email: khalilgreenidge16@gmail.com
Created: 37/04/2015
-->
<?php session_start(); ?>
<!DOCTYPE html>
<html class="bg-black">
  <head>
    <meta charset="UTF-8">
    <title>HEDU IMS | Reset Password</title>
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
      <div class="header">Update Password</div>
	  
      <form action="post.php" method="post" onsubmit="return (checkPattern() && checkPass())">
        <div class="body bg-gray">
				<?php
						//IF LINK IS ACTIVATED OR EXPIRED --> SHOW ERROR. ELSE --> DISPLAY PAGE AND ADD USER TO DATABASE
						$hash = $dbendDate = $dbactive = $mkdate = $today = $dbuser = $dbpwd = $dbgender = $dbname = $dbemail =  '';
						
						//GET TODAY'S DATE
						$today = strtotime("now");								
						
						if(isset($_GET['hash'])){
							//extract hash
							$hash = $_GET['hash'];
							//SANITIZE STRING
							$hash = filter_var($hash, FILTER_SANITIZE_STRING);
							
						}
						else{
							exit("Dont play with the URL please");
						}
						
						//ESTABLISH CONNECT
						$con = mysqli_connect("localhost", "root", "");
								
						//CONNECT TO DB
						$db = mysqli_select_db($con, "heduis");
								
						//MAKE QUERY 1
						$rs1 = mysqli_query($con, "SELECT * FROM activation_links WHERE hash='$hash' ");// or die('Error :'.mysqli_error());
						$rs2 = mysqli_query($con, "SELECT * FROM password_reset WHERE hash='$hash' "); // or die('Error :'.mysqli_error());
											
						if(!$con || !$db || !$rs1 || !$rs2){
							echo "Error: ".mysqli_error();
						}
						else{
							//IF LINK IS ACTIVATED OR EXPIRED --> SHOW ERROR. ELSE --> DISPLAY PAGE AND RESET PASSWORD
							
							while($row = mysqli_fetch_array($rs1)){
								
								$dbendDate = strtotime($row["endDate"]);
								//echo "today--".$today."  end date-->".$dbendDate;
							}
							
							
							//DISPLAY USER NAME
							while($row = mysqli_fetch_array($rs2)){
								//ASSIGN VARIABLES TO UPDATE PASSWORD
								$dbuser = $row["user"];
															
							}
							
							if($today >= $dbendDate || mysqli_num_rows($rs1) < 1 ){
								$rs = mysqli_query("DELETE FROM activation_links WHERE hash='$hash' ") or die('Error: '.mysqli_error());
								
								echo "<h2>Link Expired!</h2>";
								echo "<br/>";
								echo "He's dead jimmy!";
								echo '<img src="dist/img/sad.png" width="20" height="20" />';
								echo '<img src="dist/img/brokenlink.png" width="20" height="20" />';
								echo "<br/><br/>";
								echo '<div class="footer">
										  <a href="login.php" class="btn bg-olive btn-block">Login</a>
													  
										</div>
									  ';
								exit();
							}
														
						}
						mysqli_close($con);
					
					?>
		  <div class="form-group">
            <input type="text" name="user" class="form-control" value="<?php echo $dbuser; ?>" readonly />
          </div>
          <div class="form-group">
			<input type="hidden" name="hash" value="<?php echo $hash;?>" />
			<input type="hidden" name="dbuser" value="<?php echo $dbuser;?>" />
            <input type="password" name="pwd" class="form-control" placeholder="Password" id="pass1" autocomplete="off"  required
			onkeyup="checkPattern()"/>
          </div>
		  <div class="form-group">
            <input type="password" name="conpwd" class="form-control" placeholder="Confirm Password" id="pass2" autocomplete="off" onkeyup="checkPass()" required/>
			<br/>
			<div id="bubble" class="bubble" style="margin: 0 auto;">
				<p id="message" class="message" style="padding: 10px; text-align: center; color: white; border-radius: 6px" ></p>
			</div>
		 </div>
		  <script>
			function checkPattern(){
				var x = document.getElementById("pass1");
				var decimal =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;  
				var message = document.getElementById('message');
				//Set the colors we will be using ...
				var goodColor = "#5fa918";
				var badColor = "#a94442";
				
				if(x.value.match(decimal)){   
					message.style.backgroundColor = goodColor;
					message.innerHTML = "Pattern Correct";
					return true;  
				}  
				else{   
					message.style.backgroundColor = badColor;
					message.innerHTML = "Must be at least 8 and less than 21 characters, at least one lowercase letter, uppercase letter, and one numeric digit";
					return false;  
				}  
			}
		  
		  
			function checkPass(){
				//Store the password field objects into variables ...
				var pass1 = document.getElementById('pass1');
				var pass2 = document.getElementById('pass2');
				//Store the Confimation Message Object ...
				var message = document.getElementById('message');
				//Set the colors we will be using ...
				var goodColor = "#5fa918";
				var badColor = "#a94442";
				//Compare the values in the password field 
				//and the confirmation field
				if(pass1.value == pass2.value){
					//The passwords match. 
					//Set the color to the good color and inform
					//the user that they have entered the correct password 
				
					message.style.backgroundColor = goodColor;
					message.innerHTML = "Passwords Match!"
					return true;
				}else{
					//The passwords do not match.
					//Set the color to the bad color and
					//notify the user.
					
					message.style.backgroundColor = badColor;
					message.innerHTML = "Passwords Do Not Match!"
					return false;
				}
			}  
		  </script>
				
        </div>
        <div class="footer">
          <button type="submit" class="btn bg-olive btn-block">Update Password</button>
			          
        </div>
      </form>
	  
      
    </div>

   
  </body>
</html>