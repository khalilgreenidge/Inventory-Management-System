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
    <title>HEDU IMS | Record View</title>
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
  </head>
  <body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- header logo: style can be found in header.less -->
      <header class="main-header">
          <?php include "header.php"; ?>
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
					include "menu.php";
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
            View All Items
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Test Form</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			Current Inventory for H.E.D.U  <button style="width: auto" class="btn bg-olive btn-block" onclick="window.print()">Print</button>
			<br/><br/>
			
			<?php
				
				//VARIABLES
				$type = "";
				
				
					
				$con = mysqli_connect("localhost", "root", "");
							
				$db = mysqli_select_db($con, "heduis");
							
				$rs = mysqli_query($con, "SELECT * FROM stock ORDER BY type");
									
				if(!$con || !$db || !$rs ){
					die('Error: '.mysqli_error());
				}
				else{
					echo "
						<table class=\"table\">
							<tr>
								<th>Service Tag/Serial #</th>
								<th>Name</th>
								<th>Brand</th>
								<th>Model</th>
								<th>Type</th>
								<th>Loaned</th>
							</tr>
						";	
						
					while($row = mysqli_fetch_array($rs)){
						echo "<tr>";
							
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['brand'] . "</td>";
						echo "<td>" . $row['model'] . "</td>";
						echo "<td>" . $row['type'] . "</td>";
						echo "<td>" . $row['loaned'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
						
					
					mysqli_close($con);
				}
			?>
			

        </section><!-- /.content -->
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
