<?php	
	$rs1 = mysqli_query($con, "SELECT id FROM stock") or die("Error: ".mysqli_error());				
	$rs2 = mysqli_query($con, "SELECT type FROM stock GROUP BY type") or die("Error: ".mysqli_error());				
				
	$file = "links.xml";
	
	$fh = fopen($file, 'w') or die("Can't open file");
	
	$type = "";
	
	$data = '
		<pages>';
	while($row  = mysqli_fetch_array($rs1)){
			$dbid = $row["id"];
			$data .= '
			<link>
				<title>'.$dbid.'</title>
				<url>search.php?key='.$dbid.'</url>
			</link>';
	}	
	
	while($row  = mysqli_fetch_array($rs2)){
			$type = $row["type"];
			$data .= '
			<link>
				<title>'.$type.'</title>
				<url>search.php?key='.$type.'</url>
			</link>';
	}
	
	
	$data .= '</pages>';	
	
	
	fwrite($fh, $data);
	
	fclose($fh);
	
?>