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
			
			$color = array('#E94D20', '#ECA403', '#63A74A');
			
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
				
				
				/* $stock[] = "['".$type."', ".$total.", '".$color[0]."' ]"; */
				
				echo $color[$i];
				
				$i++;
			}
			
					
		}

?>