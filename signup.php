<!--
Author: Khalil Greenidge
Email: khalilgreenidge16@gmail.com
Created: 37/04/2015
-->
<!DOCTYPE html>
<html class="bg-black">
  <head>
    <meta charset="UTF-8">
    <title>HEDU IMS | Sign up</title>
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
      <div class="header">Sign up</div>
	  
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return (checkPattern() && checkPass() && checkName());" >
        <div class="body bg-gray">
			
		  <div class="form-group">
            <input type="text" name="fname" id="name1" onkeyup="upperCase()"  class="form-control" min="3" max="19" placeholder="First Name" autocomplete="off" required/>
          </div>		  
		  <div class="form-group">
            <input type="text" name="lname" id="name2" onkeyup="upperCase2()" class="form-control" min="3" max="19" placeholder="Last Name" autocomplete="off" required/>
          </div>
		  <div class="form-group">
				Male <input type="radio" name="gender" value="male" required/> 
				Female <input type="radio" name="gender" value="female" required/></br>
		  </div>	
          <div class="form-group">
            <input type="text" name="user" id="uname" class="form-control" placeholder="User" autocomplete="off" required />
          </div>
		  <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" max="60" autocomplete="on" required  />
		  </div>	
          <div class="form-group">
            <input type="password" id="pass1" name="pwd" class="form-control" placeholder="Password" id="pass1" autocomplete="off" 
			required onkeyup="checkPattern()"/>
          </div> 

		  <div class="form-group">
            <input type="password" name="conpwd" class="form-control" placeholder="Confirm Password" id="pass2" onkeyup="checkPass()" autocomplete="off" required/>
          </div>
          <script>
					  
			function checkPattern(form){
				var x = document.getElementById("pass1");
				var decimal =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}$/;  
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
					message.innerHTML = "Must be at least 8 characters and less than 30, at least one lowercase letter, uppercase letter, and one numeric digit";
					return false;  
				}  
			}
			
			function checkName(){
				var name1 = document.getElementById('name1');
				var name2 = document.getElementById('name2');
				var uname = document.getElementById('uname');
				
				//Store the Confimation Message Object ...
				var goodColor = "#5fa918";
				var badColor = "#a94442";
				var message = document.getElementById('message');
				
				if( (name1.value.length > 2 && name1.value.length < 20) && (name2.value.length > 2 && name2.value.length < 20)  && (uname.value.length > 2 && uname.value.length < 20)){
					
					return true;
				}
				else{
					//INVALID NAME
					//notify the user.
					
					message.style.backgroundColor = badColor;
					message.innerHTML = "First, Last and User name must all be at least 3 characters and less than 20!"
					return false;
				}
				
				
			}
		  
			function checkPass(form){
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
				}
				else{
					//The passwords do not match.
					//Set the color to the bad color and
					//notify the user.
					
					message.style.backgroundColor = badColor;
					message.innerHTML = "Passwords Do Not Match!"
					return false;
				}
				
							
			}  
			
			
			String.prototype.capitalizeFirstLetter = function() {
				return this.charAt(0).toUpperCase() + this.slice(1);
			}
			
			function upperCase(){
				//GET REPRESENTATIVE
				var f = document.getElementById("name1");
				
				//GET FIRST LETTER
				f.value = f.value.capitalizeFirstLetter();

			}
			
			function upperCase2(){
				//GET REPRESENTATIVE
				var f = document.getElementById("name2");
				
				//GET FIRST LETTER
				f.value = f.value.capitalizeFirstLetter();

			}
	
		 </script>
		  
		  	<div id="bubble" class="bubble" style="margin: 0 auto;">
				<p id="message" class="message" style="padding: 10px; text-align: center; color: white; border-radius: 6px" ></p>
			</div>
        </div>
        <div class="footer">
          <button type="submit" class="btn bg-olive btn-block">Submit</button>
		  <p><a href="login.php">Login</a></p>

        </div>
      </form>
	  
	  <?php
		//DEFINE VARIABLES
		$name = $fname = $lname = $gender = $email = $user = $pwd = $conpwd = 
		$dbuser = $chars = $randomstring = $length = $hash ="";
		
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
					
			$user = strtolower(test_user($_POST["user"]));
						
			$name = ucwords(strtolower(test_name($_POST["fname"]) . " " .test_name($_POST["lname"])));
						
			$gender = $_POST["gender"];
			
			$email = strtolower($_POST["email"]);
			
			$hash = md5($email.time());
			
			
			//VALIDATION
			$pwd = md5($_POST["pwd"]);
						
			//GENERATE RANDOM LINK AND SAVE TO DATABASE
			
			
			date_default_timezone_set("America/La_Paz");
			
			$startDate = date("Y-m-d", time());
			
			$endDate = date("Y-m-d", strtotime("today +7 days"));
			
			
											
			//ESTABLISH CONNECT
			$con = mysql_connect("localhost", "root", "");
					
			//CONNECT TO DB
			$db = mysql_select_db("heduis");
					
			//MAKE QUERY 1
			$rs = mysql_query("SELECT * FROM users WHERE user='$user' ");
			
			$rs1 = mysql_query("SELECT * FROM users WHERE email='$email' ");
			
			$rs2 = mysql_query("INSERT INTO activation_links VALUES('$hash', '$startDate', '$endDate')") or die('Error: '.mysql_error());
			
			$rs3 = mysql_query("INSERT INTO registration VALUES('$hash', '$user', '$pwd', '$gender', '$name', '$email' )") or die('Error: '.mysql_error());;

			
			if(!$con || !$db){
				echo "Error: ".mysql_error();
			}
			
			if(mysql_num_rows($rs) > 0){
				//USERNAME UNAVAILABLE
				echo '<script>
						  function checkUser(){	
							var msg = document.getElementById("message");
							
							message.style.backgroundColor = "#a94442";
							
							msg.innerHTML	= " '.$user.' is not available."
						  }	
						  window.checkUser();
					  </script>
					 
					';
				exit();
			}
			if(mysql_num_rows($rs1) > 0){
				echo '<script>
						  function checkMail(){	
							var msg = document.getElementById("message");
							
							message.style.backgroundColor = "#a94442";
							
							msg.innerHTML	= " '.$email.' is not available."
						  }	
						  window.checkMail();
					  </script>
					 
					';
				exit();
			}
			else{
				//SEND AN EMAIL TO ADMIN FOR ACCEPTANCE
				$subject = "HEDU IMS | Account Confirmation";
			
				// the message
				$msg = "
				<!DOCTYPE html>
				<!--BACKGROUND TABLE-->
				<style>
					p {color: #444444;}
				</style>

				<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\" align=\"center\" style=\"padding-top:0px;font-family:Arial,Helvetica,sans-serif;font-weight:normal;font-size:14px;line-height:19px;color:#444444;border-collapse:collapse;background-color:#ececec\">
					<tbody>
					<tr>
						<td width=\"100%\">
						<br>
						
						<!--INNER TABLE-->
						<table width=\"600\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" >
							<tbody>
								<!--HEADER ROW-->
								
								<tr style=\"background-color: #3c8dbc;\" align=\"center\">		
									<td width=\"100%\" height=\"75\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" 
										style=\"align: center;background-color: #3c8dbc;!important;font-family:
										Arial,Helvetica,sans-serif;font-weight:normal;font-size:20px;
										line-height:19px;color: white;border-collapse:collapse\">
								
										<a href=\"http://localhost:8000/index.php\" style=\"text-decoration:none;display:inline; color: white;\" target=\"_blank\">
											<img alt=\"logo\" border=\"0\" style=\"vertical-align:middle;display:inline;
											float:none\" src=\"http://s14.postimg.org/ojywskxwt/logo.gif\" width=\"80\" height=\"75\" class=\"CToWUd\"> 
											HEDU IMS
										
										</a>
										
									</td>
									
								</tr><!--END HEADER ROW-->
								
								<tr><!--CONTENT 1-->
									<td width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\" Height=\"100%\" valign=\"top\" style=\"padding:30px 68px 22px; font-family:Arial,Helvetica,sans-serif;font-weight:normal;font-size:14px;line-height:19px;color:#444444;background-color:#ffffff!important; border-bottom:0; \"> 
										<p style=\"line-height:24px!important;font-size:14px!important;margin-bottom:20px\">
											Hi Admin,<br>
											<br>
											A user - ".$user. " - by the name of ".$name." has requested to join HEDU's IMS.<br/>
											Do you accept? Click following the link or scan the QrCode below to accept:
											
											<br/>
											<br/>
											
											
												<a href=\"http://localhost:8000/confirm.php?hash=$hash\" target=\"_blank\">http://localhost:8000/confirm.php?hash=$hash</a>
												
												<br/><br/>
												OR
												<br/><br/>
												
												<img src=\"http://768d91e2.ngrok.io/qrcode.php?text=http://192.168.1.15:8000/confirm.php?hash=$hash&size=100\" alt=\"Qr Code\" />
												
												<br/>
												This link must be clicked within 7 days, to avoid security exploits. </p>
												<br/><br/>
											<p style=\"font-family:Arial,Helvetica,sans-serif;font-weight:normal;font-size:14px;line-height:24px;margin-top:0!important;margin-bottom:0!important\">
											 Thanks!<br>
											HEDU IMS 
											</p>
								
										<p style=\"margin-bottom:6px\">
										<br/>
										
										</p>
										<br/>
													
										
									</td>
								</tr><!--END CONTENT-->
													
									
								<!--FOOTER-->
								<tr style=\"background: #3c8dbc\">
									<td width=\"100%\" height=\"82\" align=\"center\" valign=\"middle\" style=\"padding:0px 13px 12px; vertical-align:middle;height: 100%; line-height: 20px;text-align: center; color: #ccc;font-size: 11px;\">
												
									<br/>
									<h3>HEDU IMS</h3>
									<p>&copy; 2015 - ".date("Y").", 
									Developed by: <a href=\"mailto:khalilgreenidge16@gmail.com\" target=\"_blank\">Khalil Greenidge</a> </p>
																
									</td>
								</tr>
								
							  </tbody>
							</table><!--END INNER TABLE-->
								
							<!--FINE LINES-->
								
							<table width=\"100%\" bgcolor=\"#ECECEC\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial,Helvetica,sans-serif;font-weight:normal;font-size:14px;line-height:19px;color:#7e7e7e;border-collapse:collapse\">
									<tbody>
										<tr>
											<td width=\"100%\" style=\"text-align:left;color:#7e7e7e!important;font-size:10px;line-height:14px;padding:10px 15px\">
											<p style=\"text-align:center;color:#a4a4a4\">
											  Please do not reply directly to this email. Only click the link as instructed.<br>
											  You can reach tech support by sending a message to <a href=\"mailto:techadmin@hedu.edu.bb\" target=\"_blank\">techadmin@<span class=\"il\">hedu</span>.edu.bb</a>.<br/><br/></p>
															
											</td>
										</tr>
									</tbody>
									
									
							</table>
						 </td>
						</tr>		
					</tbody>
				</table>";
				
				//HEADERS
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				date_default_timezone_set("America/La_Paz");
				$headers .= "Date: ".date("Y/m/d, h:i:sa")."\r\n";
				$headers .= "From: HEDU IMS <no@hedu.edu.bb>";

					// send email
					if(mail("khalilgreenidge16@gmail.com", $subject,$msg, $headers)){
						//SHOW MESSAGE
						echo "<div id=\"ani\" class=\"info\"><img src=\"dist/img/info.png\" width=\"20\" height=\"20\"/>Pending approval. If not approved in 7 days, please reapply.</div>";
										
						//NB *** THE BUTTON ONLY WORKS IN GMAIL AND NOT HOTMAIL!!
					}
					else {
						//ERROR
						echo "<div id=\"ani\" class=\"error\"><img src=\"dist/img/x.png\"/> Error sending mail :( </div>";
					}
						
				}//END ELSE STATEMENT
			
				mysql_close($con);
		}
		
		function test_name($data){
			if (!preg_match("/^[a-zA-Z ]*$/", $data)) {
			  echo '<script>
						  function checkName(){	
							var msg = document.getElementById("message");
							
							message.style.backgroundColor = "#a94442";
							
							msg.innerHTML	= "Only letters and white space allowed."
						  }	
						  window.checkName();
					  </script>
					 window.checkName();
					';
					exit();
			}
			else{
				return $data;
			}
		}
		
		function test_user($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		function generateRandomString() {
			$length = 30;
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randomString;
		}
		
		
		
	  ?>
	  
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>