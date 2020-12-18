<!--
Author: Khalil Greenidge
Email: khalilgreenidge16@gmail.com
Created: 37/04/2015
-->
<?php 
	session_start();
	
	if(empty($_SESSION["login"])){
		header("Location: login.php");
	}
?> 
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>HEDU IMS | Tickets</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="shortcut icon" href="dist/img/logo.gif" />
    <link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<script>
		function showResult(str) {
		  if (str.length==0) { 
			document.getElementById("livesearch").innerHTML="";
			document.getElementById("livesearch").style.border="0px";
			return;
		  }
		  if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		  } 
		  else {  // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  
		  xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			  document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
			  document.getElementById("livesearch").style.border="1px solid #A5ACB2";
			}
		  }
		  
		  xmlhttp.open("GET","livesearch.php?q="+str,true);
		  xmlhttp.send();
		}
	</script>
  </head>
  <body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- header logo: style can be found in header.less -->
      <header class="main-header">
			<?php include "header.php";?>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->
          <form action="search.php" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="key" autocomplete="off" onkeyup="showResult(this.value)" required class="form-control" placeholder="Search Serial#, Service Tag, Type"/>
              <span class="input-group-btn">
                <button type='submit'  id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
			<div id="livesearch"></div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php 
				if($_SESSION["user"] == "admin"){
					include "adminmenu.php";
				}
				else{
					include "menu.php";
				}
		  ?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tickets
          </h1><br/>
          <button style="width: auto" class="btn bg-olive btn-block" onclick="window.print()">Print</button>
        </section>

        <!-- Main content -->
        <section class="content">
			<br/>
			<!-- Form Starts Here -->
			<?php
				
				//VARIABLES
				$type = "";
				
				$con = mysql_connect("localhost", "root", "");
							
				$db = mysql_select_db("heduis");
							
				$rs = mysql_query("SELECT * FROM loan ");
									
				if(!$con || !$db || !$rs ){
					die('Error: '.mysql_error());
				}
				else{
					echo "
						<table class=\"table\">
							<tr>
								<th>Ticket #</th>
								<th>Service tag#</th>
								<th>Officer</th>
								<th>Email</th>
								<th>Returned</th>
								<th>Loan Date</th>
								<th>Return Date</th>
								<th>Duration</th>
								<th>Reason</th>
								<th>Status</th>
							</tr>
						";	
						
					while($row = mysql_fetch_array($rs)){
						echo "<tr>";
							
						echo "<td>" . $row['ticket_id'] . "</td>";
						echo "<td>" . $row['ID'] . "</td>";
						echo "<td>" . $row['Officer'] . "</td>";
						echo "<td>" . $row['Email'] . "</td>";
						if($row['Returned'] == "yes"){
							echo "<td align='center'><img src=\"dist/img/tick.png\" height=\"20px\" weight=\"20px\" /></td>";
						}
						else{
							echo "<td align='center'><img src=\"dist/img/clock.png\" height=\"20px\" weight=\"20px\" /></td>";
						}
						echo "<td>" . $row['LoanDate'] . "</td>";
						if(($row['Returned'] == "no") &&  (strtotime("now") > strtotime($row['ReturnDate']) ) ){
							//BACKGROUND IS RED
							
							echo "<td style=\"background-color: red; color: white;\">" . $row['ReturnDate'] . "</td>";
						}
						else{
							echo "<td>" . $row['ReturnDate'] . "</td>";
						}
						echo "<td>" . $row['Duration'] . "</td>";
						echo "<td>" . $row['Reason'] . "</td>";
						if($row["Status"] == "accepted"){
							echo "<td><span class=\"label label-success\">" . $row['Status'] . "</span></td>";
						}
						else if($row["Status"] == "pending") {
							echo "<td><span class=\"label label-warning\">" . $row['Status'] . "</td>";
						}
						else if($row["Status"] == "declined") {
							echo "<td><span class=\"label label-danger\">" . $row['Status'] . "</td>";
						}
						echo "</tr>";
						
					}
						
						echo "</table>";
						
						echo "<br/><br/><br/>";
						
				}	
				
				
			?>
					
					<h4>Select a ticket number to accept/decline</h4><br/>
					
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
					
						Ticket #: <select name ="ticket" required style="width: 140px; position: absolute; left: 25%">
										<option value="">Choose..</option>
						<?php
							$email = $officer = $duration = "";
							
							//PRINT DROP DOWN LIST
							$result1 = mysql_query("SELECT * FROM loan WHERE status=\"pending\" ") or die(mysql_error());
							
							while($row = mysql_fetch_array($result1)){
								echo "<option value = ".$row["ticket_id"].">".$row["ticket_id"]."</option>";
								$email = $row["Email"];
								$duration = $row["Duration"];
								$officer = $row["Officer"];
							}
							mysql_close($con);
						?>
						</select><br/><br/>
						Status: <select name="status" required style="width: 140px; position: absolute; left: 25%">
									<option value="">Choose..</option>
									<option value="accepted">accept</option>
									<option value="declined">decline</option>
								</select>
						
						<br/><br/><br/>
						<input type="submit" style="width: 140px;"/> 
					</form>
					
					<?php
						if($_SERVER["REQUEST_METHOD"] == "POST" ){
							
							$id = $mkdate = $today = $end = "";
							$die = 0;
							
							$today = date("Y-m-d");
							
							$ticket = $_POST["ticket"];
							
							$status = $_POST["status"];
							
							$con = mysql_connect("localhost", "root", "");
							
							$db = mysql_select_db("heduis");
										
							$rs = mysql_query("UPDATE loan SET Status=\"$status\" WHERE ticket_id=$ticket ");
							$rs1 = mysql_query("SELECT * FROM loan WHERE ticket_id = $ticket ");
								
							if(!$con || !$db || !$rs || !$rs1){
								die('Error: '.mysql_error());
								$die = 1;
							}
							else{
							
								while($row = mysql_fetch_array($rs1)){
									$id = $row["ID"];
									$officer = $row["Officer"];
									$email = $row["Email"];
								}
							
								if($status == "accepted"){
									$rs1 = mysql_query("UPDATE stock SET loaned=\"yes\" WHERE id=\"$id\" ") or die('Error: '.mysql_error());
								}	
								
								
								
								//SEND AN EMAIL TO ADMIN FOR ACCEPTANCE
								$subject = "HEDU IMS | Request ".ucfirst($status);
							
								// the message
								$msg = "
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
															Hi ".$officer.",<br>
															<br>
															Your ticket -- #".$ticket."-- has been processed by the System's Administrator.<br>
															It has been ".$status.". If you have any enquires, please speak with the administrator - <a href=\"mailto:techadmin@hedu.edu.bb\" target=\"_blank\">techadmin@<span class=\"il\">hedu</span>.edu.bb</a>.
															
															<br>
															<br>
															
															
																<a href=\"http://localhost:8000/login.php\" target=\"_blank\">Click here to login</a>
																													
																<br/>
																 </p>
																<br/><br/>
															<p style=\"font-family:Arial,Helvetica,sans-serif;font-weight:normal;font-size:14px;line-height:24px;margin-top:0!important;margin-bottom:0!important\">
															 Best Regards,<br>
															<span class=\"il\">HEDU IMS</span> 
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
									if($die != 1){
									
										if(mail($email, $subject,$msg, $headers)){;
											//SHOW MESSAGE
											$location = 'tickets.php';
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$location.'">';					
											
										}
										else {
											//ERROR
											echo "<div id=\"ani\" class=\"error\"><img src=\"dist/img/x.png\"/> Error sending mail! </div>";
										}
									}
						
							}//END ELSE STATEMENT	
						
						}
					?>
				
			
			
			

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <?php include "footer.php" ?>
    </div><!-- ./wrapper -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
