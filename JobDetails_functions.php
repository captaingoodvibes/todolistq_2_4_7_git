<?PHP
//**********************************************************************************************
//**************************************************************************** FUNCTIONS - START
function LocAddActionWhenJobInserted($StartTime) {
        // echo "\$StartTime in LocAddActionWhenJobInserted() = $StartTime<BR>";
	// Get data from the database where the name variable = ????
	$id = $_POST['id'];
	$AddAction = $_POST['AddAction'];
	//$StartTime = $_POST['StartTime'];
	$ColumnUserName = $_POST['ColumnUserName'];
	$ReadableStartTime = $_POST['ReadableStartTime'];
	$ColumnJobID = $_POST['ColumnJobID'];
	$ActionRelToFkClientID = $_POST['ActionRelToFkClientID'];
	$JobTitle = $_POST['JobTitle'];
	$JobToFkUserID = $_POST['JobToFkUserID'];
	$JobFromFkUserID = $_POST['JobFromFkUserID'];
	$JobFkClientID = $_POST['JobFkClientID'];
	
//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
				$debug = $_POST['debug'];
				$debugMsg .= "<BR>\$id = $id";
				$debugMsg .= "<BR>\$AddAction = $AddAction";
				$debugMsg .= "<BR>\$StartTimeeeee1 = $StartTime";
				$debugMsg .= "<BR>\$ColumnUserName = $ColumnUserName";
				$debugMsg .= "<BR>\$ReadableStartTime = $ReadableStartTime";
				$debugMsg .= "<BR>\$ColumnJobID = $ColumnJobID";
				$debugMsg .= "<BR>\$ActionRelToFkClientID = $ActionRelToFkClientID";
				$debugMsg .= "<BR>\$JobTitle = $JobTitle";
				$debugMsg .= "<BR>\$JobToFkUserID = $JobToFkUserID";
				$debugMsg .= "<BR>\$JobFromFkUserID = $JobFromFkUserID";
				$debugMsg .= "<BR>\$JobFkClientID = $JobFkClientID";
				include("config/debug.php");
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************
	
	$EndTime = time();
	$TotalTime = $EndTime - $StartTime;
	
	$jobMessage = "Job Added  - ";
	$ActionText_raw = $jobMessage . $JobTitle;
	$ActionText = addslashes($ActionText_raw);
	$dbsFindJobID = new dbSession();
	//$sql = "SELECT JobID from job WHERE JobTimeInserted = '$StartTime' AND JobTitle = 'test x'";
	$sql = "SELECT JobID, JobFromFkUserID from job WHERE JobTitle = '$JobTitle'";
	$Results = $dbsFindJobID->getResult($sql);
	$debugMsg .= "Results is $Results<BR>";
	$row = $dbsFindJobID->getArray($Results);
	$JobID = $row['JobID'];
	$JobFromFkUserID = $row['JobFromFkUserID'];

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
				$debug = $_POST['debug'];
				$debugMsg .= "<BR>\$ActionText = $ActionText ";
				$debugMsg .= "<BR>\$JobID = $JobID ";
				include("config/debug.php");
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************

	$debugMsg .= "\$ActionText = $ActionText<BR />\n<BR>";
	include("config/tpl_bodystart.php");
	
	echo "<DIV align=\"center\">";
	//LocHtmlPageStart();

	$dbsActionAdd = new dbSession();

		if ($AddAction != "Add current action or Event") {
			$sql = "INSERT INTO action (ActionText, ActionFkJobID, ActionFkClientID, ActionRelToFkClientID, ActionFromFkUserID, ActionToFkUSerID, ActionDateSecs, ActionTotalSecs) VALUES ('$ActionText', '$JobID', '$JobFkClientID', '$ActionRelToFkClientID', '$JobFromFkUserID', '$JobToFkUserID', '$StartTime', '$TotalTime')";
			
				if ($dbsActionAdd->getResult($sql)) {
					$msg = "Action Added.";
					$debugMsg .= "\$StartTime = $StartTime<BR />\n<BR>";
					include("config/tpl_bodystart.php");
				} else {
					$msg = $dbsActionAdd->printError();
				}
		} else {
			echo "<BR><BR>Not a valid Action. Please type it again.";
		}
	
	echo "$msg<BR>";
        /**
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"Nothing\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Back to Client Card\">";
	echo "</form>"; */
	echo "</DIV>";
}
function insertJob() {
        $UserID = $_POST['UserID'];
        //echo "\$UserID = $UserID<BR>";
	$JobTitle = addslashes($_POST['JobTitle']);
	$JobCardNumber = $_POST['JobCardNumber'];
	$JobFkClientID = $_POST['JobFkClientID'];
	$JobType = $_POST['JobType'];
	$JobToFkUserID = $_POST['JobToFkUserID'];
	$JobFromFkUserID = $_POST['login_UserID'];
	$JobChild = $_POST['JobChild'];
	$JobParent = $_POST['JobParent'];
	$JobStatus = $_POST['JobStatus'];
	$JobPriority = $_POST['JobPriority'];
	$StartTime = $_POST['StartTime'];
	$JobTimeInserted = $StartTime;
//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
	$debug = $_POST['debug'];
	$debugMsg .= "<BR>\$JobTimeInserted = " . $_POST['JobTimeInserted'];
	$debugMsg .= "<BR>\$JobTimeInserted = $JobTimeInserted";
	$debugMsg .= "<BR>\$StartTime = $StartTime";
	include("config/debug.php");
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************

	$StartTime = $_POST['StartTime'];
	$InsertIntoDatabase = $_POST['InsertIntoDatabase'];
	


  	//LocHtmlPageStart();
  	echo "<BR><BR>";
  	
  	global $debug;
	$debugMsg .= "\$SearchClientName = $SearchClientName<BR />\n<BR>";
	$debugMsg .= "\$StartTime = $StartTime<BR />\n<BR>";
	$debugMsg .= "\$JobFkClientID = $JobFkClientID<BR />\n<BR>";
	$debugMsg .= "\$JobParent = $JobParent<BR />\n<BR>";
	$debugMsg .= "\$JobChild = $JobChild<BR />\n<BR>";
	$debugMsg .= "Adding a base priority \$JobPriorityUp = $JobPriorityUp<BR />\n<BR>";	  
	$debugMsg .= "Adding a base priority \$JobType = $JobType<BR />\n<BR>";
	$debugMsg .= "\$JobPriority inside insert funtion = $JobPriority<BR />\n<BR>";	
	include("config/tpl_bodystart.php");

		/**
		$dbs = new dbSession();
		
		$sql = "SELECT JobPriority FROM `Job` WHERE JobPriority <= '$JobPriorityUp' AND JobType = '$JobType' AND JobStatus = 'Active' ORDER BY JobPriority DESC LIMIT 0,3";
		
		$Results = $dbs->getResult($sql);

		$list = "0";

		while ($row = $dbs->getArray($Results)) {
			
			$priorityArray = $row['JobPriority'];

			$debugMsg .= "In loop add base priority \$priorityArray[$list] = " . round($priorityArray, 20) . "<BR>";
			include("config/tpl_bodystart.php");
			
			$list = $list + 1;
			$priorityList[] = round($priorityArray, 20);

		}
		*/
	//$JobTimeInserted = $_POST['StartTime'];
	$JobTimeInserted = time();
	$JobSchedTimeInSecs = time();
	$StartTime = $JobTimeInserted;
	// echo "\$StartTime = $StartTime<BR>";
	
	

	// $JobPriority = 1;
	
	$dbs = new dbSession();
	
//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
				$debug = $_POST['debug'];
				$debugMsg .= "<BR>\$JobTimeInserted next to insert= $JobTimeInserted";
				include("config/debug.php");
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************

	//	if ($InsertIntoDatabase != "") {
			$sql = "INSERT INTO job (JobParent, JobCardNumber, JobSchedTimeInSecs, JobTitle, JobPriority, JobTimeInserted, JobFkClientID, JobStatus, JobType, JobFromFkUserID, JobToFkUserID) 
			VALUES ('$JobParent', '$JobCardNumber', '$JobSchedTimeInSecs', '$JobTitle', '$JobPriority', '$JobTimeInserted', '$JobFkClientID', '$JobStatus', '$JobType', '$UserID', '$JobToFkUserID')";

			if ($dbs->getResult($sql)) {
					$msg = "Job Added.";
					$advise_parent = new child;
					$advise_parent-> advise_parent_of_children($JobParent);
					// echo $advise_parent->jchild; 
				} else {
					$msg = $dbs->printError();
				}
				
	echo "$msg<BR><BR>";
	$ClientID = $JobFkClientID;
	LocAddActionWhenJobInserted($StartTime);
	/**
        echo "<form method=\"post\" action=\"./index.php\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_board\">";
        include ("log_in_authentication_form_vars.php");
        echo "<input class=\"top_buttons\"  type=\"submit\" name=\"action\" value=\"Job Board\">";
        echo "</form>"; */
        
        echo "<form method=\"post\" action=\"./whiteBoard.php\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"whiteBoard\">";
        include ("log_in_authentication_form_vars.php");
        echo "<input class=\"top_buttons\"  type=\"submit\" name=\"action\" value=\"Job Board\">";
        echo "</form>";
        echo"<BR>";
        echo "Add another<BR><form method=\"post\" action=\"./index.php\">";
        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $_POST['ClientID'] . "\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_job\">";
        include ("log_in_authentication_form_vars.php");
        echo "<input class=\"top_buttons\" type=\"submit\" name=\"action\" value=\"job\">";
        echo "</form>";
}

function add_job() {
	//include("config/class_detect.php");
	$box_vars = new detect;
	$box_vars->my_box();
	$job_details_textarea_cols = $box_vars->job_details_textarea_cols;
	
	$ClientID = $_POST['ClientID'];
	if ( empty($ClientID)){
	        $_POST['ClientID'] = $_POST['JobFkClientID'];
	}
	$JobParent = $_POST['JobParent'];
	//echo "\$ClientID = $ClientID";
	if ( ! empty($ClientID)) {
		$dbsClientName = new dbSession();
		$sql = "SELECT ClientName from client WHERE ClientID = \"$ClientID\" LIMIT 1";
		$ResultsClient = $dbsClientName->getResult($sql);
		$rowClient = $dbsClientName->getArray($ResultsClient);
		$clientName = $rowClient['ClientName'];
		$_POST['ClientName'] = $clientName;
	
		
		$dbsFromUserFirstName = new dbSession();
		$sql = "SELECT UserFirstname from user WHERE UserID = \"$JobFromFkUserID\" LIMIT 1";
		$ResultsFromUser = $dbsFromUserFirstName->getResult($sql);
		$rowFromUser = $dbsFromUserFirstName->getArray($ResultsFromUser);
		$FromUserFirstname = $rowFromUser['UserFirstname'];
	}
		/**
		$dbsToUserFirstName = new dbSession();
		$sql = "SELECT UserFirstname from User WHERE UserID = \"$JobToFkUserID\" LIMIT 1";
		$ResultsToUser = $dbs->getResult($sql);
		$rowToUser = $dbs->getArray($ResultsToUser);
		$ToUserFirstname = $rowToUser['UserFirstname'];
		*/
// echo "<H3>Add Job</H3>";
$header_size = $_POST['header_size'];
echo "<H" . $header_size . ">Add Job</H" . $header_size . ">";
echo "
	<form method=\"post\" action=\"$PHP_SELF\">
	<TABLE>
		<TR>
			<TD>Fault / JobTitle</TD>
			<TD>
				<TEXTAREA tabindex=\"24\" rows=\"5\" cols=\"$job_details_textarea_cols\" 
				name=\"JobTitle\" WRAP=\"virtual\">$JobTitle</TEXTAREA>
			</TD>
		</TR>
		<TR>
			<TD>JobCardNumber</TD>
			<TD><input type=\"text\" width=\"15\" name=\"JobCardNumber\" tabindex=\"9\"  value=\"\"></TD>
		</TR>
		<TR>
			<TD>JobParent</TD>
			<TD><input type=\"text\" width=\"15\" name=\"JobParent\" tabindex=\"9\"  value=\"$JobParent\"></TD>
		</TR>
		<TR>
			<TD>ForClient</TD>
			<TD>
";
				$ClientName = $_POST['ClientName'];
				echo "$ClientName";

				/** echo "  change";

					$dbs = new dbSession();
					$sql = "SELECT ClientID, ClientName from Client WHERE ClientID = '$ActionRelToFkClientID' ORDER BY 'ClientName' ASC";
					$Results = $dbs->getResult($sql);
					$row = $dbs->getArray($Results);
					$clientName = $row['ClientName'];
					*/

				echo "<a href=\"addJob3.php?OptionCatch=SearchClient6&StartTime=$StartTime&AddMessageTermination=1&ClientID=$ClientID\">  Change </a>";
				/**
				echo "<form method=\"post\" action=\"$PHP_SELF\" >";
				echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
				echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"SearchClient6\">";
				echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
				echo "<input type=\"submit\" tabindex=\"18\" name=\"Submit\" value=\"Change\">";
				echo "</form>";
				*/
				/**
				echo "<SELECT name=\"JobFkClientID\">";
				echo "<OPTION value=\"$ClientID\">$clientName";
				$dbs = new dbSession();
				$sql = "SELECT ClientName, ClientID from Client ORDER BY ClientName ASC";
				$Results = $dbs->getResult($sql);
			
				while ($row = $dbs->getArray($Results)) {
					// $optValue = $row['ClientName'];				
					echo "<OPTION value=\"$row[ClientID]\">$row[ClientName]";
					}
				echo "</SELECT>";
				*/
				
echo "
		</TD>
		</TR>
		<TR>
			<TD><!-- JobType --></TD>
			<TD><!-- <select name=\"JobType\" tabindex=\"3\"\">
			<OPTION  value=\"WorkShop\">WorkShop
			<OPTION  value=\"Onsite\">Onsite
			-->";
echo "                  <input type=\"hidden\" name=\"JobType\" value=\"WorkShop\">";			 
echo "			</TD>
		</TR>
		<TR>
			<TD><!--AssignedFrom--></TD>
			<TD>
";

	// **************************************************
	// Selects the logged on user as the default for the select box
				
				$UserID = $_POST['UserID'];
				//echo "UserID = $UserID ";
				$JobFromFkUserID = $UserID; // Default value
				$dbs = new dbSession();
				$sql = "SELECT UserFirstname, UserLogin FROM user WHERE UserID = '$UserID'";
				$Results = $dbs->getResult($sql);
				$row = $dbs->getArray($Results);
				$UserFirstname = $row['UserFirstname'];
				//$JobType = $row['JobType'];
				$UserLogin = $row['UserLogin'];
	// **************************************************
	                        //*************************************************************************************************
                                //******************************************************************** DEBUG VARIABLES HERE - START
                                $turn_this_debug_on = 0;
                                if ($turn_this_debug_on == 1) {     
                                        $debugMsg .= "<BR>********************************************************************<BR>";
                                        $debugMsg .= "Debug vars within addJob3.php<BR>";
                                        $debugMsg .= "\$_POST['ClientID'] = " . $_POST['ClientID'] . "<BR>";
                                        $debugMsg .= "\$UserFirstname = " . $$UserFirstname . "<BR>"; 
                                        $debugMsg .= "\$_POST['UserID'] = " . $_POST['UserID'] . "<BR>"; 
                                        $debugMsg .= "\$UserLogin = " . $UserLogin . "<BR>"; 
                                        $debugMsg .= "********************************************************************<BR>";
                                        include("config/debug.php");
                                }
                                //********************************************************************** DEBUG VARIABLES HERE - END
                                //*************************************************************************************************
				// echo "$UserLogin";
				/** echo "<SELECT name=\"JobFromFkUserID\">";
				$JobFromFkUserID = "1"; // Default value
				
				$dbs = new dbSession();
				$sql = "SELECT UserID, UserLogin from user WHERE UserActive = '1'";
				$Results = $dbs->getResult($sql);
				$row = $dbs->getArray($Results);
				echo "<OPTION value=\"$UserID\">$UserFirstname";
				
					while ($row = $dbs->getArray($Results)) {
						echo "<OPTION value=\"$row[UserID]\">$row[UserLogin]";
						}
				echo "</SELECT>"; */
	
echo "	
			</TD>
		</TR>

		<TR>
			<TD>AssignedTo</TD>
			<TD>
";
	                        echo $_POST['UserLogin'] . "<BR>";
				echo "<SELECT name=\"JobToFkUserID\">";
				$JobToFkUserID = "1"; // Default value
				
				$dbs = new dbSession();
				$sql = "SELECT UserLogin, UserID from user WHERE UserActive = '1'";
				$Results = $dbs->getResult($sql);
				$row = $dbs->getArray($Results);
				echo "<OPTION value=\"$UserID\">$UserLogin";
				
					while ($row = $dbs->getArray($Results)) {
						// $optValue = $row['UserID'];				
						echo "<OPTION value=\"$row[UserID]\">$row[UserLogin]";
						}
				echo "</SELECT>";
	
echo "	
			</TD>
		</TR>
		<TR>
			<TD><!--Priority--></TD>
			<TD>
";

				//echo "<SELECT name=\"JobPriority\">";
				 $JobToFkUserID = "1"; // Default value
				
				$dbs = new dbSession();
				$sql = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" $sqlAdjustment ORDER BY JobPriority DESC";
				$Results = $dbs->getResult($sql);
				$row = $dbs->getArray($Results);
				$firstValue = $row[JobPriority] + 1;
				//echo "<OPTION value=\"$firstValue\">0";
				$JobPriorityAbove = $row[JobPriority];
				$priorityValue = 1;

					while ($row = $dbs->getArray($Results)) {
						//$optValue = $row['UserID'];
						$newPriority = ($JobPriorityAbove + $row[JobPriority]) / 2;
						//echo "<OPTION value=\"$newPriority\">$priorityValue";
						$JobPriorityAbove = $row[JobPriority];
						$priorityValue = $priorityValue + 1;
						}
				$lastValue = $row[JobPriority] - 1;
				//echo "<OPTION value=\"$lastValue\">$priorityValue";
				//echo "</SELECT>";
				echo "<input type=\"hidden\" name=\"JobPriority\" value=\"$firstValue\">";
				

echo "
			</TD>
		</TR>
		</TABLE>
";

	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"JobFkClientID\" value=\"" . $_POST['ClientID'] . "\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $_POST['StartTime'] . "\">";
	echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $_POST['ClientName'] . "\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"insertJob\">";
	// echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
	echo "<input type=\"hidden\" name=\"JobStatus\" value=\"Active\">";
	include ("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" tabindex=\"18\" name=\"Submit\" value=\"Add Job\">";
	echo "</form>";
}
function LocEndCallAddAction_maybe_delete_this() {  //There is another one in action_functions.php
  	
	$ActionFkClientID = $_POST['ClientID'];
	$JobFkClientID = $_POST['JobFkClientID'];
	$JobID = $_POST['JobID'];
	$name = $_POST['name'];
	$UserID = $_POST['UserID'];
	$ColumnUserName = ['ColumnUserName'];

        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {	
                        $debugMsg .= "In LocEndCallAddAction()<BR>";
                        $debugMsg .= "\$JobID = $JobID<BR>";
                        $debugMsg .= "\$id = $id<BR>";
                        $debugMsg .= "\$ActionFkClientID= $ActionFkClientID<BR>";
                        $debugMsg .= "\$JobFkClientID = $JobFkClientID<BR>";
                        $debugMsg .= "\$ClientID = $ClientID<BR>";
                        $debugMsg .= "\$AddAction = $AddAction<BR>";
                        $debugMsg .= "\$StartTime = $StartTime<BR>";
                        $debugMsg .= "\$name = $name<BR>";
                        $debugMsg .= "\$UserID = $UserID<BR>";
                        $debugMsg .= "\$ColumnUserName = $ColumnUserName<BR>";
                        $debugMsg .= "\$ReadableStartTime = $ReadableStartTime<BR>";
	                $debugMsg .= "\$ColumnJobID = $ColumnJobID<BR>";
	                $debugMsg .= "\$ActionRelToFkClientID = $ActionRelToFkClientID<BR>";
	                $debugMsg .= "\$ActionFkJobID= $ActionFkJobID<BR>";
	                include("config/debug.php");
	        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
	
	if (empty($StartTime)) {
				//$StartTime = time();
				
				$config_time_zone = $_POST['config_time_zone'];
				$MNTTZ = new DateTimeZone($config_time_zone);

				$dt = new DateTime();

				$dt->setTimezone($MNTTZ);

				$StartTime = $dt->format('U');
				
				// echo "\$StartTime = $StartTime";
			}
			//else{
			//	LocEndCallAddAction();
			//}
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"0\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"StartCall\">";
	echo "<input type=\"hidden\" name=\"JobID\" value=\"$JobID\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" tabindex=\"20\" name=\"Submit\" value=\"Restart Action timer\">";
	
	// $config_time_zone = $_POST['config_time_zone'];
	$config_time_zone = $_POST['user_time_zone'];
	//**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {	
	        $debugMsg .= "Function LocEndCallAddAction() in JobDetails.php<BR>";
	        $debugMsg .= "\$_POST[\'user_time_zone\'] ign = " . $_POST['user_time_zone'] . "<BR>";
	        $debugMsg .= "\$_POST[\'config_time_zone\'] = " . $_POST['config_time_zone'] . "<BR>";
	        $debugMsg .= "\$config_time_zone = " . $config_time_zone . "<BR>";
	        include("config/debug.php");
	        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
	$MNTTZ = new DateTimeZone($config_time_zone);

	$dt = new DateTime();

	$dt->setTimezone($MNTTZ);

	$StartTime = $dt->format('U');
	
	$date = new DateTime("@$StartTime");
	$date->setTimezone($MNTTZ);
	
	echo "  Current Start Time = ";
	//echo date("H:i:s", $StartTime);
	echo $date->format(DATE_RFC1123);
	
	echo "</form>";
	
	echo "Add Action................. ";
	
	
	/**
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	
	echo "<select tabindex=\"21\" name=\"ColumnUserName\">";
	// echo "<OPTION value=\"\">";
	$dbsName = new dbSession();
	$login_name_for_menu = $_SESSION['peopleLoggedInName'];
	$sqlName = "SELECT UserID from user WHERE UserLogin = '$login_name_for_menu'";
	$Results = $dbsName->getResult($sqlName);
	$row = $dbsName->getArray($Results);
	echo "<OPTION value=\"$row[UserID]\">$login_name_for_menu";

	$dbs = new dbSession();
	$sql = "SELECT * from user WHERE UserActive = '1'";
	$Results = $dbs->getResult($sql);
		while ($row = $dbs->getArray($Results)) {
			$optValue = $row['UserID'];				
			echo "<OPTION value=\"$row[UserID]\">$row[UserLogin]";
			}
	echo "</SELECT>";	
	
	
	
	echo " <a href=\"addJob3.php?OptionCatch=AddJob&ClientID=$id&ClientName=$name&StartTime=$StartTime\"  tabindex=\"22\">JID - JCN</a> ";

	// echo "<form method=\"post\" action=\"$PHP_SELF\">";
	
	echo "<select tabindex=\"23\" name=\"ColumnJobID\">";
	echo "<OPTION value=\"\">";
	$dbs = new dbSession();
	$sql = "SELECT * from Job WHERE JobFkClientID = '$id' ORDER BY JobCardNumber ASC";
	$Results = $dbs->getResult($sql);
	
		while ($row = $dbs->getArray($Results)) {
			$optValue = $row['JobID'];				
			echo "<OPTION value=\"$row[JobID]\">$row[JobID] - $row[JobCardNumber]";
			}
	echo "</SELECT>";
	*/
	
	echo "<TEXTAREA tabindex=\"24\" rows=\"5\" cols=\"45\" name=\"AddAction\" WRAP=\"virtual\"></TEXTAREA>";
	
	echo "<BR><BR>";
	
	// echo "Related to client  ";
	
	$dbs = new dbSession();
	$sql = "SELECT ClientID, ClientName from client WHERE ClientID = '$ActionRelToFkClientID' ORDER BY 'ClientName' ASC";
	$Results = $dbs->getResult($sql);
	$row = $dbs->getArray($Results);
	$clientName = $row['ClientName'];
	
        /** Monday 2/2/2015 - DP - Add this section later after I've put Spiros online for sale. 
	echo "<a href=\"JobDetails.php?OptionCatch=SearchClient7&StartTime=$StartTime&AddMessageTermination=1&id=$id&JobID=$JobID\">Related to client </a> -   .$clientName.    .";
	*/

	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";  
	echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"$JobID\">";
	echo "<input type=\"hidden\" name=\"ActionRelToFkClientID\" value=\"$ActionRelToFkClientID\">";
	echo "<input type=\"hidden\" name=\"ActionFkClientID\" value=\"$JobFkClientID\">";
	echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
	include("log_in_authentication_form_vars.php");
	echo "<input  tabindex=\"27\" type=\"submit\" name=\"OptionCatch\" value=\"End Call\">";
	/** echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	// echo "<input type=\"hidden\" name=\"OptionCatch2\" value=\"InsertAction\">";
	include("log_in_authentication_form_vars.php");
	echo "<input tabindex=\"28\" type=\"submit\" name=\"OptionCatch\" value=\"Add Untimed Action\">"; */
	echo "</form>"; 
	// echo "<BR><BR>";
}
function SearchClient7() {
	// Get data from the database where the name variable = ????
	$SearchClientName = $_POST['SearchClientName'];
	$StartTime = $_POST['StartTime'];
	$fieldName = $_POST['fieldName'];
	$id = $_POST['id'];
	$ClientID = $_POST['ClientID'];
	$JobID = $_POST['JobID'];

	global $debug;
	$debugMsg .= "Start Time = $StartTime<BR>";
	$debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
	$debugMsg .= "\$fieldName= $fieldName<BR>";
	include("config/tpl_bodystart.php");

	$dbs = new dbSession();
	$sql = "SELECT ClientID, ClientName, ClientContactName from client ORDER BY ClientName ASC";
	//$sql = "SELECT ClientID from client where ClientName REGEXP \'f\'";
	$Results = $dbs->getResult($sql);
	$debugMsg .= "Results is $Results<BR>";
	
	//$StartTime = time();
	//$config_time_zone = $_POST['config_time_zone'];
	$config_time_zone = $_POST['user_time_zone'];
	$MNTTZ = new DateTimeZone($config_time_zone);

	$dt = new DateTime();

	$dt->setTimezone($MNTTZ);

	$StartTime = $dt->format('U');
	
		while ($row = $dbs->getArray($Results)) {
			$ClientID = $row['ClientID'];
			$ClientName = $row['ClientName'];
			echo "<form method=\"post\" action=\"$PHP_SELF\">";
			echo "  ClientName is <B> $ClientName </B>- ";
			$ClientContactName = $row['ClientContactName'];
			echo " and the contact name is $ClientContactName - ";
			echo "  ClientID is $ClientID - ";
			// echo "<a href=\"JobDetails.php?JobID=$JobID&clientName=$ClientName&id=$id&ClientID=$ClientID&StartTime=$StartTime&name=$name\">$name</a>";
			
                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                        echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $ClientName . "\">";
                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"client_changed_for_job\">";
                        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">";
                        echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                        include("log_in_authentication_form_vars.php");
                        echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"Change\">";
                        echo "</form>";
		}
	/**
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"Nothing\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Start Over\">";
	echo "</form>";
	echo "<BR><BR>"; */
	
}
function delete_job_card() {
	// Edit the cards details
	$JobID = $_POST['JobID'];
	$JobParent = $_POST['JobParent'];
	//echo "\$JobParent at top = $JobParent<BR>";
	$check_for_babies = new child;
	$check_for_babies->check_if_job_has_babies($JobID);
	$no_of_babies = $check_for_babies->got_babies;
	//echo "\$check_for_babies = $no_of_babies<BR>";
	if ($check_for_babies->got_babies == 0) {

		$dbs_del_job = new dbSession();
		$sql_del_job = "DELETE FROM job WHERE JobID = '$JobID' ";

			if ($dbs_del_job->getResult($sql_del_job)) {
				echo "<DIV align=\"center\">";
				$msg = "Card Deleted.";
				echo "<BR>$msg";
				$check_if_parent_has_babies = new child;
				$children = $check_if_parent_has_babies->check_if_job_has_babies($JobID);
				$number_of_children = $check_if_parent_has_babies->got_babies;
				//echo "kiddies = $number_of_children<BR>";
				//$JobParent = $check_if_parent_has_babies->got_babies;
				
				//**********************************************************************************************
				//***************************************************************** DEBUG VARIABLES HERE - START
				$turn_this_debug_on = 0;
                                if ($turn_this_debug_on == 1) {	
				$debug = $_POST['debug'];
				$debugMsg .= "The parent $JobParent has ";
				$debugMsg .= $number_of_children . " babies<BR>";
				include("config/debug.php");
				}
				//******************************************************************* DEBUG VARIABLES HERE - END
				//**********************************************************************************************
				if (empty($number_of_children)) {
					$child = new child;
					// echo "to other == $JobParent == has ";
					$child->advise_parent_babies_died($JobParent);
				}
				echo "<BR>";
				// echo "<A href=\"index.php\" class=\"linkPlainInWhiteAreas\">Home</A>";
				echo "</DIV>";
			} else {
				echo "<DIV align=\"center\">";
				$msg = $dbs_del_job->printError();
				echo "<BR>$msg";
				echo "<BR>";
				// echo "<FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"\"><A href=\"index.php\">Home</A></FONT>";
				echo "</DIV>";
			}
	} else { 
		echo "<DIV align=\"center\">";
		$msg = "<BR> There are sub jobs attached to this job. Please move or delete them first.<BR><BR>";
		echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#FF0000\">$msg</FONT>";
		echo "</DIV>";
	}
	include("logged_in_end_of_page.php");
	exit();
}
function delete_job_card_question() {
	$JobParent = $_POST['JobParent'];
	$ClientID = $_POST['ClientID'];
	$JobID = $_POST['JobID'];
	//*************************************************************************************************
	//******************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {        
                // $debug = $_POST['debug'];
                $debugMsg .= "<font class=\"generalFontOnWhite\"><BR>********************************************************************<BR>";
                $debugMsg .= "Debug vars within topIndex002.php<BR>";
                $debugMsg .= "\$_POST['ClientID'] = " . $_POST['ClientID'] . "<BR>";
                $debugMsg .= "\$_POST['login_instance_token'] = " . $_POST['login_instance_token'] . "<BR>"; 
                $debugMsg .= "\$_POST['User_db_token'] = " . $_POST['User_db_token'] . "<BR>"; 
                $debugMsg .= "\$_POST['name'] = " . $_POST['name'] . "<BR>"; 
                $debugMsg .= "\$_POST['pass'] = " . $_POST['pass'] . "<BR>"; 
                $debugMsg .= "\$user_authenticated = $user_authenticated<BR>";
                $debugMsg .= "\$OptionCatch = $OptionCatch<BR><BR>";
	        $debugMsg .= "This -->" . $_POST['OptionCatch'] . "<-- is the \$OptionCatch in topIndex002.php<BR><BR>";
                $debugMsg .= "********************************************************************<BR></font>";
                include("config/debug.php");
        }
        //********************************************************************** DEBUG VARIABLES HERE - END
        //*************************************************************************************************
	echo "<DIV align=\"center\">";
	echo " Are you sure you want to delete this card?<BR><BR>";
	// echo "<A href=\"JobDetails.php?JobID=$JobID\" class=\"linkPlainInWhiteAreas\">No</A><BR><BR>";
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_card\">";
        echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">"; 
        include("log_in_authentication_form_vars.php");
        echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"No\">";
        echo "</form>";
	// echo "<A href=\"JobDetails.php?OptionCatch=DeleteCard&JobID=$JobID&JobParent=$JobParent\" class=\"linkPlainInWhiteAreas\">Yes</A><BR><BR>";
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"delete_job_card\">";
        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
        echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobParent . "\">";
        include("log_in_authentication_form_vars.php");
        echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"Yes\">";
        echo "</form>";
	echo "</DIV>";
	//include("logged_in_end_of_page.php");
	// exit;
}
function job_card() {
        
	$JobID = $_POST['JobID'];
	$JobFkClientID = $_POST['ClientID'];
        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 0;
                if ($turn_this_debug_on == 1) {	
	                $debug = $_POST['debug'];
	                $debugMsg .= "Inside Main() in JobDetails.php<BR>";
	                $debugMsg .= "JobID=$JobID<BR>";
	                $debugMsg .= "\$JobFkClientIDs = $JobFkClientID<BR>";
	                include("config/debug.php"); 
	        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************	
        /**
	$dbst = new dbSession();
	$sqlt = "SELECT * from config WHERE ConfigID = 1 LIMIT 0, 30";
	
	$Resultst = $dbst->getResult($sqlt);
	
	while ($rowt = $dbst->getArray($Resultst)) {
	
	$config_time_zone = $rowt['config_time_zone'];
	$_POST['config_time_zone'] = $config_time_zone;
	}
	//echo "\$config_time_zone = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";
	*/
	
	$dbs = new dbSession();
	
	$sql = "SELECT * from job WHERE JobID = \"$JobID\" LIMIT 0, 1";
	
	$Results = $dbs->getResult($sql);
	
	while ($row = $dbs->getArray($Results)) {
	
	// form was here.	
	//echo "<form method=\"post\" action=\"whiteBoard.php\">";
	
		if (empty($JobFkClientID)) {
			$JobFkClientID = $row['JobFkClientID'];
		} else {
			$JobFkClientID = $JobFkClientID;
		}
		
        $_POST['JobFkClientID'] = $JobFkClientID;

	$ClientID = $JobFkClientID; // This is put here so the Add reminder gets $ClientID.
	
	$JobParent = $row['JobParent'];
	$JobStatus = $row['JobStatus'];
	$JobEstSecs = $row['JobEstSecs'];
	$JobTitle = stripslashes($row['JobTitle']);
	//$JobTitle = $row['JobTitle'];
	$initialJobStatus = $JobStatus;
	$JobType = $row['JobType'];
	$JobFromFkUserID = $row['JobFromFkUserID']; 
	//$JobFkClientID = $row['JobFkClientID'];
	$id = $row['JobFkClientID'];
	$_POST['JobFkClientID'] = $id;
	$JobToFkUserID = $row['JobToFkUserID'];
	$JobTimeInserted = $row['JobTimeInserted'];
	$JobCardNumber = $row['JobCardNumber'];
	$JobDescription = stripslashes($row['JobDescription']);
	$JobParts = stripslashes($row['JobParts']);
	$job_visibility = $row['job_visibility'];
	
	
	$config_time_zone = $_POST['user_time_zone'];
	
	// *****************************************************************************
	// *************************************************** JOB INSERTED TIME - START
	// Takes the unix time stamp and spews it back in the right time zone.
	if ( empty($JobTimeInserted) ) {
		$JobTimeInserted = time();	
                $update_cause_of_no_job_scehd_time = 1;
	}
	$Ad = new DateTime("@$JobTimeInserted");
	$zone_action = new DateTimeZone($config_time_zone);
	$Ad->setTimezone($zone_action);
	$ReadableJobTimeInserted = $Ad->format(DATE_RFC1123);
	
	// ***************************************************** JOB INSERTED TIME - END
	// *****************************************************************************
	
	
	// *****************************************************************************
	// ****************************************************** SCHEDULED TIME - START
	$JobSchedTimeInSecs = $row['JobSchedTimeInSecs'];
	// echo "\$JobSchedTimeInSecs bonobo 1 = $JobSchedTimeInSecs<BR>";
	$update_cause_of_no_job_scehd_time = 0;
	if ( ($JobSchedTimeInSecs == 0) || empty($JobSchedTimeInSecs) ) {
		$JobSchedTimeInSecs = time();
		// $JobSchedTimeInSecs = $StartTime;
		// echo "If there is no \$JobSchedTimeInSecs then \$JobSchedTimeInSecs = $JobSchedTimeInSecs<BR>";
		// 1510653000
                //$time_right_now = $current_date_time->format(DATE_RFC1123);
                //echo "\$time_right_now = $time_right_now<BR>"; 
                $update_cause_of_no_job_scehd_time = 1;
	}
	//****************************************************************
	//******************************************** UNNECESSARY - START
	// Unnecessary as timestamp is unaffected by time zone change.
	// After PHP 5.3 you can get human readable date/ times by 
	// setting the time zone. --> Although I have reinstated the bit
	// that spews back the human readable with the CORRECT time zone.
	
	$Ad_scheduled_time = new DateTime("@$JobSchedTimeInSecs");
        $zone_action = new DateTimeZone($config_time_zone);
        $Ad_scheduled_time->setTimezone($zone_action);
        
        // echo $Ad_scheduled_time->format(DATE_RFC1123) . "<BR>";
        
        // echo $Ad_scheduled_time->format('U') . " <FONT color=\"red\"> Brought from DB into DateTime() and back to unix form.</FONT><BR>";
        /**
        $job_scheduled_time_converted_U = $Ad_scheduled_time->format('U');
        echo "\$JobSchedTimeInSecs = $JobSchedTimeInSecs<BR>";
        echo "\$job_scheduled_time_converted_U = $job_scheduled_time_converted_U<BR>";
        */
	//********************************************** UNNECESSARY - END
	//****************************************************************
	
	// ******************************************************** SCHEDULED TIME - END
	// *****************************************************************************

	$date_time_zone = new DateTimeZone("$config_time_zone");
        $date_time_ready_for_offset = new DateTime("now", $date_time_zone);
        
        
        $time_offset = $date_time_zone->getOffset($date_time_ready_for_offset);
        $_POST['time_offset'] = $time_offset;
        $in_hours = $time_offset / 3600;
        $JobSchedTimeInSecs_plus_offset = $JobSchedTimeInSecs + $time_offset;
	/**
	
	$config_time_zone = $_POST['user_time_zone'];
	$zone_action = new DateTimeZone($config_time_zone);
	$Ad_sched->setTimezone($zone_action);
	$ReadableJobTimeInserted = $Ad_job_inserted_time->format(DATE_RFC1123);
	$ReadableJobTimeInserted_U = $Ad_job_inserted_time->format('U');
	
	$difference_in_sched_time_U = $JobSchedTimeInSecs_plus_offset - $JobSchedTimeInSecs;
	echo "\$JobSchedTimeInSecs = $JobSchedTimeInSecs<BR>";
	// New JobSchedTimeInSecs
	if ($update_cause_of_no_job_scehd_time == 1) {
	        $JobSchedTimeInSecs = $JobSchedTimeInSecs_if_not_in_db;
	}else{
                $JobSchedTimeInSecs = $JobSchedTimeInSecs_plus_offset;
        }
        echo "\$JobSchedTimeInSecs = $JobSchedTimeInSecs<BR>";
        echo "\$JobSchedTimeInSecs_if_not_in_db = $JobSchedTimeInSecs_if_not_in_db <BR>";
        echo "\$ReadableJobTimeInserted_sched = $ReadableJobTimeInserted_sched <BR>";
        echo "\$ReadableJobTimeInserted_sched_U = $ReadableJobTimeInserted_sched_U <BR>";
        */
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {	
	                $debug = $_POST['debug'];
	                $debugMsg .= "Dealing with time zone offsets for schedule of jobs inside Main() in JobDetails.php<BR>";
	                $debugMsg .= "<BR> \$time_offset = $time_offset<BR>";
	                $debugMsg .= "\$_POST['time_offset'] = " . $_POST['time_offset'] . "<BR>";
	                $debugMsg .= "\$in_hours = $in_hours<BR>";
	                $debugMsg .= "\$ReadableJobTimeInserted_sched = $ReadableJobTimeInserted_sched<BR>";
	                $debugMsg .= "\$ReadableJobTimeInserted_sched_U = $ReadableJobTimeInserted_sched_U<BR>";
	                $debugMsg .= "\$ReadableJobTimeInserted = $ReadableJobTimeInserted<BR>";
	                $debugMsg .= "\$ReadableJobTimeInserted_U = $ReadableJobTimeInserted_U<BR>";
	                $debugMsg .= "\$difference_in_sched_time_U = $difference_in_sched_time_U<BR>";
	                include("config/debug.php"); 
	                
	        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
	
	
	
	
	//echo "\$JobTimeInserted =" . $_POST['JobTimeInserted'];
	// $ReadableJobTimeInserted = date("H:i:s d-M-Y",$JobTimeInserted);
	//echo "\$ReadableJobTimeInserted = $ReadableJobTimeInserted";
	//echo date("H:i:s d-M-Y",$JobTimeInserted);

	
	
	
	// include("config/class_detect.php");
	$box_vars = new detect;
	$box_vars->my_box();
	$job_details_textarea_cols = $box_vars->job_details_textarea_cols; // not working so commented out
	// $job_details_textarea_cols = 37;


//**********************************************************************************************
//************************************************************************** TIME ZONE 2 - START
	
	// $Adw = new DateTime("@$JobTimeInserted");
	//$config_time_zone = $_POST['config_time_zone'];
	//$zone_action = new DateTimeZone($config_time_zone);
	//$Adw->setTimezone($zone_action);
	//$ActionDateTime = $Adw->format(DATE_RFC1123);
	
	
	
	
	// $config_time_zone = $_POST['config_time_zone'];
	//echo "\$config_time_zone = $config_time_zone <BR>";
	
	//$MNTTZ = new DateTimeZone($config_time_zone);

	// $dt = new DateTime();

	// $dt->setTimezone($MNTTZ);

	// $StartTime = $dt->format('U');
	
	// $date = new DateTime("@$StartTime");
	// $date->setTimezone($MNTTZ);
	
	
	//echo date("H:i:s", $StartTime);
	
//**************************************************************************** TIME ZONE 2 - END
//**********************************************************************************************

//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {	
	//$debug = $_POST['debug'];
	$debugMsg .= "\$JobTitle = $JobTitle<BR>";
	$debugMsg .= "Current Start Time lll = $ActionDateTime<BR>";
	$debugMsg .= "\$StartTime_lll = $StartTime<BR>";
	$debugMsg .= "\$JobTimeInserted_lll = $JobTimeInserted<BR>";
	$debugMsg .= "\$JobFkClientID = $JobFkClientID<BR>";
	$debugMsg .= "\$JobCardNumber_mtb = $JobCardNumber<BR>";
	$debugMsg .= "\$JobTitleccc = " . $row['JobChild'] . "<BR>";
	$debugMsg .= "\$JobTitleccc = " . stripslashes($row['JobTitle']) . "<BR>";
	$debugMsg .= "\$JobTitleccc = $JobTitle<BR>";
	include("config/debug.php");
	}
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************	
	        
		
		$dbsClientName = new dbSession();
		$sql = "SELECT ClientName from client WHERE ClientID = \"$JobFkClientID\" LIMIT 1";
		$ResultsClient = $dbsClientName->getResult($sql);
		$rowClient = $dbsClientName->getArray($ResultsClient);
		$clientName = $rowClient['ClientName'];
		
		$dbsFromUserFirstName = new dbSession();
		$sql = "SELECT UserFirstname from user WHERE UserID = \"$JobFromFkUserID\" LIMIT 1";
		$ResultsFromUser = $dbsFromUserFirstName->getResult($sql);
		$rowFromUser = $dbsFromUserFirstName->getArray($ResultsFromUser);
		$FromUserFirstname = $rowFromUser['UserFirstname'];
		
		$dbsToUserFirstName = new dbSession();
		$sql = "SELECT UserFirstname from user WHERE UserID = \"$JobToFkUserID\" LIMIT 1";
		$ResultsToUser = $dbsToUserFirstName->getResult($sql);
		$rowToUser = $dbsToUserFirstName->getArray($ResultsToUser);
		$ToUserFirstname = $rowToUser['UserFirstname'];
		

		//$ReadableJobSchedTime = date("H:i:s d-M-Y",$JobSchedTimeInSecs);
		
		// $ReadableJobSchedHour = date("H",$JobSchedTimeInSecs);
		$schedHourMadeTo12HourClock = $Ad_scheduled_time->format('h');
		$JobTimeHour = $schedHourMadeTo12HourClock;
		// $ReadableJobSchedminute = date("i",$JobSchedTimeInSecs);
		$ReadableJobSchedminute = $Ad_scheduled_time->format('i');
		$JobTimeMinute = $ReadableJobSchedminute;
		$schedAmPm = $Ad_scheduled_time->format('a');
		$JobTimeAmPm = $schedAmPm;
		// $ReadableJobSchedDay = date("d",$JobSchedTimeInSecs);
		$ReadableJobSchedDay = $Ad_scheduled_time->format('d');
		$JobTimeDay = $ReadableJobSchedDay;
		// $ReadableJobSchedMonth = date("M",$JobSchedTimeInSecs);
		$ReadableJobSchedMonth = $Ad_scheduled_time->format('M');
		$JobTimeMonth = $ReadableJobSchedMonth;
		// echo "\$JobTimeMonth = $ReadableJobSchedMonth <BR>";
		
		// $ReadableJobSchedMonthDigit = date("m",$JobSchedTimeInSecs);
		$ReadableJobSchedMonthDigit = $Ad_scheduled_time->format('m');
		// echo "\$ReadableJobSchedMonthDigit = $ReadableJobSchedMonthDigit<BR>";
		// $ReadableJobSchedYear = date("Y",$JobSchedTimeInSecs);
		$ReadableJobSchedYear = $Ad_scheduled_time->format('Y');
		$JobTimeYear = $ReadableJobSchedYear;
		
		// echo "\$JobSchedTimeInSecs bonobo 2 = $JobSchedTimeInSecs<BR>";
		//********************************************
	        // For more info look at the date_time_zone_unix.php file I created - DP Fri 6th February 2015 15:39 AEST.
	        // $format = 'Y m d H i s';
	        $format = 'Y m d h i s a P';
	        //echo "hello $JobTimeAmPm<BR>";
                //$date = DateTime::createFromFormat($format, "$JobTimeYear $JobTimeMonth $JobTimeDay $JobTimeMilitary $JobTimeMinute 0");
                $xx = "$JobTimeYear $ReadableJobSchedMonthDigit $JobTimeDay $JobTimeHour $JobTimeMinute 00 " . $JobTimeAmPm . " " . $config_time_zone;
                // echo "\$xx = $xx<BR>";
                $Sched_time_reconstituted = DateTime::createFromFormat($format, $xx );
                //$date->format('Y-m-d H:i:s');
                $JobSchedTimeInSecs = $Sched_time_reconstituted->format('U');
                /** echo "\$JobSchedTimeInSecs bonobo 2.5 = $JobSchedTimeInSecs<BR>";
                echo "This is the \$JobSchedTimeInSecs before the time offset";
                echo $Ad_scheduled_time->format('U') . "<BR>";
                echo $Ad_scheduled_time->format(DATE_RFC1123) . " reconsituted date <BR><BR>"; */
		/**
		if ($ReadableJobSchedHour >= 13) {
			$schedHourMadeTo12HourClock = $ReadableJobSchedHour - 12;
			$schedAmPm = "PM";
		}elseif ($ReadableJobSchedHour == 12) {
			$schedHourMadeTo12HourClock = $ReadableJobSchedHour;
			$schedAmPm = "PM";
		}else{
			$schedHourMadeTo12HourClock = $ReadableJobSchedHour;
			$schedAmPm = "AM";
		} */
                
                $debugMsg .= "\$ReadableJobSchedTime = $ReadableJobSchedTime<BR /><BR>";
		$debugMsg .= "\$JobSchedTimeInSecs = $JobSchedTimeInSecs<BR /><BR>";
		$debugMsg .= "\$ReadableJobSchedHour = $ReadableJobSchedHour<BR /><BR>";
		$debugMsg .= "\$ReadableJobSchedminute = $ReadableJobSchedminute<BR /><BR>";
		$debugMsg .= "\$ReadableReminderSchedHourlyyyyyyyyyy = $ReadableReminderSchedHour<BR /><BR>";
		$debugMsg .= "\$ReadableReminderSchedMonthDigit = $ReadableReminderSchedMonthDigit<BR /><BR>";
		$debugMsg .= "\$ReadableReminderSchedHourlyyyyyyyyyy = $ReadableReminderSchedHour<BR /><BR>";
		$debugMsg .= "\$ReadableReminderSchedMonthDigit = $ReadableReminderSchedMonthDigit<BR /><BR>";
		include("config/debug.php");
		
		$_POST['JobParent_a'] = $row[JobParent];
	

	// echo "<form method=\"post\" action=\"$PHP_SELF\">";
	
	echo "<H3>Job card</H3>";
	
        ?>                    
        <div class="container">
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                For Client
                        </div>
                        <div class="three columns" style="margin-top: 1%; text-align: left;">
                        <?PHP
                            /* DP 22/3/2108 The following is testing putting normal href links back into parts
                            of the code so that a link can be right clicked and opened in a 
                            new window. For example the client name at the top of the job card
                            should have a way of seeing the client card details and mofying them 
                            on the fly without disturbing the action timing against the job card.
                            */
                            /*
                            echo "<a href=\"index.php?OptionCatch=client_details&ClientID=$ClientID&StartTime=$StartTime\">test</a><br>";
                            client_button_with_start_time_href($ClientID,$StartTime); */
                            client_button_with_start_time($ClientID,$StartTime);
                            client_phone($ClientID,$StartTime);
                        ?>
                        </div>
                        <div class="five columns" style="margin-top: 1%; text-align: left;">
                                <?PHP
                                // client_button_with_start_time($ClientID,$StartTime);
                                echo "<form method=\"post\" action=\"$PHP_SELF\">";
                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"SearchClient7\">";
                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">"; 
                                include("log_in_authentication_form_vars.php");
                                echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"Change\">";
                                echo "</form>";        
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                Fault / JobTitle
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP 
                                echo "<form method=\"post\" action=\"$PHP_SELF\">";
                                echo "<TEXTAREA tabindex=\"24\" rows=\"5\" cols=\"$job_details_textarea_cols\" 
				name=\"JobTitle\" WRAP=\"virtual\">$JobTitle</TEXTAREA>";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                Repairs / Deatails
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP 
                                echo "<TEXTAREA tabindex=\"24\" rows=\"5\" cols=\"$job_details_textarea_cols\" 
				name=\"JobDescription\" WRAP=\"virtual\">$JobDescription</TEXTAREA>";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                Parts
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP 
                                echo "<TEXTAREA tabindex=\"24\" rows=\"5\" cols=\"$job_details_textarea_cols\" 
				name=\"JobParts\" WRAP=\"virtual\">$JobParts</TEXTAREA>";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                JobID - JobCardNumber
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP 
                                // echo "<form method=\"post\" action=\"$PHP_SELF\">";
                                echo "$JobID - <input type=\"text\" width=\"15\" name=\"JobCardNumber\" tabindex=\"9\"  value=\"$JobCardNumber\">";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                Job parent
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP 
                                echo "<input type=\"text\" width=\"15\" name=\"JobParent\" tabindex=\"9\"  value=\"$JobParent\">";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="twelve columns" style="margin-top: 1%; text-align: left;">
                                <B>Date Job Added </B>
                                <?PHP 
                                echo "<input type=\"hidden\" name=\"JobTimeInserted\" value=\"$JobTimeInserted\">$ReadableJobTimeInserted";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                JobStatus
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP 
                                echo "  <SELECT name=\"JobStatus\" tabindex=\"3\"\">
		                        <OPTION  value=\"$JobStatus\">$JobStatus
		                        <OPTION  value=\"Active\">Active
		                        <OPTION  value=\"Job Complete\">Job Complete
		                        </SELECT>  
		                        <!-- 
		                        <TD>JobType</TD>
		                        <TD><select name=\"JobType\" tabindex=\"3\"\">
		                        <OPTION  value=\"$JobType\">$JobType
		                        <OPTION  value=\"Onsite\">Onsite
		                        <OPTION  value=\"WorkShop\">WorkShop
		                        </SELECT>
		                        </TD>
	                                </TR> -->";
	                                echo "<input type=\"hidden\" name=\"JobType\" value=\"WorkShop\">";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                AssignedBy
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP 
                                echo "<input type=\"hidden\" name=\"JobFromFkUserID\" value=\"$JobFromFkUserID\">";
			        echo $FromUserFirstname ;
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                AssignedTo
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP 
                                echo "<SELECT name=\"JobToFkUserID\">";
				echo "<OPTION value=\"$JobToFkUserID\">$ToUserFirstname";
				$dbs = new dbSession();
				$sql = "SELECT UserFirstname, UserID from user";
				$Results = $dbs->getResult($sql);
				
					while ($row = $dbs->getArray($Results)) {
						// $optValue = $row['UserID'];				
						echo "<OPTION value=\"$row[UserID]\">$row[UserFirstname]";
						}
				echo "</SELECT>";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                Scheduled Time
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP 
                                	echo "<TABLE>	
		                                <TR>
			                                <TD></TD>
			                                <TD>
			                                <select name=\"JobTimeHour\" tabindex=\"3\"\">
			                                <OPTION  value=\"$schedHourMadeTo12HourClock\">$schedHourMadeTo12HourClock
                                ";
			                                $timeHourOption = "0";
			                                while ($timeHourOption <= "11") {		
				                                $timeHourOption = $timeHourOption + 1;
				                                echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
			                                }

                                echo "
			                                </SELECT>
			
			                                :
			                                <select name=\"JobTimeMinute\" tabindex=\"4\">
			                                <OPTION  value=\"$ReadableJobSchedminute\">$ReadableJobSchedminute
                                ";
			                                $timeMinuteOption = "00";
			                                echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
			                                while ($timeMinuteOption <= "40") {		
				                                $timeMinuteOption = $timeMinuteOption + 10;
				                                echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
			                                }

                                echo "
			                                </SELECT>

			                                <select name=\"JobTimeAmPm\" tabindex=\"5\">
			                                <OPTION  value=\"$schedAmPm\">$schedAmPm
			                                <OPTION  value=\"am\">am
			                                <OPTION  value=\"pm\">pm
			                                </SELECT>

			                                <!-- Day -->
			                                <select name=\"JobTimeDay\" tabindex=\"6\">
			                                <OPTION  value=\"$ReadableJobSchedDay\">$ReadableJobSchedDay
                                ";
			                                $timeDayOption = 0;
			                                while ($timeDayOption <= "30") {		
				                                $timeDayOption = $timeDayOption + 1;
				                                echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
				
			                                }

                                echo "
			                                </SELECT>

			                                <!-- Month -->
			                                <SELECT name=\"JobTimeMonth\" tabindex=\"7\">
			                                <OPTION  value=\"$ReadableJobSchedMonthDigit\">$ReadableJobSchedMonth
			                                <OPTION  value=\"1\">January
			                                <OPTION  value=\"2\">February
			                                <OPTION  value=\"3\">March
			                                <OPTION  value=\"4\">April
			                                <OPTION  value=\"5\">May
			                                <OPTION  value=\"6\">June
			                                <OPTION  value=\"7\">July
			                                <OPTION  value=\"8\">August
			                                <OPTION  value=\"9\">September
			                                <OPTION  value=\"10\">October
			                                <OPTION  value=\"11\">November
			                                <OPTION  value=\"12\">December
			                                </SELECT>

			                                <!--Year-->
			                                <select name=\"JobTimeYear\" tabindex=\"8\"\">
			                                <OPTION  value=\"$ReadableJobSchedYear\">$ReadableJobSchedYear
                                ";
			                                $timeYearOptionSeconds = time(); //echo date("H:i:s");
			                                $timeYearOption = date("Y");
			                                $timeYearOptionLimit = $timeYearOption + 5;
			                                while ($timeYearOption <= $timeYearOptionLimit) {		
				                                echo "<OPTION  value=\"$timeYearOption\">$timeYearOption";
				                                $timeYearOption = $timeYearOption + 1;
			                                }

			                                $jobEstimatedHours = date("H", mktime(0,0,$JobEstSecs));
			                                $jobEstimatedMins = date("i", mktime(0,0,$JobEstSecs));
			                                $estimatedSecs = date("s", mktime(0,0,$JobEstSecs));
			                                $jobEstimatedDays = floor(($JobEstSecs / 86400));
			
			                                $JobTotalTimeDaysDays = "00";

			                                $estimatedDaysInSecs = $jobEstimatedDays * 86400;
			                                $estimatedHoursInSecs = $jobEstimatedHours * 3600;
			                                $estimatedMinsInSecs = $jobEstimatedMins * 60;
			
			
			                                $totalEstimatedTime = ($estimatedDaysInSecs + $estimatedHoursInSecs + $estimatedMinsInSecs + $jobEstimatedSec);

			
			
                                echo "
			                                </SELECT>
			                                <BR>in the $config_time_zone time zone.
			                                </TD>
		                                </TR>
	                                </TABLE>";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                        <?PHP 

	                        $dbs = new dbSession();
	                        $sql = "SELECT * from action WHERE ActionFkJobID = \"$JobID\" ORDER BY ActionDateSecs DESC";
	                        $Results = $dbs->getResult($sql);
	
	                        while ($row = $dbs->getArray($Results)) {
		
		                        $ActionTotalSecs = $row['ActionTotalSecs'];
		                        $ActionTotalBreakSecs = $row['ActionTotalBreakSecs'];

		                        /**

			                        global $debug;
			                        $debugMsg .= "ssssssssss\$ActionTotalBreakSecs = $ActionTotalBreakSecs<BR>";
			                        $debugMsg .= "ssssssssss\$ActionCumulativeTime = $ActionCumulativeTime<BR>";
			                        include("config/tpl_bodystart.php");
		                        */


		                        $ActionCumulativeTime = $ActionCumulativeTimeTotal;
		                        $ActionCumulativeTimeTotal = $ActionTotalSecs - $ActionTotalBreakSecs + $ActionCumulativeTime;
	                        }

	                        // echo "B \$ActionCumulativeTimeTotal $ActionCumulativeTimeTotal = \$ActionTotalSecs $ActionTotalSecs - \$ActionTotalBreakSecs $ActionTotalBreakSecs + \$ActionCumulativeTime $ActionCumulativeTime <BR><BR>";
	                        $ActionCumulativeTimeTotalReadableDay = floor(($ActionCumulativeTimeTotal / 86400));
	                        $ActionCumulativeTimeTotalReadable = date("H:i:s", mktime(0,0,$ActionCumulativeTimeTotal));
	                        $ActionCumulativeTimeTotalReadableHour = date("H", mktime(0,0,$ActionCumulativeTimeTotal));
	                        $ActionCumulativeTimeTotalReadableMin = date("i", mktime(0,0,$ActionCumulativeTimeTotal));
	                        $ActionCumulativeTimeTotalReadableSec = date("s", mktime(0,0,$ActionCumulativeTimeTotal));

	                        // echo "eeee\$ActionCumulativeTimeTotal = $ActionCumulativeTimeTotal<BR><BR>";
	                        // echo "eeee\$totalEstimatedTime = $totalEstimatedTime<BR><BR>";

	                        // *************************************
	                        // Caculating the difference in the ob estimate to the actual job time
	                        // So that we can display it in ms and as a percentage - Start
	                        $total_Difference_In_Logged_Time_To_Estimated_Time = $totalEstimatedTime - $ActionCumulativeTimeTotal;
	
	                        $difference_direction_Prenote = 'Completed in';
	                        $difference_direction = 'of the time estimated';

	                        if ($total_Difference_In_Logged_Time_To_Estimated_Time < 0) {

		                        $total_Difference_In_Logged_Time_To_Estimated_Time = $total_Difference_In_Logged_Time_To_Estimated_Time * -1;

		                        $difference_direction_Prenote = '';
		                        $difference_direction = 'Longer';

	                        }
	                        // echo "\$totalEstimatedTime = $totalEstimatedTime<BR><BR>";	
	                        // echo "\$total_Difference_In_Logged_Time_To_Estimated_Time = $total_Difference_In_Logged_Time_To_Estimated_Time<BR>";
	                        // echo "\$ActionCumulativeTimeTotal = $ActionCumulativeTimeTotal<BR><BR>";

	                        if ($ActionCumulativeTimeTotal < $totalEstimatedTime) {
		                        $Percentage_Time_Differnece = ($ActionCumulativeTimeTotal / $totalEstimatedTime);
	                        } else {
		                        $Percentage_Time_Differnece = ($ActionCumulativeTimeTotal / $totalEstimatedTime);
	                        }


	                        $Percentage_Time_Differnece = round($Percentage_Time_Differnece * 100);
		                        /**
		                        global $debug;
		                        $debugMsg .= "Top<BR>";
		                        $debugMsg .= "\$totalEstimatedTime = $totalEstimatedTime<BR>";
		                        $debugMsg .= "\$ActionCumulativeTimeTotal = $ActionCumulativeTimeTotal<BR>";
		                        $debugMsg .= "\$total_Difference_In_Logged_Time_To_Estimated_Time = $total_Difference_In_Logged_Time_To_Estimated_Time<BR>";
		                        include("config/tpl_bodystart.php");
		                        */
	
	
	                        if ($total_Difference_In_Logged_Time_To_Estimated_Time >= 86400) {
		                        /**
		                        global $debug;
		                        $debugMsg .= "Top<BR>";
		                        $debugMsg .= "\$total_Difference_In_Logged_Time_To_Estimated_Time = $total_Difference_In_Logged_Time_To_Estimated_Time<BR>";
		                        include("config/tpl_bodystart.php");
		                        */

		                        $job_Difference_Days = floor(($total_Difference_In_Logged_Time_To_Estimated_Time / 86400));
		
	                        } elseif ($total_Difference_In_Logged_Time_To_Estimated_Time <= -86400) {
		                        /**
		                        global $debug;
		                        $debugMsg .= "Bottom<BR>";
		                        $debugMsg .= "\$total_Difference_In_Logged_Time_To_Estimated_Time = $total_Difference_In_Logged_Time_To_Estimated_Time<BR>";
		                        include("config/tpl_bodystart.php");
		                        */

		                        $job_Difference_Days = floor(($total_Difference_In_Logged_Time_To_Estimated_Time / 86400));

	                        } else {

		                        $job_Difference_Days = 0;

	                        }

	                        $job_Difference_Hours = floor(($total_Difference_In_Logged_Time_To_Estimated_Time / 3600));
	                        if ($job_Difference_Hours >= 24) {

		                        $job_Difference_Hours = $job_Difference_Hours - ($job_Difference_Days * 24);

	                        } elseif ($job_Difference_Hours <= -24){
		
		                        $job_Difference_Hours = $job_Difference_Hours - ($job_Difference_Days * 24);
		
	                        } else {

		                        $job_Difference_Hours = $job_Difference_Hours;

	                        }

	                        $job_Difference_Mins = floor(($total_Difference_In_Logged_Time_To_Estimated_Time / 60));
	                        // echo "\$job_Difference_Mins = $job_Difference_Mins";
	                        if ($job_Difference_Mins >= 60) {
		                        /**
		                        global $debug;
		                        $debugMsg .= "Working out Mins<BR /><BR>";
		                        $debugMsg .= "\$job_Difference_Mins = $job_Difference_Mins<BR>";
		                        $debugMsg .= "minus \$$ActionCumulativeTimeTotalReadableDay = $ActionCumulativeTimeTotalReadableDay * 24 * 60 <BR>";
		                        $debugMsg .= "minus \$ActionCumulativeTimeTotalReadableHour $ActionCumulativeTimeTotalReadableHour * 60 <BR>";
		                        include("config/tpl_bodystart.php");
		                        */
		                        $job_Difference_Mins = $job_Difference_Mins - ($job_Difference_Days * 24 * 60) - ($job_Difference_Hours * 60) + 1;

	                        } else {

		                        $job_Difference_Mins = $job_Difference_Mins;
		                        // $total_Difference_In_Logged_Time_To_Estimated_Time = 0;

	                        }

	                        $job_Difference_Sec = floor(($total_Difference_In_Logged_Time_To_Estimated_Time));
	                        if ($job_Difference_Sec >= 60) {
		                        /**
		                        global $debug;
		                        $debugMsg .= "Working out Mins<BR /><BR>";
		                        $debugMsg .= "\$job_Difference_Sec = $job_Difference_Sec<BR>";
		                        $debugMsg .= "minus \$$ActionCumulativeTimeTotalReadableDay = $ActionCumulativeTimeTotalReadableDay * 24 * 60 <BR>";
		                        $debugMsg .= "minus \$ActionCumulativeTimeTotalReadableHour $ActionCumulativeTimeTotalReadableHour * 60 <BR>";
		                        include("config/tpl_bodystart.php");
		                        */
		                        $job_Difference_Sec = $job_Difference_Sec - ($job_Difference_Days * 86400) - ($job_Difference_Hours * 3600) - ($job_Difference_Mins * 60)+ 1;

	                        } else {

		                        $job_Difference_Sec = $job_Difference_Sec;
		                        // $total_Difference_In_Logged_Time_To_Estimated_Time = 0;

	                        }
	                        // Caculating the difference in the ob estimate to the actual job time
	                        // So that we can display it in ms and as a percentage - End
	                        // *************************************
	
		
                        // echo "\$JobSchedTimeInSecs bonobo 4 = $JobSchedTimeInSecs<BR>";		
	
                        echo "Estimated Time";
                        ?>
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP 
                                echo "          <input tabindex=\"9\" type=\"text\" name=\"jobEstimatedDays\" size=\"3\" value=\"$jobEstimatedDays\"> Days
			                        <input tabindex=\"10\" type=\"text\" name=\"jobEstimatedHours\" size=\"2\" value=\"$jobEstimatedHours\"> Hours
			                        <input tabindex=\"11\" type=\"text\" name=\"jobEstimatedMins\" size=\"2\" value=\"$jobEstimatedMins\"> Minutes
			                        <input tabindex=\"11.5\" type=\"text\" name=\"jobEstimatedSec\" size=\"2\" value=\"$estimatedSecs\"> Seconds";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                <?PHP
                                        // echo "\$JobSchedTimeInSecs bonobo 3 = $JobSchedTimeInSecs<BR>";
				        // echo "<SELECT name=\"JobFromFkUserID\">";
				        //echo "<OPTION value=\"$JobFromFkUserID\">$FromUserFirstname";
				
				        //$dbs = new dbSession();
				        //$sql = "SELECT UserFirstname, UserID from user";
				        //$Results = $dbs->getResult($sql);
				        /**
					        while ($row = $dbs->getArray($Results)) {
						        // $optValue = $row['UserID'];				
						        echo "<OPTION value=\"$row[UserID]\">$row[UserFirstname]";
						        }
				        echo "</SELECT>"; */
	
                                        echo "Actual Calculated Time";
			                                
                                ?>
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP 
                                        echo " 
                                        $ActionCumulativeTimeTotalReadableDay Days
	                                $ActionCumulativeTimeTotalReadableHour Hours
	                                $ActionCumulativeTimeTotalReadableMin Minutes
	                                $ActionCumulativeTimeTotalReadableSec Seconds

	                                <!-- Logged time + Action times = $ActionCumulativeTimeTotalReadableDay days $ActionCumulativeTimeTotalReadable  -->
                                        "; 
                                        //$JobTotalTimeDaysDays $JobTotalTimeHour $JobTotalTimeMins 
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                        </div>
                <?PHP 
                ?>
                </div>
        </div>
        <?PHP
        ?>                      
        <div class="container">
                <div class="row">
                        <div class="twelve columns" style="margin-top: 1%; text-align: left;">
                                <?PHP
echo "
		                        <!--<TR>
			                        <TD>Time dif from Estimation</TD>
			                        <TD>
			                        Days<input tabindex=\"9\" type=\"text\" name=\"\" size=\"3\" value=\"$job_Difference_Days\">
			                        Hours<input tabindex=\"10\" type=\"text\" name=\"\" size=\"2\" value=\"$job_Difference_Hours\">
			                        Minutes<input tabindex=\"11\" type=\"text\" name=\"\" size=\"2\" value=\"$job_Difference_Mins\">
			                        Seconds<input tabindex=\"11.5\" type=\"text\" name=\"\" size=\"2\" value=\"$job_Difference_Sec\">
			                         $difference_direction  by $total_Difference_In_Logged_Time_To_Estimated_Time seconds.
			                        </TD>
			                        <TD>
			                        </TD>
		                        </TR>
		                        <TR>
			                        <TD>Percentage Difference</TD>
			                        <TD>$difference_direction_Prenote $Percentage_Time_Differnece % $difference_direction
			                        </TD>
			                        <TD>
			                        </TD>
		                        </TR> -->
                        <!-- 		<TR>
			                        <TD>Adjusted Time</TD>
			                        <TD>
			                        <input tabindex=\"9\" type=\"text\" name=\"adjustedDays\" size=\"3\" value=\"$JobTotalTimeDays\">
			                        Days
			                        <input tabindex=\"10\" type=\"text\" name=\"adjustedHours\" size=\"2\" value=\"$JobTotalTimeHour\">
			                        Hours
			                        <input tabindex=\"11\" type=\"text\" name=\"adjustedMins\" size=\"2\" value=\"$JobTotalTimeMins\">
			                        Minutes
			                        </TD>
			                        <TD>
			                        </TD>
		                        </TR>
		                        <TR>
			                        <TD>Adjusted Time Comments</TD>
			                        <TD>
				                        <TEXTAREA tabindex=\"24\" rows=\"1\" cols=\"$job_details_textarea_cols\" 
				                        name=\"JobTitle\" WRAP=\"virtual\">$clockComment</TEXTAREA>
			                        </TD>
		                        </TR>	 
		                        <TR>
			                        <TD>Fault / JobTitle</TD>
			                        <TD>
				                        <TEXTAREA tabindex=\"24\" rows=\"5\" cols=\"$job_details_textarea_cols\" 
				                        name=\"JobTitle\" WRAP=\"virtual\">$JobTitle</TEXTAREA>
				                        <BR>
			                        </TD>
		                        </TR>
		                        <TR>
			                        <TD>Repairs / Deatails</TD>
			                        <TD>
				                        <TEXTAREA tabindex=\"24\" rows=\"5\" cols=\"$job_details_textarea_cols\" 
				                        name=\"JobDescription\" WRAP=\"virtual\">$JobDescription</TEXTAREA>
				                        <BR>
			                        </TD>
		                        </TR>
		                        <TR>
			                        <TD>Parts   </TD>
			                        <TD>
				                        <TEXTAREA tabindex=\"24\" rows=\"5\" cols=\"$job_details_textarea_cols\" 
				                        name=\"JobParts\" WRAP=\"virtual\">$JobParts</TEXTAREA>
				                        <BR>
			                        </TD>
		                        </TR> -->
		                        </TABLE>
	                                ";
	
	                                if (empty($StartTime)) {
				                                //$StartTime = time();
				                                // echo "\$StartTime = $StartTime";
				                                $config_time_zone = $_POST['config_time_zone'];
				                                $MNTTZ = new DateTimeZone($config_time_zone);

				                                $dt = new DateTime();

				                                $dt->setTimezone($MNTTZ);

				                                $StartTime = $dt->format('U');
	                                }    
	                        ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                <?PHP
                                        echo "Visibility<BR>";  
                                        echo "\$job_visibility = $job_visibility"; 
                                ?>
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP
                                if ($job_visibility == 2) {
                                        $jv_public = "checked";
                                        $jv_users = "";                                
                                }else{
                                        $jv_public = "";
                                        $jv_users = "checked"; 
                                }
	                                echo "Public        <input type=\"radio\" name=\"job_visibility\" value=\"2\"" . $jv_public . "><BR>";
	                                echo "Users Only    <input type=\"radio\" name=\"job_visibility\" value=\"0\"" . $jv_users . ">";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                <?PHP
                                        
                                ?>
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP
                                        // echo "<form method=\"post\" action=\"$PHP_SELF\">";
	                                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	                                echo "<input type=\"hidden\" name=\"time_offset\" value=\"$time_offset\">";
	                                echo "<input type=\"hidden\" name=\"JobFkClientID\" value=\"$JobFkClientID\">";
	                                echo "<input type=\"hidden\" name=\"initialJobStatus\" value=\"$initialJobStatus\">";
	                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"edit_job_card\">";
	                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	                                echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
	                                echo "<input type=\"hidden\" name=\"JobID\" value=\"$JobID\">";
	                                // echo "\$JobSchedTimeInSecs bonobo 5 = $JobSchedTimeInSecs<BR>";
	                                echo "<input type=\"hidden\" name=\"JobSchedTimeInSecs\" value=\"" . $JobSchedTimeInSecs . "\">";
	                                include("log_in_authentication_form_vars.php");
	                                echo "<input type=\"submit\" tabindex=\"18\" name=\"Submit\" value=\"Apply Changes\">";
	                                echo "</form>";
                                ?>
                        </div>
                </div>
                <div class="row">
                        <div class="four columns" style="margin-top: 1%; text-align: left;">
                                <?PHP
                                        
                                ?>
                        </div>
                        <div class="eight columns" style="margin-top: 1%; text-align: left;">
                                <?PHP
                                        echo "<form method=\"post\" action=\"$PHP_SELF\">";
	                                $JobParent_a = $_POST['JobParent_a'];
	                                echo "<input type=\"hidden\" name=\"JobID\" value=\"$JobID\">";
	                                echo "<input type=\"hidden\" name=\"JobFkClientID\" value=\"$JobFkClientID\">";
	                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"$JobFkClientID\">";
	                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	                                echo "<input type=\"hidden\" name=\"JobParent\" value=\"$JobParent_a\">";
	                                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"delete_job_card_question\">";
	                                echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
	                                include("log_in_authentication_form_vars.php");
	                                echo "<input type=\"submit\" tabindex=\"19\" name=\"Submit\" value=\"DeleteCard\">";
	                                echo "</form>";
                                ?>
                        </div>
                </div>
        <?PHP
	}
	echo "<div>";
}


function edit_job_card() {
        $config_time_zone = $_POST['config_time_zone'];
        // echo "\$config_time_zone bonobo = $config_time_zone <BR>"; 
	$id = $_POST['id'];
	$ClientID = $_POST['ClientID'];
	$name = $_POST['name']; 
	$InsertIntoDatabase = $_POST['InsertIntoDatabase'];
	$JobID = $_POST['JobID'];
	$JobType = $_POST['JobType'];
	$JobFkClientID = $_POST['JobFkClientID'];
	$JobFromFkUserID = $_POST['JobFromFkUserID'];
	$JobToFkUserID = $_POST['JobToFkUserID'];
	$JobParent = $_POST['JobParent'];
	$JobChild = $_POST['JobChild'];
	$JobTimeInserted = $_POST['JobTimeInserted'];
	$JobCardNumber = $_POST['JobCardNumber'];
	$JobTitle = addslashes($_POST['JobTitle']);
	$JobDescription = addslashes($_POST['JobDescription']);
	$JobParts = addslashes($_POST['JobParts']);
	$JobTimeHour = $_POST['JobTimeHour'];
	$JobTimeMinute = $_POST['JobTimeMinute'];
	$JobTimeAmPm = $_POST['JobTimeAmPm'];
	$schedAmPm = $_POST['schedAmPm'];
	$JobTimeDay = $_POST['JobTimeDay'];
	$JobTimeMonth = $_POST['JobTimeMonth'];
	$JobTimeYear = $_POST['JobTimeYear'];
	$jobMessage = $_POST['jobMessage'];
	$JobStatus = $_POST['JobStatus'];
	$initialJobStatus = $_POST['initialJobStatus'];
	$jobEstimatedDays = $_POST['jobEstimatedDays'];
	$jobEstimatedHours = $_POST['jobEstimatedHours'];
	$jobEstimatedMins = $_POST['jobEstimatedMins'];
	$jobEstimatedSec = $_POST['jobEstimatedSec'];
	$JobSchedTimeInSecs = $_POST['JobSchedTimeInSecs'];
	$job_visibility = $_POST['job_visibility'];
	// echo "\$JobSchedTimeInSecs bonobo 6 = $JobSchedTimeInSecs<BR>";

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {	
				$debug = $_POST['debug'];
				$debugMsg .= "In EditDetails() in JobDetails.php<BR>";
				$debugMsg .= "\$JobTitle = $JobTitle<BR>";
				$debugMsg .= "\$JobIDrrr = $JobID<BR>";
				$debugMsg .= "\$JobStatus = $JobStatus<BR>";
				$debugMsg .= "\$initialJobStatus= $initialJobStatus<BR>";
				$debugMsg .= "\$JobCardNumber = $JobCardNumber<BR><BR>";
				$debugMsg .= "\$JobTimeHour = $JobTimeHour<BR>";
				$debugMsg .= "\$StartTime = $StartTime<BR>";
				$debugMsg .= "\$estimatedDays = $estimatedDays<BR>";
				$debugMsg .= "\$JobTimeMinute = $JobTimeMinute<BR>";
				$debugMsg .= "\$JobTimeAmPm = $JobTimeAmPm<BR>";
				$debugMsg .= "\$schedAmPm = $schedAmPm<BR>";
				$debugMsg .= "\$JobTimeDay = $JobTimeDay<BR>";
				$debugMsg .= "\$JobTimeMonth = $JobTimeMonth<BR>";
				$debugMsg .= "\$JobTimeYear = $JobTimeYear<BR>";
				$debugMsg .= "\$JobParent = $JobParent<BR>";
				$debugMsg .= "\$JobSchedTimeInSecs = $JobSchedTimeInSecs<BR>";
				$debugMsg .= "\$total_Difference_In_Logged_Time_To_Estimated_Time = $total_Difference_In_Logged_Time_To_Estimated_Time<BR>";
				include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************
	// echo "In the function itself<BR>";
	/**
	if (($JobTimeAmPm == "PM") AND ($JobTimeHour <= 12)) {

		$JobTimeMilitary = $JobTimeHour + 12;

	}else{
		$JobTimeMilitary = $JobTimeHour;
	} */
	$Ad_scheduled_time = new DateTime("@$JobSchedTimeInSecs");
        $zone_action = new DateTimeZone($config_time_zone);
        $Ad_scheduled_time->setTimezone($zone_action);
        
	// echo "\$JobTimeHour = $JobTimeHour<BR>";
	// echo "\$JobTimeAmPm = $JobTimeAmPm<BR>";
	
	$estimatedDaysInSecs = $jobEstimatedDays * 86400;
	$estimatedHoursInSecs = $jobEstimatedHours * 3600;
	$estimatedMinsInSecs = $jobEstimatedMins * 60;
	// echo "nnnn\$jobEstimatedSec = $jobEstimatedSec<BR><BR>";
	$totalEstimatedTime = ($estimatedDaysInSecs + $estimatedHoursInSecs + $estimatedMinsInSecs + $jobEstimatedSec);
	// echo "nnnn\$totalEstimatedTime = $totalEstimatedTime<BR><BR>";
	// echo "nnnn\$ActionCumulativeTimeTotal = $ActionCumulativeTimeTotal<BR><BR>";
	$total_Difference_In_Logged_Time_To_Estimated_Time = $totalEstimatedTime - $ActionCumulativeTimeTotal;
	
	
	
	// $JobSchedTimeInSecs = mktime($JobTimeMilitary,$JobTimeMinute,0,$JobTimeMonth,$JobTimeDay,$JobTimeYear);
	//********************************************
	// For more info look at the date_time_zone_unix.php file I created - DP Fri 6th February 2015 15:39 AEST.
	// $format = 'Y m d H i s';
	$format = 'Y m d h i s a P';
	//echo "hello $JobTimeAmPm<BR>";
        //$date = DateTime::createFromFormat($format, "$JobTimeYear $JobTimeMonth $JobTimeDay $JobTimeMilitary $JobTimeMinute 0");
        $xx = "$JobTimeYear $JobTimeMonth $JobTimeDay $JobTimeHour $JobTimeMinute 00 " . $JobTimeAmPm . " " . $config_time_zone;
       //  echo "<FONT color=\"red\"> \$xx = $xx<BR>";
        $Ad_scheduled_time = DateTime::createFromFormat($format, $xx );
        //$date->format('Y-m-d H:i:s');
        $JobSchedTimeInSecs = $Ad_scheduled_time->format('U');
       // echo "This is the \$JobSchedTimeInSecs before the time offset</FONT>";
        // echo $Ad_scheduled_time->format('U') . "<BR>";
        // echo $Ad_scheduled_time->format(DATE_RFC1123) . " reconsituted date <BR><BR>";
        
        // $zone_action = new DateTimeZone($config_time_zone);
        // $date->setTimezone($zone_action);
        // echo $date->format('U') . "<BR>";
        // echo $date->format(DATE_RFC1123) . "<BR><BR>";
        //********************************************
	// $JobSchedTimeInSecs = $JobSchedTimeInSecs - $_POST['time_offset'];
	// echo "This is the \$JobSchedTimeInSecs AFTER the time offset" . $JobSchedTimeInSecs . "<BR>";	
	$dbsUpdateJobCard = new dbSession();

	echo "<DIV align=\"center\">";
	
//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {	
				$debug = $_POST['debug'];
				$debugMsg .= "Near conversion back from military time in EditDetails() in JobDetails.php<BR>";
				$debugMsg .= "\$_POST[\'time_offset\'] = " . $_POST['time_offset'] . "<BR>";
				$debugMsg .= "\$JobIDzzzzzzzzz = $JobID<BR>";
				$debugMsg .= "\$JobCardNumber = $JobCardNumber<BR>";
				$debugMsg .= "\$JobTimeHour = $JobTimeHour<BR>";
				$debugMsg .= "\$StartTime = $StartTime<BR>";
				$debugMsg .= "\$estimatedDays = $estimatedDays<BR>";
				$debugMsg .= "\$JobTimeMinute = $JobTimeMinute<BR>";
				$debugMsg .= "\$JobTimeAmPm = $JobTimeAmPm<BR>";
				$debugMsg .= "\$JobTimeDay = $JobTimeDay<BR>";
				$debugMsg .= "\$JobTimeMonth = $JobTimeMonth<BR>";
				$debugMsg .= "\$JobTimeYear = $JobTimeYear<BR>";
				$debugMsg .= "\$JobParent = $JobParent<BR>";
				$debugMsg .= "\$total_Difference_In_Logged_Time_To_Estimated_Time = $total_Difference_In_Logged_Time_To_Estimated_Time<BR>";
				include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************
	$sql = "UPDATE job SET JobCardNumber = '$JobCardNumber', JobStatus = '$JobStatus', JobType = '$JobType', JobFkClientID = '$JobFkClientID', JobFromFkUserID = '$JobFromFkUserID', JobToFkUserID = '$JobToFkUserID', JobParent = '$JobParent', JobTimeInserted = '$JobTimeInserted', JobSchedTimeInSecs = '$JobSchedTimeInSecs', JobEstSecs = '$totalEstimatedTime', JobTitle = '$JobTitle', JobDescription = '$JobDescription', JobParts = '$JobParts', job_visibility = '$job_visibility' WHERE JobID = '$JobID'";

	//$sql = "UPDATE job SET JobCardNumber = '$JobCardNumber' WHERE JobID = '$JobID'";
	$dbs_up = new dbSession();
			$sql_up = "SELECT * from job WHERE JobID = $JobID"; 
			//echo $sql_up . "<BR>"; 
			$Results_up = $dbs_up->getResult($sql_up);
			while ($row = $dbs_up->getArray($Results_up)) {
					$JobParent_up = $row['JobParent'];
					// echo "\$JobParent_up == $JobParent_up above dbssession<BR>";
			}
	
	
	//$find_the_olds = new child;
	//$find_the_olds->find_parent($JobID); 
	// echo $JobParent_up . " in the find_the_olds.<BR>";
				if ($dbsUpdateJobCard->getResult($sql)) {
					$msg = "Card Edited.";
					echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT><BR><BR>";
						// echo "<BR>$msg";
	                                $StartTime = time();
	                                //echo "<BR />\n<A href=\"clientcard2.php?id=$ClientID&StartTime=$StartTime\" class=\"linkPlainInWhiteAreas\" >Back to Client Card</A><BR><BR>";
	                                $_POST['$JobID'] = $JobID;
	                                
	                                // echo "<FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"\"><A href=\"JobDetails.php?JobID=$JobID\" class=\"linkPlainInWhiteAreas\">Back to Job card</A></FONT><BR><BR>";
	                                        echo "<form method=\"post\" action=\"./index.php\">";
			                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
			                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_card\">";
                                                include("log_in_authentication_form_vars.php");
                                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Back to Job Card\">";
                                                echo "</form>";
	                                // echo "<FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"\"><A href=\"whiteBoard.php?\" class=\"linkPlainInWhiteAreas\">Back to Job Board</A></FONT><BR><BR>";
	                                        echo "<form method=\"post\" action=\"./whiteBoard.php\">";
	                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_board\">";
                                                include("log_in_authentication_form_vars.php");
                                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Back to Job Board.\">";  
                                                echo "</form>";
	                                
					/**
					$child_update = new child;
					$child_update->add_delete_parent($JobParent, $JobID, $JobParent_up);
					echo $jchild;
					echo $child_msg;
					*/
					
					/**if (empty($AddMessageTermination)) {
						echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";
						// echo "<A href=\"index.php\">   Home</A>";
						
						Main();
						LocEndCallAddAction();
						ShowActions();
						exit();
					} */
					echo "<BR>";
					
					echo "</DIV>";
					// END MAIN


					//**********************************************************************************************
					//********************************************************************** LOGIN 2ND SECTION - START 
					// This works in conjunction with the LOGIN 1ST SECTION.
					// See the LOGIN 1ST SECTION for information on how to 
					// impliment.

									?>

								</FONT>

								</div>
	
							</td>
						</tr>




					</table>

					<BR>

					<?PHP
					include("footer001.php");
					?>

					</DIV>
					</body>
					</html>

					<?PHP
				} else {
					$msg = $dbs->printError();
					echo "<BR>$msg";
				}
	
	// echo "<BR><A href=\"index.php\">Start Over</A>";
	echo "</DIV>";

	
	$dbsFindOutIfJobAlreadyCompleted = new dbSession();
	$sql = "SELECT JobStatus from job WHERE JobID = '$JobID'";
	$Results = $dbsFindOutIfJobAlreadyCompleted->getResult($sql);
	$debugMsg .= "Results is $Results<BR>";
	$row = $dbsFindOutIfJobAlreadyCompleted->getArray($Results);
	$currentJobStatus = $row['JobStatus'];
//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
                if ($turn_this_debug_on == 1) {	
				$debug = $_POST['debug'];
				$debugMsg .= "\$currentJobStatus2 = $currentJobStatus<BR><BR>";
				$debugMsg .= "\$initialJobStatus2 = $initialJobStatus<BR><BR>";
				include("config/debug.php");
				}
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************
	
	if (($initialJobStatus == "Active") AND ($currentJobStatus == "Job Complete")) {
			$_POST['jobMessage'] = "Job or Task Completed  - ";
			LocAddActionWhenJobFinished();
	}
	elseif (($initialJobStatus == "Job Complete") AND ($currentJobStatus == "Active")) {
			$_POST['jobMessage'] = "Job or Task has been Reactivated  - ";
			LocAddActionWhenJobFinished();
	}
	
//loc_update_job_has_a_child()
 
 
 
 	
	$JobParent_a = $_POST['JobParent_a'];
	$JobParent = $_POST['JobParent'];
	$JobID    = $_POST['JobID'];
	$job_tree = $_POST['job_tree'];

	$dbs_job_child = new dbSession();
	$sql_child = "UPDATE job SET JobChild = 1 WHERE JobID = \"$JobParent\" LIMIT 1";
	
		if ($dbs_job_child->getResult($sql_child)) {
			//locReminderCheck();
			//Main();
			//Onsite();
			echo "<BR>";
			exit();
		} else {
			$msg = $dbs->printError();
			echo "<FONT SIZE=\"4\" COLOR=\"#CC0000\">$msg</FONT>";
			//locReminderCheck();
			//Main();
			//Onsite();
			echo "<BR>";
			exit();
		} 
		exit();

}
function loc_update_job_has_a_child() {
	$JobParent_a = $_POST['JobParent_a'];
	$JobParent = $_POST['JobParent'];
	// echo "\$JobParent_a == $JobParent_a";
	// echo "\$JobParent == $JobParent";
	$JobID    = $_POST['JobID'];
	$job_tree = $_POST['job_tree'];

	$dbs_job_child = new dbSession();
	$sql_child = "UPDATE job SET JobChild = 1 WHERE JobID = \"$JobID\" LIMIT 1";
	//$sql = "UPDATE reminder SET ReminderSchedTimeInSecs = '$newReminderSchedTimeInSecs' WHERE ReminderID = '$ReminderID'";
	
		if ($dbs_job_child->getResult($sql_child)) {
			//$msg = "<BR>Branch Updated.";
			//echo "<FONT SIZE=\"4\" COLOR=\"#339900\">$msg</FONT><BR><BR>";
			locReminderCheck();
			Main();
			//Onsite();
			echo "<BR>";
		} else {
			$msg = $dbs->printError();
			echo "<FONT SIZE=\"4\" COLOR=\"#CC0000\">$msg</FONT>";
			locReminderCheck();
			Main();
			//Onsite();
			echo "<BR>";
		}
	//echo "</DIV>";
	
}

function LocAddActionWhenJobFinished() {
	
//**********************************************************************************************
// *************************************************************************** VARIABLES - START
	$id = $_POST['id'];
	$ClientID = $_POST['ClientID'];
	$AddAction = $_POST['AddAction'];
	$StartTime = $_POST['StartTime'];
	$ColumnUserName = $_POST['ColumnUserName'];
	$ReadableStartTime = $_POST['ReadableStartTime'];
	$ColumnJobID = $_POST['ColumnJobID'];
	$ActionRelToFkClientID = $_POST['ActionRelToFkClientID'];
	$JobTitle = $_POST['JobTitle'];
	$JobToFkUserID = $_POST['JobToFkUserID'];
	$JobFromFkUserID = $_POST['JobFromFkUserID'];
	$JobFkClientID = $_POST['JobFkClientID'];
	$JobTimeInserted = $_POST['JobTimeInserted'];
	$jobMessage = $_POST['jobMessage'];
	$JobDescription = $_POST['JobDescription'];
// ***************************************************************************** VARIABLES - END
//**********************************************************************************************

	$EndTime = time();
	$TotalTime = $EndTime - $StartTime;
	$TotalTimeHMS = date("H:i:s", mktime(0,0,$TotalTime));
	$ReadableStartTime = date("H:i:s", mktime(0,0,$StartTime));
	
	$ActionText_raw = $jobMessage . "\nJob Title = " . $JobTitle . "\n" . "Repars / details = " . $JobDescription;
	$ActionText = addslashes($ActionText_raw);
	
//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {	
	// $debug = $_POST['debug'];
	$debugMsg .= "<BR>\$JobID = $JobID";
	$debugMsg .= "<BR>\$JobTimeInserted = $JobTimeInserted";
	$debugMsg .= "<BR>\$JobTitle = $JobTitle";
	$debugMsg .= "<BR>\$ActionText = $ActionText";
	$debugMsg .= "<BR>\$id = $id";
	$debugMsg .= "<BR>\$ClientID = $ClientID";
	$debugMsg .= "<BR>\$AddAction = $AddAction";
	$debugMsg .= "<BR>\$StartTimeeeee1 = $StartTime";
	$debugMsg .= "<BR>\$ColumnUserName = $ColumnUserName";
	$debugMsg .= "<BR>\$ReadableStartTime = $ReadableStartTime";
	$debugMsg .= "<BR>\$ColumnJobID = $ColumnJobID";
	$debugMsg .= "<BR>\$ActionRelToFkClientID = $ActionRelToFkClientID";
	$debugMsg .= "<BR>\$JobToFkUserID = $JobToFkUserID";
	$debugMsg .= "<BR>\$JobFromFkUserID = $JobFromFkUserID";
	$debugMsg .= "<BR>\$JobFkClientID = $JobFkClientID";
	$debugMsg .= "<BR>\$jobMessage = $jobMessage";
	$debugMsg .= "<BR>\$JobDescription = $JobDescription";
	$debugMsg .= "<BR>ColumnJobID = $ColumnJobID<BR />\n<BR>";
	$debugMsg .= "<BR>ActionRelToFkClientID = $ActionRelToFkClientID<BR />\n<BR>";
	$debugMsg .= "<BR>ActionRelToFkClientID = $ActionRelToFkClientID<BR />\n<BR>";
	include("config/debug.php");
	}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************
        /**
	$dbsFindJobID = new dbSession();
	$sql = "SELECT JobID from job WHERE JobTimeInserted = '$JobTimeInserted' AND JobTitle = '$JobTitle'";
	$Results = $dbsFindJobID->getResult($sql);
	$debugMsg .= "Results is $Results<BR>";
	$row = $dbsFindJobID->getArray($Results);
	$JobID = $row['JobID'];
        */
        $JobID = $_POST['$JobID'];
	$debugMsg .= "\$ActionText = $ActionText<BR />\n<BR>";
	include("config/tpl_bodystart.php");
	
	echo "<DIV align=\"center\">";

	$dbsActionAdd = new dbSession();

		if ($AddAction != "Add current action or Event") {
			$sql = "INSERT INTO action (ActionText, ActionFkJobID, ActionFkClientID, ActionRelToFkClientID, ActionFromFkUserID, ActionToFkUSerID, ActionDateSecs, ActionTotalSecs) VALUES ('$ActionText', '$JobID', '$JobFkClientID', '$JobFkClientID', '$JobFromFkUserID', '$JobToFkUserID', '$EndTime', '')";
			
				if ($dbsActionAdd->getResult($sql)) {
					$msg = "Action Added.";
					$debugMsg .= "\$StartTime = $StartTime<BR />\n<BR>";
					include("config/tpl_bodystart.php");
				} else {
					$msg = $dbsActionAdd->printError();
				}
		} else {
			echo "<BR><BR>Not a valid Action. Please type it again.";
		}
	
	echo "$msg<BR><BR><BR>";
        /**
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"Nothing\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Back to Client Card\">";
	echo "</form>";
	*/
	echo "</DIV>";
}
function LocSelectJob() {
	global $id;
	$ClientID = $_POST['ClientID'];
	// echo "*\$id= $id<BR>";
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "View current Job by  ";
	
	echo "Job Names........ ";
	$sql = "SELECT JobID, JobTitle, JobCardNumber from job WHERE JobFkClientID = '$ClientID' ORDER BY JobTitle ASC";
	htMakeListFromSqlOptValue($sql, JobID, selected, JobTitle, JobID);
	echo "  Or by  ";
	
	echo "Job Numbers........ ";
	$sql = "SELECT JobID, JobTitle, JobCardNumber from job WHERE JobFkClientID = '$ClientID' ORDER BY JobTitle ASC";
	htMakeListFromSqlOptValue($sql, JobID, selected, JobCardNumber, JobID);
	echo "  ";
	
	// echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"JobDetails\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Goto Job Details\">";
	echo "</form>";
}
Function LocShowJobDetails() {
	Global $JobID;
	echo "<a href=\"showJob.php?id=$JobID\">JobID = $JobID</a>";
}

Function LocAddAction(){
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "Add Action................. ";
	echo "<input type=\"text\" name=\"AddAction\" value=\"Add current action or Event\">";
	echo "<BR>";
	
	// echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"InsertAction\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" name=\"Submit\" value=\"Add Action\">";
	echo "</form>";
}
function InsertAction() {
	// Get data from the database where the name variable = ????
	global $id;
	global $AddAction;
	global $StartTime;
	global $ColumnUserName;
	global $ColumnJobID;
	global $ActionRelToFkClientID;
	$ClientID = $_POST['ClientID'];
	
	global $debug;
	$debugMsg .= "\$AddAction = $AddAction<BR />\n<BR>";
	$debugMsg .= "\$id in insert action c= $id<BR />\n<BR>";
	$debugMsg .= "\$ColumnUserName = $ColumnUserName<BR />\n<BR>";
	$debugMsg .= "\$ColumnJobID = $ColumnJobID<BR />\n<BR>";
	include("config/tpl_bodystart.php");
	
	$dbs = new dbSession();
	// echo "* test3	\$dbs= $dbs<BR>";

	echo "<DIV align=\"center\">";

		if ($AddAction != "Add current action or Event") {
			// $sql = "INSERT INTO action (ActionText, ActionFkClientID, ActionDateTime) VALUES ('$AddAction', '$id', now())";
			$sql = "INSERT INTO action (ActionFkJobID, ActionText, ActionFkClientID, ActionRelToFkClientID, ActionFromFkUserID, ActionDateSecs) VALUES ('$ColumnJobID', '$AddAction', '$ClientID', '$ActionRelToFkClientID', $ColumnUserName, $StartTime)";
			
				if ($dbs->getResult($sql)) {
					$msg = "Actionssssssssssssssssssssss Added.";
					echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT>";
						global $debug;
							$debugMsg .= "\$ClientID in insert action d= $ClientID<BR />\n<BR>";
						include("config/tpl_bodystart.php");
					Main();
					LocStartCall();
					LocEndCallAddAction();
					ShowActions();
					echo "<BR>";
				} else {
					$msg = $dbs->printError();
					echo "<FONT SIZE=\"4\" COLOR=\"#CC0000\">$msg</FONT>";
					Main();
					LocStartCall();
					LocEndCallAddAction();
					ShowActions();
					echo "<BR>";
				}
		} else {
			echo "<BR><BR>Not a valid Action. Please type it again.";
		}
	echo "</DIV>";
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"Nothing\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" name=\"Submit\" value=\"Back to Card\">";
	echo "</form>";
	echo "<BR><BR>";
	echo "</DIV>";
}
function LocInsertActionAtEndOfCall() {
	// Get data from the database where the name variable = ????
	// echo "in the LocInsertActionAtEndOfCall()<BR>";
	$id = $_POST['id'];
	$UserID = $_POST['UserID'];
	$ClientID = $_POST['ClientID'];
	$AddAction = addslashes($_POST['AddAction']); 
	$StartTime = $_POST['StartTime'];
	$ColumnUserName = $_POST['ColumnUserName'];
	$ReadableStartTime = $_POST['ReadableStartTime'];
	$ColumnJobID = $_POST['ColumnJobID'];
	$ActionRelToFkClientID = $_POST['ActionRelToFkClientID'];
	$ActionFkJobID = $_POST['ActionFkJobID'];
	$ActionFkClientID = $_POST['ActionFkClientID'];
	
//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {	
                $debugMsg .= "Inside LocInsertActionAtEndOfCall()<BR>";
                $debugMsg .= "\$id = $id<BR>";
                $debugMsg .= "\$UserID = $UserID<BR>";
                $debugMsg .= "\$ClientID = $ClientID<BR>";
                $debugMsg .= "AddAction = $AddAction<BR>";
                $debugMsg .= "\$StartTime = $StartTime<BR>";
                $debugMsg .= "\$ColumnUserName = $ColumnUserName<BR>";
                $debugMsg .= "\$ReadableStartTime = $ReadableStartTime<BR>";
	        $debugMsg .= "\$ColumnJobID = $ColumnJobID<BR>";
	        $debugMsg .= "\$ActionRelToFkClientID = $ActionRelToFkClientID<BR>";
	        $debugMsg .= "\$ActionFkJobID= $ActionFkJobID<BR>";
	        $debugMsg .= "\$ActionFkClientID= $ActionFkClientID<BR>";
	        include("config/debug.php");
	}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************

	// echo"Insert Action<BR>";
	// echo "Start Time = $StartTime<BR>";
	//$EndTime = date ("h:i:s");
	// $EndTime = date ("M-d-Y");
	$EndTime = time();
	
	// $EndTime = date ("l dS of F Y h:i:s A");
	
	// time();
	// echo "End Time = $EndTime<BR>";
	// echo date ("M-d-Y", mktime (0,0,0,12,32,1997));
	// echo "<BR>";
	$TotalTime = $EndTime - $StartTime;
	// echo "Total Time in seconds = $TotalTime<BR>";
	// echo "<BR>";

	// Old lines that caused an error on windows systems but not linux
	// $TotalTimeHMS = date("H:i:s", mktime(0,0,$TotalTime));
	// $ReadableStartTime = date("H:i:s", mktime(0,0,$StartTime));

	// New lines that should work on lindows systems as well as unix
	$TotalTimeHMS = date("H:i:s", $TotalTime);
	$ReadableStartTime = date("H:i:s", $StartTime);

	// echo "Total Time in h,m,s = $TotalTimeHMS<BR>";
	// echo "\$ColumnUserName = $ColumnUserName<BR>";
	
	echo "<DIV align=\"center\">";

	$dbs = new dbSession();
	// echo "* test3	\$dbs= $dbs<BR>";

		if ($AddAction != "Add current action or Event") {
			$sql = "INSERT INTO action (ActionText, ActionFkJobID, ActionFkClientID, ActionRelToFkClientID, ActionFromFkUserID, ActionDateSecs, ActionTotalSecs) VALUES ('$AddAction', '$ActionFkJobID', '$ActionFkClientID', '$ActionRelToFkClientID', '$UserID', '$StartTime', '$TotalTime')";
			
				if ($dbs->getResult($sql)) {
					$msg = "Action Added.";
					$ActionRelToFkClientID = "";
					$_POST['ClientID'] = '';
					echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT>";
					Main();
					LocStartCall();
					LocEndCallAddAction();
					ShowActions();
					exit;
					echo "<BR>";
				} else {
					echo "in here.<BR>";
					$msg = $dbs->printError();
					echo "<FONT SIZE=\"4\" COLOR=\"#CC0000\">$msg</FONT>";
					Main();
					LocStartCall();
					LocEndCallAddAction();
					ShowActions();
					echo "<BR>";
				}
		} else {
			echo "<BR><BR>Not a valid Action. Please type it again.";
		}
	echo "</DIV>";
	// echo "id in insert action as a seperate echo = $id";
	/*
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"AddUser\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Add User\">";
	echo "</form>";	
	echo "<BR>";
	
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"Nothing\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Back to Client Card\">";
	echo "</form>";
	echo "</DIV>";
	// echo "<BR><BR>";
	*/
	
}
function LocStartCall(){
	global $StartTime;
	// $StartTime = date ("h:i:s");
	//$StartTime = time();
	// time();
	$config_time_zone = $_POST['config_time_zone'];
	
	$MNTTZ = new DateTimeZone($config_time_zone);

	$dt = new DateTime();

	$dt->setTimezone($MNTTZ);

	$StartTime = $dt->format('U');
	
	global $debug;
	$debugMsg .= "StartTime now = $StartTime<BR />\n<BR>";
	include("config/tpl_bodystart.php");
}
function LocEndCall(){
	global $StartTime;
	
	echo "Start Time = $StartTime<BR>";
	//$EndTime = date ("h:i:s");
	// $EndTime = date ("M-d-Y");
	$EndTime = time();
	
	// $EndTime = date ("l dS of F Y h:i:s A");
	
	// time();
	echo "End Time = $EndTime<BR>";
	echo date ("M-d-Y", mktime (0,0,0,12,32,1997));
	echo "<BR>";
	$TotalTime = $EndTime - $StartTime;
	echo "Total Time in seconds = $TotalTime<BR>";
	echo "<BR>";
	$TotalTimeHMS = date("H:i:s", mktime(0,0,$TotalTime));
	echo "Total Time in h,m,s = $TotalTimeHMS<BR>";

}
function LocFinishCallAndInsertAction(){
	global $StartTime;
	// $StartTime = date ("h:i:s");
	//$StartTime = time();
	// time();
	
	$config_time_zone = $_POST['config_time_zone'];
	$MNTTZ = new DateTimeZone($config_time_zone);

	$dt = new DateTime();

	$dt->setTimezone($MNTTZ);

	$StartTime = $dt->format('U');
				
	echo "StartTime = $StartTime";
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "Search for........ ";
	echo "<input type=\"text\" name=\"SearchClientName\" value=\"\">";
	echo "<BR>";
	
	// echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"SearchClient\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" name=\"Submit\" value=\"Search\">";
	echo "</form>";
	echo "<BR>";
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"AddUser\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" name=\"Submit\" value=\"Add User\">";
	echo "</form>";
	echo "<BR>";
	
	echo "<BR>";
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"EndCall\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" name=\"Submit\" value=\"End Call\">";
	echo "</form>";
	echo "<BR>";
}
// This does same as above except allows you to define a different value for
// the var than the one that actually appears in the list
function htMakeListFromSqlOptValue2($sql, $selected, $listCol, $optValCol) {
		
	echo	"<select name=\"ColumnUserName\">" .
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
}
//****************************************************************************** FUNCTIONS - END
//**********************************************************************************************

?>
