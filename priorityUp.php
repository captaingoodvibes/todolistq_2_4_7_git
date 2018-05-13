<?php
//**********************************************************************************************
//******************************************************************************** TITLE - START
/**
*	file:	priorityUp.php
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
include("config/headAndBody001.php");
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
$sql = "SELECT JobPriority FROM `job` WHERE JobPriority > '$JobPriorityUp' AND JobType = '$JobType' AND JobStatus = 'Active' $sqlAdjustment ORDER BY JobPriority DESC";
$Results = $dbs->getResult($sql);
$debugMsg .= "JobPriority = $JobPriorityUp<BR><BR>";
include("config/tpl_bodystart.php");
$list = "0";

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

$list = $list - 1;
$numRows = mysql_numrows($Results);
$debugMsg .= "Number of rows = $numRows<BR>";
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

if ( $priorityList[0] == $JobPriorityUp ) {
	$priorityList[0] = "";
} 
if ( ($priorityList[0] == "") || ($priorityList[0] <= "0")) {
	echo "You can not increase the top priority!<BR>";
}
// This line is checking for the bottom priority
if ( ($priorityList[$list] == $JobPriorityUps) || ($priorityList[$list] <= "0")) {
	echo "You can not decrease the bottom priority!";
}

elseif ( ($priorityList[1] == "") || ($priorityList[1] <= "0")) {
		
	$JobPriorityUp = $priorityList[0] + 1;
        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        global $debugMsg;
        $debugMsg .= "JobPriority = $JobPriorityUp<BR><BR>";
        include("config/tpl_bodystart.php");
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
	// echo "<a href=\"whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Update Priority to $JobPriorityUp</a>";
	echo "<form method=\"post\" action=\"./whiteBoard.php\">";
        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriorityUp . "\">";
        include("log_in_authentication_form_vars.php");
        echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Move to the top priority position.\">";
        echo "</form>";
	
}else{	
	$dbs = new dbSession();
	$sql = "SELECT JobPriority FROM `job` WHERE JobType = '$JobType' AND JobStatus = 'Active' ORDER BY JobPriority ASC";
	// $sql = "SELECT JobPriority FROM `Job` WHERE JobPriority > '$JobPriorityUp' AND JobType = '$JobType' AND JobStatus = 'Active' ORDER BY JobPriority ASC";
	$Results = $dbs->getResult($sql);
	$orderNumber = 0;
	global $debugMsg;
	$debugMsg .= "\$topValue = $topValue<BR>";
	include("config/tpl_bodystart.php");
	if ($priorityList[$topValue]) {
		$JobPriorityUp = $priorityList[0] + 1;
		// echo "<a href=\"whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Move to Priority position 0<!-- $JobPriorityUp --></a>";
		echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriorityUp . "\">";
                include("log_in_authentication_form_vars.php");
                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Move to Priority position 0\">";
                echo "</form>";
	}
	$jobNumberTest = $jobNumber;
	$jobNumber = 0;
		
	if ($jobNumber <= $jobNumberTest) {
		while ( ($row = $dbs->getArray($Results)) ) {
			$priorityArray = $row['JobPriority'];
			$priorityList[] = round($priorityArray, 20);
			$orderNumber2nd = $orderNumber + 1;
			$orderNumberPlusOne = $orderNumber + 1;
			$orderNumber3 = $orderNumber + 3;
			$orderNumberMinusOne = $orderNumber - 1;
			$jobNumberMinusOne = $jobNumber - 1;
				if ($orderNumber > 1) {
				// echo "<BR><a href=\"whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Move to Priority position $jobNumberMinusOne <!-- $orderNumber places to $JobPriorityUp --></a>";
				echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriorityUp . "\">";
                                include("log_in_authentication_form_vars.php");
                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Move to Priority position " . $jobNumberMinusOne . "\">";
                                echo "</form>";
				}
				if ($jobNumber <= $jobNumberTest) {
					$JobPriorityUp = ($priorityList[$orderNumber] + $priorityList[$orderNumber - 1]) / 2;
				}elseif  ($jobNumber > $jobNumberTest) {
					$JobPriorityUp = ($priorityList[$orderNumber] + $priorityList[$orderNumber + 1]) / 2;
				}
			$orderNumber = $orderNumber + 1;
			$jobNumber = $jobNumber + 1;
		}
	} else {
		echo "<BR><BR>Go!!<BR>";
		// This section is for reducing the job priority
		while ( ($row = $dbs->getArray($Results))) {
			$priorityArray = $row['JobPriority'];
			$priorityList[] = round($priorityArray, 20);
			$orderNumber2nd = $orderNumber - 1;
			$JobPriorityUp = ($priorityList[$orderNumber] + $priorityList[$orderNumber + 1]) / 2;
			$orderNumber = $orderNumber + 1;
			$jobNumber = $jobNumber + 1;
			// echo "<a href=\"whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Move to Priority position $jobNumber <!-- $orderNumber places to $JobPriorityUp --></a><BR>";
			echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriorityUp . "\">";
                        include("log_in_authentication_form_vars.php");
                        echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Move to Priority position " . $jobNumber . "\">";
                        echo "</form>";
		}
	}		
}

//*********************************************************************************** MAIN - END
//**********************************************************************************************

include("logged_in_end_of_page.php");

?>
