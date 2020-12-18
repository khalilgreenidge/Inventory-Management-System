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
    <title>HEDU IMS | Statistics</title>
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
	
	<?php
		$con = mysql_connect("localhost", "root", "");
		
		$db = mysql_select_db("heduis");
				
		$rs1 = mysql_query("SELECT * FROM stock GROUP BY type ");	

		$type = "";	
							
		$stock[] = "['Option', 'Total', { role: 'style' }]";
							
		if(!$con || !$db || !$rs1){
			die('Error: '.mysql_error());
		}
		else{		
			
			$i = 0;
			
			$color = array('#2E2EFE', '#DBA901', '#222d32');
			
			while($row = mysql_fetch_array($rs1)){
				
				//RESET COUNTER IF EQUAL TO 3
				if($i > 2){
					$i = 0;
				}
				
				$type = $row["type"];
				
				$total = mysql_num_rows(mysql_query("SELECT * FROM stock WHERE type = \"$type\" "));
				
				/* echo "Type: ".$type."<br/>";
				echo "Total: ".$total."<br/><br/>";  */
				
				/*APPEND TO STOCK ARRAY*/
				
				
				$stock[] = "['".$type."', ".$total.", '".$color[$i]."' ]";
				
				
				$i++;
			}
			
					
		}
		
	?>
	
	<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
			
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
	  var data;
	  var options;
	  
      function drawChart() {
	
		data = google.visualization.arrayToDataTable([
		<?php echo( implode(",", $stock) ); ?>
		]);

				
        // Set chart options
        options = {'title':'HEDU\'s Current Inventory',
                       'width':700,
                       'height':800,
					   'animation': {
							'startup': true,
							'duration': 3000,
							'easing': 'out',		
					   }					   
					   };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
	  
	  function myfunc(value){
		switch (value){
			case 'Bar':
				chart = new google.visualization.BarChart(document.getElementById('chart_div'));
				chart.draw(data, options);
				break;
				
			case 'Column':
				chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
				chart.draw(data, options);
				break;
				
			case 'Pie':
				chart = new google.visualization.PieChart(document.getElementById('chart_div'));
				chart.draw(data, options);
				break;				
			
		}
		
	  }
	   
    drawChart();
	  
    </script>
	
  </head>
  <body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- header logo: style can be found in header.less -->
      <header class="main-header">
			<?php include "header.php"; ?>
      </header> <!--END HEADER-->
	  
      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
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

      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Statistics
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Statistics</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		
			<br/><br/>
			<!--Div that will hold the pie chart-->
			<div id="chart_div" style="margin: 0 auto;">
			</div>
			<select id="list" onchange="myfunc(this.value)">
				<option value="Bar">Bar Chart</option>
				<option value="Column">Column Chart</option>
				<option value="Pie">Pie Chart</option>
			</select>
		  
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
