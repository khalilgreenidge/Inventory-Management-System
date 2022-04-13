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
    <title>HEDU IMS | Return an asset</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	
    <!-- Ionicons -->
    <link rel="shortcut icon" href="dist/img/logo.gif" />
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
            Return Form
            
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
		
			<?php
				
				//VARIABLES
				$type = "";
				
				$con = mysqli_connect("localhost", "root", "");
							
				$db = mysqli_select_db($con, "heduis");
							
				$rs = mysqli_query($con, "SELECT * FROM loan WHERE Returned=\"no\" AND Status=\"accepted\"  ORDER BY ReturnDate ");
									
				if(!$con || !$db || !$rs ){
					die('Error: '.mysqli_error());
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
							</tr>
						";	
					
					if(mysqli_num_rows($rs) < 1):
						echo "<b>All items have been returned</b>";
					endif;
					
					while($row = mysqli_fetch_array($rs)){
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
						
						echo "</tr>";
					}
						echo "</table>";
						
						echo "<br/><br/><br/>";
						
				}	
			?>	
			
             		
			<hr/>
			<h3>Return an item</h3>
			
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				Ticket# : <select name ="ticket" required>
										<option value="">Choose..</option>
						<?php
							$officer = $duration = "";
							
							//PRINT DROP DOWN LIST
							$result1 = mysqli_query($con, "SELECT * FROM loan WHERE Returned=\"no\" ") or die(mysqli_error());
							
							while($row = mysqli_fetch_array($result1)){
								echo "<option value = ".$row["ticket_id"].">".$row["ticket_id"]."</option>";
								$email = $row["Email"];
								$duration = $row["Duration"];
								$officer = $row["Officer"];
							}
							mysqli_close($con);
						?> </select><br/>
					<br/>		
				<input type="submit" style="width: 100px;"/> <input type="reset" style="width: 100px;"/>
			
			</form>
			
			<?php
				//VARIABLES
				$id = $name = $item = $date = $date = $duration = $reason = $status = $cat = $dbB = "";
				$ticket = 0;
				
				//PROCESS FORM
				if($_SERVER["REQUEST_METHOD"] == "POST"){
					
					$ticket = $_POST["ticket"];
					
									
					
					$con = mysqli_connect("localhost", "root", "");
	
					$db = mysqli_select_db($con, "heduis");
					
					date_default_timezone_set("America/La_Paz");
					$mkdate = getdate(date("U"));
					$date = "$mkdate[year]"."-".date("m-d"); 
					
					$rs = mysqli_query($con, "SELECT * FROM loan WHERE ticket_id=\"$ticket\"");	
					
								
					if(!$con || !$db || !$rs){
						die('Error: '.mysqli_error());
					}
					else{
						while($row = mysqli_fetch_array($rs)){
							$id = $row["ID"];
						}
						
						$rs2 = mysqli_query("UPDATE stock SET loaned=\"no\" WHERE id=\"$id\" ") or die('Error: '.mysqli_error());
						$rs3 = mysqli_query("UPDATE loan SET Returned=\"yes\" WHERE ticket_id=\"$ticket\" ") or die('Error: '.mysqli_error());
						
						echo "<div id=\"ani\" class='success'>Success! <img src=\"dist/img/tick.png\"/></div>";						
						$location = 'return.php';
						echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$location.'">';					
					
					}
					mysqli_close($con);
															
				}
				
				//TEST FUNCTION
				function test_input($data){
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}
				
				
			?>
			
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
          <?php include "footer.php"; ?>
      </footer>
    </div><!-- ./wrapper -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
