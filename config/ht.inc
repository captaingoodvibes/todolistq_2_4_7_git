<?php
/**
*	file:		ht.inc
*	auth:	Matthew Donnici
*	date:	4/1/2002
*	last:		4/1/2002 matt
*	note:	this is an include file called ht with common html form functions living here
*/


// Start Form Functions -------------------------------------------------------//
function htFormStart($action, $method, $extra) {
	echo "<form action=\"$action\" method=\"$method\" $extra>" ;
}

function htFormInput($type, $name, $value, $size, $extra) {
	echo "<input type=\"$type\" name=\"$name\" value=\"$value\" size=\"$size\" $extra >";
}

function htFormTextarea($name, $cols, $rows, $text) {
	echo "<textarea name=\"$name\" cols=\"$cols\" rows=\"$rows\" >";
	echo "$text</textarea>";
}

function htBackButton() {
	echo "<p><INPUT TYPE=\"BUTTON\" VALUE=\"back\" ONCLICK=\"self.history.back()\">";
}

function htFormEnd() {
	echo "</form>";
}

//here are functions matthew has moved from html.inc-9/01/2002----------------------//
function htMakeListFromSql($sql, $name, $selected) {
	
	echo	"<select name=\"$name\">";
	// Include a blank line
	echo "<option> </option>";
	
	$dbs = new dbSession();
	if ( $res = $dbs->getResult($sql) ) {
		
		while ( $row = $dbs->getRow($res) ) {
			echo	"<option";
			if ( $row[0] == $selected ) {
				echo " selected>";
			} else {
				echo ">";
			}
			echo $row[0] . "</option>";
		}
		
		echo "</select>";
	}
} // END htMakeListFromSql()

function htMakeMultiListFromSql($sql, $name, $selected, $size) {
	
	echo	"<select name=\"$name\" multiple size=\"$size\">";
	// Include a blank line
	echo "<option> </option>";
	
	$dbs = new dbSession();
	if ( $res = $dbs->getResult($sql) ) {
		
		while ( $row = $dbs->getRow($res) ) {
			echo	"<option";
			if ( $row[0] == $selected ) {
				echo " selected>";
			} else {
				echo ">";
			}
			echo $row[0] . "</option>";
		}
		
		echo "</select>";
	}
} // END htMakeMultiListFromSql()

// This does same as above except allows you to define a different value for
// the var than the one that actually appears in the list
function htMakeListFromSqlOptValue($sql, $name, $selected, $listCol, $optValCol) {
	
	echo	"<select name=\"$name\">" .
	"<option> </option>";
	
	$dbs = new dbSession();
	if ( $res = $dbs->getResult($sql) ) {
		
		while ( $row = $dbs->getArray($res) ) {
			$optValue = $row["$optValCol"];
			
			echo	"<option";
			if ( $row[$listCol] == $selected ) {
				echo " value= \"$optValue\" selected>";
			} else {
				echo " value= \"$optValue\">";
			}
			echo $row[$listCol] . "</option>";
		}
		
		echo "</select>";
	}
} // END htMakeListFromSqlOptValue()

// Same but make multi list
function htMakeMultiListFromSqlOptValue($sql, $name, $selected, $size, $listCol, $optValCol) {
	
	echo	"<select name=\"$name\" multiple size=\"$size\">" .
	"<option> </option>";
	
	$dbs = new dbSession();
	if ( $res = $dbs->getResult($sql) ) {
		
		while ( $row = $dbs->getArray($res) ) {
			$optValue = $row["$optValCol"];
			
			echo	"<option";
			if ( $row[$listCol] == $selected ) {
				echo " value= \"$optValue\" selected>";
			} else {
				echo " value= \"$optValue\">";
			}
			echo $row[$listCol] . "</option>";
		}
		
		echo "</select>";
	}
} // END htMakeListFromSqlOptValue()

function htMakeListFromArray($arr, $name, $selected) {
	echo	"<select name=\"$name\">";
	// Include a blank line
	echo "<option> </option>";
	foreach ($arr as $tmp) {
		echo	"<option";
		if ( $tmp == $selected ) {
			echo " selected>";
		} else {
			echo ">";
		}
		echo $tmp . "</option>";
	}
	echo "</select>";
} // END htMakeListFromArray()


function htMakeMultiListFromArray($arr, $name, $selected, $size) {
	echo	"<select name=\"$name\" multiple size=\"$size\">";
	// Include a blank line
	echo "<option> </option>";
	foreach ($arr as $tmp) {
		echo	"<option";
		if ( $tmp == $selected ) {
			echo " selected>";
		} else {
			echo ">";
		}
		echo $tmp . "</option>";
	}
	echo "</select>";
} // END htMakeMultiListFromArray()

// Javascript popup window
// Note: second argument to window.open must NOT have a space
// ie must be same as rules for variable names
function htJavaPopup($funcName, $width, $height) {
	
	echo        "\n\n<script language=\"JavaScript\">\n" .
	"<!-- \n" .
	"function " . $funcName . "(url) { \n" .
	"window.open(url,'Profile','toolbar=no," .
	"scrollbars=no,resizable=yes,width=" . $width .
	",height=" . $height . "') " .
	" } \n" .
	"// END -->\n" .
	"</script>\n\n";
}
// END Form Functions --------------------------------------------------//


// This function will return an image tag with maximum dimensions set correctly
function htDisplayImage($imageFile, $imageUrl, $maxWidth, $maxHeight, $extra) {
	// Get image data
	$imageInfo = getImageSize($imageFile);
	/////////////////////////////////////////////////////////////////
	//echo "<p>Image Info : " . $imageInfo[0] . ", " . $imageInfo[1] .
	//    ", " . $imageInfo[2] . ", " . $imageInfo[3];
	/////////////////////////////////////////////////////////////////
	// Set these values in case no conditions apply
	$imageWidthStr = " width=\"" . $imageInfo[0] . "\" ";
	$imageHeightStr = " height=\"" . $imageInfo[1] . "\" ";
	// If we assign a new value to height or width we have to NOT
	// assign a value to the other one ... else we get stretched images
	if ( $imageInfo[0] > $imageInfo[1] ) { // Wider - set width
	if ( $imageInfo[0] > $maxWidth ) {
		$imageWidthStr = " width=\"" . $maxWidth . "\" ";
		$imageHeightStr = " ";
	}
	} elseif ( $imageInfo[0] <= $imageInfo[1] ) { // Taller - set height
	if ( $imageInfo[1] > $maxHeight ) {
		$imageHeightStr = " height=\"" . $maxHeight . "\" ";
		$imageWidthStr = " ";
	}
	}
	$ht = "<img src=\"" . $imageUrl . "\" " . $imageWidthStr . " " . $imageHeightStr . " " . $extra . ">";
	return $ht;
} // END htDisplayImage()

?>
