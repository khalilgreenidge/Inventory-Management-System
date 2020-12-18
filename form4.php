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
    <title>HEDU IMS | Licences</title>
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
          <h1>Licences <img src="dist/img/license.png" width="50" height="45" />
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
		
			<!-- form start -->
            <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                ID: <input type="text" name="id" value="<?php
					$num = 0; $number = 0;
					$highest = 0;
					
					$con = mysql_connect("localhost", "root", "");
							
					$db = mysql_select_db("heduis");
									
					$rs = mysql_query("SELECT id FROM licence");
									
					if(!$con || !$db || !$rs ){
						die('Error: '.mysql_error());
					}
					else{
						while($row = mysql_fetch_array($rs)){
							$num = $row['id'];
							if($num > $highest ){
								$highest = $num;
							}
						}
						$number = $highest +1;
						echo $number;	
					}	
					mysql_close();
				
				?>" readonly /><br/><br/>
                Brand: <input type="text" name="brand" /><br/><br/>
				Version: <input type="text" name="version" /><br/><br/>
				Key: <input type="text" name="key" required /><br/><br/>
                Type: <select name="type">
                        <option>Software </option>
                        <option>Switch</option>
                        <option>Router</option>
                        <option>Miscellaneous</option>
                      </select><br/><br/> 
				Browser Support: &nbsp;
				<a href="http://www.opera.com/computer/windows" target="blank"><img src="dist/img/opera.gif" alt="Opera" width="20" height="20"></a> 
				<a href="http://download.cnet.com/Apple-Safari/3000-2356_4-10697481.html" target="blank"><img src="dist/img/safari.gif" alt="Safari" width="20" height="20"></a>
				<a href="https://www.google.com/chrome/browser/desktop/" target="blank"><img src="dist/img/chrome.gif" alt="Chrome" width="20" height="20"></a>
				<img src="dist/img/firefox.gif" alt="firefox" width="20" height="20">
				<img src="dist/img/ie.gif" alt="IE" width="20" height="20">
				<br/><br/>
				
				Start Date: <img src="dist/img/calender.png" /><input type="date" name="startDate" max="<?php
					date_default_timezone_set("America/La_Paz");
					echo date("Y-m-d", strtotime("today")); 
				?>" /> <br/><br/>
				End Date: <img src="dist/img/calender.png" /><input type="date" name="endDate" min="<?php 
					date_default_timezone_set("America/La_Paz");
					echo date("Y-m-d", strtotime("today")); 
				?>" /><br/><br/><br/>
				
                <input type="submit" /> <input type="reset" />   
            </form>
			
			<?php
				//VARIABLES
				$id = $brand = $version = $key = $type = $startDate = $endDate = "";
				
				//PROCESS FORM
				if($_SERVER["REQUEST_METHOD"] == "POST" ){
					$id = strtoupper($_POST["id"]);
					$brand = ucfirst(test_input($_POST["brand"]));
					$version = ucfirst(test_input($_POST["version"]));
					$key = test_input($_POST["key"]);
					$type = test_input($_POST["type"]);
					$startDate = test_input($_POST["startDate"]);
					$endDate = test_input($_POST["endDate"]);
					
					//CONNECT TO DB
					$con = mysql_connect("localhost", "root", "");
					
					$db = mysql_select_db("heduis");
					
					$rs = mysql_query("INSERT INTO licence VALUES(\"$id\", \"$brand\", \"$version\", \"$key\", \"$type\", \"$startDate\", \"$endDate\") ");
					
					if(!$con || !$db || !$rs){
						die('Error: '.mysql_error());
					}
					else{
						//PRINT MESSAGE
						
						echo "<div id=\"ani\" class=\"success\">New item Added! <img src=\"dist/img/tick.png\"/></div>";
					}
					$location = "form4.php";
					
					echo '<META HTTP-EQUIV="Refresh" Content="7; URL='.$location.'">';
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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
