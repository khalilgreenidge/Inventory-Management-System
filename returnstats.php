<?php
	header('Content-type: application/json');

	$con = mysqli_connect("localhost", "root", "");
	
	$db = mysqli_select_db($con, "heduis");
			
	$rs1 = mysqli_query($con, "SELECT * FROM stock GROUP BY type ");	

	$type = "";	
						
	$stock = array();
						
	if(!$con || !$db || !$rs1){
		die('Error: '.mysqli_error());
	}
	else{		
		
		while($row = mysqli_fetch_array($rs1)){
			
			$type = $row["type"];
			
			$total = mysqli_num_rows(mysqli_query($con, "SELECT * FROM stock WHERE type = \"$type\" "));
			
			/* echo "Type: ".$type."<br/>";
			echo "Total: ".$total."<br/><br/>";  */
			
			/*APPEND TO STOCK ARRAY*/
			$stock[] = array($type => $total);
			
			
			
		}
		
				
	}
	
	echo json_encode($stock);

?>