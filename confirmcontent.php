<?php
	echo "<h2>Account Confirmed!</h2>";
	echo "<br/><br/>";
	
	

	//SEND MAIL NOTIFYING USER
	$subject = "Welcome to HEDU IMS";
				
	// the message
	$msg = "
	<!--BACKGROUND TABLE-->

	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\" align=\"center\" style=\"padding-top:0px;font-family:Arial,Helvetica,sans-serif;font-weight:normal;font-size:14px;line-height:19px;color:#444444;border-collapse:collapse;background-color:#ececec\">
		<tbody>
		<tr>
			<td width=\"100%\">
				<br>
								
								<!--INNER TABLE-->
								<table width=\"600\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" >
									<tbody>
										<!--HEADER ROW-->
										
										<tr style='background-color: #3c8dbc;' align=\"center\">		
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
													Hi ".$dbname.",<br>
													<br>
													Your user account - '$dbuser' - has been approved by the admin.<br/>
													Feel free to log in any time to HEDU's Inventory Management System!<br>
													<br>
													
													
														<a href='http://localhost:8000/login.php'>Click here</a><br/><br/>
													
													<p style=\"font-family:Arial,Helvetica,sans-serif;font-weight:normal;font-size:14px;line-height:24px;margin-top:0!important;margin-bottom:0!important\">
													 Best Regards!<br>
													 Administrator <br/>
													HEDU IMS</p>
												
										
												<p style=\"margin-bottom:6px\">
												<br/>
												 Have a question or query? <br/>Send an email to <a href=\"mailto:techadmin@hedu.edu.bb\" target=\"_blank\">techadmin@hedu.edu.bb</a>&nbsp;&nbsp;
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
											Developed by: <a href=\"mailto:khalilgreenidge16@gmail.com\" target=\"_blank\">Khalil Greenidge</a></p>
																		
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
													  This is an automated service, please do not reply directly to this email. Only click the link as instructed.<br>
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
						$headers .= "From: HEDU IMS <no-reply-signup@hedu.edu.bb>";

							// send email
							if(mail($dbemail, $subject,$msg, $headers)){
								//SHOW MESSAGE
								echo "<div id=\"ani\" class=\"success\"><img src=\"dist/img/tick.png\" width=\"20\" height=\"20\"/> Account confirmed! </div>";
								
				
								//NB *** THE BUTTON ONLY WORKS IN GMAIL AND NOT HOTMAIL!!
							}
							else {
								//ERROR
								echo "<div id=\"ani\" class=\"error\"><img src=\"dist/img/x.png\"/> Error! </div>";
							}
					
				?>