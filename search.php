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
	
	// Date in the past
	
?> 
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>HEDU IMS | Record View</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
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
	<?php 
		echo header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		echo header("Cache-Control: no-cache");
		echo header("Pragma: no-cache");
	?>	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue" onload="setFocus()">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- header logo: style can be found in header.less -->
      <header class="main-header">
			<?php 
				include "header.php";
			?>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->
          <form action="search.php" method="get" class="sidebar-form">
            <div class="input-group">
              <input id="searchtxt" type="text" name="key" autocomplete="off" required onkeyup="showResult(this.value)" class="form-control" placeholder="Search Serial#, Service Tag, Type"/>
              <span class="input-group-btn">
                <button type='submit'  id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
			<div id="livesearch"></div>

          </form>
		  <script>
				function setFocus(){
					document.getElementById("searchtxt").focus();
				}
		  </script>

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
            Search
			
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
			<br/>
			<?php
				
				//VARIABLES
				$num = 0;
				$key = "";
				
				if(isset($_GET['key'])):
					//extract hash
					$key = $_GET['key'];
					
					//SANITIZE STRING
					$key = filter_var($key, FILTER_SANITIZE_STRING);
					
				endif;
							
				$type = $key;
				
				$con = mysql_connect("localhost", "root", "");
						
				$db = mysql_select_db("heduis");
					
				$rs = mysql_query("SELECT * FROM stock WHERE type='$type' or id='$key'");
				$rs1 = mysql_query("SELECT * FROM stock WHERE id='$key'");
								
				if(!$con || !$db || !$rs ){
					die('Error: '.mysql_error());
				}
				else{
				
					
					while($row = mysql_fetch_array($rs1)){
						$type = $row['type'];
						echo "<h1>".$type."</h1>";
					}
					
					
					$num = mysql_num_rows($rs);
					
					$die = 0;
					
					if(mysql_num_rows($rs) > 0){
						//extract hash
						$key = $_GET['key'];
						
						//SANITIZE STRING
						$key = filter_var($key, FILTER_SANITIZE_STRING);
						
					
						echo 'Showing <b>'.$num.'</b> results for -- '.$key.'(s)  <img id="bounce" src="dist/img/'.$type.'.png" width="50" height="50" alt="Search.png"/>';
					}
					else{
						echo "<h3>Sorry, no items found</h3>";
						echo "<br/>";
						$die = 1;
						echo 'Need any help searching? Send an email to the  <a href="mailto:techadmin@hedu.edu.bb">administrator</a>';
					}
					
					echo '<br/><br/>'; 
					
					if($_SESSION["user"] == "admin" && $die != 1){
						include 'searchform.php';
					}
					
					?>
										
					<script>
			
			
						String.prototype.capitalizeFirstLetter = function() {
							return this.charAt(0).toUpperCase() + this.slice(1);
						}
						
													
						function upperCase(){
							//GET REPRESENTATIVE
							var f = document.getElementById("type");
							
							//GET FIRST LETTER
							f.value = f.value.capitalizeFirstLetter();

						}
						
						function check(){
							var btn = document.getElementById("uploadBtn");
							var file = document.getElementById("uploadFile").value = btn.value;
							var msg = document.getElementById("message");
							
							var x = "png";
							
							if( file.slice(-3) != x ){
								msg.style.backgroundColor = "#a94442";
								msg.innerHTML	= "Image must be a .png image ";
								return false;
							}
							else{
								msg.innerHTML	= "";
								msg.style.backgroundColor = "#f4f5f7";
								return true;
							}
						}
					</script>
					<br/>
					<?php		
						if(isset($_GET['key'])){
							echo "
							<br/><br/>
							<table class=\"table\">
								<tr>
									<th>Service Tag/Serial #</th>
									<th>Name</th>
									<th>Brand</th>
									<th>Model</th>
									<th>Type</th>
									<th>Loaned</th>
									<th>Comment</th>
								</tr>
							";	
							
							while($row = mysql_fetch_array($rs)){
								echo "<tr>";
								
								echo "<td>" . $row['id'] . "</td>";
								echo "<td>" . $row['name'] . "</td>";
								echo "<td>" . $row['brand'] . "</td>";
								echo "<td>" . $row['model'] . "</td>";
								echo "<td>" . $row['type'] . "</td>";
								echo "<td>" . $row['loaned'] . "</td>";
								echo "<td>" . $row['Comment'] . "</td>";
								
								echo "</tr>";
							}
							echo "</table>";
							
						}
					
						mysql_close($con);
					}
			
			?>
			
			<?php
				$name = $type = $url = $picname = $key = "";
				

				//PROCESS FORM
				if($_SERVER["REQUEST_METHOD"] == "POST"){
					
					$key = $_POST["key"];
					echo $key;
					$name = ucwords($_POST["name"]);
					$type = ucwords($_POST["type"]);

					if($name == ""){
						$picname = $type;
					}
					
					else{
						$picname = $name;
					}
					
					if( $_FILES['pic']['name'] != ""){
						//ADD NEW PIC
						$target_dir = "dist/img/";
						
						$ext = '.png';
						$target_file = $target_dir . $picname .$ext;
								
						if(move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file) ){
							echo '<script>
											  function checkFile(){	
												var msg = document.getElementById("message");
												
												message.style.backgroundColor = "#5fa918";
												
												msg.innerHTML	= "Yes! File uploaded successfully"
											  }	
											  window.checkFile();
										  </script>
										 
										';
						}
						else{
							echo '<script>
											  function checkFile(){	
												var msg = document.getElementById("message");
												
												message.style.backgroundColor = "#a94442";
												
												msg.innerHTML	= "Sorry, there was an error uploading the file."
											  }	
											  window.checkFile();
										  </script>
										 
										';
						}//END IF FILE MOVED
								
						
						
					
					}//END FILE NOT EMPTY
					
					
					//CHANGE NAME/TYPE
					if(!empty($name)){	
						//CONNECT TO DATABASE TO SAVE TYPE AND PIC
						$con = mysql_connect("localhost", "root", "");
						
						$db = mysql_select_db("heduis");
						
									
						
						if(!$con || !$db ){
							die('Error: '.mysql_error());
						}
						else{
							echo $type. "&nbsp;". $name;
							$rs = mysql_query("SELECT * FROM new_stationery WHERE type='$type' ") or die("Error: ");
							$rs2 = mysql_query("SELECT * FROM new_office_equipment WHERE type='$type' ") or die("Error: ");
							$rs3 = mysql_query("SELECT * FROM new_equipment WHERE type='$type' ") or die("Error: ");
							
							if(mysql_num_rows($rs) > 0){
								$rs = mysql_query("UPDATE new_stationery SET type='$name' WHERE type='$type' ") or die("Error: ");
								$rs = mysql_query("UPDATE stock SET type='$name' WHERE type='$type' ") or die("Error: ");
							}
							
							elseif(mysql_num_rows($rs2) > 0){
								$rs2 = mysql_query("UPDATE new_office_equipment SET type='$name' WHERE type='$type' ") or die("Error: ");
								$rs2 = mysql_query("UPDATE stock SET type='$name' WHERE type='$type' ") or die("Error: ");
							}
							
							elseif(mysql_num_rows($rs3) > 0){
								$rs3 = mysql_query("UPDATE new_equipment SET type='$name' WHERE type='$type' ") or die("Error: ");
								$rs3 = mysql_query("UPDATE stock SET type='$name' WHERE type='$type' ") or die("Error: ");
							}
							//ADD TO LINKS FILE FOR LIVESEARCH
							include 'write.php';
						}
						mysql_close($con);
					}
					
					clearstatcache();
					
					//REFRESH
					
						$location = 'index.php';
						echo '<META HTTP-EQUIV="Refresh"  Content="0; URL='.$location.'" />';						
						echo $key;
					
				}//END POST
				
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
    </div><!-- ./wrapper -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
