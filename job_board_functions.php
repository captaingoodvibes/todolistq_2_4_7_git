<?PHP 
function job_complete() {
        echo "herey <BR>";
	$JobID = $_POST['JobID'];
	$UserID = $_POST['UserID'];
	$ClientID = $_POST['ClientID'];
	$JobTitle = addslashes($_POST['JobTitle']);
	$StartTime = time();
	//**********************************************************************************************
	//***************************************************************** DEBUG VARIABLES HERE - START
	$turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {	
		$debug = $_POST['debug'];
		$debugMsg .= "In the function job_complete on the whiteboard the \$JobID = $JobID<BR>";
		include("config/debug.php");
	}
	//******************************************************************* DEBUG VARIABLES HERE - END
	//**********************************************************************************************
	$update_job = new child;
	$update_job->job_complete($JobID);
	$jobStatus = $update_job->jobStatus;
	
	$update_action_job_complete = new child;
	$update_action_job_complete->make_action_saying_the_job_is_complete($JobID, $ClientID, $UserID, $JobTitle, $StartTime);
	$action_status = $update_action_job_complete->action_status;
	echo "<DIV align=\"center\" ><FONT SIZE=\"4\" COLOR=\"#009933\">$jobStatus $action_status</FONT></DIV>";
	echo "<form method=\"post\" action=\"./index.php\">";
	echo "<BR><BR> Back to the <BR>";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_board\">";
        include ("log_in_authentication_form_vars.php");
        echo "<input class=\"top_buttons\"  type=\"submit\" name=\"action\" value=\"Job Board\">";
        echo "</form>";
}

function priority_down() {
//**********************************************************************************************
//************************************************************************* PRIORITY_DOWN - START
// This first part of the script is to handle pushing the priority downwards.
$JobID = $_POST['JobID'];
$JobPriorityUp = $_POST['JobPriorityUp'];
$JobType = $_POST['JobType'];
$JobToFkUserID = $_POST['JobToFkUserID'];
$JobParent = $_POST['JobParent'];
$jobNumber = $_POST['jobNumber'];

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
$dbs = new dbSession();
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
		// echo "<a href=\"index.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Move to Priority position $jobNumber <!-- $JobPriorityUp --></a><BR>";
		echo "<form method=\"post\" action=\"./index.php\">";
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
		// echo "<a href=\"index.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Move to Priority position $jobNumber <!-- $JobPriorityUp --></a><BR>";
		echo "<form method=\"post\" action=\"./index.php\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriorityUp . "\">";
                include("log_in_authentication_form_vars.php");
                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Move to Priority position " . $jobNumber . "\">";
                echo "</form>";
	}
$numRows = $numRows - 1;
}
//************************************************************************** PRIORITY_DOWN - END
//**********************************************************************************************
}

function priority_up() {
//**********************************************************************************************
//************************************************************************* PRIORITY_UP  - START
// This first part of the script is to handle pushing the priority upwards
$JobID = $_POST['JobID'];
$JobPriorityUp = $_POST['JobPriorityUp'];
$JobType = $_POST['JobType'];
$JobToFkUserID = $_POST['JobToFkUserID'];
$jobNumber = $_POST['jobNumber'];

if ($CurrentlyLoggedInAs == "") {
        $sqlAdjustment = "";
}else{
        $sqlAdjustment = "AND JobToFkUserID = \"$CurrentlyLoggedInAs\"";
}

$sql = "SELECT JobPriority FROM `job` WHERE JobPriority > '$JobPriorityUp' AND JobType = '$JobType' AND JobStatus = 'Active' $sqlAdjustment ORDER BY JobPriority DESC";
$dbs = new dbSession();
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
	// echo "<a href=\"index.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Update Priority to $JobPriorityUp</a>";
	echo "<form method=\"post\" action=\"./index.php\">";
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
		// echo "<a href=\"index.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Move to Priority position 0<!-- $JobPriorityUp --></a>";
		echo "<form method=\"post\" action=\"./index.php\">";
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
				// echo "<BR><a href=\"index.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Move to Priority position $jobNumberMinusOne <!-- $orderNumber places to $JobPriorityUp --></a>";
				echo "<form method=\"post\" action=\"./index.php\">";
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
			// echo "<a href=\"index.php?JobID=$JobID&JobPriorityUp=$JobPriorityUp\">Move to Priority position $jobNumber <!-- $orderNumber places to $JobPriorityUp --></a><BR>";
			echo "<form method=\"post\" action=\"./index.php\">";
                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriorityUp . "\">";
                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_board\">";
                        include("log_in_authentication_form_vars.php");
                        echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Move to Priority position " . $jobNumber . "\">";
                        echo "</form>";
		}
	}		
}

//**************************************************************************** PRIORITY_UP - END
//**********************************************************************************************
}
function job_board() {
	$CurrentlyLoggedInAs = $_POST['CurrentlyLoggedInAs'];
	$CurrentlyLoggedInAsName = $_POST['CurrentlyLoggedInAsName'];
	
	$job_tree = $_POST['job_tree'];
	// $job_tree = "";
	if (empty($job_tree)) {
		// echo "The job tree is empty.<BR>";
		$job_tree = 0;
	}
	// $CurrentlyLoggedInAs = 1;
	echo "<DIV align=\"center\">";
	/**
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "Show jobs for ";
	echo "<SELECT name=\"CurrentlyLoggedInAs\">";
			
				
		if (empty($JobFromFkUserID)) {
			$JobFromFkUserID = 1;
		}
	
	
	echo "<OPTION value=\"$JobFromFkUserID\">$FromUserFirstname";
	echo "<OPTION value=\"\">Everyone";
	
		$dbs = new dbSession();
		$sql = "SELECT UserFirstname, UserID from user";
		$Results = $dbs->getResult($sql);
	
		while ($row = $dbs->getArray($Results)) {
			// $optValue = $row['UserID'];				
			echo "<OPTION value=\"$row[UserID]\">$row[UserFirstname]";
		}
	echo "</SELECT>";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	//echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"DeleteCardQuestion\">";
	//echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
	echo "<input type=\"submit\" tabindex=\"19\" name=\"Submit\" value=\"Go\">";
	echo "</form>";
	*/


	// echo "<BR> \$CurrentlyLoggedInAs = $CurrentlyLoggedInAs";
	// echo "<BR> \$CurrentlyLoggedInAsName = $CurrentlyLoggedInAsName";
	echo "<DIV align=\"center\">";
	
	//include("config/class_detect.php");
	$box_vars = new detect;
	$box_vars->my_box();
	$mybox_width = $box_vars->mybox_width;
	$job_board_col_1 = $box_vars->job_board_col_1;
	$job_board_User = $box_vars->job_board_User;
	$job_board_Priority = $box_vars->job_board_Priority;
	$job_board_Client = $box_vars->job_board_Client;
	$job_board_job_title = $box_vars->job_board_job_title;
	$job_board_JID = $box_vars->job_board_JID;
	$cols_for_textarea = $box_vars->cols_for_textarea;
	$job_title_length_divisor = $box_vars->job_title_length_divisor;
	
	
	
	echo "<B><H3>Task / Job List</H3></B>";
	$dbs = new dbSession();
	if ($CurrentlyLoggedInAs == "") {
		$sqlAdjustment = "";
	}else{
		$sqlAdjustment = "AND JobToFkUserID = \"$CurrentlyLoggedInAs\"";
	}
	// echo "<BR> \$sqlAdjustment = $sqlAdjustment";
	$sql = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" $sqlAdjustment ORDER BY JobPriority DESC";
	// echo "<BR> \$sql = $sql";
	
	$Results = $dbs->getResult($sql);
	
	$aColor = 1;
	        echo "<div class=\"row\">";
                        ?>
                        <div class="four columns" style="margin-top: 1%; ">
                        <?PHP
                        
                        echo "<TABLE border=\"0\" width=\"100%\">";
                                echo "<TR class=\"hide_under_400\">";
                                        echo "<TD bgcolor=\"#FFFFFF\" width=\"20%\" style=\"word-wrap: break-word; text-align: center;\"><B>For</B></TD>";
                                        echo "<TD bgcolor=\"#FFFFFF\" width=\"50%\" style=\"word-wrap: break-word; text-align: center;\"><B>Priority</B></TD>";
                                        echo "<TD bgcolor=\"#FFFFFF\" width=\"30%\" style=\"word-wrap: break-word; text-align: center;\"><B>Client</B></TD>";
                                        
                                echo "</TR class=\"hide_under_400\">";
                        echo "</TABLE>";
                        ?>
                        </div>
                        <div class="four columns" style="margin-top: 1%;">
                        <?PHP
                        echo "<TABLE border=\"0\">";
                                echo "<TR class=\"hide_under_400\">";	                                
                                        echo "<TD bgcolor=\"#FFFFFF\" width=\"10%\" style=\"word-wrap: break-word; text-align: center;\"><B>Job Title</B></TD>";
                                echo "</TR class=\"hide_under_400\">";
                        echo "</TABLE>";
                        ?>
                        </div>
                        <div class="four columns" style="margin-top: 1%;">
                        <?PHP
                        echo "<TABLE border=\"0\">";
                                echo "<TR class=\"hide_under_400\">";	                                
                                        echo "<TD bgcolor=\"#FFFFFF\" width=\"10%\" style=\"word-wrap: break-word; text-align: center;\" title=\"Job IDentification Number.\"><B>JID</B></TD>";
                                echo "</TR class=\"hide_under_400\">";
                        echo "</TABLE>";
                        ?>
                        </div>
                </div>
                <?PHP
	// echo "<TABLE>";
	$jobNumber = 0;	
	while ($row = $dbs->getArray($Results)) {
			//This $jobNumber variable will need to be put back below this line instead of line 213 and line 
			// 152  removed : $jobNumber = 0;
			// And line 144 in priorityUp.php to go back to $jobNumber = 1;


			
			// $jobNumber = $jobNumber + 1;
			$JobParent = $row['JobParent'];
			$JobChild = $row['JobChild'];
			$JobBranch = $row['JobBranch'];
			$JobTitle = $row['JobTitle'];
			$_POST['JobTitle'] = $JobTitle;
			$JobID = $row['JobID'];
			$JobFkClientID = $row['JobFkClientID'];
			$_POST['JobID'] = $JobID;
			$JobCardNumber = $row['JobCardNumber'];
			$JobPriority = $row['JobPriority'];
			$JobImpUrg = $row['JobImpUrg'];
			$JobStatus = $row['JobStatus'];
			$JobType = $row['JobType'];
			$JobToFkUserID = $row['JobToFkUserID'];
			$dbsClientName = new dbSession();
			$sql = "SELECT ClientName from client WHERE ClientID = \"$JobFkClientID\" LIMIT 1";
			$ResultsClient = $dbs->getResult($sql);
			$rowClient = $dbs->getArray($ResultsClient);
			$clientName = $rowClient['ClientName'];		
			
			switch ($JobImpUrg) {
				case "0";
					$color_imp_urg_A = "#4775D1";
					$color_imp_urg_B = "#4775D1";
					$color_imp_urg_C = "#4775D1";
					$color_imp_urg_D = "#4775D1";
					break;
				case "A";
					$color_imp_urg_A = "#FF5050";
					$color_imp_urg_B = "#4775D1";
					$color_imp_urg_C = "#4775D1";
					$color_imp_urg_D = "#4775D1";
					break;
				case "B";
					$color_imp_urg_A = "#4775D1";
					$color_imp_urg_B = "#FF9933";
					$color_imp_urg_C = "#4775D1";
					$color_imp_urg_D = "#4775D1";
					break;
				case "C";
					$color_imp_urg_A = "#4775D1";
					$color_imp_urg_B = "#4775D1";
					$color_imp_urg_C = "#FFBD7D";
					$color_imp_urg_D = "#4775D1";
					break;
				case "D";
					$color_imp_urg_A = "#4775D1";
					$color_imp_urg_B = "#4775D1";
					$color_imp_urg_C = "#4775D1";
					$color_imp_urg_D = "#FFFF00";
					break;
			}
		
		echo "<div class=\"row\" class=\"hide_under_400\">";
                        ?>
                        <div class="four columns" style="margin-top: 1%; ">
                        <?PHP
                        
                        ?>
                        </div>
                        <div class="four columns" style="margin-top: 1%;">
                        <?PHP
                        
                        ?>
                        </div>
                        <div class="four columns" style="margin-top: 1%;">
                        <?PHP
                        
                        ?>
                        </div>
                </div>
                <?PHP	
                
		if (empty($JobParent)) {
		if ($aColor == 1) {
			$aColor = 0;
			$setColor = "#99ccff";
		}
		else {
			$aColor = 1;
			$setColor = "#99ccff";
		}
		// echo "<TR>";
		if ($JobChild == 1) {
			$setColor = "#99ccff";
			$aColor = 1;
		}
		echo "<div class=\"row\" class=\"hide_under_400\" style=\"background-color: $setColor;\">";
                        ?>
                        <div class="four columns" style="margin-top: 1%; ">
                        <?PHP
			        echo "<TABLE border=\"0\">";
			                echo "<TR>";
			                        //********************************************************************			
			                        //************************************************ BRANCH MAIN - START
			                        //if (empty($job_tree)) {
			                        //$job_tree = 0;
			                        //}
			                        $job_tree = $_POST['job_tree'];
			                        // echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"3%\" colspan=\"2\">";
			                        //********************************************************************			
                                                //********************** CHECK TO SEE IF THIS JOB HAS CHILDREN - START
                                                //echo "\$JobID = $JobID<BR>";
                                                $JobChild = 0;
                                                $dbs_find_children = new dbSession();
                                                $sql_find_children = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" AND JobParent = \"$JobID\" ORDER BY JobPriority DESC";
                                                $Results_find_children = $dbs_find_children->getResult($sql_find_children);
                                                while ($row_find_children = $dbs_find_children->getArray($Results_find_children)) {
                                                        $JobChild = 1; 
                                                }
		                                // echo "\$JC - \$JID  = $JobChild - $JobID <BR>";
                                                //************************ CHECK TO SEE IF THIS JOB HAS CHILDREN - END
                                                //********************************************************************
			                        // echo " \$job_tree == $job_tree<BR>";
			                        // echo "\$JobBranch - \$JID = $JobBranch - $JobID<BR>";
			                        if ($JobBranch == 0 && $JobStatus == "Active") {
			                                
				                        if ($JobChild == 1 ) {
				                                
					                        echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"20%\">";
					                        /**
					                        echo "
					                        <a href='index.php?JobID=$JobID&JobPriorityUp=$JobPriority&JobType=$JobType&JobToFkUserID
					                        = $CurrentlyLoggedInAs&jobNumber=$jobNumber&job_tree=1&OptionCatch=branch'><img src=\"images/plus.png\" height=\"10\" width=\"9\" border=\"0\" title=\"Expand Branch\"></a>  $UserFirstname";
					                        */
				                                echo "<form method=\"post\" action=\"./index.php\">";
                                                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                                                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                                                                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                                                                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                                                                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                                                                echo "<input type=\"hidden\" name=\"job_tree\" value=\"1\">";
                                                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                                                                include("log_in_authentication_form_vars.php");
                                                                // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                                                                echo "<input class=\"inputA\" type=\"image\" src=\"images/plus.png\" width=\"40\" height=\"40\" title=\"Expand branch.\"  name=\"action\" value=\"CBM\">";
                                                                // echo "$UserFirstname</form>";
                                                                user_button($JobToFkUserID);
					                        $job_tree = 0;
				                        } else {
					                        echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"20%\">$UserFirstname";
				                                user_button($JobToFkUserID);
				                        }
				
			                        } elseif ($JobBranch == 1 && $JobStatus == "Active") {
				                        if ($JobChild == 1) {
					                        echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"20%\" >";
					                        // echo "<a href='index.php?JobID=$JobID&JobPriorityUp=$JobPriority&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber&job_tree=0&OptionCatch=branch'><img src=\"images/minus.png\" height=\"10\" width=\"9\" border=\"0\" title=\"Collapse Branch\"></a>  ";
				                                // echo "<form method=\"post\" action=\"./WhiteBoard.php\">";
                                                                /** echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                                                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                                                                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                                                                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                                                                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                                                                echo "<input type=\"hidden\" name=\"job_tree\" value=\"0\">";
                                                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">"; */
                                                                // include("log_in_authentication_form_vars.php");
                                                                //echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"\">";
                                                                // echo "<input class=\"inputA\" type=\"image\" src=\"images/minus.png\" title=\"Collapse branch.\" name=\"action\" value=\"CBM\">minus</input>";
                                                                // echo "</form>";
                                                                
                                                                echo "<form method=\"post\" action=\"./index.php\">";
				                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
				                                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
				                                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
				                                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
				                                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
				                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
				                                echo "<input type=\"hidden\" name=\"job_tree\" value=\"0\">";
                                                                include("log_in_authentication_form_vars.php");
                                                                echo "<input class=\"inputA\" type=\"image\" src=\"./images/minus.png\" width=\"40\" height=\"40\" title=\"Collapse this branch.\" name=\"action\" value=\"CBM\">";
                                                                echo "</form>";
                                                                user_button($JobToFkUserID);
					                        $job_tree = 1;
				                        } else {
					                        echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"20%\">$UserFirstname";
					                        user_button($JobToFkUserID);
				                        }
			                        } else {
				                        $job_tree = 0;
			                        }
			                        echo "</TD>";
					
			                        //************************************************** BRANCH MAIN - END
			                        //********************************************************************	
			
			                        echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"50%\">";
			                        //echo "<a href='priorityUp.php?JobID=$JobID&JobPriorityUp=$JobPriority&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber' class=\"linkPlainInWhiteAreas\"> </a>";
                                                echo "$jobNumber";
				                                echo "<form method=\"post\" action=\"./index.php\">";
				                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
				                                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
				                                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
				                                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
				                                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
				                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"priority_up\">";
                                                                include("log_in_authentication_form_vars.php");
                                                                echo "<input class=\"inputA\" type=\"image\" src=\"./images/up_pointer.png\" width=\"40\" height=\"40\" title=\"Raise the priority of this job.\" name=\"action\" value=\"\">";
                                                                echo "</form>";
				
			                                        // echo "	<img src=\"images/up_pointer.png\" height=\"10\" width=\"12\" border=\"0\">";
			                                        /** echo "	<a href='priorityDwn.php?JobID=$JobID&JobPriorityUp=$JobPriority&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber'>
				                                <img src=\"images/down_pointer.png\" height=\"10\" width=\"12\" border=\"0\">
				                                </a>"; 
				                                */
		                                                echo "<form method=\"post\" action=\"./index.php\">";
		                                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
		                                                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
		                                                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
		                                                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
		                                                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
		                                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"priority_down\">";
                                                                include("log_in_authentication_form_vars.php");
                                                                echo "<input type=\"image\" src=\"./images/down_pointer.png\" width=\"40\" height=\"40\" title=\"Lower the priority of this job.\" name=\"action\" value=\"\">";
                                                                echo "</form>";
				
				
			                        include("index_imp_urg_matrix.php");
				
			                        echo "	</TD>";
			
			                        $job_title_length = strlen($JobTitle);
			                        $rows_for_textarea = $job_title_length / $job_title_length_divisor;
			                        $rows_for_textarea = floor($rows_for_textarea);
			                        if ($rows_for_textarea < 1) {
				                        $rows_for_textarea = 1;
			                        }
			                        echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"30%\">";
			                        if (empty($JobFkClientID)) {
			                        }else{
                                                        client_button($JobFkClientID,$clientName);
                                                }
                                                echo "</TD>";
                                        echo "</TR>";
                                echo "</TABLE>";
                        ?>
                        </div>
                        <div class="four columns" style="margin-top: 1%;">
                        <?PHP
			        // echo "<TD bgcolor=\"$setColor\"><pre>$JobTitle </pre></TD>";
			        // echo "<TD bgcolor=\"$setColor\"><font face=\"arial\" size=\"3\"><pre><TEXTAREA rows=\"5\" cols=\"57\" name=\"ActionText\">" . wordwrap($JobTitle, 63, "<br>", true) . "</TEXTAREA></pre></font></TD>";
			        // echo "<TD bgcolor=\"$setColor\"><font face=\"arial\" size=\"3\"><pre><TEXTAREA rows=\"$rows_for_textarea\" cols=\"$cols_for_textarea\" name=\"ActionText\">$JobTitle</TEXTAREA></pre></font></TD>";
			        // echo "<TD bgcolor=\"$setColor\"><font face=\"arial\" size=\"3\"><pre>$JobTitle</pre></font></TD>";
			        // echo "<TD bgcolor=\"$setColor\"><font face=\"arial\" size=\"3\">";
			        echo "<div style=\"white-space: pre-wrap;\">$JobTitle</div></font>";
                                // echo "</TD>";
			        // echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
			
			        //echo "<a class=\"linkPlainInWhiteAreas\" href=\"JobDetails.php?JobID=$JobID&id=$JobFkClientID&JobCardNumber=$JobCardNumber\">$JobID-$JobCardNumber</a><BR><BR>";
			?>
                        </div>
                        <div class="four columns" style="margin-top: 1%;">
                        <?PHP
			        // echo "\$JobFkClientID = $JobFkClientID";
			        job_button($JobID,$JobFkClientID,$JobCardNumber);
			        // echo "<a href=\"./addJob3.php?OptionCatch=AddJob&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID&JobID=$JobID&JobParent=$JobID\"><img src=\"images/child2.gif\" width=\"20\" height=\"20\" title=\"Add child Job\"></img></a>";
			        echo "<form method=\"post\" action=\"./index.php\">";
			        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_job\">";
			        echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
			        echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
			        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID . "\">";
			        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
                                include("log_in_authentication_form_vars.php");
                                echo "<input type=\"image\" src=\"./images/child2.gif\" width=\"40\" height=\"40\" title=\"Add child Job\" name=\"action\">";
                                echo "</form>";
			        // echo "<a href=\"./index.php?OptionCatch=job_complete&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID&JobID=$JobID&JobParent=$JobID\"><img src=\"images/tick.gif\" width=\"20\" height=\"20\" title=\"Job Complete\"></img></a>";
			        echo "<form method=\"post\" action=\"./index.php\">";
			        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_complete\">";
			        echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
			        echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
			        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID . "\">";
			        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
                                echo "<input type=\"hidden\" name=\"JobTitle\" value=\"" . $JobTitle . "\">";
                                include("log_in_authentication_form_vars.php");
                                echo "<input class=\"inputA\" type=\"image\" src=\"./images/tick.gif\" width=\"40\" height=\"40\" title=\"Complete this job.\" name=\"action\" value=\"\">";
                                echo "</form>";
			        //echo "</TD>";
			
			        // echo "</TR>";
			?>
                        </div>
                </div>
                        <?PHP
			if ($JobChild == 1 && $job_tree == 1) {
				cascade_job();
			}

			$jobNumber = $jobNumber + 1;
	     
		}
	}	
	
	// echo "</TABLE>";
	echo "</DIV>";
	        	
// include("logged_in_end_of_page.php");
}
function cascade_job() {
//**********************************************************************************************
//**************************************************************************** CASCADE 2 - START		
			$JobID = $_POST['JobID'];
			$job_tree = $_POST['job_tree'];
			
			$x = $_POST['JobID'];
			
				//include("config/class_detect.php");
			$box_vars = new detect;
			$box_vars->my_box();
			$mybox_width = $box_vars->mybox_width;
			$job_board_col_1 = $box_vars->job_board_col_1;
			$job_board_User = $box_vars->job_board_User;
			$job_board_Priority = $box_vars->job_board_Priority;
			$job_board_Client = $box_vars->job_board_Client;
			$job_board_job_title = $box_vars->job_board_job_title;
			$job_board_JID = $box_vars->job_board_JID;
			$cols_for_textarea = $box_vars->cols_for_textarea;
			$branch_spacer_total_from_class = $box_vars->branch_spacer_total_from_class;
			$branch_increment_from_class = $box_vars->branch_increment_from_class;
			$job_title_length_divisor = $box_vars->job_title_length_divisor;
			// echo "<BR>\$x in cascade 2 = $x";
			
			
			//$job_tree = "";
			if (empty($job_tree)) {
				//echo "<BR> The job tree in cascade 2 is empty.<BR>";
				$job_tree = 0;
			}
			// echo "<BR>\$job_ID in the beginning of cascade 2 = $Job_ID<BR>";
			//echo "\$job_tree = $job_tree";
			echo "<TR height=\"\">";
			echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"7\">";
			
			
			
//***********************************			
//********************** here 2	START

			$dbs2 = new dbSession();
			if ($CurrentlyLoggedInAs == "") {
				$sqlAdjustment = "";
			}else{
				$sqlAdjustment = "AND JobToFkUserID = \"$CurrentlyLoggedInAs\"";
			}
			// echo "<BR> \$sqlAdjustment = $sqlAdjustment";
			
			$sql2 = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" AND JobParent = $JobID $sqlAdjustment ORDER BY JobPriority DESC";
			// echo "<BR> \$sql = $sql";
	
			$Results2 = $dbs2->getResult($sql2);
	
			$aColor = 1;
			
			$branch_spacer_total = $_POST['branch_spacer_total'];
			if ($branch_spacer_total < $branch_spacer_total_from_class) {
				$branch_spacer_total = $branch_spacer_total_from_class;
			}
			
			echo "<TABLE>";
			
			echo "<TR>";
			//echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" colspan=\"7\" width=\"684\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"\"><img src=\"images/spacer.gif\" width=\"$branch_spacer_total\" height=\"1\" title=\"\"></TD>";
			
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_User\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_Priority\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_Client\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_job_title\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_JID\"></TD>";
			
			echo "</TR>";
			
			
			$jobNumber2 = 0;	
				while ($row2 = $dbs2->getArray($Results2)) {
			


						//This $jobNumber2 variable will need to be put back below this line instead of line 213 and line 
						// 152  removed : $jobNumber2 = 0;
						// And line 144 in priorityUp.php to go back to $jobNumber2 = 1;


			
						// $jobNumber2 = $jobNumber2 + 1;

						$JobParent = $row2['JobParent'];
						$JobChild = $row2['JobChild'];
						$JobBranch = $row2['JobBranch'];
						$JobTitle = $row2['JobTitle'];
						$JobID = $row2['JobID'];
						//echo "\$JobID i hope 2 == $JobID<BR>";
						$JobID2 = $row2['JobID'];
						$_POST['JobID2'] = $JobID2;
						$JobFkClientID2 = $row2['JobFkClientID'];
						$JobCardNumber = $row2['JobCardNumber'];
						$JobPriority2 = $row2['JobPriority'];
						$JobImpUrg = $row2['JobImpUrg'];
						$JobStatus = $row2['JobStatus'];
						$JobType = $row2['JobType'];
			
						$JobToFkUserID = $row2['JobToFkUserID'];
						$dbs2UserFirstName = new dbSession();
						$sql2 = "SELECT UserFirstname from user WHERE UserID = \"$JobToFkUserID\" LIMIT 1";
						$Results2User = $dbs2->getResult($sql2);
						$row2User = $dbs2->getArray($Results2User);
						$UserFirstname = $row2User['UserFirstname'];			
			
						$JobFkClientID = $row2['JobFkClientID'];
						$dbs2ClientName = new dbSession();
						$sql2 = "SELECT ClientName from client WHERE ClientID = \"$JobFkClientID\" LIMIT 1";
						$Results2Client = $dbs2->getResult($sql2);
						$row2Client = $dbs2->getArray($Results2Client);
						$clientName = $row2Client['ClientName'];				
			
			

						if ($aColor == 1) {
							$aColor = 0;
							$setColor2 = "#B8B8FF";
						}
						else {
							$aColor = 1;
							$setColor2 = "#B8B8FF";
						}
			
			
			
						switch ($JobImpUrg) {
							case "0";
								$color_imp_urg_A = "#4775D1";
								$color_imp_urg_B = "#4775D1";
								$color_imp_urg_C = "#4775D1";
								$color_imp_urg_D = "#4775D1";
								break;
							case "A";
								$color_imp_urg_A = "#FF5050";
								$color_imp_urg_B = "#4775D1";
								$color_imp_urg_C = "#4775D1";
								$color_imp_urg_D = "#4775D1";
								break;
							case "B";
								$color_imp_urg_A = "#4775D1";
								$color_imp_urg_B = "#FF9933";
								$color_imp_urg_C = "#4775D1";
								$color_imp_urg_D = "#4775D1";
								break;
							case "C";
								$color_imp_urg_A = "#4775D1";
								$color_imp_urg_B = "#4775D1";
								$color_imp_urg_C = "#FFBD7D";
								$color_imp_urg_D = "#4775D1";
								break;
							case "D";
								$color_imp_urg_A = "#4775D1";
								$color_imp_urg_B = "#4775D1";
								$color_imp_urg_C = "#4775D1";
								$color_imp_urg_D = "#FFFF00";
								break;
						}
						echo "<div class=\"row\" class=\"hide_under_400\">";
                                                        ?>
                                                        <div class="four columns" style="margin-top: 1%; ">
                                                        <?PHP
                                                        
                                                        ?>
                                                        </div>
                                                        <div class="four columns" style="margin-top: 1%;">
                                                        <?PHP
                                                        
                                                        ?>
                                                        </div>
                                                        <div class="four columns" style="margin-top: 1%;">
                                                        <?PHP
                                                        
                                                        ?>
                                                        </div>
                                                </div>
                                                <?PHP
						// In cascade 2
						//echo "<BR>\$brt2 nxt = $branch_spacer_total";
						echo "<TR>";
						echo "<TD></TD>";
						echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"2\">";
						//********************************************************************			
                                                //********************** CHECK TO SEE IF THIS JOB HAS CHILDREN - START
                                                //echo "\$JobID = $JobID<BR>";
                                                $JobChild = 0;
                                                $dbs_find_children = new dbSession();
                                                $sql_find_children = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" AND JobParent = \"$JobID\" ORDER BY JobPriority DESC";
                                                $Results_find_children = $dbs_find_children->getResult($sql_find_children);
                                                while ($row_find_children = $dbs_find_children->getArray($Results_find_children)) {
                                                        $JobChild = 1; 
                                                }
		                                //echo "\$JC = $JobChild<BR>";
                                                //************************ CHECK TO SEE IF THIS JOB HAS CHILDREN - END
                                                //********************************************************************
							if ($JobChild == 1) {
								$setColor2 = "#B8B8FF";
								$aColor = 0;
							}
							//********************************************************************			
							//*************************************************** BRANCH 2 - START
							//if (empty($job_tree)) {
							//$job_tree = 0;
							//}
							$job_tree = $_POST['job_tree'];
			
							// echo " \$job_tree == $job_tree<BR>";
							if ($JobBranch == 0 ) {
								if ($JobChild == 1 ) {
									//echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"2\">";
									/** echo "<a href='index.php?JobID=$JobID&JobPriorityUp=$JobPriority2&JobType=$JobType&JobToFkUserID
									= $CurrentlyLoggedInAs&jobNumber=$jobNumber2&job_tree=1&OptionCatch=branch'><img src=\"images/plus.png\" height=\"10\" width=\"9\" border=\"0\" title=\"Expand Branch\"></a>  $UserFirstname"; */
									$job_tree = 0;
									echo "<form method=\"post\" action=\"./index.php\">";
                                                                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority2 . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                                                                        echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                                                                        echo "<input type=\"hidden\" name=\"job_tree\" value=\"1\">";
                                                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                                                                        include("log_in_authentication_form_vars.php");
                                                                        // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                                                                        echo "<input class=\"inputA\" type=\"image\" src=\"images/plus.png\" title=\"Expand branch.\" name=\"action\" value=\"CBM\">";
                                                                        echo "</form>";
                                                                        user_button($JobToFkUserID);
				                                        //echo "</TD>";
					
								} else {
									//echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"2\">";
									user_button($JobToFkUserID);
									//echo "</TD>";
								}
							} elseif ($JobBranch == 1) {
								if ($JobChild == 1 ) {
									//echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"2\">";
									/** echo "<a href='index.php?JobID=$JobID&JobPriorityUp=$JobPriority2&JobType=$JobType&JobToFkUserID
									= $CurrentlyLoggedInAs&jobNumber=$jobNumber2&job_tree=0&OptionCatch=branch'>
									<img src=\"images/minus.png\" title=\"Collapse branch.\" height=\"10\" width=\"9\" border=\"0\" title=\"Collapse Branch\">
									</a>  $UserFirstname";
									*/
									echo "<form method=\"post\" action=\"./index.php\">";
                                                                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority2 . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                                                                        echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber2 . "\">";
                                                                        echo "<input type=\"hidden\" name=\"job_tree\" value=\"0\">";
                                                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                                                                        include("log_in_authentication_form_vars.php");
                                                                        // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                                                                        echo "<input class=\"inputA\" type=\"image\" src=\"images/minus.png\" title=\"Collapse branch.\" name=\"action\" value=\"CBM\">";
                                                                        user_button($JobToFkUserID);
                                                                        echo "</form>";
									//echo "</TD>";
									$job_tree = 1;
								} else {
									//echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"2\">";
									user_button($JobToFkUserID);
									//echo "</TD>";
								}
							} else {
								$job_tree = 0;
							}
			
					        echo "</TD>";
							//***************************************************** BRANCH 2 - END
							//********************************************************************	
						echo "<TD bgcolor=\"$setColor2\" align=\"middle\">";
						
						// echo "<a href='priorityUp.php?JobID=$JobID&JobPriorityUp=$JobPriority2&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber2' class=\"linkPlainInWhiteAreas\"> $jobNumber2</a><img src=\"images/up_pointer.png\" height=\"10\" width=\"12\" border=\"0\">";
						echo $jobNumber2;
						echo "<form method=\"post\" action=\"./priorityUp.php\">";
				                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
				                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority2 . "\">";
				                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
				                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
				                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber2 . "\">";
				                echo "<input type=\"hidden\" name=\"job_tree\" value=\"" . $job_tree . "\">";
                                                include("log_in_authentication_form_vars.php");
                                                echo "<input class=\"inputA\" type=\"image\" src=\"./images/up_pointer.png\" width=\"40\" height=\"40\" title=\"Raise the priority of this job.\" name=\"action\" value=\"\">";
                                                echo "</form>";
						
						//echo "<a href='priorityDwn.php?JobID=$JobID&JobPriorityUp=$JobPriority2&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber2&JobParent=$JobParent'><img src=\"images/down_pointer.png\" height=\"10\" width=\"12\" border=\"0\"></a>";
				                echo "<form method=\"post\" action=\"./priorityDwn.php\">";
	                                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
	                                        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority2 . "\">";
	                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
	                                        echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
	                                        echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber2 . "\">";
	                                        echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobParent . "\">";
                                                include("log_in_authentication_form_vars.php");
                                                echo "<input class=\"inputA\" type=\"image\" src=\"./images/down_pointer.png\" width=\"40\" height=\"40\" title=\"Lower the priority of this job.\" name=\"action\" value=\"\">";
                                                echo "</form>";
				
						include("index_imp_urg_matrix.php");
				
					echo "		</TD>";
							
						$job_title_length = strlen($JobTitle);
						$rows_for_textarea = $job_title_length / $job_title_length_divisor;
						$rows_for_textarea = floor($rows_for_textarea);
						if ($rows_for_textarea < 1) {
							$rows_for_textarea = 1;
						}
						echo "<TD bgcolor=\"$setColor2\" align=\"middle\">";
						// echo "<a class=\"linkPlainInWhiteAreas\" href=\"clientcard2.php?id=$JobFkClientID&name=$clientName\">$clientName</a>"; 
						        /**
						        echo "<form method=\"post\" action=\"./clientcard2.php\">";
                                                        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID . "\">";
                                                        echo "<input type=\"hidden\" name=\"clientName\" value=\"" . $clientName . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                                                        echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"" . $clientName . "\">";
                                                        echo "</form>"; */
                                                        client_button($JobFkClientID,$clientName);
                                                        echo "</TD>";
						// echo "<TD bgcolor=\"$setColor2\"><pre>$JobTitle </pre></TD>";
						// echo "<TD bgcolor=\"$setColor2\"><font face=\"arial\" size=\"3\"><pre><TEXTAREA rows=\"5\" cols=\"57\" name=\"ActionText\">" . wordwrap($JobTitle, 63, "<br>", true) . "</TEXTAREA></pre></font></TD>";
						// echo "<TD bgcolor=\"$setColor2\"><font face=\"arial\" size=\"3\"><pre><TEXTAREA rows=\"$rows_for_textarea\" cols=\"$cols_for_textarea\" name=\"ActionText\">$JobTitle</TEXTAREA></pre></font></TD>";
						// echo "<TD bgcolor=\"$setColor2\"><font face=\"arial\" size=\"3\"><pre>$JobTitle</pre></font></TD>";
						echo "<TD bgcolor=\"$setColor2\"><font face=\"arial\" size=\"3\"><div style=\"white-space: pre-wrap;\">$JobTitle</div></font></TD>";
						echo "<TD bgcolor=\"$setColor2\" align=\"middle\">";
						// echo "<a class=\"linkPlainInWhiteAreas\" href=\"JobDetails.php?JobID=$JobID&id=$JobFkClientID&JobCardNumber=$JobCardNumber&JobParent=$JobParent\">$JobID-$JobCardNumber</a><BR><BR>";
						/**
						echo "\$JobID = $JobID<BR>";
						echo "\$JobFkClientID = $JobFkClientID<BR>";
						echo "\$JobCardNumber = $JobCardNumber<BR>";
						echo "\$JobParent in branch 2 = $JobParent"; */
                                                        job_button($JobID,$JobFkClientID,$JobCardNumber,$JobParent);
						// echo "<a href=\"./index.php?OptionCatch=AddJob&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID2&JobID=$JobID&JobParent=$JobID\"><img src=\"images/child2.gif\" width=\"20\" height=\"20\" title=\"Add child Job\"></img></a>";
						        echo "<form method=\"post\" action=\"./index.php\">";
			                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_job\">";
			                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
			                                echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
			                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID2 . "\">";
			                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                                        echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input class=\"inputA\" type=\"image\" src=\"./images/child2.gif\" width=\"40\" height=\"40\" title=\"Add child Job\" name=\"action\" value=\"\">";
                                                        echo "</form>";
						// echo "<a href=\"./index.php?OptionCatch=job_complete&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID2&JobID=$JobID&JobParent=$JobID\"><img src=\"images/tick.gif\" width=\"20\" height=\"20\" title=\"Job Complete\"></img></a>";
						        echo "<form method=\"post\" action=\"./index.php\">";
			                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_complete\">";
			                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
			                                echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
			                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID2 . "\">";
			                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                                        echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
                                                        echo "<input type=\"hidden\" name=\"JobTitle\" value=\"" . $JobTitle . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input class=\"inputA\" type=\"image\" src=\"./images/tick.gif\" width=\"40\" height=\"40\" title=\"Complete this job.\" name=\"action\" value=\"\">";
                                                        echo "</form>";
						$_POST['JobID'] = $JobID;
						$x = $_POST['JobID'];
						$JobID = $_POST['JobID'];
						$JobID2 = $_POST['JobID2'];
						//echo "<BR>\$JobID at end of cascade 2 = $JobID";
						//echo "<BR>\$JobID2 at end of cascade 2 = $JobID2";
						//echo "<BR>\$JobBranch at end of cascade 2 = $JobBranch";
						//echo "<BR>\$brt2 = $branch_spacer_total";
						
						echo "</TD>";
			
						echo "</TR>";			
						
						
						
						if ($JobChild == 1 && $job_tree == 1) {
							$branch_increment = branch_increment_from_class;
							$_POST['$branch_increment'] = $branch_increment;
							$branch_spacer_total = $branch_spacer_total + $branch_increment;
							$_POST['branch_spacer_total'] = $branch_spacer_total;
							cascade_job3();
						}
			
						$jobNumber2 = $jobNumber2 + 1;
						
	
	}	
	
	echo "</TABLE>";
	// echo "</DIV>";	
			
//*********************** here 2 END			
//***********************************			
			echo "</TD>";
			
			echo "</TR>";	
			$aColor = 1;
			$branch_spacer_total = 0;
			$_POST['branch_spacer_total'] = $branch_spacer_total;
//****************************************************************************** CASCADE 2 - END			
//**********************************************************************************************
}
function cascade_job3() {
//**********************************************************************************************
//**************************************************************************** CASCADE 3 - START		
			$JobID = $_POST['JobID'];
			$job_tree = $_POST['job_tree'];
			$JobID2 = $_POST['JobID2'];
			
			$x = $_POST['JobID'];
			//include("config/class_detect.php");
			$box_vars = new detect;
			$box_vars->my_box();
			$mybox_width = $box_vars->mybox_width;
			$job_board_col_1 = $box_vars->job_board_col_1;
			$job_board_User = $box_vars->job_board_User;
			$job_board_Priority = $box_vars->job_board_Priority;
			$job_board_Client = $box_vars->job_board_Client;
			$job_board_job_title = $box_vars->job_board_job_title;
			$job_board_JID = $box_vars->job_board_JID;
			$cols_for_textarea = $box_vars->cols_for_textarea;
			$branch_spacer_total_from_class = $box_vars->branch_spacer_total_from_class;
			$branch_increment_from_class = $box_vars->branch_increment_from_class;
			$job_title_length_divisor = $box_vars->job_title_length_divisor;
			//echo "<BR>\$JobID in beginning of cascade 3 = $JobID";
			//echo "<BR>\$JobID2 at end of cascade 3 = $JobID2";
			
			echo "<TR>";
			echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"7\">";
			
//***********************************			
//********************** here 3	START

			$dbs3 = new dbSession();
			if ($CurrentlyLoggedInAs == "") {
				$sqlAdjustment = "";
			}else{
				$sqlAdjustment = "AND JobToFkUserID = \"$CurrentlyLoggedInAs\"";
			}
			// echo "<BR> \$sqlAdjustment = $sqlAdjustment";
			// echo "\$JobID just before sql == $JobID<BR>";
			// echo "\$JobID2 just before sql == $JobID2<BR>";
			$sql3 = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" AND JobParent = $JobID2 $sqlAdjustment ORDER BY JobPriority DESC";
			// echo "<BR> \$sql = $sql";
	
			$Results3 = $dbs3->getResult($sql3);
	
			$aColor = 1;
	
			$branch_spacer_total = $_POST['branch_spacer_total'];
			
			echo "<TABLE>";
			echo "<TR>";
			//echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" colspan=\"7\" width=\"684\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\"><img src=\"images/spacer.gif\" width=\"$branch_spacer_total\" height=\"0\" title=\"\"></TD>";
			
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_User\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_Priority\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_Client\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_job_title\"></TD>";
			echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_JID\"></TD>";
			
			echo "</TR>";
			
			$jobNumber3 = 0;	
				while ($row3 = $dbs3->getArray($Results3)) {
			


						//This $jobNumber3 variable will need to be put back below this line instead of line 213 and line 
						// 152  removed : $jobNumber3 = 0;
						// And line 144 in priorityUp.php to go back to $jobNumber3 = 1;


			
						// $jobNumber3 = $jobNumber3 + 1;

						$JobParent = $row3['JobParent'];
						$JobChild = $row3['JobChild'];
							
						$JobBranch = $row3['JobBranch'];
						$JobTitle = $row3['JobTitle'];
						$JobID = $row3['JobID'];
						$JobFkClientID3 = $row3['JobFkClientID'];
						$JobCardNumber = $row3['JobCardNumber'];
						$JobPriority3 = $row3['JobPriority'];
						$JobImpUrg = $row3['JobImpUrg'];
						$JobStatus = $row3['JobStatus'];
						$JobType = $row3['JobType'];
			
						$JobToFkUserID = $row3['JobToFkUserID'];
						$dbs3UserFirstName = new dbSession();
						$sql3 = "SELECT UserFirstname from user WHERE UserID = \"$JobToFkUserID\" LIMIT 1";
						$Results3User = $dbs3->getResult($sql3);
						$row3User = $dbs3->getArray($Results3User);
						$UserFirstname = $row3User['UserFirstname'];			
			
						$JobFkClientID = $row3['JobFkClientID'];
						$dbs3ClientName = new dbSession();
						$sql3 = "SELECT ClientName from client WHERE ClientID = \"$JobFkClientID\" LIMIT 1";
						$Results3Client = $dbs3->getResult($sql3);
						$row3Client = $dbs3->getArray($Results3Client);
						$clientName = $row3Client['ClientName'];				
			
			

						if ($aColor == 1) {
							$aColor = 0;
							$setColor3 = "#CC99FF";
						}
						else {
							$aColor = 1;
							$setColor3 = "#CC99FF";
						}
						
			
			
			
						switch ($JobImpUrg) {
							case "0";
								$color_imp_urg_A = "#4775D1";
								$color_imp_urg_B = "#4775D1";
								$color_imp_urg_C = "#4775D1";
								$color_imp_urg_D = "#4775D1";
								break;
							case "A";
								$color_imp_urg_A = "#FF5050";
								$color_imp_urg_B = "#4775D1";
								$color_imp_urg_C = "#4775D1";
								$color_imp_urg_D = "#4775D1";
								break;
							case "B";
								$color_imp_urg_A = "#4775D1";
								$color_imp_urg_B = "#FF9933";
								$color_imp_urg_C = "#4775D1";
								$color_imp_urg_D = "#4775D1";
								break;
							case "C";
								$color_imp_urg_A = "#4775D1";
								$color_imp_urg_B = "#4775D1";
								$color_imp_urg_C = "#FFBD7D";
								$color_imp_urg_D = "#4775D1";
								break;
							case "D";
								$color_imp_urg_A = "#4775D1";
								$color_imp_urg_B = "#4775D1";
								$color_imp_urg_C = "#4775D1";
								$color_imp_urg_D = "#FFFF00";
								break;
						}
						
						
						
						
						// In cascade 3
						//echo "<BR>\$brt3 next to set = $branch_spacer_total";
						echo "<TR>";
						
						echo "<TD>";
						
						
						echo "</TD>";
						echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"2\">";
						//********************************************************************			
                                                //********************** CHECK TO SEE IF THIS JOB HAS CHILDREN - START
                                                //echo "\$JobID = $JobID<BR>";
                                                $JobChild = 0;
                                                $dbs_find_children = new dbSession();
                                                $sql_find_children = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" AND JobParent = \"$JobID\" ORDER BY JobPriority DESC";
                                                $Results_find_children = $dbs_find_children->getResult($sql_find_children);
                                                while ($row_find_children = $dbs_find_children->getArray($Results_find_children)) {
                                                        $JobChild = 1; 
                                                }
		                                //echo "\$JC = $JobChild<BR>";
                                                //************************ CHECK TO SEE IF THIS JOB HAS CHILDREN - END
                                                //********************************************************************
						
							if ($JobChild == 1) {
								$setColor3 = "#CC99FF";
								$aColor = 0;
							}
							
			
			
							//********************************************************************			
							//*************************************************** BRANCH 3 - START
							//if (empty($job_tree)) {
							//$job_tree = 0;
							//}
							$job_tree = $_POST['job_tree'];
			
							// echo " \$job_tree == $job_tree<BR>";
							if ($JobBranch == 0 ) {
								if ($JobChild == 1) {
									//echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"2\">";
									/** echo "
									<a href='index.php?JobID=$JobID&JobPriorityUp=$JobPriority3&JobType=$JobType&JobToFkUserID
									= $CurrentlyLoggedInAs&jobNumber=$jobNumber3&job_tree=1&OptionCatch=branch'><img src=\"images/plus.png\" height=\"10\" width=\"9\" border=\"0\" title=\"Expand Branch\"></a>  $UserFirstname </TD>"; */
									$job_tree = 0;
									echo "<form method=\"post\" action=\"./index.php\">";
                                                                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                                                                        echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber3 . "\">";
                                                                        echo "<input type=\"hidden\" name=\"job_tree\" value=\"1\">";
                                                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                                                                        include("log_in_authentication_form_vars.php");
                                                                        // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                                                                        echo "<input class=\"inputA\" type=\"image\" src=\"images/plus.png\" title=\"Expand branch.\" name=\"action\" value=\"CBM\">";
                                                                        echo "</form>";
                                                                        user_button($JobToFkUserID);
				                                        //echo "</TD>";
					
					
								} else {
									//echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"2\">";
									user_button($JobToFkUserID);
									//echo "</TD>";
								}
							} elseif ($JobBranch == 1 ) {
								if ($JobChild == 1) {
									//echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"2\">";
									/** echo "
									<a href='index.php?JobID=$JobID&JobPriorityUp=$JobPriority3&JobType=$JobType&JobToFkUserID
									= $CurrentlyLoggedInAs&jobNumber=$jobNumber3&job_tree=0&OptionCatch=branch'>
									<img src=\"images/minus.png\" height=\"10\" width=\"9\" border=\"0\" title=\"Collapse Branch\">
									</a>  $UserFirstname </TD>"; */
									echo "<form method=\"post\" action=\"./index.php\">";
                                                                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority3 . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                                                                        echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                                                                        echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber3 . "\">";
                                                                        echo "<input type=\"hidden\" name=\"job_tree\" value=\"0\">";
                                                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                                                                        include("log_in_authentication_form_vars.php");
                                                                        // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                                                                        echo "<input class=\"inputA\" type=\"image\" src=\"images/minus.png\" title=\"Collapse branch.\" name=\"action\" value=\"CBM\">";
                                                                        echo "</form>";
                                                                        user_button($JobToFkUserID);
									//echo "</TD>";
									$job_tree = 1;
								} else {
									//echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"2\">";
									user_button($JobToFkUserID);
									//echo "</TD>";
								}
							} else {
								$job_tree = 0;
							}
			
					        echo "</TD>";
							//***************************************************** BRANCH 3 - END
							//********************************************************************	
						echo "<TD bgcolor=\"$setColor3\" align=\"middle\">";
						// echo "<a href='priorityUp.php?JobID=$JobID&JobPriorityUp=$JobPriority3&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber3&job_tree=$job_tree' class=\"linkPlainInWhiteAreas\"> $jobNumber3</a><img src=\"images/up_pointer.png\" height=\"10\" width=\"12\" border=\"0";
						echo "$jobNumber3";
						echo "<form method=\"post\" action=\"./priorityUp.php\">";
				                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
				                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority3 . "\">";
				                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
				                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
				                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber3 . "\">";
				                echo "<input type=\"hidden\" name=\"job_tree\" value=\"" . $job_tree . "\">";
                                                include("log_in_authentication_form_vars.php");
                                                echo "<input class=\"inputA\" type=\"image\" src=\"./images/up_pointer.png\" width=\"40\" height=\"40\" title=\"Raise the priority of this job.\" name=\"action\" value=\"\">";
                                                echo "</form>";
							
						// echo "<img src=\"images/down_pointer.png\" height=\"10\" width=\"12\" border=\"0\"></a> ";
				                echo "<form method=\"post\" action=\"./priorityDwn.php\">";
	                                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
	                                        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority3 . "\">";
	                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
	                                        echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
	                                        echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber3 . "\">";
	                                        echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobParent . "\">";
                                                include("log_in_authentication_form_vars.php");
                                                echo "<input class=\"inputA\" type=\"image\" src=\"./images/down_pointer.png\" width=\"40\" height=\"40\" title=\"Lower the priority of this job.\" name=\"action\" value=\"\">";
                                                echo "</form>";
				
						
			include("index_imp_urg_matrix.php");
			
			echo "				</TD>";
						$job_title_length = strlen($JobTitle);
						$rows_for_textarea = $job_title_length / $job_title_length_divisor;
						$rows_for_textarea = floor($rows_for_textarea);
						if ($rows_for_textarea < 1) {
							$rows_for_textarea = 1;
						}
						echo "<TD bgcolor=\"$setColor3\" align=\"middle\">"; 
						// echo "<a class=\"linkPlainInWhiteAreas\" href=\"clientcard2.php?id=$JobFkClientID&name=$clientName\">$clientName</a>";
						        /**
						        echo "<form method=\"post\" action=\"./clientcard2.php\">";
                                                        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID . "\">";
                                                        echo "<input type=\"hidden\" name=\"clientName\" value=\"" . $clientName . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                                                        echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"" . $clientName . "\">";
                                                        echo "</form>"; */
                                                        client_button($JobFkClientID,$clientName);
                                                        echo "</TD>";
						// echo "<TD bgcolor=\"$setColor3\"><pre>$JobTitle </pre></TD>";
						// echo "<TD bgcolor=\"$setColor3\"><font face=\"arial\" size=\"3\"><pre><TEXTAREA rows=\"5\" cols=\"57\" name=\"ActionText\">" . wordwrap($JobTitle, 63, "<br>", true) . "</TEXTAREA></pre></font></TD>";
						// echo "<TD bgcolor=\"$setColor3\"><pre><TEXTAREA rows=\"$rows_for_textarea\" cols=\"$cols_for_textarea\" name=\"ActionText\">$JobTitle</TEXTAREA></pre></TD>";
						// echo "<TD bgcolor=\"$setColor3\"><pre>$JobTitle</pre></TD>";
						// echo "<TD bgcolor=\"$setColor3\"><font face=\"arial\" size=\"3\"><div style=\"white-space: pre-wrap;\">$JobTitle</div></font></TD>";
						echo "<TD bgcolor=\"$setColor3\"><font face=\"arial\" size=\"3\"><div style=\"white-space: pre-wrap;\">$JobTitle</div></font></TD>";
						echo "<TD bgcolor=\"$setColor3\" align=\"middle\">";
						// echo "<a class=\"linkPlainInWhiteAreas\" href=\"JobDetails.php?JobID=$JobID&id=$JobFkClientID&JobCardNumber=$JobCardNumber&JobParent=$JobParent\">$JobID-$JobCardNumber</a><BR><BR>";
						
						// echo "\$JobFkClientID in branch 3 = $JobFkClientID";
						        job_button($JobID,$JobFkClientID,$JobCardNumber,$JobParent);
						// echo "<a href=\"./index.php?OptionCatch=AddJob&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID3&JobID=$JobID&JobParent=$JobID\"><img src=\"images/child2.gif\" width=\"40\" height=\"40\" title=\"Add child Job\"></img></a>";
						        echo "<form method=\"post\" action=\"./index.php\">";
			                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_job\">";
			                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
			                                echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
			                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID3 . "\">";
			                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                                        echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input class=\"inputA\" type=\"image\" src=\"./images/child2.gif\" width=\"40\" height=\"40\" title=\"Add child Job\" name=\"action\" value=\"\">";
                                                        echo "</form>";
						// echo "<a href=\"./index.php?OptionCatch=job_complete&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID3&JobID=$JobID&JobParent=$JobID\"><img src=\"images/tick.gif\" width=\"20\" height=\"20\" title=\"Job Complete\"></img></a>";
						        echo "<form method=\"post\" action=\"./index.php\">";
			                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_complete\">";
			                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
			                                echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
			                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID3 . "\">";
			                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                                        echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
                                                        echo "<input type=\"hidden\" name=\"JobTitle\" value=\"" . $JobTitle . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input class=\"inputA\" type=\"image\" src=\"./images/tick.gif\" width=\"40\" height=\"40\" title=\"Complete this job.\" name=\"action\" value=\"\">";
                                                        echo "</form>";
						$_POST['JobID'] = $JobID;
						$x = $_POST['JobID'];
						$JobID = $_POST['JobID'];
						$JobID2 = $_POST['JobID2'];
						//echo "<BR>\$JobID at end of cascade 3 = $JobID";
						//echo "<BR>\$JobID2 at end of cascade 3 = $JobID2";
						//echo "<BR>\$JobBranch at end of cascade 3 = $JobBranch";
						//echo "<BR>\$JobChild at end of cascade 3 = $JobChild";
						//echo "<BR>\$brt3 = $branch_spacer_total";
						
						echo "</TD>";
			
						echo "</TR>";			
						
						
						
						if ($JobChild == 1 && $job_tree == 1) {
							$branch_increment = $_POST['$branch_increment'];
							$branch_spacer_total = $branch_spacer_total + $branch_increment;
							$_POST['branch_spacer_total'] = $branch_spacer_total;
							cascade_job();
						}
						
						$jobNumber3 = $jobNumber3 + 1;
						
	
	}	
	
	echo "</TABLE>";
	// echo "</DIV>";	
			
//*********************** here 3 END			
//***********************************			
			echo "</TD>";
			
			echo "</TR>";	
			$aColor = 1;
			$branch_spacer_total = 0;
			$_POST['branch_spacer_total'] = $branch_spacer_total;
//****************************************************************************** CASCADE 3 - END			
//**********************************************************************************************
}
function loc_update_branch() {
	$JobID    = $_POST['JobID'];
	$job_tree = $_POST['job_tree'];
	// echo "\$JobID == $JobID <BR>";
	// echo "\$job_tree = $job_tree <BR>";

	$dbs_job_branch = new dbSession();
	$sql_branch = "UPDATE job SET JobBranch = $job_tree WHERE JobID = \"$JobID\" LIMIT 1";
	//$sql = "UPDATE reminder SET ReminderSchedTimeInSecs = '$newReminderSchedTimeInSecs' WHERE ReminderID = '$ReminderID'";
	
		if ($dbs_job_branch->getResult($sql_branch)) {
			//$msg = "<BR>Branch Updated.";
			//echo "<FONT SIZE=\"4\" COLOR=\"#339900\">$msg</FONT><BR><BR>";
			//locReminderCheck();     // Found in reminder_functions.php
                        //job_board();            // Found in job_board_functions.php
			//Onsite();
			echo "<BR>";
		} else {
			$msg = $dbs->printError();
			echo "<FONT SIZE=\"4\" COLOR=\"#CC0000\">$msg</FONT>";
			//locReminderCheck();     // Found in reminder_functions.php
                        //job_board();            // Found in job_board_functions.php
			//Onsite();
			echo "<BR>";
		}
	echo "</DIV>";
}

?>
