<?php
	header('Content-type: application/json');

	$con = mysql_connect("localhost", "root", "");
	
	$db = mysql_select_db("heduis");
			
	$rs1 = mysql_query("SELECT * FROM stock GROUP BY type ");	

	$type = "";	
						
	$stock = array();
						
	if(!$con || !$db || !$rs1){
		die('Error: '.mysql_error());
	}
	else{		
		
		while($row = mysql_fetch_array($rs1)){
			
			$type = $row["type"];
			
			$total = mysql_num_rows(mysql_query("SELECT * FROM stock WHERE type = \"$type\" "));
			
			/* echo "Type: ".$type."<br/>";
			echo "Total: ".$total."<br/><br/>";  */
			
			/*APPEND TO STOCK ARRAY*/
			$stock[] = array($type => $total);
			
			
			
		}
		
				
	}
	
	echo json_encode($stock);

?>