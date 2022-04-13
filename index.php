<!--
Author: Khalil Greenidge
Email: khalilgreenidge16@gmail.com
Created: 30/04/2015
-->
<?php 
	session_start();
	
	if(empty($_SESSION["login"])){
		header("Location: login.php");
	}
	
	$hash = "";
	$endDate = "";
	
	$con = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($con, "heduis");
	$rs = mysqli_query($con, "SELECT * FROM activation_links");
	
	$start = $expire = 0;
	
	$today = strtotime("now");
	
	if(!$con || !$db || !$rs){
		die('Error: '.mysqli_error());
	}
	else{
		
		while($row = mysqli_fetch_array($rs)){
			
			$expire = strtotime($row["endDate"]);
			
			if($today > $expire){
				$endDate = date("Y-m-d", $expire);
				$rs1 = mysqli_query($con, "DELETE FROM activation_links WHERE endDate=\"$endDate\" ") or die('Error: '.mysqli_error());
			}
			
		}
		
	}
	
	mysqli_close($con);
	
?> 
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>HEDU IMS | Home</title>
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="shortcut icon" href="dist/img/logo.gif" />
    <!-- Bootstrap 3.3.1 -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.2.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
   
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
	<?php 
		echo header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		echo header("Cache-Control: no-cache");
		echo header("Pragma: no-cache");
	?>	
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
  <body class="skin-blue"  >
    <div class="wrapper">
      <!-- header logo: style can be found in header.less -->
      <header class="main-header">
			<?php include "header.php"; ?>
      </header> <!--END HEADER-->
	  
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar" style="min-height: 100% !important;" >
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

		<!-- search form -->
          <form action="search.php" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="key" autocomplete="off" required onkeyup="showResult(this.value)" class="form-control" placeholder="Search Serial#, Service Tag, Type"/>
              <span class="input-group-btn">
                <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
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

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard <img src="dist/img/dashboard.png" width="50" height="45"/>
          </h1>
          
        </section>
		
		        <!-- Main content -->
		<section class="content" style="min-height: 800px">
			
			<?php
			$con = mysqli_connect("localhost", "root", "");
			$db = mysqli_select_db($con, "heduis");
			$num = 0;
			$a = 1;
			$j = 0;
			$br = "";
			
			$rs1 = mysqli_query($con, "SELECT * FROM new_stationery GROUP BY type ");
			$rs2 = mysqli_query($con, "SELECT * FROM new_equipment GROUP BY type");
			$rs3 = mysqli_query($con, "SELECT * FROM new_office_equipment GROUP BY type");
			$type = "";			
						
			if(!$con || !$db || !$rs1|| !$rs2 ||!$rs3){
				die('Error: '.mysqli_error());
			}
			else{		
			
				if($_SESSION["user"] == "admin"){
										//STATIONERY
				
				$i = 'a';
				//ECHO ROW
				echo '<div id="row">';
				
				echo '<h3>Stationery</h3>';
				
				while($row = mysqli_fetch_array($rs1)){
					if($i > 'd'){
						$i = 'a';
					}
					$type = $row["type"];	
					$rs = mysqli_query($con, "SELECT * FROM stock WHERE type='$type'");
					$num = mysqli_num_rows($rs);
					
					echo '
					<div id="col" class="'.$i.'" onclick="window.location.href=\'search.php?key='.$type.'\'" ">
						<img src="dist/img/'.$type.'.png" width="50" height="50" /> '.$type.'s <span>'.$num.'</span>
					</div>
					
					';
					$i++;
				}
				
				//CLOSE ROW
				echo '</div>';
						
				
									//COMPUTER EQUIPMENT
									
				$i = 'a';
				//ECHO ROW
				
				echo '<div id="row" style="margin-bottom: 20px">';
				echo '<br/>';
				echo '<h3>Computer Equipment</h3>';
				
				while($row = mysqli_fetch_array($rs2)){
					if($i > 'd'){
						$i = 'a';
					}
								
					$type = $row["type"];	
					$rs = mysqli_query($con, "SELECT * FROM stock WHERE type='$type'");
					$num = mysqli_num_rows($rs);
					
					echo '
					<div id="col" class="'.$i.'" onclick="window.location.href=\'search.php?key='.$type.'\'" ">
						<img src="dist/img/'.$type.'.png" width="50" height="50" /> '.$type.'s <span>'.$num.'</span>
					</div>
					
					';
					$i++;
					
				}
				
				//CLOSE ROW
				echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				</div>
				<br/>';

				
										//OFFICE EQUIPMENT
				
				$i = 'a';
				//ECHO ROW
				echo '<div id="row">';
				echo '<br/>';
				echo '<h3>Office Equipment</h3>';
				
				while($row = mysqli_fetch_array($rs3)){
					
					if($i > 'd'){
						$i = 'a';
					}					
					$type = $row["type"];	
					$rs = mysqli_query($con, "SELECT * FROM stock WHERE type='$type'");
					$num = mysqli_num_rows($rs);
					
					echo '
					<div id="col" class="'.$i.'" onclick="window.location.href=\'search.php?key='.$type.'\'" ">
						<img src="dist/img/'.$type.'.png" width="50" height="50" /> '.$type.'s <span>'.$num.'</span>
					</div>
					';
					$i++;
					$a++;
					if($a % 3 == 0){ 
						$br .= "<br/><br/><br/><br/><br/><br/><br/><br/>";
					}	
				}
				
				//ADD A BR TAG WHEN COLUMNS REACH 3
				
				echo $br;
				
				//CLOSE ROW
				echo '</div>
				<br/>';
				
				}
				
				else{
									//USER DASHBOARD
										
					$i = 'a';
					//ECHO ROW
					
					echo '<div id="row">';
					echo '<br/>';
					echo '<h3>Computer Equipment</h3>';
					
					$rs = mysqli_query($con, "SELECT * FROM stock WHERE type='Laptop'") or die("Error: ".mysqli_error());
					$rs1 = mysqli_query($con, "SELECT * FROM stock WHERE type='Desktop'") or die("Error: ".mysqli_error());
					$rs2 = mysqli_query($con, "SELECT * FROM stock WHERE type='Tablet'") or die("Error: ".mysqli_error());
					
					$row = mysqli_fetch_array($rs);
						if($i > 'd'){
							$i = 'a';
						}
									
						$type = $row["type"];	
						
					
						$num = mysqli_num_rows($rs);
						
						echo '
						<div id="col" class="'.$i.'" onclick="window.location.href=\'search.php?key='.$type.'\'" ">
							<img src="dist/img/'.$type.'.png" width="50" height="50" /> '.$type.'s <span>'.$num.'</span>
						</div>
						';
					$i++;
						
					
					$row = mysqli_fetch_array($rs1);
					if($i > 'd'){
						$i = 'a';
					}
								
					$type = $row["type"];	
					
				
					$num = mysqli_num_rows($rs1);
					
					echo '
					<div id="col" class="'.$i.'" onclick="window.location.href=\'search.php?key='.$type.'\'" ">
						<img src="dist/img/'.$type.'.png" width="50" height="50" /> '.$type.'s <span>'.$num.'</span>
					</div>
					';
					$i++;
					
					
					$row = mysqli_fetch_array($rs2);
					if($i > 'd'){
						$i = 'a';
					}
								
					$type = $row["type"];	
					
				
					$num = mysqli_num_rows($rs2);
					
					echo '
					<div id="col" class="'.$i.'" onclick="window.location.href=\'search.php?key='.$type.'\'" ">
						<img src="dist/img/'.$type.'.png" width="50" height="50" /> '.$type.'s <span>'.$num.'</span>
					</div>
					';
					$i++;
					
					
					//CLOSE ROW
					echo '</div>
					<br/>';
				}
				
			}
		?>
		<br/>
		<br/>
		<br/>	
		<br/>	
		</section>
      </div><!-- /.content-wrapper -->
	  
      <footer class="main-footer">
		<?php include "footer.php";?>
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