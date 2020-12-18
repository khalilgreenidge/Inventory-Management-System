<?php session_start(); ?>

<!--
Author: Khalil Greenidge
Email: khalilgreenidge16@gmail.com
Created: 37/04/2015
-->

<!DOCTYPE html>
<html class="bg-black">
  <head>
    <meta charset="UTF-8">
    <title>HEDU IMS | Reset Password</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="shortcut icon" href="dist/img/logo.gif" />
    <link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

  </head>
  <body class="bg-black">
    <div class="form-box" id="login-box">
      <div class="header">Forgot your password?</div>
	  
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="body bg-gray">
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Account Email" autocomplete="on" required />
          </div>
          
        </div>
        <div class="footer">
          <button type="submit" class="btn bg-olive btn-block">Reset Password</button>

          
        </div>
      </form>
	  
	  <?php
		//DEFINE VARIABLES
		$email = $hash = $dbemail = $dbuser = "";
		
		if($_SERVER["REQUEST_METHOD"] == "POST" ){
					
			$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
			
			function test_input($data){
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				  $emailErr = "Invalid email format"; 
				}
				else{
					return data;
				}
			}
			
			//GENERATE RANDOM LINK
			$hash = md5($email.time());
			
			//SET DATES TO EXPIRE
			date_default_timezone_set("America/La_Paz");
			$mkdate = getdate(date("U"));
			$startDate = "$mkdate[year]"."-".date("m-d");
				
			$endDate = date("Y-m-d", strtotime("today +7 days"));
			
			
			//GET USERNAME FROM DATABASE
			
			//ESTABLISH CONNECT
			$con = mysql_connect("localhost", "root", "");
					
			//CONNECT TO DB
			$db = mysql_select_db("heduis");
					
			//MAKE QUERY		
			$rs = mysql_query("SELECT * FROM users WHERE email='$email' ")  or die('Error: '.mysql_error());
			
			$rs1 = mysql_query("INSERT INTO activation_links VALUES('$hash', '$startDate', '$endDate')") or die('Error: '.mysql_error());
			

								
			if(!$con || !$db){
				echo "Error: ".mysql_error();
			}
			else{
				if(mysql_num_rows($rs) < 1){
					//EMAIL ISNT FOUND
					echo $email." is not found.";
					exit;
			    }
				else{
					//EXTRACT DATABASE USER AND CREATE SESSION
					while($row = mysql_fetch_array($rs)){
						$dbuser = $row["user"];
						
					}
					
					$rs2 = mysql_query("INSERT INTO password_reset(user, hash) VALUES('$dbuser', '$hash' )") or die('Error: '.mysql_error());
					
					
					$subject = "HEDU IMS | Password Reset Confirmation";
			
					// the message
					$msg ='
<!--BACKGROUND TABLE-->
<head>
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
</head>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="padding-top:0px;font-family:Arial,Helvetica,sans-serif;font-weight:normal;font-size:14px;line-height:19px;color:#444444;border-collapse:collapse;background-color:#ececec">
	<tbody>
	<tr>
		<td width="100%">
		<br>
		
		<!--INNER TABLE-->
		<table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="font-family: "Source Sans Pro","Helvetica Neue",Helvetica,Arial,sans-serif;">
			<tbody>
				<!--HEADER ROW-->
				<tr style="background-color: #3c8dbc"; align="center">		
					<td width="100%\" height="75" border="0" cellspacing="0" cellpadding="0" 
					style="background-color: #3c8dbc;!important;font-family:
					Arial,Helvetica,sans-serif;font-weight:normal;font-size:20px;
					line-height:19px;color: white;border-collapse:collapse">
							
						<a href="http://localhost:8000/index.php" style="text-decoration:none;display:inline; color: white" target="_blank\">
						<img alt="logo" border="0" style="vertical-align:middle;display:inline;
						float:none" src="http://s14.postimg.org/ojywskxwt/logo.gif" width="80" height="75" class="CToWUd\"> 
						HEDU IMS</a>
										
					</td>
									
				</tr><!--END HEADER ROW-->
				
				<tr><!--CONTENT 1-->
					<td width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" Height="100%" valign="top" style="padding:30px 68px 22px; font-family:Arial,Helvetica,sans-serif;font-weight:normal;font-size:14px;line-height:19px;color:#444444;background-color:#ffffff!important; border-bottom:0; "> <!--border-collapse:collapse;-->
						<p style="line-height:24px!important;font-size:14px!important;margin-bottom:20px">
							Hi '.$dbuser.',<br>
							<br>
							You recently requested to reset your HEDU IMS password.<br>
							Please set a new password by clicking the link below:<br/>
							
							<br/><br/>
							
							<a href="http://localhost:8000/updatepwd.php?hash='.$hash.' ">http://localhost:8000/updatepwd.php?hash='.$hash.'</a><br/><br/>
							
							Your link will expire in 7 days and on activation!
							<br/><br/><br/>
							
							<p style="font-family:Arial,Helvetica,sans-serif;font-weight:normal;font-size:14px;line-height:24px;margin-top:0!important;margin-bottom:0!important">
							 Thanks!<br/>
							HEDU IMS
							</p>
				
						<p style="margin-bottom:6px">
						<br/>
						 Have a question or query? <br/>Send an email to techadmin@hedu.edu.bb&nbsp;&nbsp;
						</p>
						<br/>
									
						
					</td>
				</tr><!--END CONTENT-->
									
					
				<!--FOOTER-->
				<tr style="background: #3c8dbc">
					<td width="100%" height="82" align="center" valign="middle" style="padding:0px 13px 12px; vertical-align:middle;height: 100%; line-height: 20px;text-align: center; color: #ccc;font-size: 11px;">
								
					<br/>
					<h3>H E D U  I M S</h3>
					<p>&copy; 2015 - '.date("Y").', 
					Developed by: <a href="mailto:khalilgreenidge16@gmail.com" target="_blank">Khalil Greenidge</a> </p>
												
					</td>
				</tr>
				
			  </tbody>
			</table><!--END INNER TABLE-->
				
			<!--FINE LINES-->
				
			<table width="100%" bgcolor="#ECECEC" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial,Helvetica,sans-serif;font-weight:normal;font-size:14px;line-height:19px;color:#7e7e7e;border-collapse:collapse">
					<tbody>
						<tr>
							<td width="100%" style="text-align:left;color:#7e7e7e!important;font-size:10px;line-height:14px;padding:10px 15px">
							<p style="text-align:center;color:#a4a4a4">
							  Please do not reply directly to this email. This is an automated service.<br>
							  You can reach tech support by sending a message to <a href="mailto:techadmin@hedu.edu.bb" target="_blank">techadmin@<span class="il">hedu</span>.edu.bb</a>.<br/><br/></p>
											
							</td>
						</tr>
					</tbody>
					
					
			</table>
		 </td>
		</tr>		
	</tbody>
</table>';

				// use wordwrap() if lines are longer than 70 characters
				//$msg = wordwrap($msg,70);
				
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				date_default_timezone_set("America/La_Paz");
				$headers .= "Date: ".date("Y/m/d, h:i:sa")."\r\n";
				$headers .= "From: HEDU IMS<no-reply@hedu.edu.bb>";

				// send email
				if(mail($email,$subject,$msg, $headers)){
					//SHOW MESSAGE
					echo "<div id=\"ani\" class=\"success\">Mail Sent! <img src=\"dist/img/tick.png\"/></div>";
									
					//NB *** THE BUTTON ONLY WORKS IN GMAIL AND NOT HOTMAIL!!
				}
				else {
					//ERROR
					echo "<div id=\"ani\" class=\"error\"><img src=\"dist/img/x.png\"/> Error! </div>";
				}
			  }
			}//END FOUND EMAIL
			
		}//END POST
	  ?>
	  
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>