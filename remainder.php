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
    <title>HEDU IMS | View Items Remaining</title>
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
            Items Remaining
            
          </h1>
		   <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<?php if($_SESSION["user"] == "admin"){	
						echo '<li><a href="loan.php">Loan Form</a></li>';
				  }
				  else{
						echo '<li><a href="userloan.php">Loan Form</a></li>';
				  }
			?>
            <li class="active">Items Remaining</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		
            <div class="box-body">
              View items not loaned.
			</div>
			
			
			<?php
				
				//VARIABLES
									
					$con = mysql_connect("localhost", "root", "");
							
					$db = mysql_select_db("heduis");
							
					if($_SESSION["user"] == "admin"){		
						$rs = mysql_query("SELECT * FROM stock WHERE loaned=\"no\" ORDER BY type ");
					}
					else{
						$rs = mysql_query("SELECT * FROM stock WHERE loaned=\"no\" AND type=\"Tablet\" OR type=\"Laptop\" OR type=\"Desktop\" ORDER BY type ");
					}
										
					if(!$con || !$db || !$rs ){
						die('Error: '.mysql_error());
					}
					else{
						echo "<br/>
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
						
						while($row = mysql_fetch_array($rs)){
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
						
					}
					mysql_close($con);
				
			?>
			 
			
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
