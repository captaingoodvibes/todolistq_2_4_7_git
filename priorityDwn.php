<?php

//**********************************************************************************************
//******************************************************************************** TITLE - START
/**
*	file:	priorityDwn.php
*	auth:	Dion Patelis (owner)
*	desc;	Handles prioritising jobs up and down the list.
*	date:	15 April 2003 - Dion Patelis
*	last:	Saturday 17th Jan 2015 - Dion Patelis
*/
//********************************************************************************** TITLE - END
//**********************************************************************************************

	
//**********************************************************************************************
//***************************************************************************** INCLUDES - START
include("config/dbSession.class");
include("config/headAndBody001_with_db_name_in_tab.php");
$user_authenticated = $_POST['user_authenticated'];
$login_instance_token = $_POST['login_instance_token'];
$login_name = $_POST['name'];
$login_pass = $_POST['pass'];
$login_UserID = $_POST['UserID'];
include("config/config.php");
include("config/tpl_bodystart.php");
// include("config/dbSession.class");
include("config/standardPageBits.php");
include("log_in_authentication_check.php");
include("config/topIndex002.php");
include("config/ssl.php");
include("config/ht.inc");
include("searchFunctions.php");
include("log_in_authentication_form.php");
include("logged_in_start_of_page.php");
//******************************************************************************* INCLUDES - END
//**********************************************************************************************


//**********************************************************************************************
//****************************************************************************** GLOBALS - START
$JobID = $_POST['JobID'];
$JobPriorityUp = $_POST['JobPriorityUp'];
$JobType = $_POST['JobType'];
$JobToFkUserID = $_POST['JobToFkUserID'];
$JobParent = $_POST['JobParent'];
$jobNumber = $_POST['jobNumber'];
//******************************************************************************** GLOBALS - END
//**********************************************************************************************


//**********************************************************************************************
//****************************************************************** CONNECT TO DATABASE - START
$dbs = new dbSession();
//******************************************************************** CONNECT TO DATABASE - END
//**********************************************************************************************


//**********************************************************************************************
//********************************************************************************* MAIN - START
// This first part of the script is to handle pushing the priority upwards

	if ($CurrentlyLoggedInAs == "") {
		$sqlAdjustment = "";
	}else{
		$sqlAdjustment = "AND JobToFkUserID = \"$CurrentlyLoggedInAs\"";
	}
	// echo "<BR> \$sqlAdjustment = $sqlAdjustment";
	// $sql = "SELECT * from Job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" $sqlAdjustment ORDER BY JobPriority DESC"; 
// $sql = "SELECT JobPriority FROM `job`";	

//$sql = "SELECT JobPriority FROM `job` WHERE JobPriority > '$JobPriorityUp' AND JobType = '$JobType' AND JobStatus = 'Active' $sqlAdjustment ORDER BY JobPriority DESC";
$sql = "SELECT JobPriority FROM job WHERE JobPriority <= '$JobPriorityUp' AND JobType = '$JobType' AND JobParent = '$JobParent' AND JobStatus = 'Active' ORDER BY JobPriority DESC LIMIT 0,30";

// $sql = "SELECT JobPriority FROM `Job` WHERE JobPriority > '$JobPriorityUp' AND JobType = '$JobType' AND JobStatus = 'Active' $sqlAdjustment ORDER BY JobPriority DESC";

// echo "<BR> \$sql = $sql";

$Results = $dbs->getResult($sql);

$debugMsg .= "JobPriority = $JobPriorityUp<BR><BR>";
include("config/tpl_bodystart.php");

$list = "0";

$numRows = mysql_num_rows($Results);

$debugMsg .= "Number of rows above loop = $numRows<BR>";
include("config/tpl_bodystart.php");

while ($row = $dbs->getArray($Results)) {
	
	$priorityArray = $row['JobPriority'];
	$debugMsg .= "In loop \$priorityArray[$list] = " . round($priorityArray, 20) . "<BR>";
	include("config/tpl_bodystart.php");
	$priorityList[] = round($priorityArray, 20);
	$list = $list + 1;
	
}

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$debug = $_POST['debug'];
$debugMsg .= "JobPriorityUp = $JobPriorityUp<BR><BR>";
$debugMsg .= "JobType = $JobType<BR>";
$debugMsg .= "\$sql = $sql<BR>";
$debugMsg .= "\$Results = $Results<BR>";
$debugMsg .= "\$row = $row<BR>";
include("config/debug.php");
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************

//**********************************************************************************************
//******************************************************************** MAY NOT NEED THIS - START
$list = $list - 1;
//********************************************************************** MAY NOT NEED THIS - END
//**********************************************************************************************

//echo "\$list = $list tickle <BR>"; 
//echo "\$priorityList[$list] ="  . round($priorityArray, 20) . " tickleo <BR>";

//echo "\$priorityList[$list] = $priorityList[$list] tickleos <BR>";

// $row = $dbs->getArray($Results);

// $JobPriorityUp = $row['JobPriority'];

//$numRows = mysql_num_rows($Results);

$debugMsg .= "Number of rows below loop = $numRows<BR>";
include("config/tpl_bodystart.php");

$topValue = $numRows - 1;


include("config/tpl_bodystart.php");

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$debug = $_POST['debug'];
$debugMsg .= "Top value = $topValue<BR>";
$debugMsg .= "\$priorityList = $priorityList<BR>";
$debugMsg .= "\$priorityList0 = " . $priorityList[0] . "<BR>";
$debugMsg .= "\$priorityList1 = " . $priorityList[1] . "<BR>";
include("config/debug.php");
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************
$list_number_a = 0;
$list_number_b = 1;

while ($numRows >= 1) {
$list_number_a = $list_number_a + 1;
$list_number_b = $list_number_b + 1;
$pr1 = $priorityList[$list_number_a];
$pr2 = $priorityList[$list_number_b];
$pr2ndFromBottom = $priorityList[1];

	if ( ($priorityList[$list_number_a] == "") || ($priorityList[$list_number_a] == "0") ) {
		
		echo "You can not decrease the bottom priority!";

	}elseif( ($priorityList[$list_number_b] == "") || ($priorityList[$list_number_b] =="0")) {
		global $debug;
	  	$debugMsg .= "\$pr2ndFromBottom = $pr2ndFromBottom<BR>";
		$debugMsg .= "\$pr2 = " . $pr2 . "<BR>";
		include("config/tpl_bodystart.php");
		$JobPriorityUp = $pr2ndFromBottom / 2;
		$debugMsg .= "JobPriority = $JobPriorityUp<BR><BR>";
		include("config/tpl_bodystart.php");
		$jobNumber = $jobNumber + 1;
		// echo "<a href=\"whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Move to Priority position $jobNumber <!-- $JobPriorityUp --></a><BR>";
		echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriorityUp . "\">";
                include("log_in_authentication_form_vars.php");
                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Move to Priority position " . $jobNumber . "\">";
                echo "</form>";
	}else{
	  	global $debug;
	  	$debugMsg .= "\$pr1 = " . $pr1 . "<BR>";
		$debugMsg .= "\$pr2 = " . $pr2 . "<BR>";
		include("config/tpl_bodystart.php");
		$JobPriorityUp = ($pr1 + $pr2) / 2;
		$debugMsg .= "JobPriority = $JobPriorityUp<BR><BR>";
		include("config/tpl_bodystart.php");
		$jobNumber = $jobNumber + 1;
		// echo "<a href=\"whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Move to Priority position $jobNumber <!-- $JobPriorityUp --></a><BR>";
		echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriorityUp . "\">";
                include("log_in_authentication_form_vars.php");
                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Move to Priority position " . $jobNumber . "\">";
                echo "</form>";
	}
$numRows = $numRows - 1;
}

//*********************************************************************************** MAIN - END
//**********************************************************************************************

include("logged_in_end_of_page.php");

?>
