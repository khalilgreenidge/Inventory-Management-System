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
    <title>HEDU IMS | Computer Equipment</title>
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

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
              <input type="text" name="key"  autocomplete="off" required onkeyup="showResult(this.value)"  class="form-control" placeholder="Search Serial#, Service Tag, Type"/>
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

      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            New Computer Asset <img src="dist/img/imac.png" width="50" height="50" /><img src="dist/img/board.png" width="50" height="50"/>
          </h1>
		  <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="form2.php">Enter new record for Computer Equipment</a></li>
            <li class="active">New Computer Asset</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			
				
			<!-- form start -->
            <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" onsubmit="return check()" >
                
				Type: <input id="type" type="text" name="type" onkeyup="upperCase()" required placeholder="(e.g. router or projector" /><br/><br/>
				Picture: <input id="uploadFile" placeholder="Choose Image" disabled="disabled" />
							<div class="fileUpload btn btn-primary" style="background-color: #222d32;
							color: white;  border-radius: 7px;">
								<span>Upload</span>
								<input id="uploadBtn" onchange="check()" type="file" name="pic" class="upload" required/>
							</div>
				<div id="bubble" class="bubble">
					<p id="message" class="message" style="padding: 10px; text-align: center; color: white; border-radius: 15px" ></p>
				</div>	
				<input type="submit"/> <input type="reset" />	
             </form> 			 
			<script>		
			String.prototype.capitalizeFirstLetter = function() {
				return this.charAt(0).toUpperCase() + this.slice(1);
			}
			
			document.getElementById("uploadBtn").onchange = function () {
				document.getElementById("uploadFile").value = this.value;
				var msg = document.getElementById("message");
				var file = document.getElementById("uploadFile").value = this.value;
				
				var x = "png";
				
				if( file.slice(-3) != x ){
					msg.style.backgroundColor = "#a94442";
				
					msg.innerHTML	= "Image must be a .png image ";
				}
				else{
					msg.innerHTML	= "";
					msg.style.backgroundColor = "#f4f5f7";
				}
			}
			
			function check(){
				var btn = document.getElementById("uploadBtn");
				var file = document.getElementById("uploadFile").value = btn.value;
				var msg = document.getElementById("message");
				
				var x = "png";
				
				if( file.slice(-3) != x ){
					msg.style.backgroundColor = "#a94442";
					msg.innerHTML	= "Image must be .png image ";
					return false;
				}
				else{
					msg.innerHTML	= "";
					msg.style.backgroundColor = "#f4f5f7";
					return true;
				}
			}
			
			
			function upperCase(){
				//GET REPRESENTATIVE
				var f = document.getElementById("type");
				
				//GET FIRST LETTER
				f.value = f.value.capitalizeFirstLetter();

			}
			</script>
			 <?php
				//VARIABLES
				$type = $dbtype = "";
				
				//PROCESS FORM
				if($_SERVER["REQUEST_METHOD"] == "POST"){
					
					$type = ucfirst(test_input($_POST["type"]));
					
					$con = mysqli_connect("localhost", "root", "");
					
					$db = mysqli_select_db($con, "heduis");
					
					$rs = mysqli_query($con, "SELECT * FROM new_equipment WHERE type=\"$type\" ");
							
					
					
					if(!$con || !$db || !$rs ){
						die('Error: '.mysqli_error());
					}
					else{
						//IF ITEM IS FOUND, PRINT ALREADY ADDED
						if( mysqli_num_rows($rs) > 0 ){
							echo "<div id=\"ani\" class='error'><img src=\"dist/img/x.png\"/> Item already added! </div>";
						}
						else{
							$rs1 = mysqli_query("INSERT INTO new_equipment(type) VALUES(\"$type\")") or die('Error: '.mysqli_error());
							echo "<div id=\"ani\" class='success'>New item added! <img src=\"dist/img/tick.png\"/></div>";
						
							//ADD NEW PIC
							$target_dir = "dist/img/";
							$imageType = pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION);
							
							// Check if image file is a PNG image 
							if($imageType != "png"){
								//ERROR
								echo $imageType;
								exit("Your image must be a PNG image file.");
							}					
							else{
								$ext = '.png';
								$target_file = $target_dir . $type .$ext;
								
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
								}
								
							}		
						}	
					}
					mysqli_close($con);
				}	
				
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
			<?php include "footer.php";?>
      </footer>
    </div><!-- ./wrapper -->


  </body>
</html>
