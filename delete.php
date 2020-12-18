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
    <title>HEDU IMS | Delete an asset</title>
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
              <input type="text" name="key" required class="form-control" placeholder="Search Serial#, Service Tag, Type"/>
              <span class="input-group-btn">
                <button type='submit'  id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
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
            Edit a Record
            
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
		
            <div class="box-body">
			
             		
			<hr/>
			<h3>Delete an asset</h3>
			
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				
				Service Tag#: <input name="id" type="text" required />	<br/><br/>			
				<input type="submit" /> <input type="reset" />
			
			</form>
			
			<?php
				//VARIABLES
				$id = $name = $item = $date = $duration = $reason = $status = $cat = $dbB = "";
				
				
				//PROCESS FORM
				if($_SERVER["REQUEST_METHOD"] == "POST"){

					$id = $_POST["id"];
										
					
					$con = mysql_connect("localhost", "root", "");
	
					$db = mysql_select_db("heduis");
					
					$rs = mysql_query("SELECT * FROM stock WHERE id='$id'");
								
					if(!$con || !$db || !$rs ){
						die('Error: '.mysql_error());
					}
					else{
						while($row = mysql_fetch_array($rs)){
							$dbB = $row['loaned'];
						}
						
												
						//IF ITEM IS RETURNED, PRINT ALREADY RETURNED. ELSE --> RETURNED!
						if($dbB == "no"){
							//ERROR
							echo "<div id=\"ani\" class='error'><img src=\"dist/img/x.png\"/> Item not found! </div>";
						}
						else{
							//SUCCESS
							$rs2 = mysql_query("DELETE FROM stock WHERE id='$id'") or die('Error: '.mysql_error());
							
							echo "<div id=\"ani\" class='success'>Success! <img src=\"dist/img/tick.png\"/></div>";
						}	
					}
					mysql_close($con);
					$location = "index.php";
					
					echo '<META HTTP-EQUIV="Refresh" Content="7; URL='.$location.'">';
										
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
        <?php include "footer.php";?>
    </div><!-- ./wrapper -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
