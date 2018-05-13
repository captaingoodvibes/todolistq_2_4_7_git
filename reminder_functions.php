<?PHP
function postpone_reminder() {
	global $ReminderID;
	global $ReminderTitle;

	$ReminderID = $_POST['ReminderID'];
	$ReminderTitle = $_POST['ReminderTitle'];
	$reminderTimeHour = $_POST['reminderTimeHour'];
	$reminderTimeMinute = $_POST['reminderTimeMinute'];
	$ReminderSchedTimeInSecs = $_POST['ReminderSchedTimeInSecs'];

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {       
        $debug = $_POST['debug'];
        $debugMsg .= "\$ReminderID = $ReminderID<BR>";
        $debugMsg .= "\$reminderTimeDay = $reminderTimeDay<BR>";
        $debugMsg .= "\$reminderTimeHour = $reminderTimeHour<BR>";
        $debugMsg .= "\$reminderTimeMinute = $reminderTimeMinute<BR>";
        $debugMsg .= "\$ReminderSchedTimeInSecs = $ReminderSchedTimeInSecs<BR>";
        include("config/debug.php");
}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************

	echo "<DIV align=\"center\">";
	echo "Postpone $ReminderTitle by";

	echo "
	<form method=\"post\" action=\"$PHP_SELF\">
	<TABLE>
		<TR>
			<TD></TD>
			<TD>
			<select name=\"reminderTimeDay\" tabindex=\"\">
";
			$timeDayOption = 0;
			echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
			while ($timeDayOption <= "30") {		
				$timeDayOption = $timeDayOption + 1;
				echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
			}

echo "
			</SELECT>Day(s)

			<select name=\"reminderTimeHour\" tabindex=\"3\"\">
";
			$timeHourOption = 0;
			echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
			while ($timeHourOption <= "22") {		
				$timeHourOption = $timeHourOption + 1;
				echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
			}

echo "
			</SELECT>
			
			hour(s)
			<select name=\"reminderTimeMinute\" tabindex=\"3\">
";
			echo "<OPTION  value=\"05\">05";
			$timeMinuteOption = "00";
			echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
			while ($timeMinuteOption <= "40") {		
				$timeMinuteOption = $timeMinuteOption + 10;
				echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
			}

echo "
			</SELECT>
			minutes
			</TD>
		</TR>
	</TABLE>
";

	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"ReminderFkClientID\" value=\"$ClientID\">";
	echo "<input type=\"hidden\" name=\"ReminderID\" value=\"$ReminderID\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"postpone_and_update_reminder\">";
	echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
	echo "<input type=\"hidden\" name=\"JobStatus\" value=\"Active\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" tabindex=\"18\" name=\"Submit\" value=\"Postpone Reminder\">";
	echo "</form>";
	echo "</DIV>";
	$GET_['OptionCatch'] = "";
	include("logged_in_end_of_page.php");
}
function postpone_and_update_reminder() {
	global $ReminderID;
	global $reminderTimeDay;
	global $reminderTimeHour;
	global $reminderTimeMinute;
	global $ReminderSchedTimeInSecs;

	$ReminderID = $_POST['ReminderID'];
	$reminderTimeDay = $_POST['reminderTimeDay'];
	$reminderTimeHour = $_POST['reminderTimeHour'];
	$reminderTimeMinute = $_POST['reminderTimeMinute'];
	$ReminderSchedTimeInSecs = $_POST['ReminderSchedTimeInSecs'];

//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "\$ReminderID = $ReminderID<BR>";
        $debugMsg .= "\$reminderTimeDay = $reminderTimeDay<BR>";
        $debugMsg .= "\$reminderTimeHour = $reminderTimeHour<BR>";
        $debugMsg .= "\$reminderTimeMinute = $reminderTimeMinute<BR>";
        $debugMsg .= "\$ReminderSchedTimeInSecs = $ReminderSchedTimeInSecs<BR>";
        include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************


	$currentTime = time();
	//echo "\$currentTime = $currentTime<BR><BR>";
	$reminderTotalTimeToPostponeBy = (($reminderTimeDay * 86400) + ($reminderTimeHour * 3600) + ($reminderTimeMinute * 60));
	$newReminderSchedTimeInSecs = ($reminderTotalTimeToPostponeBy + $currentTime);
	//echo "\$newReminderSchedTimeInSecs = $newReminderSchedTimeInSecs<BR><BR>";
	echo "<DIV align=\"center\">";

	$dbs = new dbSession();

		$sql = "UPDATE reminder SET ReminderSchedTimeInSecs = '$newReminderSchedTimeInSecs' WHERE ReminderID = '$ReminderID'";

		// $sql = "UPDATE Reminder SET ReminderTimeDismissedInSecs = '$ReminderTimeDismissedInSecs' WHERE ReminderID = '$ReminderID'";

				
				if ($dbs->getResult($sql)) {
					$msg = "Reminder Postponed.";
					echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT><BR><BR>";
					locReminderCheck();     // Found in reminder_functions.php
                                        job_board();            // Found in job_board_functions.php
					//Onsite();
				
				} else {
					$msg = $dbs->printError();
					echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#CC3300\">$msg</FONT>";
					locReminderCheck();     // Found in reminder_functions.php
                                        job_board();            // Found in job_board_functions.php
					//Onsite();
					
				}
	echo "<BR>";
	echo "</DIV>";

}
function locReminderCheck() {
        echo "<H3 style=\"color: #CC3300;\">This version of the Task/Job List is under construction. </H3><FONT style=\"color: #CC3300;\">It is a modification of 'Job Board 1' intended for mobile devices --> To be completed soon. Stay tunned.</FONT><BR>";
        $UserID = $_POST['UserID'];
	$currentTime = time();
//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "\$currentTime = $currentTime<BR><BR>";
        include("config/debug.php");
}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************
	$dbsReminder = new dbSession();
	$sql = "SELECT ReminderID, ReminderSchedTimeInSecs, ReminderTimeDismissedInSecs from reminder WHERE ReminderTimeDismissedInSecs = '0' AND ReminderSchedTimeInSecs <= '$currentTime' AND (ReminderToFkUserID = '$UserID' OR ReminderToFkUserID = 2) ORDER BY ReminderSchedTimeInSecs DESC";
	$Results = $dbsReminder->getResult($sql);
	// $row = $dbsReminder->getArray($Results);
	//echo "dismis test<BR>";
	// echo "ReminderID = " . $row['ReminderID'] . "<BR>";
	$proceed = 1;
	// echo "\$row = $row";

		while ($row = $dbsReminder->getArray($Results)) {
			$ReminderTimeDismissedInSecs = $row['ReminderTimeDismissedInSecs'];
			$proceed = 0;
		}
	if ($proceed == 0) {
		locShowReminder();
	}

}

function locShowReminder() {
        $UserID = $_POST['UserID'];
        $user_log_in_name = $_POST['name'];
	echo "<H3 style=\"color: #CC3300;\">!!Reminders!!</H3><BR>";
	$currentTime = time();
	$dbs = new dbSession();
	// $sql = "SELECT * from reminder WHERE ReminderTimeDismissedInSecs = '0'  AND ReminderSchedTimeInSecs <= '$currentTime' ORDER BY ReminderSchedTimeInSecs DESC";
	// $sql = "SELECT * from reminder WHERE ReminderTimeDismissedInSecs = '0'  AND ReminderSchedTimeInSecs <= '$currentTime' AND ReminderToFkUserID = '$UserID' ORDER BY ReminderSchedTimeInSecs DESC";
	$sql = "SELECT * from reminder WHERE ReminderTimeDismissedInSecs = '0'  AND ReminderSchedTimeInSecs <= '$currentTime' AND (ReminderToFkUserID = '$UserID' OR ReminderToFkUserID = '2') ORDER BY ReminderSchedTimeInSecs DESC";
	
	$Results = $dbs->getResult($sql);
	// echo "<div class=\"container\">";
                echo "<div class=\"row\">";
                        ?>
                        <div class="seven columns" style="margin-top: 1%; ">
                        <?PHP
                        echo "<TABLE border=\"0\" width=\"100%\">";
                                echo "<TR class=\"hide_under_400\">";
                                        echo "<TD bgcolor=\"#FFFFFF\" width=\"20%\" style=\"word-wrap: break-word; text-align: center;\"><B>From</B></TD>";
	                                echo "<TD bgcolor=\"#FFFFFF\" width=\"50%\" style=\"word-wrap: break-word; text-align: center;\"><B>Client</B></TD>";
	                                echo "<TD bgcolor=\"#FFFFFF\" width=\"10%\" style=\"word-wrap: break-word; text-align: center;\"><B>OK</B></TD>";
	                                echo "<TD bgcolor=\"#FFFFFF\" width=\"10%\" style=\"word-wrap: break-word; text-align: center;\"><B>Postpone</B></TD>";
	                                echo "<TD bgcolor=\"#FFFFFF\" width=\"10%\" style=\"word-wrap: break-word; text-align: center;\" title=\"Job IDentification Number.\"><B>JID</B></TD>";
                                echo "</TR class=\"hide_under_400\">";
                        echo "</TABLE>";
                        ?>
                        </div>
                        <div class="five columns" style="margin-top: 1%;">
                        <?PHP
                        echo "<TABLE>";
                                echo "<TR class=\"hide_under_400\">";	                                
	                                echo "<TD bgcolor=\"#FFFFFF\" align=\"center\"><B>Details</B></TD>";
                                echo "</TR class=\"hide_under_400\">";
                        echo "</TABLE>";
                        ?>
                        </div>
                </div>
                <?PHP
                
                $aColor = 0;
                while ($row = $dbs->getArray($Results)) { 
                if ($aColor == 1) {
                        $aColor = 0;
                        $setColor = "#FFFFFF";
                }
                elseif ($aColor == 0) {
                        $aColor = 1;
                        $setColor = "#FFCCCC";
                }
                echo "<div class=\"row\" style=\"background-color: $setColor;\">";
                                
                                $ReminderSchedTimeInSecs = $row['ReminderSchedTimeInSecs'];
                                $ReminderTitle = $row['ReminderTitle'];
                                $ReminderID = $row['ReminderID'];
                                $ReminderFkJobID = $row['ReminderFkJobID'];
                                // $JobCardNumber = $row['JobCardNumber'];
                                // $JobPriority = $row['JobPriority'];
                                // $JobType = $row['JobType'];

                                $ReminderFkJobID = $row['ReminderFkJobID'];
                                $dbsJobNumber = new dbSession();
                                $sql = "SELECT JobID, JobCardNumber from job WHERE JobID = \"$ReminderFkJobID\" LIMIT 1";
                                $ResultsClient = $dbsJobNumber->getResult($sql);
                                $rowJob = $dbsJobNumber->getArray($ResultsClient);
                                $JobCardNumber = $rowJob['JobCardNumber'];
                                $ReminderToFkUserID = $row['ReminderToFkUserID'];
                                $ReminderFromFkUserID = $row['ReminderFromFkUserID'];

                                $dbsUserFirstName = new dbSession();
                                $sql = "SELECT UserFirstname, UserLogin from user WHERE UserID = \"$ReminderFromFkUserID\" LIMIT 1";
                                $ResultsUser = $dbsUserFirstName->getResult($sql);
                                $rowUser = $dbsUserFirstName->getArray($ResultsUser);
                                $UserFirstname = $rowUser['UserFirstname'];
                                $user_login_from_db_for_reminder = $rowUser['UserLogin'];			

                                $ReminderFkClientID = $row['ReminderFkClientID'];
                                $dbsClientName = new dbSession();
                                $sql = "SELECT ClientName from client WHERE ClientID = \"$ReminderFkClientID\" LIMIT 1";
                                $ResultsClient = $dbsClientName->getResult($sql);
                                $rowClient = $dbsClientName->getArray($ResultsClient);
                                $clientName = $rowClient['ClientName'];		                               
			?>
			
                        <div class="seven columns" style="margin-top: 1%;">
                        <?PHP
                                echo "<TABLE border=\"0\" width=\"100%\">";
                                        echo "<TR class=\"hide_under_400\">";
                                                echo "<TD width=\"20%\" style=\"word-wrap: break-word; text-align: center;\">";
                                                        if(($user_log_in_name == $user_login_from_db_for_reminder) && ($ReminderToFkUserID == 2)) {
                                                                echo "Me to Everyone.";
                                                        }elseif($ReminderToFkUserID == 2) {
                                                                user_button($ReminderFromFkUserID);
                                                                echo "to Everyone.";
                                                        }elseif ($user_log_in_name == $user_login_from_db_for_reminder) {
                                                                // echo "Me";
                                                        }else{
                                                                user_button($ReminderFromFkUserID);
                                                        }
                                                echo "</TD>";
                                                echo "<TD width=\"50%\">";                                               
                                                        if (empty($ReminderFkClientID)){
			                                                                
                                                        }else{
                                                                client_button_with_start_time($ReminderFkClientID,'');
                                                        }
                                                echo "</TD>";
                                                echo "<TD width=\"10%\">";
                                                        echo "<form method=\"post\" action=\"./index.php\">";
                                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"OK\">";
                                                        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                                                        echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
                                                        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input type=\"image\" src=\"./images/sort_none.png\"  title=\"Confirm Reminder and hide it permanently.\" name=\"action\">";
                                                        echo "</form>";
                                                echo "</TD>";
                                                echo "<TD width=\"10%\">";
                                                        echo "<form method=\"post\" action=\"./index.php\">";
                                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"postpone\">";
                                                        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                                                        echo "<input type=\"hidden\" name=\"ReminderTitle\" value=\"" . $ReminderTitle . "\">";
                                                        echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
                                                        echo "<input type=\"hidden\" name=\"ReminderSchedTimeInSecs\" value=\"" . $ReminderSchedTimeInSecs . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input type=\"image\" src=\"./images/sort_none.png\"  title=\"Postpone.\" name=\"action\">";
                                                        echo "</form>";
                                                echo "</TD>";
                                                echo "<TD width=\"10%\">";
                                                        if ($ReminderFkJobID == "0") {
			
                                                        }else{
	                                                        // echo "<a href=\"JobDetails.php?JobID=$ReminderFkJobID\">$ReminderFkJobID-$JobCardNumber</a>";
	                                                        job_button($ReminderFkJobID,'','','');
                                                        }
                                                echo "</TD>";
                                        echo "</TR>";
                                        echo "<TR class=\"hide_over_400\">";
                                                echo "<TD>";
                                                        if(($user_log_in_name == $user_login_from_db_for_reminder) && ($ReminderToFkUserID == 2)) {
                                                                echo "From me to everyone.";
                                                        }elseif($ReminderToFkUserID == 2) {
                                                                echo "From ";
                                                                user_button($ReminderFromFkUserID);
                                                                echo "to Everyone.";
                                                        }elseif ($user_log_in_name == $user_login_from_db_for_reminder) {
                                                                // echo "Me";
                                                        }else{
                                                                echo "From ";
                                                                user_button($ReminderFromFkUserID);
                                                        }
                                                echo "<BR>";                                            
                                                        if (empty($ReminderFkClientID)){
			                                                                
                                                        }else{
                                                                client_button_with_start_time($ReminderFkClientID,'');
                                                        }
                                                echo "<BR>";
                                                        echo "<form method=\"post\" action=\"./index.php\"> OK  --> ";
                                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"OK\">";
                                                        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                                                        echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
                                                        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input type=\"image\" src=\"./images/sort_none.png\"  title=\"Confirm Reminder and hide it permanently.\" name=\"action\">";
                                                        echo "</form>";
                                                echo "<BR>";
                                                        echo "<form method=\"post\" action=\"./index.php\"> Postpone --> ";
                                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"postpone\">";
                                                        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                                                        echo "<input type=\"hidden\" name=\"ReminderTitle\" value=\"" . $ReminderTitle . "\">";
                                                        echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
                                                        echo "<input type=\"hidden\" name=\"ReminderSchedTimeInSecs\" value=\"" . $ReminderSchedTimeInSecs . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input type=\"image\" src=\"./images/sort_none.png\"  title=\"Postpone.\" name=\"action\">";
                                                        echo "</form>";
                                                echo "<BR>";
                                                        if ($ReminderFkJobID == "0") {
			
                                                        }else{
	                                                        // echo "<a href=\"JobDetails.php?JobID=$ReminderFkJobID\">$ReminderFkJobID-$JobCardNumber</a>";
	                                                        job_button($ReminderFkJobID,'','','');
                                                        }
                                                echo "</TD>";
                                        echo "</TR>";
                                echo "</TABLE>";
                        ?>
                        </div>
                        <div class="five columns" style="margin-top: 1%;" >
                        <?PHP
                                echo "<form method=\"post\" id=\"reminder_edit_button" . $ReminderID . "\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"reminder_card\">";
                                echo "<input type=\"hidden\" name=\"ReminderID\" value=\"$ReminderID\"><BR>";
                                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                                include("log_in_authentication_form_vars.php");
                                echo "<button type=\"submit\" class=\"link_styled_button\" form=\"reminder_edit_button" . $ReminderID . "\" value \"submit\" title=\"Edit Reminder.\">$ReminderTitle</button>";
                                echo "</form>";
                        ?>
                        </div>
                </div>
                        <?PHP                             
                        }
                        echo "<img src=\"images/spacer.gif\" height=\"20\" title=\"\">";
                ?>
                
                
        <!-- </div> -->
        <?PHP

}
function add_reminder() {

	$ReminderID = $_POST['ReminderID'];
	$UserID = $_POST['UserID'];
	$JobID = $_POST['JobID'];
	$JobCardNumber = $_POST['JobCardNumber'];
	$ClientID = $_POST['ClientID'];
	$StartTime = $_POST['StartTime'];
	// *****************************************************************************
	// ****************************************************** SCHEDULED TIME - START
	$config_time_zone = $_POST['user_time_zone'];
	$ReminderSchedTimeInSecs = $row['ReminderSchedTimeInSecs'];
	if ( ($ReminderSchedTimeInSecs == 0) || empty($ReminderSchedTimeInSecs) ) {
		$ReminderSchedTimeInSecs = time();
                $update_cause_of_no_job_scehd_time = 1;
	}
	//****************************************************************
	//******************************************** UNNECESSARY - START
	// Unnecessary as timestamp is unaffected by time zone change.
	// After PHP 5.3 you can get human readable date/ times by 
	// setting the time zone. --> Although I have reinstated the bit
	// that spews back the human readable with the CORRECT time zone.
	$Ad_scheduled_time = new DateTime("@$ReminderSchedTimeInSecs");
        $zone_action = new DateTimeZone($config_time_zone);
        $Ad_scheduled_time->setTimezone($zone_action);
	//********************************************** UNNECESSARY - END
	//****************************************************************
	
	// ******************************************************** SCHEDULED TIME - END
	// *****************************************************************************
	
        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {
                $debugMsg .= "At the start of the Main() function.<BR>";
                $debugMsg .= "\$ClientID = $ClientID<BR />\n<BR>";
                include("config/debug.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
	if ( ! empty($ClientID)) {
		$dbsClientName = new dbSession();
		$sql = "SELECT ClientName from client WHERE ClientID = \"$ClientID\" LIMIT 1";
		$ResultsClient = $dbsClientName->getResult($sql);
		$rowClient = $dbsClientName->getArray($ResultsClient);
		$clientName = $rowClient['ClientName'];
	
		
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
	
	$currentTime = time();

	// $ReadableReminderSchedTime = date("H:i:s d-M-Y",$currentTime);
	$ReadableReminderSchedTime = $Ad_scheduled_time->format('Y m d h i s a P');
	// $ReadableReminderSchedHour = date("H",$currentTime);
	$schedHourMadeTo12HourClock = $Ad_scheduled_time->format('h');
	//$ReadableReminderSchedminute = date("i",$currentTime);
	$ReadableReminderSchedminute = $Ad_scheduled_time->format('i');
	$schedAmPm = $Ad_scheduled_time->format('a');
	//$ReadableReminderSchedDay = date("d",$currentTime);
	$ReadableReminderSchedDay = $Ad_scheduled_time->format('d');
	// $ReadableReminderSchedMonth = date("M",$currentTime);
	$ReadableReminderSchedMonth = $Ad_scheduled_time->format('M');
	// $ReadableReminderSchedMonthDigit = date("m",$currentTime);
	$ReadableReminderSchedMonthDigit = $Ad_scheduled_time->format('m');
	// $ReadableReminderSchedYear = date("Y",$currentTime);
	$ReadableReminderSchedYear = $Ad_scheduled_time->format('Y');
        /**
	if ($ReadableReminderSchedHour >= 13) {
			$schedHourMadeTo12HourClock = $ReadableReminderSchedHour - 12;
			$schedAmPm = "PM";
		}elseif ($ReadableReminderSchedHour = 12) {
			$schedHourMadeTo12HourClock = $ReadableReminderSchedHour;
			$schedAmPm = "PM";
		}else{
			$schedHourMadeTo12HourClock = $ReadableReminderSchedHour;
			$schedAmPm = "AM";
	} */
$header_size = $_POST['header_size'];
echo "<H" . $header_size . ">Add Reminder</H" . $header_size . ">";
echo "  <!-- <H3>Add Reminder</H3> -->
	
	<TABLE>
		<TR>
			<TD>Related to Client</TD>
			<TD>
";
				echo "$clientName";

				/** echo "  change";

					$dbs = new dbSession();
					$sql = "SELECT ClientID, ClientName from Client WHERE ClientID = '$ActionRelToFkClientID' ORDER BY 'ClientName' ASC";
					$Results = $dbs->getResult($sql);
					$row = $dbs->getArray($Results);
					$clientName = $row['ClientName'];
					*/

				// echo "<a href=\"addReminder.php?OptionCatch=search_client_in_add_reminder8&StartTime=$StartTime&AddMessageTermination=1&id=$id\">  Change </a>";
				
                                echo "<form method=\"post\" id=\"change_client_in_reminder_button_form\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"search_client_in_add_reminder\">";
                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                                echo "<input type=\"hidden\" name=\"id\" value=\"" . $id . "\">";
                                echo "<input type=\"hidden\" name=\"JobID\" value=\"$JobID\">";
                                include("log_in_authentication_form_vars.php");
                                // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                                echo "<button type=\"submit\" form=\"change_client_in_reminder_button_form\" value=\"submit\">Change</button>";
                                // echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"" . $clientName . "\">";
                                echo "</form>"; 
				/**
				echo "<SELECT name=\"ReminderFkClientID\">";
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
			<TD><form method=\"post\" action=\"$PHP_SELF\">Type</TD>
			<TD><select name=\"ReminderType\" tabindex=\"3\"\">
			<OPTION  value=\"Reminder\">Reminder
			<OPTION  value=\"Call\">Call
			<OPTION  value=\"Email\">Email
			<OPTION  value=\"Fax\">Fax
			<OPTION  value=\"Job\">Job
			<OPTION  value=\"Meeting\">Meeting
			</TD>
		</TR>
		<TR>
			<TD>Title</TD>
			<TD>
				<TEXTAREA tabindex=\"24\" rows=\"5\" cols=\"20\" 
				name=\"ReminderTitle\" WRAP=\"virtual\">$JobTitle</TEXTAREA>
			</TD>
		</TR>
		<TR>
			<TD>Scheduled Time</TD>
			<TD>
			<select name=\"reminderTimeHour\" tabindex=\"3\"\">
			<OPTION  value=\"$schedHourMadeTo12HourClock\">$schedHourMadeTo12HourClock
";
			
			$timeHourOption = 0;
			while ($timeHourOption <= "11") {		
				$timeHourOption = $timeHourOption + 1;
				echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
			}

echo "
			</SELECT>
			
			:
			<select name=\"reminderTimeMinute\" tabindex=\"3\">
			<OPTION  value=\"$ReadableReminderSchedminute\">$ReadableReminderSchedminute
";
			$timeMinuteOption = "00";
			echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
			while ($timeMinuteOption <= "40") {		
				$timeMinuteOption = $timeMinuteOption + 10;
				echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
			}

echo "
			</SELECT>

			<select name=\"reminderTimeAmPm\" tabindex=\"3\">
			<OPTION  value=\"$schedAmPm\">$schedAmPm
			<OPTION  value=\"AM\">AM
			<OPTION  value=\"PM\">PM
			</SELECT>

			Day
			<select name=\"reminderTimeDay\" tabindex=\"\">
			<OPTION  value=\"$ReadableReminderSchedDay\">$ReadableReminderSchedDay
";
			$timeDayOption = 0;
			while ($timeDayOption <= "30") {		
				$timeDayOption = $timeDayOption + 1;
				echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
			}

echo "
			</SELECT>

			Month
			<SELECT name=\"reminderTimeMonth\" tabindex=\"55\">
			<OPTION  value=\"$ReadableReminderSchedMonthDigit\">$ReadableReminderSchedMonth
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

			Year
			<select name=\"reminderTimeYear\" tabindex=\"3\"\">
			<OPTION  value=\"$ReadableReminderSchedYear\">$ReadableReminderSchedYear
";
			$timeYearOptionSeconds = time(); //echo date("H:i:s");
			$timeYearOption = date("Y");
			$timeYearOptionLimit = $timeYearOption + 5;
			while ($timeYearOption <= $timeYearOptionLimit) {		
				echo "<OPTION  value=\"$timeYearOption\">$timeYearOption";
				$timeYearOption = $timeYearOption + 1;
			}

echo "
			</SELECT>
			$config_time_zone
			</TD>
		</TR>
		
		<TR>
			<TD>AssignedFrom</TD>
			<TD>
";
				//$UserID = $_SESSION['UserID'];
				// echo "\$UserID = $UserID ";
				// echo "<SELECT name=\"ReminderFromFkUserID\" tabindex=\"14\">";
				$JobFromFkUserID = $UserID; // Default value
				$dbs = new dbSession();
				$sql = "SELECT UserLogin, UserFirstname, UserID from user WHERE UserID = '$UserID'";
				$Results = $dbs->getResult($sql);
				$row = $dbs->getArray($Results);
				$UserLogin = $row[UserLogin];
				$FromUserFirstname = $row[UserFirstname];
				$toUserFirstname = $row[UserFirstname];
				echo "$UserLogin";
				echo "<input type=\"hidden\" name=\"ReminderFromFkUserID\" value=\"$UserID\">";
				
				//echo "<SELECT name=\"ReminderFromFkUserID\">";
				//$JobFromFkUserID = "1"; // Default value
				/**
				$dbs = new dbSession();
				$sql = "SELECT UserLogin, UserID from user WHERE UserActive = '1'";
				$Results = $dbs->getResult($sql);
				$row = $dbs->getArray($Results);
				echo "<OPTION value=\"$JobFromFkUserID\">$UserLogin";
				
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
	
				echo "<SELECT name=\"ReminderToFkUserID\">";
				$JobToFkUserID = "1"; // Default value
				
				$dbs = new dbSession();
				$sql = "SELECT UserLogin, UserID from user WHERE UserActive = '1'";
				$Results = $dbs->getResult($sql);
				$row = $dbs->getArray($Results);
				echo "<OPTION value=\"$UserID\">$UserLogin";
				echo "<OPTION value=\"2\">everyone";
				echo "<OPTION value=\"$row[UserID]\">$row[UserLogin]";
				
					while ($row = $dbs->getArray($Results)) {
						// $optValue = $row['UserID'];				
						echo "<OPTION value=\"$row[UserID]\">$row[UserLogin]";
						}
				echo "</SELECT>";
	
echo "	
			</TD>
		</TR>
		</TABLE>
";
        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {
                $debugMsg .= "Just above the Add reminder button.<BR>";
                $debugMsg .= "\$ClientID = $ClientID<BR />\n<BR>";
                include("config/debug.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"ReminderFkClientID\" value=\"$ClientID\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"insert_reminder\">";
	echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
	echo "<input type=\"hidden\" name=\"JobStatus\" value=\"Active\">";
	echo "<input type=\"hidden\" name=\"JobID\" value=\"$JobID\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" tabindex=\"18\" name=\"Submit\" value=\"Add Reminder\">";
	echo "</form><BR><BR>";
	
}

function insert_reminder() {
        $config_time_zone = $_POST['user_time_zone'];
	$ClientEmail = $_POST['ClientEmail'];
	$ClientFax = $_POST['ClientFax'];
	$ClientPhone2 = $_POST['ClientPhone2'];
	$ClientPhone1 = $_POST['ClientPhone1'];
	$ClientCountry = $_POST['ClientCountry'];
	$ClientPostcode = $_POST['ClientPostcode'];
	$ClientState = $_POST['ClientState'];
	$ClientCity = $_POST['ClientCity'];
	$ClientAddress2 = $_POST['ClientAddress2'];
	$ClientAddress1 = $_POST['ClientAddress1'];
	$ClientContactName = $_POST['ClientContactName'];
	$ClientPriority = $_POST['ClientPriority'];
	$ClientDate = $_POST['ClientDate'];
	$ClientType = $_POST['ClientType'];
	$ClientID = $_POST['ClientID'];
	$id = $_POST['id'];
	$id = $_POST['id'];
	$ReminderTitle = addslashes($_POST['ReminderTitle']);
	$ReminderToFkUserID = $_POST['ReminderToFkUserID'];
	$ReminderFromFkUserID = $_POST['ReminderFromFkUserID'];
	$ReminderType = $_POST['ReminderType'];
	$reminderTimeYear = $_POST['reminderTimeYear'];
	$reminderTimeMonth = $_POST['reminderTimeMonth'];
	$reminderTimeDay = $_POST['reminderTimeDay'];
	$reminderTimeAmPm = $_POST['reminderTimeAmPm'];
	$reminderTimeMinute = $_POST['reminderTimeMinute'];
	$reminderTimeHour = $_POST['reminderTimeHour'];
	$ReminderFkClientID = $_POST['ReminderFkClientID'];
	$StartTime = $_POST['StartTime'];
	$GotoClientCard = $_POST['GotoClientCard'];
	$SearchClientName = $_POST['SearchClientName'];
	$ClientUrl = $_POST['ClientUrl'];
	$JobType = $_POST['JobType'];
	$JobID = $_POST['JobID'];
	$JobFromFkUserID = $_POST['JobFromFkUserID'];
	$JobToFkUserID = $_POST['JobToFkUserID'];
	$JobCardNumber = $_POST['JobCardNumber'];
	$JobTimeInserted = $_POST['JobTimeInserted'];
	$JobTitle = $_POST['JobTitle'];
	$JobStatus = $_POST['JobStatus'];
	$InsertIntoDatabase = $_POST['InsertIntoDatabase'];
	$UserID = $_POST['UserID'];
  	
  	echo "<BR><BR>";
        /**
	if (($reminderTimeAmPm == "PM") AND ($reminderTimeHour <= 11)) {

		$reminderTimeMilitary = $reminderTimeHour + 12;

	}else{
		$reminderTimeMilitary = $reminderTimeHour;
	}
	*/
        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {
                $debugMsg .= "In insertJob() in addReminder.php<BR>";
                $debugMsg .= "\$config_time_zone = $config_time_zone<BR />\n<BR>";
                $debugMsg .= "\$UserID= $UserID<BR />\n<BR>";
                $debugMsg .= "\$ReminderFkClientID = $ReminderFkClientID<BR />\n<BR>";
	        $debugMsg .= "\$ReminderTitle = $ReminderTitle<BR />\n<BR>";
	        $debugMsg .= "\$reminderTimeHour = $reminderTimeHour<BR />\n<BR>";
	        $debugMsg .= "\$StartTime = $StartTime<BR />\n<BR>";
	        $debugMsg .= "\$reminderTimeMinute = $reminderTimeMinute<BR />\n<BR>";
	        $debugMsg .= "\$reminderTimeAmPm = $reminderTimeAmPm<BR />\n<BR>";
	        $debugMsg .= "\$reminderTimeDay = $reminderTimeDay<BR />\n<BR>";
	        $debugMsg .= "\$reminderTimeMonth = $reminderTimeMonth<BR />\n<BR>";
	        $debugMsg .= "\$reminderTimeYear = $reminderTimeYear<BR />\n<BR>";
	        $debugMsg .= "\$ReminderType = $ReminderType<BR />\n<BR>";		
	        $debugMsg .= "\$ReminderFromFkUserID = $ReminderFromFkUserID<BR />\n<BR>";
	        $debugMsg .= "\$ReminderToFkUserID = $ReminderToFkUserID<BR />\n<BR>";
	        $debugMsg .= "\$reminderTimeMilitary bb= $reminderTimeMilitary<BR />\n<BR>";
                include("config/debug.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
  	
  	
  	
	// include("config/tpl_bodystart.php");
	/**
	if (($reminderTimeAmPm == "PM") AND ($reminderTimeHour <= 11)) {

		$reminderTimeMilitary = $reminderTimeHour + 12;

	}else{
		$reminderTimeMilitary = $reminderTimeHour;
	}
        */
	

	// $ReminderSchedTimeInSecs = ConvertToSeconds($reminderTimeYear,$reminderTimeMonth,$reminderTimeDay,$reminderTimeMilitary,$reminderTimeMinute,0);
	// mktime(hour,min,sec,month,day,yr);
	// $ReminderSchedTimeInSecs = mktime($reminderTimeMilitary,$reminderTimeMinute,0,$reminderTimeMonth,$reminderTimeDay,$reminderTimeYear);
	$ReminderSchedTimeInSecs = time();
	$Ad_scheduled_time = new DateTime("@$ReminderSchedTimeInSecs");
        $zone_action = new DateTimeZone($config_time_zone); 
        $Ad_scheduled_time->setTimezone($zone_action);
        
        $format = 'Y m d h i s a P';
        $xx = "$reminderTimeYear $reminderTimeMonth $reminderTimeDay $reminderTimeHour $reminderTimeMinute 00 " . $reminderTimeAmPm . " " . $config_time_zone;
        $Ad_scheduled_time = DateTime::createFromFormat($format, $xx );
        $ReminderSchedTimeInSecs = $Ad_scheduled_time->format('U'); 
        
	// $ReminderTimeAddedInSecs = time();
	// $StartTime = $ReminderTimeAddedInSecs;
	$StartTime = time();
	
	$dbs = new dbSession();

	//	if ($InsertIntoDatabase != "") {
			$sql = "INSERT INTO reminder (ReminderFkJobID, ReminderFkClientID, ReminderFromFkUserID, ReminderToFkUserID, ReminderType, ReminderTimeAddedInSecs, ReminderSchedTimeInSecs, ReminderTitle) 
			VALUES ('$JobID', '$ReminderFkClientID', '$UserID', '$ReminderToFkUserID', '$ReminderType', '$ReminderTimeAddedInSecs', '$ReminderSchedTimeInSecs', '$ReminderTitle')";

			if ($dbs->getResult($sql)) {
					$msg = "Reminder Added.";
				} else {
					$msg = $dbs->printError();
				}
	//	} else {
	//		echo "<BR><BR>Not a valid Job Card Number. Please type it again.";
	//	}
	
	echo "$msg<BR><BR>";
	$ClientID = $ReminderFkClientID;
	//**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {
                $debugMsg .= "In insertJob() in addReminder.php<BR>";
                $debugMsg .= "\$ReminderFkClientID 2 = $ReminderFkClientID<BR />\n<BR>";
                include("config/debug.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
	// echo " <a href=\"clientcard2.php?id=$ClientID&StartTime=$StartTime\">Back to Client Card</a> ";
	if (empty($ReminderFkClientID)){
	}else{
	echo "Back to ";
	client_button_with_start_time($ReminderFkClientID,$StartTime);
	}
	if (empty($JobID)){
	}else{
	echo "<BR>";
	job_button($JobID,'','','');
	}
	echo "<form method=\"post\" action=\"./whiteBoard.php\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"whiteBoard\">";
        include ("log_in_authentication_form_vars.php");
        echo "<input class=\"top_buttons\"  type=\"submit\" name=\"action\" value=\"Job Board\">";
        echo "</form>";
	
}
function reminder_card() {
	$ReminderID = $_POST['ReminderID'];
	$ReminderFkClientID = $_POST['ReminderFkClientID'];
	$JobID = $_POST['JobID'];
	$JobCardNumber = $_POST['JobCardNumber'];
	$ClientID = $_POST['ClientID'];$StartTime = $_POST['StartTime'];
	$ReminderSchedTimeInSecs = $StartTime;
	if ( ! empty($ReminderID)) {
	
		$dbsReminder = new dbSession();
		$sql = "SELECT * from reminder WHERE ReminderID = \"$ReminderID\" LIMIT 1";
		$ResultsReminder = $dbsReminder->getResult($sql);
		$rowReminder = $dbsReminder->getArray($ResultsReminder);
		$ReminderFromFkUserID = $rowReminder['ReminderFromFkUserID'];
		// echo "\$ReminderFromFkUserID = $ReminderFromFkUserID <BR>";
		$ReminderToFkUserID = $rowReminder['ReminderToFkUserID'];
		$ReminderType = $rowReminder['ReminderType'];
		$ReminderTitle = $rowReminder['ReminderTitle'];
		$ReminderSchedTimeInSecs = $rowReminder['ReminderSchedTimeInSecs'];
		// *****************************************************************************
	        // ****************************************************** SCHEDULED TIME - START
	        $config_time_zone = $_POST['user_time_zone'];
	        // $ActionActionDateSecs = $row[ActionDateSecs];
	        $ReminderSchedTimeInSecs = $rowReminder['ReminderSchedTimeInSecs'];
	        if ( ($ReminderSchedTimeInSecs == 0) || empty($ReminderSchedTimeInSecs) ) {
		        $ReminderSchedTimeInSecs = time();
                        $update_cause_of_no_job_scehd_time = 1;
	        }
	        //****************************************************************
	        //******************************************** UNNECESSARY - START
	        // Unnecessary as timestamp is unaffected by time zone change.
	        // After PHP 5.3 you can get human readable date/ times by 
	        // setting the time zone. --> Although I have reinstated the bit
	        // that spews back the human readable with the CORRECT time zone.
	        $Ad_scheduled_time = new DateTime("@$ReminderSchedTimeInSecs");
                $zone_action = new DateTimeZone($config_time_zone);
                $Ad_scheduled_time->setTimezone($zone_action);
	        //********************************************** UNNECESSARY - END
	        //****************************************************************
	
	        // ******************************************************** SCHEDULED TIME - END
	        // *****************************************************************************
		$ReminderFkJobID = $rowReminder['ReminderFkJobID'];
		$ReminderEstimateTimeInSecs = $rowReminder['ReminderEstimateTimeInSecs'];
		if ( empty($ReminderFkClientID) ) {
		        $ReminderFkClientID = $rowReminder['ReminderFkClientID'];
		}
		//if (($ReminderFkClientID == "0") || ($ReminderFkClientID != $ClientID)) {
		//	$ReminderFkClientID = $ClientID;
		// }
		// echo "\$ReminderFkClientID = $ReminderFkClientID";
		// echo "\$ReminderSchedTimeInSecs = $ReminderSchedTimeInSecs";

		
		
//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
				$debug = $_POST['debug'];
				$debugMsg .= "\$ReminderEstimateTimeInSecs = $ReminderEstimateTimeInSecs<BR />\n<BR>";
				include("config/debug.php");
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************

		// $ActionDateTime = date("H:i:s d-M-Y",$ActionDateSecs);
		//$ReadableReminderSchedTime = date("H:i:s", mktime(0,0,$ReminderSchedTimeInSecs));
		//$ReadableReminderSchedTime = date("H:i:s", $ReminderSchedTimeInSecs);
		
	        $ReadableReminderSchedTime = $Ad_scheduled_time->format('Y m d h i s a P');
	        $schedHourMadeTo12HourClock = $Ad_scheduled_time->format('h');
	        $ReadableReminderSchedminute = $Ad_scheduled_time->format('i');
	        $schedAmPm = $Ad_scheduled_time->format('a');
	        $ReadableReminderSchedDay = $Ad_scheduled_time->format('d');
	        $ReadableReminderSchedMonth = $Ad_scheduled_time->format('M');
	        $ReadableReminderSchedMonthDigit = $Ad_scheduled_time->format('m');
	        $ReadableReminderSchedYear = $Ad_scheduled_time->format('Y');
                /**
		$ReadableReminderSchedTime = date("H:i:s d-M-Y",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedHour = date("H",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedminute = date("i",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedDay = date("d",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedMonth = date("M",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedMonthDigit = date("m",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedYear = date("Y",$ReminderSchedTimeInSecs);
		
		if ($ReadableReminderSchedHour >= 13) {
			$schedHourMadeTo12HourClock = $ReadableReminderSchedHour - 12;
			$schedAmPm = "PM";
		}elseif ($ReadableReminderSchedHour == 12) {
			$schedHourMadeTo12HourClock = $ReadableReminderSchedHour;
			$schedAmPm = "PM";
		}else{
			$schedHourMadeTo12HourClock = $ReadableReminderSchedHour;
			$schedAmPm = "AM";
		}
                */
		
//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
		$debug = $_POST['debug'];
		$debugMsg .= "\$ReminderSchedTimeInSecs = $ReminderSchedTimeInSecs<BR /><BR>";
		$debugMsg .= "\$ReadableReminderSchedTime = $ReadableReminderSchedTime<BR /><BR>";
		$debugMsg .= "\$ReadableReminderSchedHourlyyyyyyyyyy = $ReadableReminderSchedHour<BR /><BR>";
		$debugMsg .= "\$ReadableReminderSchedMonthDigit = $ReadableReminderSchedMonthDigit<BR /><BR>";
		include("config/debug.php");
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************

		$dbsClientName = new dbSession();
		$sql = "SELECT ClientName from client WHERE ClientID = \"$ReminderFkClientID\" LIMIT 1";
		$ResultsClient = $dbsClientName->getResult($sql);
		$rowClient = $dbsClientName->getArray($ResultsClient);
		$clientName = $rowClient['ClientName'];
	
		$dbsFromUserFirstName = new dbSession();
		$sql = "SELECT UserFirstname from user WHERE UserID = \"$ReminderFromFkUserID\" LIMIT 1";
		$ResultsFromUser = $dbsFromUserFirstName->getResult($sql);
		$rowFromUser = $dbsFromUserFirstName->getArray($ResultsFromUser);
		$FromUserFirstname = $rowFromUser['UserFirstname'];

		$dbsToUserFirstName = new dbSession();
		$sqlToUser = "SELECT UserFirstname from user WHERE UserID = \"$ReminderToFkUserID\" LIMIT 1";
		$ResultsToUser = $dbsToUserFirstName->getResult($sqlToUser);
		$rowToUser = $dbsToUserFirstName->getArray($ResultsToUser);
		$toUserFirstname = $rowToUser['UserFirstname'];
		
			$dbsJob = new dbSession();
			$sqlJob = "SELECT JobID, JobCardNumber, JobTitle from job WHERE JobID = \"$ReminderFkJobID\" LIMIT 1";
			$ResultsToUser = $dbsJob->getResult($sqlJob);
			$rowJob = $dbsJob->getArray($ResultsToUser);
			$JobCardNumber = $rowJob['JobCardNumber'];
			if (empty($JobID)) {
				$JobID = $rowJob['JobID'];
			}
	}else{
		$ReminderFkClientID = $ClientID;
		$dbsClientName = new dbSession();
		$sql = "SELECT ClientName from client WHERE ClientID = \"$ReminderFkClientID\" LIMIT 1";
		$ResultsClient = $dbsClientName->getResult($sql);
		$rowClient = $dbsClientName->getArray($ResultsClient);
		$clientName = $rowClient['ClientName'];
		// echo "\$clientName = $clientName";
		// echo "\$ReminderFkClientID = $ReminderFkClientID";

		$ReminderSchedTimeInSecs = $StartTime;
		// *****************************************************************************
	        // ****************************************************** SCHEDULED TIME - START
	        $config_time_zone = $_POST['user_time_zone'];
	        // $ActionActionDateSecs = $row[ActionDateSecs];
	        $ReminderSchedTimeInSecs = $rowReminder['ReminderSchedTimeInSecs'];
	        if ( ($ReminderSchedTimeInSecs == 0) || empty($ReminderSchedTimeInSecs) ) {
		        $ReminderSchedTimeInSecs = time();
                        $update_cause_of_no_job_scehd_time = 1;
	        }
	        //****************************************************************
	        //******************************************** UNNECESSARY - START
	        // Unnecessary as timestamp is unaffected by time zone change.
	        // After PHP 5.3 you can get human readable date/ times by 
	        // setting the time zone. --> Although I have reinstated the bit
	        // that spews back the human readable with the CORRECT time zone.
	        $Ad_scheduled_time = new DateTime("@$ReminderSchedTimeInSecs");
                $zone_action = new DateTimeZone($config_time_zone);
                $Ad_scheduled_time->setTimezone($zone_action);
	        //********************************************** UNNECESSARY - END
	        //****************************************************************
	
	        // ******************************************************** SCHEDULED TIME - END
	        // *****************************************************************************
		$ReadableReminderSchedTime = $Ad_scheduled_time->format('Y m d h i s a P');
	        $schedHourMadeTo12HourClock = $Ad_scheduled_time->format('h');
	        $ReadableReminderSchedminute = $Ad_scheduled_time->format('i');
	        $schedAmPm = $Ad_scheduled_time->format('a');
	        $ReadableReminderSchedDay = $Ad_scheduled_time->format('d');
	        $ReadableReminderSchedMonth = $Ad_scheduled_time->format('M');
	        $ReadableReminderSchedMonthDigit = $Ad_scheduled_time->format('m');
	        $ReadableReminderSchedYear = $Ad_scheduled_time->format('Y');
	        /**
		$ReadableReminderSchedTime = date("H:i:s d-M-Y",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedHour = date("H",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedminute = date("i",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedDay = date("d",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedMonth = date("M",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedMonthDigit = date("m",$ReminderSchedTimeInSecs);
		$ReadableReminderSchedYear = date("Y",$ReminderSchedTimeInSecs);
		
		if ($ReadableReminderSchedHour >= 13) {
			$schedHourMadeTo12HourClock = $ReadableReminderSchedHour - 12;
			$schedAmPm = "PM";
		}elseif ($ReadableReminderSchedHour == 12) {
			$schedHourMadeTo12HourClock = $ReadableReminderSchedHour;
			$schedAmPm = "PM";
		}else{
			$schedHourMadeTo12HourClock = $ReadableReminderSchedHour;
			$schedAmPm = "AM";
		}
                */
		
//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
				$debug = $_POST['debug'];
				$debugMsg .= "\$ReminderSchedTimeInSecs = $ReminderSchedTimeInSecs<BR /><BR>";
				$debugMsg .= "\$ReadableReminderSchedTime = $ReadableReminderSchedTime<BR /><BR>";
				$debugMsg .= "\$ReadableReminderSchedHourlyyyyyyyyyy = $ReadableReminderSchedHour<BR /><BR>";
				$debugMsg .= "\$ReadableReminderSchedMonthDigit = $ReadableReminderSchedMonthDigit<BR /><BR>";
				include("config/debug.php");
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************
	}
$ReminderType = "Reminder";
$header_size = $_POST['header_size'];
echo "<H" . $header_size . ">Reminder Card</H" . $header_size . ">";	
echo "  <!-- <H3>Reminder Card</H3> -->
	
	<TABLE>
                <TR>
			<TD>Related to Client</TD>
			<TD>
";
				echo "$clientName";
				// echo "<a href=\"reminderCard.php?JobID=$JobID&JobCardNumber=$JobCardNumber&OptionCatch=SearchClient8&ReminderID=$ReminderID&StartTime=$StartTime&AddMessageTermination=1&id=$id\" tabindex=\"12\">  Change </a>";
				echo "<form method=\"post\" id=\"change_client_in_reminder_button_form\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"search_client_in_reminder_card\">";
                                echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                                echo "<input type=\"hidden\" name=\"id\" value=\"" . $id . "\">";
                                echo "<input type=\"hidden\" name=\"JobID\" value=\"$JobID\">";
                                include("log_in_authentication_form_vars.php");
                                echo "<button type=\"submit\" form=\"change_client_in_reminder_button_form\" value=\"submit\">Change</button>";
                                echo "</form>"; 
				
echo "
		</TD>
	        </TR>
		<!-- <TR>
			<TD>Type</TD>
			<TD><select name=\"ReminderType\" tabindex=\"1\"\">
			<OPTION  value=\"$ReminderType\">$ReminderType
			<OPTION  value=\"Reminder\">Reminder
			<OPTION  value=\"Call\">Call
			<OPTION  value=\"Email\">Email
			<OPTION  value=\"Fax\">Fax
			<OPTION  value=\"Job\">Job
			<OPTION  value=\"Meeting\">Meeting
			</TD>
		</TR> -->
		<TR>
			<TD><form method=\"post\" action=\"$PHP_SELF\">Title</TD>
			<TD>
				<TEXTAREA tabindex=\"2\" rows=\"5\" cols=\"20\" 
				name=\"ReminderTitle\" WRAP=\"soft\">$ReminderTitle</TEXTAREA>
			</TD>
		</TR>
		<TR>
			<TD>Scheduled Time</TD>
			<TD>
			<select name=\"reminderTimeHour\" tabindex=\"3\"\">
			<OPTION  value=\"$schedHourMadeTo12HourClock\">$schedHourMadeTo12HourClock
";
			$timeHourOption = 0;
			while ($timeHourOption <= "11") {		
				$timeHourOption = $timeHourOption + 1;
				echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
			}

echo "
			</SELECT>
			
			:
			<select name=\"reminderTimeMinute\" tabindex=\"4\">
			<OPTION  value=\"$ReadableReminderSchedminute\">$ReadableReminderSchedminute
";
			$timeMinuteOption = "00";
			echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
			while ($timeMinuteOption <= "40") {		
				$timeMinuteOption = $timeMinuteOption + 10;
				echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
			}

echo "
			</SELECT>

			<select name=\"reminderTimeAmPm\" tabindex=\"5\">
			<OPTION  value=\"$schedAmPm\">$schedAmPm
			<OPTION  value=\"AM\">AM
			<OPTION  value=\"PM\">PM
			</SELECT>

			Day
			<select name=\"reminderTimeDay\" tabindex=\"6\">
			<OPTION  value=\"$ReadableReminderSchedDay\">$ReadableReminderSchedDay
";
			$timeDayOption = 0;
			while ($timeDayOption <= "30") {		
				$timeDayOption = $timeDayOption + 1;
				echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
			}

echo "
			</SELECT>

			Month
			<SELECT name=\"reminderTimeMonth\" tabindex=\"7\">
			<OPTION  value=\"$ReadableReminderSchedMonthDigit\">$ReadableReminderSchedMonth
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
";

			/**
			<OPTION  value=\"\">June
			<OPTION  value=\"\">July
			<OPTION  value=\"\">August
			<OPTION  value=\"\">September
			<OPTION  value=\"\">October
			<OPTION  value=\"\">November
			<OPTION  value=\"\">December
			*/


echo "
			Year
			<select name=\"reminderTimeYear\" tabindex=\"8\"\">
			<OPTION  value=\"$ReadableReminderSchedYear\">$ReadableReminderSchedYear
";
			$timeYearOptionSeconds = time(); //echo date("H:i:s");
			$timeYearOption = date("Y");
			$timeYearOptionLimit = $timeYearOption + 5;
			while ($timeYearOption <= $timeYearOptionLimit) {		
				echo "<OPTION  value=\"$timeYearOption\">$timeYearOption";
				$timeYearOption = $timeYearOption + 1;
			}

			$ReminderTotalTimeHour = date("H", mktime(0,0,$ReminderEstimateTimeInSecs));
			$ReminderTotalTimeMins = date("i", mktime(0,0,$ReminderEstimateTimeInSecs));
			// $ReminderTotalTimeDays = date("D", mktime(0,0,$ReminderEstimateTimeInSecs));
			$ReminderTotalTimeDays = floor(($ReminderEstimateTimeInSecs / 86400));
			// $ReminderTotalTimeDays = round(($ReminderEstimateTimeInSecs / 86400));
			// echo "\$ReminderTotalTimeDays = $ReminderTotalTimeDays";
			// echo "blaaa";

echo "
			</SELECT>
			$config_time_zone
			</TD>
		</TR>
		<!-- <TR>
			<TD>Estimated Time</TD>
			<TD>
			<input tabindex=\"9\" type=\"text\" name=\"estimatedDays\" value=\"$ReminderTotalTimeDays\">
			Days
			<input tabindex=\"10\" type=\"text\" name=\"estimatedHours\" value=\"$ReminderTotalTimeHour\">
			Hours
			<input tabindex=\"11\" type=\"text\" name=\"estimatedMins\" value=\"$ReminderTotalTimeMins\">
			Minutes
			</TD>
			<TD>
";
				// echo "$clientName";

				/** echo "  change";

					$dbs = new dbSession();
					$sql = "SELECT ClientID, ClientName from Client WHERE ClientID = '$ActionRelToFkClientID' ORDER BY 'ClientName' ASC";
					$Results = $dbs->getResult($sql);
					$row = $dbs->getArray($Results);
					$clientName = $row['ClientName'];
					

				echo "<a href=\"reminderCard.php?JobID=$JobID&JobCardNumber=$JobCardNumber&OptionCatch=SearchClient8&ReminderID=$ReminderID&StartTime=$StartTime&AddMessageTermination=1&id=$id\">  Change </a>";

				
				echo "<SELECT name=\"ReminderFkClientID\">";
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
		</TR> -->
		<!-- 
                <TR>
			<TD>Related to Job</TD>
			<TD>
";
				echo "$JobID - $JobCardNumber";

				echo "<a href=\"reminderCard.php?ClientID=$ClientID&OptionCatch=SearchJob&ReminderID=$ReminderID&StartTime=$StartTime&AddMessageTermination=1&id=$id\" tabindex=\"13\">  Change </a>";

echo "
		</TD>
		</TR> -->
		<TR>
			<TD>AssignedFrom</TD>
			<TD>
";
				// $UserID = $_SESSION['UserID'];
				//echo "ReminderID = $ReminderID ";
				// echo "<SELECT name=\"ReminderFromFkUserID\" tabindex=\"14\">";
				$JobFromFkUserID = $UserID; // Default value
				$dbs = new dbSession();
				$sql = "SELECT UserFirstname, UserID from user WHERE UserID = '$ReminderFromFkUserID'";
				$Results = $dbs->getResult($sql);
				$row = $dbs->getArray($Results);
				$FromUserFirstname = $row[UserFirstname];
				echo "$FromUserFirstname";

				$dbsx = new dbSession();
				$sqlx = "SELECT UserFirstname, UserID from user WHERE UserActive = '1' ";
				$Resultsx = $dbsx->getResult($sqlx);
				$rowx = $dbsx->getArray($Resultsx);
				/** echo "<OPTION value=\"$ReminderFromFkUserID\">$FromUserFirstname";
					echo "<OPTION value=\"$rowx[UserID]\">$rowx[UserFirstname]";
				//echo "userID = $rowx[UserID]";
					while ($rowx = $dbsx->getArray($Resultsx)) {
						//echo "userID = $rowx[UserID]";
						echo "<OPTION value=\"$rowx[UserID]\">$rowx[UserFirstname]";
						}
				echo "</SELECT>"; */
	
echo "	
			</TD>
		</TR>

		<TR>
			<TD>AssignedTo</TD>
			<TD>
";
				
				echo "<SELECT name=\"ReminderToFkUserID\" tabindex=\"14\">";
				// echo "\$ReminderToFkUserID = $ReminderToFkUserID";
				$dbs = new dbSession();
				$sql = "SELECT UserFirstname, UserID from user WHERE UserID = '$ReminderToFkUserID'";
				$Results = $dbs->getResult($sql);
				$row = $dbs->getArray($Results);
				$toUserFirstname = $row[UserFirstname];
				$ReminderToFkUserID = $row[UserID];

				//echo "<SELECT name=\"ReminderToFkUserID\" tabindex=\"15\">";
				//$JobToFkUserID = "1"; // Default value
				
				$dbs2 = new dbSession();
				$sql = "SELECT UserFirstname, UserID from user WHERE UserActive = '1' ";
				$Results = $dbs2->getResult($sql);
				$row2 = $dbs2->getArray($Results);
				echo "<OPTION value=\"$ReminderToFkUserID\">$toUserFirstname";
					echo "<OPTION value=\"$row2[UserID]\">$row2[UserFirstname]";
					echo "<OPTION value=\"2\">Everyone";
					while ($row2 = $dbs2->getArray($Results)) {
						// $optValue = $row['UserID'];				
						echo "<OPTION value=\"$row2[UserID]\">$row2[UserFirstname]";
						}
				echo "</SELECT>";
	
echo "	
			</TD>
		</TR>
		</TABLE>
";
	$ReminderID = $_POST['ReminderID'];
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"ReminderFkJobID\" value=\"$JobID\">";
	echo "<input type=\"hidden\" name=\"ReminderFkClientID\" value=\"$ReminderFkClientID\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"locUpdateReminder\">";
	echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
	echo "<input type=\"hidden\" name=\"JobStatus\" value=\"Active\">";
	echo "<input type=\"hidden\" name=\"ReminderID\" value=\"$ReminderID\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" tabindex=\"16\" name=\"Submit\" value=\"Apply Changes\">";
	echo "</form>";
	echo "</DIV>";
}
function locUpdateReminder() {
	//-------------------------------------
	//echo "IIIIIIIIIIIIIIIIIIIIIIIIn this reminter function";
	$ReminderTitle = addslashes($_POST['ReminderTitle']);
	$ReminderID = $_POST['ReminderID'];
	//--------------------------------------
        $config_time_zone = $_POST['user_time_zone'];
	$ClientEmail = $_POST['ClientEmail'];
	$ClientFax = $_POST['ClientFax'];
	$ClientPhone2 = $_POST['ClientPhone2'];
	$ClientPhone1 = $_POST['ClientPhone1'];
	$ClientCountry = $_POST['ClientCountry'];
	$ClientPostcode = $_POST['ClientPostcode'];
	$ClientState = $_POST['ClientState'];
	$ClientCity = $_POST['ClientCity'];
	$ClientAddress2 = $_POST['ClientAddress2'];
	$ClientAddress1 = $_POST['ClientAddress1'];
	$ClientContactName = $_POST['ClientContactName'];
	$ClientPriority = $_POST['ClientPriority'];
	$ClientDate = $_POST['ClientDate'];
	$ClientType = $_POST['ClientType'];
	$ClientID = $_POST['ClientID'];
	$id = $_POST['id'];
	
	$ReminderToFkUserID = $_POST['ReminderToFkUserID'];
	$ReminderFromFkUserID = $_POST['ReminderFromFkUserID'];
	$ReminderType = $_POST['ReminderType'];
	$reminderTimeYear = $_POST['reminderTimeYear'];
	$reminderTimeMonth = $_POST['reminderTimeMonth'];
	$reminderTimeDay = $_POST['reminderTimeDay'];
	$reminderTimeAmPm = $_POST['reminderTimeAmPm'];
	$reminderTimeMinute = $_POST['reminderTimeMinute'];
	$reminderTimeHour = $_POST['reminderTimeHour'];
	$ReminderFkClientID = $_POST['ReminderFkClientID'];
	$StartTime = $_POST['StartTime'];
	$GotoClientCard = $_POST['GotoClientCard'];
	$SearchClientName = $_POST['SearchClientName'];
	$ClientUrl = $_POST['ClientUrl'];
	$JobType = $_POST['JobType'];
	$JobID = $_POST['JobID'];
	$JobFromFkUserID = $_POST['JobFromFkUserID'];
	$JobToFkUserID = $_POST['JobToFkUserID'];
	$JobCardNumber = $_POST['JobCardNumber'];
	$JobTimeInserted = $_POST['JobTimeInserted'];
	$JobTitle = $_POST['JobTitle'];
	$JobStatus = $_POST['JobStatus'];
	$InsertIntoDatabase = $_POST['InsertIntoDatabase'];
	$estimatedDays = $_POST['estimatedDays'];
	$estimatedHours = $_POST['estimatedHours'];
	$estimatedMins = $_POST['estimatedMins'];
  	
  	echo "<DIV align=\"center\">";
  	/**
	if (($reminderTimeAmPm == "PM") AND ($reminderTimeHour <= 12)) {

		$reminderTimeMilitary = $reminderTimeHour + 12;

	}else{
		$reminderTimeMilitary = $reminderTimeHour;
	}
        */
	$estimatedDaysInSecs = $estimatedDays * 86400;
	$estimatedHoursInSecs = $estimatedHours * 3600;
	$estimatedMinsInSecs = $estimatedMins * 60;

	$totalEstimatedTime = ($estimatedDaysInSecs + $estimatedHoursInSecs + $estimatedMinsInSecs);


//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
				$debug = $_POST['debug'];
					$debugMsg .= "\$totalEstimatedTime = $totalEstimatedTime<BR />\n<BR>";
					$debugMsg .= "\$estimatedDays = $estimatedDays<BR />\n<BR>";
					$debugMsg .= "\$reminderTimeHour = $reminderTimeHour<BR />\n<BR>";
					$debugMsg .= "\$StartTime = $StartTime<BR />\n<BR>";
					$debugMsg .= "\$estimatedDays = $estimatedDays<BR />\n<BR>";
					$debugMsg .= "\$reminderTimeMinute = $reminderTimeMinute<BR />\n<BR>";
					$debugMsg .= "\$reminderTimeAmPm = $reminderTimeAmPm<BR />\n<BR>";
					$debugMsg .= "\$reminderTimeDay = $reminderTimeDay<BR />\n<BR>";
					$debugMsg .= "\$reminderTimeMonth = $reminderTimeMonth<BR />\n<BR>";
					$debugMsg .= "\$reminderTimeYear = $reminderTimeYear<BR />\n<BR>";
					$debugMsg .= "\$ReminderType = $ReminderType<BR />\n<BR>";		
					$debugMsg .= "\$ReminderFromFkUserID = $ReminderFromFkUserID<BR />\n<BR>";
					$debugMsg .= "\$ReminderToFkUserID = $ReminderToFkUserID<BR />\n<BR>";
					$debugMsg .= "\$reminderTimeMilitary = $reminderTimeMilitary<BR />\n<BR>";
				include("config/debug.php");
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************

	

	
	/**
	if (($reminderTimeAmPm == "PM") AND ($reminderTimeHour <= 11)) {

		$reminderTimeMilitary = $reminderTimeHour + 12;

	}else{
		$reminderTimeMilitary = $reminderTimeHour;
	}*/

	

	// $ReminderSchedTimeInSecs = ConvertToSeconds($reminderTimeYear,$reminderTimeMonth,$reminderTimeDay,$reminderTimeMilitary,$reminderTimeMinute,0);
	// mktime(hour,min,sec,month,day,yr);
	// $ReminderSchedTimeInSecs = mktime($reminderTimeMilitary,$reminderTimeMinute,0,$reminderTimeMonth,$reminderTimeDay,$reminderTimeYear);
	$ReminderSchedTimeInSecs = time();
	$Ad_scheduled_time = new DateTime("@$ReminderSchedTimeInSecs");
        $zone_action = new DateTimeZone($config_time_zone); 
        $Ad_scheduled_time->setTimezone($zone_action);
        
        $format = 'Y m d h i s a P';
        $xx = "$reminderTimeYear $reminderTimeMonth $reminderTimeDay $reminderTimeHour $reminderTimeMinute 00 " . $reminderTimeAmPm . " " . $config_time_zone;
        $Ad_scheduled_time = DateTime::createFromFormat($format, $xx );
        $ReminderSchedTimeInSecs = $Ad_scheduled_time->format('U'); 
	//echo "time a =" . mktime($reminderTimeMilitary,$reminderTimeMinute,0,$reminderTimeMonth,$reminderTimeDay,$reminderTimeYear) . "<BR>";

	//echo "time b =" . mktime(1,$reminderTimeMinute,0,$reminderTimeMonth,$reminderTimeDay,$reminderTimeYear);

	//$ReminderTimeAddedInSecs = time();
	//$StartTime = $ReminderTimeAddedInSecs;
	$StartTime = time();
	
	$dbs = new dbSession();

	//	if ($InsertIntoDatabase != "") {
			
			$sql = "UPDATE reminder SET ReminderFkClientID = '$ReminderFkClientID', ReminderFromFkUserID = '$ReminderFromFkUserID', ReminderToFkUserID = '$ReminderToFkUserID', ReminderType = '$ReminderType', ReminderTimeAddedInSecs = '$ReminderTimeAddedInSecs', ReminderSchedTimeInSecs = '$ReminderSchedTimeInSecs', ReminderTitle = '$ReminderTitle', ReminderEstimateTimeInSecs= '$totalEstimatedTime' WHERE ReminderID = '$ReminderID'";

			/**
			$sql = "UPDATE Reminder SET (ReminderFkJobID, ReminderFkClientID, ReminderFromFkUserID, ReminderToFkUserID, ReminderType, ReminderTimeAddedInSecs, ReminderSchedTimeInSecs, ReminderTitle) VALUES ('$ReminderFkJobID', '$ReminderFkClientID', '$ReminderFromFkUserID', '$ReminderToFkUserID', '$ReminderType', '$ReminderTimeAddedInSecs', '$ReminderSchedTimeInSecs', '$ReminderTitle') WHERE ReminderID = '$ReminderID'";*/

/**
			$sql = "UPDATE Job SET JobCardNumber = '$JobCardNumber', JobStatus = '$JobStatus', 
			JobType = '$JobType', JobFkClientID = '$JobFkClientID', 
			JobFromFkUserID = '$JobFromFkUserID', JobToFkUserID = '$JobToFkUserID', 
			JobTimeInserted = '$JobTimeInserted', JobCardNumber = '$JobCardNumber', 
			JobTitle = '$JobTitle', JobDescription = '$JobDescription', 
			JobParts = '$JobParts' WHERE JobID = '$JobID'";
			*/

			if ($dbs->getResult($sql)) {
					echo "<DIV align=\"center\">";
					$msg = "Reminder Updated.";
					echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT><BR><BR>";
                                        echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"whiteBoard\">";
                                        include ("log_in_authentication_form_vars.php");
                                        echo "<input class=\"top_buttons\"  type=\"submit\" name=\"action\" value=\"Job Board 1\">";
                                        echo "</form>";
					// locReminderCheck();     // Found in reminder_functions.php
					echo "<BR>";
					echo "</DIV>";
				} else {
					$msg = $dbs->printError();
					echo "<BR>$msg";
					echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"whiteBoard\">";
                                        include ("log_in_authentication_form_vars.php");
                                        echo "<input class=\"top_buttons\"  type=\"submit\" name=\"action\" value=\"Job Board 1\">";
                                        echo "</form>";
					// locReminderCheck();     // Found in reminder_functions.php
					echo "</DIV>";
				}
	$ClientID = $ReminderFkClientID;
}
function dismiss_ok_reminder() {
	$ReminderID = $_POST['ReminderID'];
	echo "<DIV align=\"center\">";
	$ReminderTimeDismissedInSecs = time();
	$dbs = new dbSession();
	$sql = "UPDATE reminder SET ReminderTimeDismissedInSecs = '$ReminderTimeDismissedInSecs' WHERE ReminderID = '$ReminderID'";
		if ($dbs->getResult($sql)) {
			$msg = "<BR>Reminder Cleared.";
			echo "<FONT SIZE=\"4\" COLOR=\"#339900\">$msg</FONT><BR><BR>";
			locReminderCheck();     // Found in reminder_functions.php
                        job_board();            // Found in job_board_functions.php
			//Onsite();
			echo "<BR>";
		} else {
			$msg = $dbs->printError();
			echo "<FONT SIZE=\"4\" COLOR=\"#CC0000\">$msg</FONT>";
			locReminderCheck();     // Found in reminder_functions.php
                        job_board();            // Found in job_board_functions.php
			//Onsite();
			echo "<BR>";
		}
	echo "</DIV>";
}

?>
