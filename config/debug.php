 <?php

	/* This is a standard layout to be inserted into a 
	function or a page to debug the code.
		
	$debug = $_POST['debug'];
	$debugMsg .= "Start Time = $StartTime<BR>";
	$debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
	$debugMsg .= "\$fieldName= $fieldName<BR>";
	include("config/debug.php");
	*/
	
	$dbs = new dbSession();
	$sql = "SELECT * from config WHERE ConfigID = 1 LIMIT 0, 30";
	
	$Results = $dbs->getResult($sql);
	
	while ($row = $dbs->getArray($Results)) {
		if ($row[ConfigDebug] == 1) {
				echo "<p>\n";
				echo "                <!-- start debug -->\n";
				echo "                <b class=\"generalFontOnWhite\">Debug:</b><br />\n";
				echo "                " . $debugMsg . "\n";
				echo "                <br />\n";
				echo "                <!-- end debug -->\n";
				echo "                </p>\n";
		}
	
	}
?>
