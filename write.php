<?php	
	$rs1 = mysql_query("SELECT id FROM stock") or die("Error: ".mysql_error());				
	$rs2 = mysql_query("SELECT type FROM stock GROUP BY type") or die("Error: ".mysql_error());				
				
	$file = "links.xml";
	
	$fh = fopen($file, 'w') or die("Can't open file");
	
	$type = "";
	
	$data = '
		<pages>';
	while($row  = mysql_fetch_array($rs1)){
			$dbid = $row["id"];
			$data .= '
			<link>
				<title>'.$dbid.'</title>
				<url>http://localhost:8000/search.php?key='.$dbid.'</url>
			</link>';
	}	
	
	while($row  = mysql_fetch_array($rs2)){
			$type = $row["type"];
			$data .= '
			<link>
				<title>'.$type.'</title>
				<url>http://localhost:8000/search.php?key='.$type.'</url>
			</link>';
	}
	
	
	$data .= '</pages>';	
	
	
	fwrite($fh, $data);
	
	fclose($fh);
	
?>