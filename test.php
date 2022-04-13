<?php

			$con = mysqli_connect("localhost", "root", "");
		
		$db = mysqli_select_db($con, "heduis");
				
		$rs1 = mysqli_query($con, "SELECT * FROM stock GROUP BY type ");	

		$type = "";	
							
		$stock[] = "['Option', 'Total', { role: 'style' }]";
							
		if(!$con || !$db || !$rs1){
			die('Error: '.mysqli_error());
		}
		else{		
			
			$i = 0;
			
			$color = array('#E94D20', '#ECA403', '#63A74A');
			
			while($row = mysqli_fetch_array($rs1)){
				
				//RESET COUNTER IF EQUAL TO 3
				if($i > 2){
					$i = 0;
				}
				
				$type = $row["type"];
				
				$total = mysqli_num_rows(mysqli_query($con, "SELECT * FROM stock WHERE type = \"$type\" "));
				
				/* echo "Type: ".$type."<br/>";
				echo "Total: ".$total."<br/><br/>";  */
				
				/*APPEND TO STOCK ARRAY*/
				
				
				/* $stock[] = "['".$type."', ".$total.", '".$color[0]."' ]"; */
				
				echo $color[$i];
				
				$i++;
			}
			
					
		}

?>