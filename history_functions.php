<?PHP 

function history_list() {
// echo "In case statement history. <BR>";	
	//THIS SECTION IS TESTING THE NO GLOBALS IN PHP.INI - START
		$id = $_POST['id'];
		$name = $_POST['name'];
		$StartTime = $_POST['StartTime'];
	//THIS SECTION IS TESTING THE NO GLOBALS IN PHP.INI - END
//**********************************************************************************************
//********************************************************************** SETUP START TIME - START

			$StartTime = $_POST['StartTime'];

			if( ($_POST['StartTime']) > ($StartTime) )
			{
				$StartTime = $_POST['StartTime'];
			}
			elseif( ($_POST['StartTime']) < ($StartTime) )
			{
				$StartTime = $_POST['StartTime'];
			}
			else
			{
				$StartTime = time();
			}


//********************************************************************** SETUP START TIME - END
//**********************************************************************************************	


//**********************************************************************************************
//**************************************************************************** TIME ZONE - START
	// echo "\$callOrder = $callOrder";
	
	$dbst = new dbSession();
	$sqlt = "SELECT * from config WHERE ConfigID = 1 LIMIT 0, 30";
	
	$Resultst = $dbst->getResult($sqlt);
	
	while ($rowt = $dbst->getArray($Resultst)) {
	
	$config_time_zone = $rowt['config_time_zone'];
	$_POST['config_time_zone'] = $config_time_zone;
	}
	//echo "\$config_time_zone = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";
	
//****************************************************************************** TIME ZONE - END
//**********************************************************************************************

	if ($callOrder == 1) {
	LocCallOrderUpdate();
	}
	
	/**
	echo "Choose from active users<BR>";

	$dbs = new dbSession();
	$sql = "SELECT UserLogin from user WHERE UserActive = 1 LIMIT 0, 30";
	
	$Results = $dbs->getResult($sql);
	
	while ($row = $dbs->getArray($Results)) {
	
	$ActionDateSecs = $row[ClientDate];
	if ($ActionDateSecs == "") {
	$ActionDateTime = "Unknown";
	} else {
	$ActionDateTime = date("H:i:s d-M-Y",$ActionDateSecs);
	}
	$_POST['ActionDateTime'] = $ActionDateTime;
		
	echo "<form method=\"post\" action=\"$PHP_SELF\" >";	
	$UserLogin = $row['UserLogin'];
	
	echo "UserLogin = $UserLogin<BR>";

	}
	*/
	echo "<BR>";
	
//**********************************************************************************************
//************************************************************************** TIME ZONE 2 - START
	// For more info see date_tone_offset_unix.php - DP Thu 5 Feb 2015 12:22AEST
	$config_time_zone = $_POST['config_time_zone'];
	$user_time_zone = $_POST['user_time_zone']; 
	$date_time_zone_start = new DateTimeZone($user_time_zone);
	$right_now = time();
	$Start_time_with_offset = $right_now - 604800;
	$date_start = new DateTime("@$Start_time_with_offset", $date_time_zone_start);
	$date_start->setTimezone($date_time_zone_start);
	//echo $date_start->format('Y-m-d H:i:s') . "hnb<BR>";
	$date_hr = $date_start->format('H') . "<BR>";
        //echo $date_hr;
        $Start_time_with_offset = $date_start->format('U');
	/**
	$config_time_zone = $_POST['config_time_zone'];
	//echo "\$config_time_zone = $config_time_zone <BR>";
	
	$MNTTZ = new DateTimeZone($config_time_zone);

	$dt = new DateTime();

	$dt->setTimezone($MNTTZ);

	$StartTime = $dt->format('U');
	
	$date = new DateTime("@$StartTime");
	$date->setTimezone($MNTTZ);
	
	// $date->setTimezone($MNTTZ);
	
	
	$Start_time_offset = $date->getOffset();
	*/
	//$Start_time_with_offset = $StartTime + $Start_time_offset - (3600*2) - 604800;
	
	
	$_POST['Start_time_with_offset'] = $Start_time_with_offset; 
	
//**************************************************************************** TIME ZONE 2 - END
//**********************************************************************************************

	// ****************************************************************
	// This is to convert the unix time to a readble 24hour clock - Start

		$ReadableJobSchedTime = date("H:i:s d-M-Y",$Start_time_with_offset);
		
		//$ReadableJobSchedHour = date("H",$Start_time_with_offset);
		$ReadableJobSchedHour = $date_start->format('H');
		//$ReadableJobSchedminute = date("i",$Start_time_with_offset);
		$ReadableJobSchedminute = $date_start->format('i');
		//$ReadableJobSchedDay = date("d",$Start_time_with_offset);
		$ReadableJobSchedDay = $date_start->format('d');
		//$ReadableJobSchedMonth = date("M",$Start_time_with_offset);
		$ReadableJobSchedMonth= $date_start->format('M');
		//$ReadableJobSchedMonthDigit = date("m",$Start_time_with_offset);
		$ReadableJobSchedMonthDigit = $date_start->format('m');
		//$ReadableJobSchedYear = date("Y",$Start_time_with_offset);
		$ReadableJobSchedYear= $date_start->format('Y');
		
		if ($ReadableJobSchedHour >= 13) {
			$schedHourMadeTo12HourClock = $ReadableJobSchedHour - 12;
			$schedAmPm = "PM";
		}elseif ($ReadableJobSchedHour == 12) {
			$schedHourMadeTo12HourClock = $ReadableJobSchedHour;
			$schedAmPm = "PM";
		}else{
			$schedHourMadeTo12HourClock = $ReadableJobSchedHour;
			$schedAmPm = "AM";
		}
	// This is to convert the unix time to a readble 24hour clock - End
	// ****************************************************************
echo "<DIV align=\"center\"><!-- <H2>History</H2> -->";	
$header_size = $_POST['header_size'];
echo "<H" . $header_size . ">History</H" . $header_size . ">";
echo "<form method=\"post\" action=\"./index.php\">";	
echo "  Time Zone - $user_time_zone.<BR>
	<TABLE>";
	echo "
		<TR>
		<TD>Start Time</TD>
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
		<OPTION  value=\"AM\">AM
		<OPTION  value=\"PM\">PM
		</SELECT>

		Day
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

		Month
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

		Year
		<select name=\"JobTimeYear\" tabindex=\"8\"\">
		<OPTION  value=\"$ReadableJobSchedYear\">$ReadableJobSchedYear
";
		$timeYearOptionSeconds = time(); //echo date("H:i:s");
		$timeYearOption = date("Y") - 13;
		$timeYearOptionLimit = $timeYearOption + 18;
		while ($timeYearOption <= $timeYearOptionLimit) {		
			echo "<OPTION  value=\"$timeYearOption\">$timeYearOption";
			$timeYearOption = $timeYearOption + 1;
		}

		$jobEstimatedHours = date("H", mktime(0,0,$JobEstSecs));
		$jobEstimatedMins = date("i", mktime(0,0,$JobEstSecs));
		$jobEstimatedDays = floor(($JobEstSecs / 86400));
		
		$JobTotalTimeDaysDays = "00";
						
echo "
		</SELECT> 
		
		</TD>
	</TR>
	"; 
//**********************************************************************************************
//********************************************************************* TIME ZONE FINISH - START
	// For more info see date_tone_offset_unix.php - DP Thu 5 Feb 2015 12:22AEST
	$config_time_zone = $_POST['config_time_zone'];
	$user_time_zone = $_POST['user_time_zone'];
	//echo "\$user_time_zone = $user_time_zone<BR>";
	$date_time_zone_finish = new DateTimeZone($user_time_zone);
	$date_finish = new DateTime('now', $date_time_zone_finish);
	$date_finish->setTimezone($date_time_zone_finish);
	//echo $date_finish->format('Y-m-d H:i:s') . "qwe<BR>";
	$date_hr = $date_finish->format('H') . "<BR>";
        //echo $date_hr;
        $finish_time_with_offset = $date_finish->format('U') . "<BR>";
        
	/**
	$MNTTZ = new DateTimeZone($user_time_zone);

	$dt = new DateTime();

	$dt->setTimezone($MNTTZ);

	$StartTime = $dt->format('U');
	$StartTime_readable = $dt->format(DATE_RFC1123);
	$date = new DateTime("@$StartTime");
	$date->setTimezone($MNTTZ);
	
	$Start_time_offset = $date->getOffset();
	//$finish_time_with_offset = $StartTime + $Start_time_offset - (3600*2);
	$finish_time_with_offset = $StartTime;*/
	
	//********** NEW VERSION - START
	/**
	$date_time_zone = new DateTimeZone("$user_time_zone");
        $date_time_ready_for_offset = new DateTime("now", $date_time_zone);
        $date_time_now = $date_time_ready_for_offset->format(DATE_RFC1123);
        $date_time_now_U = $date_time_ready_for_offset->format('U');
        
        $time_offset = $date_time_zone->getOffset($date_time_ready_for_offset);
        $_POST['time_offset'] = $time_offset;
        $date_time_ready_for_offset = new DateTime("now", $date_time_zone);
        
        $in_hours = $time_offset / 3600;
        $history_finish_time_in_secs = time();
        $history_finish_time_in_secs_plus_offset = $history_finish_time_in_secs + $time_offset;
        
	$Ad_sched = new DateTime("@$history_finish_time_in_secs_plus_offset");
	$history_finish_time_readabe_plus_offset = $Ad_sched->format(DATE_RFC1123);
	
	$history_finish_time_readabe_plus_offset_U = $Ad_sched->format('U'); // This line is just a reminder of how to output the unix time stamp.
	
	$history_finish_time_in_secs = time();
	$config_time_zone = $_POST['user_time_zone'];
	$Ad_sched = new DateTime("@$history_finish_time_in_secs");
	$zone_action = new DateTimeZone($config_time_zone);
	$Ad_sched->setTimezone($zone_action);
	$ReadableJobTimeInserted = $Ad_sched->format(DATE_RFC1123);
	$ReadableJobTimeInserted_U = $Ad_sched->format('U');
	
	$difference_in_sched_time_U = $JobSchedTimeInSecs_plus_offset - $JobSchedTimeInSecs;
	// New JobSchedTimeInSecs
        $JobSchedTimeInSecs = $JobSchedTimeInSecs_plus_offset;
	//********** NEW VERSION - END
	*/
	// $finish_time_with_offset = $ReadableJobTimeInserted_U;
	$_POST['finish_time_with_offset'] = $finish_time_with_offset; 
	
//*********************************************************************** TIME ZONE FINISH - END
//**********************************************************************************************


	// ****************************************************************
	// This is to convert the unix time to a readble 24hour clock - Start

		//$ReadableJobSchedTime_finish = date("H:i:s d-M-Y",$date_time_now_U);
		$ReadableJobSchedTime_finish = $date_finish->format('H');
		// $ReadableJobSchedHour_finish = date("H",$finish_time_with_offset);
		$ReadableJobSchedHour_finish = $date_finish->format('H');
                // echo $date_hr;
		//$ReadableJobSchedminute_finish = date("i",$finish_time_with_offset);
		$ReadableJobSchedminute_finish= $date_finish->format('i');
		// $ReadableJobSchedDay_finish = date("d",$finish_time_with_offset);
		$ReadableJobSchedDay_finish = $date_finish->format('d');
		// $ReadableJobSchedMonth_finish = date("M",$finish_time_with_offset);
		$ReadableJobSchedMonth_finish = $date_finish->format('M');
		// $ReadableJobSchedMonthDigit_finish = date("m",$finish_time_with_offset);
		$ReadableJobSchedMonthDigit_finish = $date_finish->format('m');
		// $ReadableJobSchedYear_finish = date("Y",$finish_time_with_offset);
		$ReadableJobSchedYear_finish = $date_finish->format('Y');
		
		if ($ReadableJobSchedHour_finish >= 13) {
			$schedHourMadeTo12HourClock_finish = $ReadableJobSchedHour_finish - 12;
			$schedAmPm_finish = "PM";
		}elseif ($ReadableJobSchedHour_finish == 12) {
			$schedHourMadeTo12HourClock_finish = $ReadableJobSchedHour_finish;
			$schedAmPm_finish = "PM";
		}else{
			$schedHourMadeTo12HourClock_finish = $ReadableJobSchedHour_finish;
			$schedAmPm_finish = "AM";
		}
	// This is to convert the unix time to a readble 24hour clock - End
	// ****************************************************************	
	
//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {	
                //$debug = $_POST['debug'];
                $debugMsg .= "Dealing with time zone offsets for history.php inside Main()<BR>";
                $debugMsg .= "\$user_time_zone = $user_time_zone<BR>";
                $debugMsg .= "\$config_time_zone = $config_time_zone<BR>";
                $debugMsg .= "\$time_offset = $time_offset<BR>";
                $debugMsg .= "\$_POST['time_offset'] = " . $_POST['time_offset'] . "<BR>";
                $debugMsg .= "\$_POST['user_time_zone'] = " . $_POST['user_time_zone'] . "<BR>";
                
                $debugMsg .= "\$Start_time_offset = $Start_time_offset<BR>";
                $debugMsg .= "\$StartTime_readable= $StartTime_readable<BR>";
                $debugMsg .= "\$in_hours = $in_hours<BR>";
                $debugMsg .= "\$history_finish_time_in_secs = $history_finish_time_in_secs<BR>";
                $debugMsg .= "\$history_finish_time_readabe_plus_offset = $history_finish_time_readabe_plus_offset<BR>";
                $debugMsg .= "\$history_finish_time_in_secs_plus_offset = $history_finish_time_in_secs_plus_offset<BR>";
                $debugMsg .= "\$history_finish_time_readabe_plus_offset_U = $history_finish_time_readabe_plus_offset_U<BR>";
                $debugMsg .= "\$ReadableJobSchedTime_finish = $ReadableJobSchedTime_finish<BR>";
                $debugMsg .= "\$ReadableJobSchedHour_finish = $ReadableJobSchedHour_finish<BR>";
                $debugMsg .= "\$ReadableJobTimeInserted = $ReadableJobTimeInserted<BR>";
	        $debugMsg .= "\$ReadableJobTimeInserted_U = $ReadableJobTimeInserted_U<BR>";
	        $debugMsg .= "\$date_time_now = $date_time_now<BR>";
	        $debugMsg .= "\$date_time_now_U = $date_time_now_U<BR>";
                include("config/debug.php"); 
        }
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************
	
	
	
	
echo "	<TR>
		<TD>Finish Time</TD>
		<TD></TD>
		<TD>
		<select name=\"JobTimeHour_finish\" tabindex=\"3\"\">
		<OPTION  value=\"$schedHourMadeTo12HourClock_finish\">$schedHourMadeTo12HourClock_finish
";
		$timeHourOption = "0";
		while ($timeHourOption <= "11") {		
			$timeHourOption = $timeHourOption + 1;
			echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
		}

echo "
		</SELECT>
		
		:
		<select name=\"JobTimeMinute_finish\" tabindex=\"4\">
		<OPTION  value=\"$ReadableJobSchedminute_finish\">$ReadableJobSchedminute_finish
";
		$timeMinuteOption = "00";
		echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
		while ($timeMinuteOption <= "40") {		
			$timeMinuteOption = $timeMinuteOption + 10;
			echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
		}

echo "
		</SELECT>

		<select name=\"JobTimeAmPm_finish\" tabindex=\"5\">
		<OPTION  value=\"$schedAmPm_finish\">$schedAmPm_finish
		<OPTION  value=\"AM\">AM
		<OPTION  value=\"PM\">PM
		</SELECT>

		Day
		<select name=\"JobTimeDay_finish\" tabindex=\"6\">
		<OPTION  value=\"$ReadableJobSchedDay_finish\">$ReadableJobSchedDay_finish
";
		$timeDayOption = 0;
		while ($timeDayOption <= "30") {		
			$timeDayOption = $timeDayOption + 1;
			echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
		}

echo "
		</SELECT>

		Month
		<SELECT name=\"JobTimeMonth_finish\" tabindex=\"7\">
		<OPTION  value=\"$ReadableJobSchedMonthDigit_finish\">$ReadableJobSchedMonth_finish
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
		<select name=\"JobTimeYear_finish\" tabindex=\"8\"\">
		<OPTION  value=\"$ReadableJobSchedYear_finish\">$ReadableJobSchedYear_finish
";
		$timeYearOptionSeconds = time(); //echo date("H:i:s");
		$timeYearOption = date("Y") - 13;
		$timeYearOptionLimit = $timeYearOption + 18;
		while ($timeYearOption <= $timeYearOptionLimit) {		
			echo "<OPTION  value=\"$timeYearOption\">$timeYearOption";
			$timeYearOption = $timeYearOption + 1;
		}

		$jobEstimatedHours = date("H", mktime(0,0,$JobEstSecs));
		$jobEstimatedMins = date("i", mktime(0,0,$JobEstSecs));
		$jobEstimatedDays = floor(($JobEstSecs / 86400));
		
		$JobTotalTimeDaysDays = "00";
echo "
		</SELECT>
		</TD>
	</TR>
	<TR>
		<TD></TD>
		<TD></TD>
		<TD>
	";
	
	$history_in_plain_text = $_POST['history_in_plain_text'];
	if ($history_in_plain_text == ""){
		$history_in_plain_text = 0;
		}
	if ($history_in_plain_text == 1) {
		$history_in_plain_text_on = "checked"; 
		$history_in_plain_text_off = "";
	} else {
		$history_in_plain_text_on = "";
		$history_in_plain_text_off = "checked";
	}	
	echo "<input type=\"radio\" name=\"history_in_plain_text\" value=\"0\" $history_in_plain_text_off> Normal<BR>";
	echo "<input type=\"radio\" name=\"history_in_plain_text\" value=\"1\" $history_in_plain_text_on> Text Only<BR>";
	echo "<BR>";	
	
echo "	
		</TD>
	</TR>
	<TR>
		<TD></TD>
		<TD></TD>
		<TD>
	";
	
		echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
		echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"date_range\">";
		echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
		echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"$ActionFkJobID\">";
		// echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"$JobCardNumberFkJobID\">";
		echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ActionFkClientID\">"; 
		echo "<input type=\"hidden\" name=\"ActionID\" value=\"$ActionID\">"; 
		//echo "<input type=\"hidden\" name=\"ColumnJobID\" value=\"$ActionFkJobID\">";
		echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
		echo "<input type=\"hidden\" name=\"user_authenticated\" value=\"$user_authenticated\">";
	        echo "<input type=\"hidden\" name=\"login_instance_token\" value=\"$login_instance_token\">";
	        echo "<input type=\"hidden\" name=\"name\" value=\"$login_name\">";
	        echo "<input type=\"hidden\" name=\"pass\" value=\"$login_pass\">";
	        echo "<input type=\"hidden\" name=\"login_UserID\" value=\"$login_UserID\">";
	        include ("log_in_authentication_form_vars.php");
		echo "<input type=\"submit\" name=\"Submit\" value=\"Set Date Range2\">";
		echo "</form>";
	
	echo "
		</TD>
	</TR>
	</TABLE>
	";
}
function show_history_actions(){
	
	$dbs = new dbSession();
	$Start_time_with_offset = $_POST['Start_time_with_offset'];
	$now_dudes = time();
	$finish_time_with_offset = $_POST['finish_time_with_offset'];
	$difference_to_current_time_from_finish_time = $finish_time_with_offset - $now_dudes;
	$difference_in_hours = $difference_to_current_time_from_finish_time / 3600;
	
	//**********************************************************************************************
	//********************************************************************** DEBUG 1 VARIABLES HERE - START
		$debug = $_POST['debug'];
		$debugMsg .= "\$now_dudes = $now_dudes<BR>";
                $debugMsg .= "\$difference_to_current_time_from_finish_time = $difference_to_current_time_from_finish_time<BR>";
                $debugMsg .= "\$difference_in_hours = $difference_in_hours<BR>";
		$debugMsg .= "\$config_time_zone = $config_time_zone<BR>";
		$debugMsg .= "\$Start_time_with_offset = $Start_time_with_offset<BR>";
		$debugMsg .= "\$finish_time_with_offset mmmmmmm= $finish_time_with_offset<BR>";
		$debugMsg .= "\$ActionTotalSecs = $ActionTotalSecs<BR>";
		include("config/debug.php");
	//********************************************************************** DEBUG 1 VARIABLES HERE - END
	//**********************************************************************************************
	
//**********************************************************************************************
//**************************************************************************** TIME ZONE - START
	// echo "\$callOrder = $callOrder";
	
	$dbst = new dbSession();
	$sqlt = "SELECT * from config WHERE ConfigID = 1 LIMIT 0, 30";
	
	$Resultst = $dbst->getResult($sqlt);
	
	while ($rowt = $dbst->getArray($Resultst)) {
	
	$config_time_zone = $rowt['config_time_zone'];
	$_POST['config_time_zone'] = $config_time_zone;
	}
	//echo "\$config_time_zone = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";
	
//****************************************************************************** TIME ZONE - END
//**********************************************************************************************

	$sql = "SELECT * from action WHERE ActionDateSecs  >= \"$Start_time_with_offset\" AND ActionDateSecs <= \"$finish_time_with_offset\" ORDER BY ActionDateSecs DESC LIMIT 0, 300";
	
	$Results = $dbs->getResult($sql);
	
	$aColor = 1;
	
	echo "<DIV align=\"center\">";
	echo "<TABLE>";

	echo "<TR>";
	echo "<TD align=\"middle\"><B>Edit</B></TD>";
	echo "<TD align=\"middle\"><B>Action by user</B></TD>";
	echo "<TD align=\"middle\" width=\"8%\"><B>JID-JCN</B></TD>";
	echo "<TD align=\"middle\" width=\"19%\"><B>Date & Time Added</B></TD>";
	echo "<TD align=\"middle\"><B>Client</B></TD>";
	echo "<TD align=\"middle\" width=\"15%\"><B>Total Time</B></TD>";
	echo "<TD align=\"middle\" width=\"50%\"><B>Detail</B></TD>";
	echo "</TR>";
		
	while ($row = $dbs->getArray($Results)) {
			
			$ActionText = $row['ActionText'];
			$ActionID = $row['ActionID'];
			$ActionFkJobID = $row['ActionFkJobID']; 
			$ActionFkClientID = $row['ActionFkClientID'];
			$ActionToFkUSerID = $row['ActionToFkUSerID'];
			$ActionFromFkUSerID = $row['ActionFromFkUSerID'];
			$ActionDateSecs = $row['ActionDateSecs'];
			
			
			$config_time_zone = $_POST['user_time_zone'];
			$Ad = new DateTime("@$ActionDateSecs");
			$zone_action = new DateTimeZone($config_time_zone);
			$Ad->setTimezone($zone_action);
			$ActionDateTime = $Ad->format(DATE_RFC1123);
			
			$_POST['ActionDateTime'] = $ActionDateTime;
			
			$ActionTotalSecs = $row['ActionTotalSecs'];
			if ($ActionTotalSecs == ""){   // This if statement put in cause PHP5 doesn't like empty vars in mktime().
				$ActionTotalSecs = 0;
				}
			$ActionTotalTime = date("H:i:s", mktime(0,0,$ActionTotalSecs));
			
			$ActionFromFkUserID = $row['ActionFromFkUserID'];
			$dbsUserFirstName = new dbSession();
			$sql = "SELECT UserFirstname from user WHERE UserID = \"$ActionFromFkUserID\" LIMIT 1";
			$ResultsUser = $dbs->getResult($sql);
			$rowUser = $dbs->getArray($ResultsUser);
			$UserFirstname = $rowUser['UserFirstname'];

			$ActionFkClientID = $row['ActionFkClientID'];
			$dbsClientName = new dbSession();
			$sql = "SELECT ClientName from client WHERE ClientID = \"$ActionFkClientID\" LIMIT 1";
			$ResultsClient = $dbs->getResult($sql);
			$rowClient = $dbs->getArray($ResultsClient);
			$ClientName = $rowClient['ClientName'];
			
			$JobCardNumberFkJobID = $row['ActionFkJobID'];
			$dbsJobSheetNumber = new dbSession();
			$sqlJob = "SELECT JobCardNumber from job WHERE JobID = \"$JobCardNumberFkJobID\" LIMIT 1";
			$ResultsJob = $dbs->getResult($sqlJob);
			$rowJob = $dbs->getArray($ResultsJob);
			$JobCardNumber = $rowJob['JobCardNumber'];
			
			$JobSheetNumber = $row['ActionFromFkUserID'];
			// $ActionFromFkUserID = $JobSheetNumber;
			$dbsUserFirstName = new dbSession();
			$sql = "SELECT UserFirstname from user WHERE UserID = \"$ActionFromFkUserID\" LIMIT 1";
			$ResultsUser = $dbs->getResult($sql);
			$rowUser = $dbs->getArray($ResultsUser);
			$UserFirstname = $rowUser['UserFirstname'];
			// $ActionFromFkUserID_2 = $rowUser['ActionFromFkUserID'];
			
			if ($aColor == 1) {
				$aColor = 0;
				$setColor = "#ccccff";
			}
			else {
				$aColor = 1;
				$setColor = "#FFFFFF";
			}
			echo "<TR>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\">";
			// echo "<a href=\"editAction.php?ActionID=$ActionID&StartTime=$StartTime&id=$id&ActionFkJobID=$JobCardNumberFkJobID&ActionRelToFkClientID=$ActionRelToFkClientID\">Edit</a><";
			        echo "<form method=\"post\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"ActionID\" value=\"" . $ActionID . "\">";
                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">";
                                echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"" . $JobCardNumberFkJobID . "\">";
                                echo "<input type=\"hidden\" name=\"ActionRelToFkClientID\" value=\"" . $ActionRelToFkClientID . "\">";
                                echo "<input type=\"hidden\" name=\"ActionDateSecs\" value=\"" . $ActionDateSecs . "\">";
                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                include("log_in_authentication_form_vars.php");
                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Edit\">";
                                echo "</form>";
                        echo "</TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\" width=\"8%\">";
			// echo "<a href=\"userCard.php?JobID=$JobCardNumberFkJobID\">$UserFirstname";
			        /**
			        echo "<form method=\"post\" action=\"./userCard.php\">";
                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobCardNumberFkJobID . "\">";
                                echo "<input type=\"hidden\" name=\"ActionFromFkUserID\" value=\"" . $ActionFromFkUserID . "\">";
                                include("log_in_authentication_form_vars.php");
                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"$UserFirstname\">";
                                echo "</form>"; */
                                user_button($ActionFromFkUserID);
			echo "</TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\" width=\"8%\">";
			// echo "<a href=\"JobDetails.php?JobID=$JobCardNumberFkJobID\">$JobCardNumberFkJobID-$JobCardNumber ";
			if (empty($JobCardNumberFkJobID)) {
			}else{
			        job_button($JobCardNumberFkJobID,'',$JobCardNumber,'');
			}
			echo "</TD>";
			
			echo "<TD align=\"middle\" bgcolor=\"$setColor\">$ActionDateTime</TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\">";
			// echo "<a href=\"clientcard2.php?ActionID=$ActionID&StartTime=$StartTime&id=$ActionFkClientID&ActionFkJobID=$JobCardNumberFkJobID&ActionRelToFkClientID=$ActionRelToFkClientID&name=$ClientName\">$ClientName</a>";
			if (empty($ActionFkClientID)) {
			
			}else{
			        client_button($ActionFkClientID,$ClientName);
			}
			echo "</TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\" width=\"15%\">$ActionTotalTime</TD>";
			echo "<TD bgcolor=\"$setColor\" width=\"50%\"><TEXTAREA rows=\"5\" cols=\"43\" name=\"ActionText\">$ActionText</TEXTAREA></TD>";
			echo "</TR>";
	}	
	echo "</TABLE>";
	echo "</DIV>";
}
function date_range() {
	// Change the date range.
	
	echo "<div align=\"center\">";
	$dbs = new dbSession();




//**********************************************************************************************
// *************************************************************************** VARIABLES - START
	$history_in_plain_text = $_POST['history_in_plain_text'];
	
	$ActionFkJobID = $_POST['ColumnJobID'];
	
	$JobTimeAmPm = $_POST['JobTimeAmPm'];

	$JobTimeHour = $_POST['JobTimeHour'];
	
	$JobTimeHour_finish = $_POST['JobTimeHour_finish'];

	$ActionBreaksHours = $_POST['ActionBreaksHours'];

	$ActionBreaksMins = $_POST['ActionBreaksMins'];

	$ActionBreaksHours = $_POST['ActionBreaksHours'];

	$ActionHours = $_POST['ActionHours'];

	$ActionMins = $_POST['ActionMins'];

	$ActionSecs = $_POST['ActionSecs'];

	$JobTimeMinute = $_POST['JobTimeMinute'];

	$JobTimeMonth = $_POST['JobTimeMonth'];

	$JobTimeDay = $_POST['JobTimeDay'];

	$JobTimeYear = $_POST['JobTimeYear'];
	
	$ActionFkClientID = $_POST['id'];
	
	$ActionRelToFkClientID = $_POST['ActionRelToFkClientID'];

	$ActionDateTime = $_POST['ActionDateTime'];

	$ActionID = $_POST['ActionID'];

	$ActionText = $_POST['ActionText'];
	
	$ActionText = stripslashes($ActionText);

	$ActionFromFkUserID = $_POST['ActionFromFkUserID'];

	$ActionToFkUSerID = $_POST['ActionToFkUSerID'];

	$ClientID = $_POST['id'];	
	
	$JobTimeAmPm_finish = $_POST['JobTimeAmPm_finish'];
	
	$JobTimeMinute_finish = $_POST['JobTimeMinute_finish'];
	
	$JobTimeMonth_finish = $_POST['JobTimeMonth_finish'];

	$JobTimeDay_finish = $_POST['JobTimeDay_finish'];

	$JobTimeYear_finish = $_POST['JobTimeYear_finish'];
	
	
	
// ***************************************************************************** VARIABLES - END
//**********************************************************************************************


//**********************************************************************************************
//*************************************************************** DEBUG 1 VARIABLES HERE - START
	$debug = $_POST['debug'];
	$debugMsg .= "\$history_in_plain_text = $history_in_plain_text<BR>";
	include("config/debug.php");
//***************************************************************** DEBUG 1 VARIABLES HERE - END
//**********************************************************************************************
	
//**********************************************************************************************
//******************************************************************** START TIME COMPILE- START
	if (($JobTimeAmPm == "PM") AND ($JobTimeHour <= 12)) {
	
		$JobTimeMilitary = $JobTimeHour + 12;

	}else{
		$JobTimeMilitary = $JobTimeHour;
	}
	
	// $ConvertActionBreaksToSecs = ConvertToSeconds($ActionBreaksHours,$ActionBreaksMins,0);
  	//$ConvertToSeconds = ConvertToSeconds($ActionHours,$ActionMins,$ActionSecs);

	$Start_time_with_offset = mktime($JobTimeMilitary,$JobTimeMinute,0,$JobTimeMonth,$JobTimeDay,$JobTimeYear);
	// echo "\$Start_time_offset editing times = $Start_time_with_offset<BR>";
	$_POST['Start_time_with_offset'] = $Start_time_with_offset;
//********************************************************************** START TIME COMPILE- END	
//**********************************************************************************************


//**********************************************************************************************
//******************************************************************* FINSIH TIME COMPILE- START
	if (($JobTimeAmPm_finish == "PM") AND ($JobTimeHour_finish <= 12)) {
	
		$JobTimeMilitary_finish = $JobTimeHour_finish + 12;

	}else{
		$JobTimeMilitary_finish = $JobTimeHour_finish;
	}
	
	// $ConvertActionBreaksToSecs = ConvertToSeconds($ActionBreaksHours,$ActionBreaksMins,0);
  	//$ConvertToSeconds = ConvertToSeconds($ActionHours,$ActionMins,$ActionSecs);

	$finish_time_with_offset = mktime($JobTimeMilitary_finish,$JobTimeMinute_finish,0,$JobTimeMonth_finish,$JobTimeDay_finish,$JobTimeYear_finish);
	$_POST['finish_time_with_offset'] = $finish_time_with_offset;
//********************************************************************* FINISH TIME COMPILE- END	
//**********************************************************************************************


//**********************************************************************************************
//*************************************************************** DEBUG 1 VARIABLES HERE - START
	$debug = $_POST['debug'];
	$debugMsg .= "Checking Variables in date_range() function. <BR>";
	$debugMsg .= "\$JobTimeAmPm = $JobTimeAmPm <BR>";
	$debugMsg .= "\$JobTimeHour = $JobTimeHour<BR>";
	$debugMsg .= "\$JobTimeMinute = $JobTimeMinute <BR>";
	$debugMsg .= "\$JobTimeMilitary = $JobTimeMilitary <BR>";
	$debugMsg .= "\$JobTimeMonth = $JobTimeMonth<BR>";
	$debugMsg .= "\$JobTimeDay = $JobTimeDay<BR>";
	$debugMsg .= "\$JobTimeYear = $JobTimeYear <BR>";
	$debugMsg .= "\$ActionDateSecs = $ActionDateSecs <BR>";
	$debugMsg .= "\$Start_time_with_offset = $Start_time_with_offset<BR>";
	$debugMsg .= "-------------<BR>";
	$debugMsg .= "\$JobTimeAmPm_finish = $JobTimeAmPm_finish <BR>";
	$debugMsg .= "\$JobTimeHour_finish = $JobTimeHour_finish<BR>";
	$debugMsg .= "\$JobTimeMinute_finish = $JobTimeMinute_finish <BR>";
	$debugMsg .= "\$JobTimeMilitary_finish = $JobTimeMilitary_finish <BR>";
	$debugMsg .= "\$JobTimeMonth_finish = $JobTimeMonth_finish<BR>";
	$debugMsg .= "\$JobTimeDay_finish = $JobTimeDay_finish<BR>";
	$debugMsg .= "\$JobTimeYear_finish = $JobTimeYear_finish <BR>";
	$debugMsg .= "\$finish_time_with_offset = $finish_time_with_offset<BR>";
	$debugMsg .= "-------------<BR>";
	$debugMsg .= "\$ActionHours = $ActionHours <BR>";
	$debugMsg .= "\$ActionMins = $ActionMins <BR>";
	$debugMsg .= "\$ActionSecs = $ActionSecs <BR>";
	$debugMsg .= "\$ConvertToSeconds = $ConvertToSeconds <BR>";
	include("config/debug.php");
//***************************************************************** DEBUG 1 VARIABLES HERE - END
//**********************************************************************************************



	// ****************************************************************
	// This is to convert the unix time to a readble 24hour clock - Start

		$ReadableJobSchedTime = date("H:i:s d-M-Y",$Start_time_with_offset);
		$ReadableJobSchedHour = date("H",$Start_time_with_offset);
		$ReadableJobSchedminute = date("i",$Start_time_with_offset);
		$ReadableJobSchedDay = date("d",$Start_time_with_offset);
		$ReadableJobSchedMonth = date("M",$Start_time_with_offset);
		$ReadableJobSchedMonthDigit = date("m",$Start_time_with_offset);
		$ReadableJobSchedYear = date("Y",$Start_time_with_offset);
		
		if ($ReadableJobSchedHour >= 13) {
			$schedHourMadeTo12HourClock = $ReadableJobSchedHour - 12;
			$schedAmPm = "PM";
		}elseif ($ReadableJobSchedHour == 12) {
			$schedHourMadeTo12HourClock = $ReadableJobSchedHour;
			$schedAmPm = "PM";
		}else{
			$schedHourMadeTo12HourClock = $ReadableJobSchedHour;
			$schedAmPm = "AM";
		}
	// This is to convert the unix time to a readble 24hour clock - End
	// ****************************************************************
// echo "<H1>History</H1>";
$header_size = $_POST['header_size'];
$user_time_zone = $_POST['user_time_zone'];
echo "<H" . $header_size . ">History</H" . $header_size . ">
Time Zone - $user_time_zone.<BR>";
	

echo "<form method=\"post\" action=\"./index.php\">";	
echo "
	<TABLE>
		<TR>
		<TD>Start Time</TD>
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
		<OPTION  value=\"AM\">AM
		<OPTION  value=\"PM\">PM
		</SELECT>

		Day
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

		Month
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

		Year
		<select name=\"JobTimeYear\" tabindex=\"8\"\">
		<OPTION  value=\"$ReadableJobSchedYear\">$ReadableJobSchedYear
";
		$timeYearOptionSeconds = time(); //echo date("H:i:s");
		$timeYearOption = date("Y") - 13;
		$timeYearOptionLimit = $timeYearOption + 18;
		while ($timeYearOption <= $timeYearOptionLimit) {		
			echo "<OPTION  value=\"$timeYearOption\">$timeYearOption";
			$timeYearOption = $timeYearOption + 1;
		}

		$jobEstimatedHours = date("H", mktime(0,0,$JobEstSecs));
		$jobEstimatedMins = date("i", mktime(0,0,$JobEstSecs));
		$jobEstimatedDays = floor(($JobEstSecs / 86400));
		
		$JobTotalTimeDaysDays = "00";
						
echo "
		</SELECT>
		</TD>
	</TR>
	";
	/**
//**********************************************************************************************
//********************************************************************* TIME ZONE FINISH - START
	
	$config_time_zone = $_POST['config_time_zone'];
	//echo "\$config_time_zone = $config_time_zone <BR>";
	
	$MNTTZ = new DateTimeZone($config_time_zone);

	$dt = new DateTime();

	$dt->setTimezone($MNTTZ);

	$StartTime = $dt->format('U');
	
	$date = new DateTime("@$StartTime");
	$date->setTimezone($MNTTZ);
	
	$date->setTimezone($MNTTZ);
	
	$Start_time_offset = $date->getOffset();
	$finish_time_with_offset = $StartTime + $Start_time_offset - (3600*2);
	
	$_POST['finish_time_with_offset'] = $finish_time_with_offset;
	
//*********************************************************************** TIME ZONE FINISH - END
//**********************************************************************************************
*/

	// ****************************************************************
	// This is to convert the unix time to a readble 24hour clock - Start

		$ReadableJobSchedTime_finish = date("H:i:s d-M-Y",$finish_time_with_offset);
		$ReadableJobSchedHour_finish = date("H",$finish_time_with_offset);
		$ReadableJobSchedminute_finish = date("i",$finish_time_with_offset);
		$ReadableJobSchedDay_finish = date("d",$finish_time_with_offset);
		$ReadableJobSchedMonth_finish = date("M",$finish_time_with_offset);
		$ReadableJobSchedMonthDigit_finish = date("m",$finish_time_with_offset);
		$ReadableJobSchedYear_finish = date("Y",$finish_time_with_offset);
		
		if ($ReadableJobSchedHour_finish >= 13) {
			$schedHourMadeTo12HourClock_finish = $ReadableJobSchedHour_finish - 12;
			$schedAmPm_finish = "PM";
		}elseif ($ReadableJobSchedHour_finish == 12) {
			$schedHourMadeTo12HourClock_finish = $ReadableJobSchedHour_finish;
			$schedAmPm_finish = "PM";
		}else{
			$schedHourMadeTo12HourClock_finish = $ReadableJobSchedHour_finish;
			$schedAmPm_finish = "AM";
		}
	// This is to convert the unix time to a readble 24hour clock - End
	// ****************************************************************	
	
	
	
	
echo "	<TR>
		<TD>Finish Time</TD>
		<TD></TD>
		<TD>
		<select name=\"JobTimeHour_finish\" tabindex=\"3\"\">
		<OPTION  value=\"$schedHourMadeTo12HourClock_finish\">$schedHourMadeTo12HourClock_finish
";

		$timeHourOption = "0";
		while ($timeHourOption <= "11") {		
			$timeHourOption = $timeHourOption + 1;
			echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
		}

echo "
		</SELECT>
		
		:
		<select name=\"JobTimeMinute_finish\" tabindex=\"4\">
		<OPTION  value=\"$ReadableJobSchedminute_finish\">$ReadableJobSchedminute_finish
";
		$timeMinuteOption = "00";
		echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
		while ($timeMinuteOption <= "40") {		
			$timeMinuteOption = $timeMinuteOption + 10;
			echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
		}

echo "
		</SELECT>

		<select name=\"JobTimeAmPm_finish\" tabindex=\"5\">
		<OPTION  value=\"$schedAmPm_finish\">$schedAmPm_finish
		<OPTION  value=\"AM\">AM
		<OPTION  value=\"PM\">PM
		</SELECT>

		Day
		<select name=\"JobTimeDay_finish\" tabindex=\"6\">
		<OPTION  value=\"$ReadableJobSchedDay_finish\">$ReadableJobSchedDay_finish
";
		$timeDayOption = 0;
		while ($timeDayOption <= "30") {		
			$timeDayOption = $timeDayOption + 1;
			echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
		}

echo "
		</SELECT>

		Month
		<SELECT name=\"JobTimeMonth_finish\" tabindex=\"7\">
		<OPTION  value=\"$ReadableJobSchedMonthDigit_finish\">$ReadableJobSchedMonth_finish
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
		<select name=\"JobTimeYear_finish\" tabindex=\"8\"\">
		<OPTION  value=\"$ReadableJobSchedYear_finish\">$ReadableJobSchedYear_finish
";
		$timeYearOptionSeconds = time(); //echo date("H:i:s");
		$timeYearOption = date("Y") - 13;
		$timeYearOptionLimit = $timeYearOption + 18;
		while ($timeYearOption <= $timeYearOptionLimit) {		
			echo "<OPTION  value=\"$timeYearOption\">$timeYearOption";
			$timeYearOption = $timeYearOption + 1;
		}

		$jobEstimatedHours = date("H", mktime(0,0,$JobEstSecs));
		$jobEstimatedMins = date("i", mktime(0,0,$JobEstSecs));
		$jobEstimatedDays = floor(($JobEstSecs / 86400));
		
		$JobTotalTimeDaysDays = "00";
						
echo "
		</SELECT>
		</TD>
	</TR>
	<TR>
		<TD></TD>
		<TD></TD>
		<TD>
";	
			$history_in_plain_text = $_POST['history_in_plain_text'];
		if ($history_in_plain_text == ""){
			$history_in_plain_text = 0;
			}
		if ($history_in_plain_text == 1) {
			$history_in_plain_text_on = "checked"; 
			$history_in_plain_text_off = "";
		} else {
			$history_in_plain_text_on = "";
			$history_in_plain_text_off = "checked";
		}	
		echo "<input type=\"radio\" name=\"history_in_plain_text\" value=\"0\" $history_in_plain_text_off> Normal<BR>";
		echo "<input type=\"radio\" name=\"history_in_plain_text\" value=\"1\" $history_in_plain_text_on> Text Only<BR>";
		echo "<BR>";	
	
echo "	
		</TD>
	</TR>
	<TR>
		<TD></TD>
		<TD></TD>
		<TD>
	";
	
		echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
		echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"date_range\">";
		echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
		echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"$ActionFkJobID\">";
		// echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"$JobCardNumberFkJobID\">";
		echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ActionFkClientID\">"; 
		echo "<input type=\"hidden\" name=\"ActionID\" value=\"$ActionID\">"; 
		//echo "<input type=\"hidden\" name=\"ColumnJobID\" value=\"$ActionFkJobID\">";
		echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
		echo "<input type=\"hidden\" name=\"user_authenticated\" value=\"$user_authenticated\">";
	        echo "<input type=\"hidden\" name=\"login_instance_token\" value=\"$login_instance_token\">";
	        echo "<input type=\"hidden\" name=\"name\" value=\"$login_name\">";
	        echo "<input type=\"hidden\" name=\"pass\" value=\"$login_pass\">";
	        echo "<input type=\"hidden\" name=\"login_UserID\" value=\"$login_UserID\">";
	        include ("log_in_authentication_form_vars.php");
		echo "<input type=\"submit\" name=\"Submit\" value=\"Set Date Range1\">";
		echo "</form>";
	
	echo "
		</TD>
	</TR>
	</TABLE>
	";


if ($history_in_plain_text == 1){
		show_actions_text_only();
		//**********************************************************************************************
                //*************************************************************** DEBUG 1 VARIABLES HERE - START
	                $debug = $_POST['debug'];
	                $debugMsg .= "We are here 2 <BR>";
	                include("config/debug.php");
                //***************************************************************** DEBUG 1 VARIABLES HERE - END
                //**********************************************************************************************
	} else {
		ShowActions(0,1,1);
	}
// include ("logged_in_end_of_page.php");
// exit;
}
function show_actions_text_only(){
	
	$dbs = new dbSession();
	$Start_time_with_offset = $_POST['Start_time_with_offset'];
	$finish_time_with_offset = $_POST['finish_time_with_offset'];
	
	//**********************************************************************************************
	//********************************************************************** DEBUG 1 VARIABLES HERE - START
		$debug = $_POST['debug'];
		$debugMsg .= "\$config_time_zone = $config_time_zone<BR>";
		$debugMsg .= "\$Start_time_with_offset = $Start_time_with_offset<BR>";
		$debugMsg .= "\$finish_time_with_offset = $finish_time_with_offset<BR>";
		$debugMsg .= "\$ActionTotalSecs = $ActionTotalSecs<BR>";
		include("config/debug.php");
	//********************************************************************** DEBUG 1 VARIABLES HERE - END
	//**********************************************************************************************
	
//**********************************************************************************************
//**************************************************************************** TIME ZONE - START
	// echo "\$callOrder = $callOrder";
	
	$dbst = new dbSession();
	$sqlt = "SELECT * from config WHERE ConfigID = 1 LIMIT 0, 30";
	
	$Resultst = $dbst->getResult($sqlt);
	
	while ($rowt = $dbst->getArray($Resultst)) {
	
	$config_time_zone = $rowt['user_time_zone'];
	$_POST['config_time_zone'] = $config_time_zone;
	}
	//echo "\$config_time_zone = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";
	
//****************************************************************************** TIME ZONE - END
//**********************************************************************************************

	$sql = "SELECT * from action WHERE ActionDateSecs  >= \"$Start_time_with_offset\" AND ActionDateSecs <= \"$finish_time_with_offset\" ORDER BY ActionDateSecs DESC LIMIT 0, 300";
	
	$Results = $dbs->getResult($sql);
	
	$aColor = 1;
	
	echo "<DIV align=\"center\">";
	echo "<TABLE>";

	echo "<TR>";
		echo "<TD align=\"middle\"><B>Action by user</B></TD>";
		echo "<TD align=\"middle\" width=\"8%\"><B>JID-JCN</B></TD>";
		echo "<TD align=\"middle\" width=\"19%\"><B>Date & Time Added</B></TD>";
		echo "<TD align=\"middle\"><B>Client</B></TD>";
		echo "<TD align=\"middle\" width=\"15%\"><B>Total Time</B></TD>";
		echo "<TD align=\"middle\" width=\"20%\"><B>Detail</B></TD>";
	echo "</TR>";
		
	while ($row = $dbs->getArray($Results)) {
			
			$ActionText = $row['ActionText'];
			$ActionID = $row['ActionID'];
			$ActionFkJobID = $row['ActionFkJobID']; 
			$ActionFkClientID = $row['ActionFkClientID'];
			$ActionToFkUSerID = $row['ActionToFkUSerID'];
			$ActionFromFkUSerID = $row['ActionFromFkUSerID'];
			$ActionDateSecs = $row['ActionDateSecs'];
			
			
			$config_time_zone = $_POST['user_time_zone'];
			$Ad = new DateTime("@$ActionDateSecs");
			$zone_action = new DateTimeZone($config_time_zone);
			$Ad->setTimezone($zone_action);
			$ActionDateTime = $Ad->format(DATE_RFC1123);
			
			$_POST['ActionDateTime'] = $ActionDateTime;
			
			$ActionTotalSecs = $row['ActionTotalSecs'];
			if ($ActionTotalSecs == ""){   // This if statement put in cause PHP5 doesn't like empty vars in mktime().
				$ActionTotalSecs = 0;
				}
			$ActionTotalTime = date("H:i:s", mktime(0,0,$ActionTotalSecs));
			
			$ActionFromFkUserID = $row['ActionFromFkUserID'];
			$dbsUserFirstName = new dbSession();
			$sql = "SELECT UserFirstname from user WHERE UserID = \"$ActionFromFkUserID\" LIMIT 1";
			$ResultsUser = $dbs->getResult($sql);
			$rowUser = $dbs->getArray($ResultsUser);
			$UserFirstname = $rowUser['UserFirstname'];

			$ActionFkClientID = $row['ActionFkClientID'];
			$dbsClientName = new dbSession();
			$sql = "SELECT ClientName from client WHERE ClientID = \"$ActionFkClientID\" LIMIT 1";
			$ResultsClient = $dbs->getResult($sql);
			$rowClient = $dbs->getArray($ResultsClient);
			$ClientName = $rowClient['ClientName'];
			
			$JobCardNumberFkJobID = $row['ActionFkJobID'];
			$dbsJobSheetNumber = new dbSession();
			$sqlJob = "SELECT JobCardNumber from job WHERE JobID = \"$JobCardNumberFkJobID\" LIMIT 1";
			$ResultsJob = $dbs->getResult($sqlJob);
			$rowJob = $dbs->getArray($ResultsJob);
			$JobCardNumber = $rowJob['JobCardNumber'];
			
			$JobSheetNumber = $row['ActionFromFkUserID'];
			$dbsUserFirstName = new dbSession();
			$sql = "SELECT UserFirstname from user WHERE UserID = \"$ActionFromFkUserID\" LIMIT 1";
			$ResultsUser = $dbs->getResult($sql);
			$rowUser = $dbs->getArray($ResultsUser);
			$UserFirstname = $rowUser['UserFirstname'];
			
			if ($aColor == 1) {
				$aColor = 0;
				$setColor = "#ccccff";
			}
			else {
				$aColor = 1;
				$setColor = "#FFFFFF";
			}
			echo "<TR>";
				echo "<TD align=\"middle\" bgcolor=\"$setColor\">$UserFirstname</TD>";
				echo "<TD align=\"middle\" bgcolor=\"$setColor\">$JobCardNumberFkJobID-$JobCardNumber </TD>";
				echo "<TD align=\"middle\" bgcolor=\"$setColor\">$ActionDateTime</TD>";
				echo "<TD align=\"middle\" bgcolor=\"$setColor\">$ClientName</TD>";
				echo "<TD align=\"middle\" bgcolor=\"$setColor\">$ActionTotalTime</TD>";
				echo "<TD bgcolor=\"$setColor\">$ActionText</TD>";
			echo "</TR>";
	}	
	echo "</TABLE>";
	echo "</DIV>";
}

 
?>
