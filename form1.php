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
	<title>HEDU IMS | Stationery</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
			  <input type="text" name="key"  autocomplete="off" required onkeyup="showResult(this.value)" class="form-control" placeholder="Search Serial#, Service Tag, Type"/>
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
	  <div class="content-wrapper" >
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			Enter New Stationery <img id="logo" src="dist/img/pencil.png" width="50" height="50" />			
		  </h1>
		  
		</section>

		<!-- Main content -->
		<section class="content" >
		
			<!-- Form Starts Here -->
			<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"><br/>
				ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="id" name="id" onkeyup="upperCase()" required /><br/><br/>
				Brand: &nbsp;&nbsp;<input type="text" name="brand" required onkeyup="upperCaseFirst()" /><br/><br/>
				Model: <input type="text" name="model" required onkeyup="upperCaseFirst()" /><br/><br/>
				Type: <select name="type" required>
					<option value="">Choose..</option>
					<?php
						$con = mysql_connect("localhost", "root", "");
						
						$db = mysql_select_db("heduis");
						
						$rs = mysql_query("SELECT * FROM new_stationery");
						
						if(!$con || !$db || !$rs){
							die('Error: '.mysql_error());
						}
						else{
							//PRINT MESSAGE
							while($row = mysql_fetch_array($rs)){
								echo "
								<option value=' ".$row['type']."'>".$row['type']."</option>
							";
							}
						}
						
						mysql_close($con);
					?>
				</select> <br/> 
				<a href="form1-1.php"> &nbsp;Type not found? Click here <a/>
					<br/><br/>
				<span style="color: #333;">Comment: </span><br/><textarea name="comment" placeholder="State" cols="50" rows="6" maxlength="180" required>
					</textarea>	
					<br/>	
				<input type="submit"/> <input type="reset" />
			</form>		
			<script>
			function upperCase(){
				//GET REPRESENTATIVE
				var f = document.getElementById("id");
				
				//GET FIRST LETTER
				f.value = f.value.toUpperCase();

			}
			
			String.prototype.capitalizeFirstLetter = function() {
				return this.charAt(0).toUpperCase() + this.slice(1);
			}
						
													
			function upperCaseFirst(){
				//GET REPRESENTATIVE
				var f = document.getElementById("type");
				
				//GET FIRST LETTER
				f.value = f.value.capitalizeFirstLetter();

			}
			</script>	
			<?php
				//VARIABLES
				$id = $dbid = $brand = $model = $type = "";
				
				//PROCESS FORM
				if($_SERVER["REQUEST_METHOD"] == "POST"){
					$id = test_input(strtoupper(test_input($_POST["id"])));
					$brand = ucfirst(test_input($_POST["brand"]));
					$model = ucfirst(test_input($_POST["model"]));
					$type = test_input($_POST["type"]);
					$comment = $_POST["comment"];
					
					$con = mysql_connect("localhost", "root", "");
	
					$db = mysql_select_db("heduis");
					
					$rs = mysql_query("SELECT * FROM stock WHERE id=\"$id\" ");
					
										
					if(!$con || !$db || !$rs ){
						die('Error: '.mysql_error());
					}
					else{
						
						//IF ITEM IS FOUND, PRINT ALREADY ADDED. ELSE --> NEW ITEM ADDED!
						if(mysql_num_rows($rs) > 0){
							//ERROR
							echo "<div id=\"ani\" class='error'><img src=\"dist/img/x.png\"/> Item already added! </div>";
						}
						else{
							//SUCCESS
							if(empty($comment)){
								$rs2 = mysql_query("INSERT INTO stock(id, brand, model, type, loaned) VALUES(\"$id\", \"$name\", \"$brand\", \"$model\", \"$type\", \"no\")") or die('Error: '.mysql_error());
							}
							else{
								$rs2 = mysql_query("INSERT INTO stock(id, brand, model, type, loaned, comment) VALUES(\"$id\",\"$brand\", \"$model\", \"$type\", \"no\", \"$comment\")") or die('Error: '.mysql_error());
							}
							echo "<div id=\"ani\" class='success'>New item Added! <img src=\"dist/img/tick.png\"/></div>";
						
							//ADD TO LINKS FILE FOR LIVESEARCH
							include 'write.php';
						
						}	
						
						
						
					}
					mysql_close($con);
				}
				
				//TEST FUNCTION
				function test_input($data){
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}
				
			?>
			<br/>
				
		</section><!-- /.content -->
	  </div><!-- /.content-wrapper -->

	  <footer class="main-footer">
		  <?php include 'footer.php';?>
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
