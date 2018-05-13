<?PHP

//**********************************************************************************************
//******************************************************************************** TITLE - START
/**
*	file:	user_card_with_time_limits_ajax_functions.php
*	auth:	Dion Patelis (owner)
*	desc;	Functions necessary for the AJAX version of the usercard.
*	date:	Tue 20th Jan 2015 - Dion Patelis
*	last:	Tue 20th Jan 2015 - Dion Patelis
*/
//********************************************************************************** TITLE - END
//**********************************************************************************************

// include("config/dbSession.class"); 

//**********************************************************************************************
//**************************************************************************** FUNCTIONS - STARTgg
function user_card_details() {
        
        $UserID = $_POST['UserID'];
        $ActionFromFkUserID = $_POST['ActionFromFkUserID'];
        $user_ID_to_display = $_POST['user_ID_to_display'];
	$ClientID = $_POST['ClientID'];
	//**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {
	        $debug = $_POST['debug'];
	        $debugMsg .= "\$UserID = $UserID<BR>";
	        $debugMsg .= "\$ActionFromFkUserID = $ActionFromFkUserID<BR>";
	        include("config/debug.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
	
	$dbs = new dbSession();
	$sql = "SELECT * from user WHERE UserID = \"$user_ID_to_display\" LIMIT 0, 30";
	
	$Results = $dbs->getResult($sql);
	
	while ($row = $dbs->getArray($Results)) {
	
	$ActionDateSecs = $row[UserDate];
	$ActionDateTime = date("H:i:s d-M-Y",$ActionDateSecs);
	$UserActive = $row[UserActive];
	
	if ($UserActive == 1) {
		$userAllreadyActive = 1;
	} else {
		$userAllreadyActive = 0;
	}
	
	
	if ($UserActive == 1) {
		$UserActiveYes = "checked";
		$UserActiveNo = "";
	} else {
		$UserActiveYes = "";
		$UserActiveNo = "checked";
	}
		
	echo "<form method=\"post\" action=\"$PHP_SELF\">";	
	$name = $row['UserFirstname'];
	
	echo " <div align=\"center\">";
	$header_size = $_POST['header_size'];
	echo "<H" . $header_size . ">User Card</H" . $header_size . ">";
	echo "
        <!-- <H1>User Card</H1> -->
			<TABLE>
		<TR>
			<TD>UserLogin</TD>
			<TD><input type=\"text\" name=\"UserLogin\" tabindex=\"1\" value=\"$row[UserLogin]\"></TD>
			<TD>UserPostcode</TD>
			<TD><input type=\"text\" name=\"UserPostcode\" tabindex=\"10\"  value=\"$row[UserPostcode]\"></TD>
		</TR>
		<TR>
			<TD>UserPassword</TD>
			<TD><input type=\"password\" name=\"UserPassword\" tabindex=\"2\"  value=\"$row[UserPassword]\"></TD>
			<TD>UserCountry</TD>
			<TD><input type=\"text\" name=\"UserCountry\" tabindex=\"12\"  value=\"$row[UserCountry]\"></TD>
		</TR>
		<TR>
			<TD>UserDate</TD>
			<TD>$ActionDateTime</TD>
			<TD>UserPhone1</TD>
			<TD><input type=\"text\" name=\"UserPhone1\" tabindex=\"13\"  value=\"$row[UserPhone1]\"></TD>
		</TR>
		<TR>
			<TD>UserFirstname</TD>
			<TD><input type=\"text\" name=\"UserFirstname\" tabindex=\"4\"  value=\"$row[UserFirstname]\"></TD>
			<TD>UserPhone2</TD>
			<TD><input type=\"text\" name=\"UserPhone2\" tabindex=\"14\"  value=\"$row[UserPhone2]\"></TD>
		</TR>
		<TR>
			<TD>UserLastname</TD>
			<TD><input type=\"text\" name=\"UserLastname\" tabindex=\"5\"  value=\"$row[UserLastname]\"></TD>
			<TD>UserFax</TD>
			<TD><input type=\"text\" name=\"UserFax\" tabindex=\"15\"  value=\"$row[UserFax]\"></TD>
		</TR>
		<TR>
			<TD>UserAddress1</TD>
			<TD><input type=\"text\" name=\"UserAddress1\" tabindex=\"6\"  value=\"$row[UserAddress1]\"></TD>
			<TD>UserEmail</TD>
			<TD><input type=\"text\" name=\"UserEmail\" tabindex=\"16\"  value=\"$row[UserEmail]\">
				<a  tabindex=\"16.5\" href=\"mailto:" . $row['UserEmail'] . "\">Send</a></TD>
		</TR>
		<TR>
			<TD>UserAddress2</TD>
			<TD><input type=\"text\" name=\"UserAddress2\" tabindex=\"7\"  value=\"$row[UserAddress2]\"></TD>
			<TD>UserUrl</TD>
			<TD><input type=\"text\" name=\"UserUrl\" tabindex=\"17\"  value=\"$row[UserUrl]\">
				<A  tabindex=\"17.5\" href=\"http://" . $row['UserUrl'] . "\"target=\"_blank\">Go</A></TD>
		</TR>
		<TR>
			<TD>UserCity</TD>
			<TD><input type=\"text\" name=\"UserCity\" tabindex=\"8\"  value=\"$row[UserCity]\"></TD>
			<TD>UserActive</TD>
			<TD><input type=\"radio\" name=\"UserActive\" tabindex=\"17\"  value=\"0\" $UserActiveNo>No 
				<input type=\"radio\" name=\"UserActive\" tabindex=\"17.5\"  value=\"1\" $UserActiveYes>Yes </TD>
		</TR>
		<TR>
			<TD>UserState</TD>
			<TD><input type=\"text\" name=\"UserState\" tabindex=\"9\"  value=\"$row[UserState]\"></TD>
			<TD>User ID</TD>
			<TD>$ClientID</TD>
		</TR>
		</TABLE>
	";
	
	
	$user_ID_to_display = $_POST['user_ID_to_display'];
	// echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"EditDetails\">";
	echo "<input type=\"hidden\" name=\"userAllreadyActive\" value=\"$userAllreadyActive\">";
	echo "<input type=\"hidden\" name=\"UserID\" value=\"$ClientID\">";
	echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
	echo "<input type=\"hidden\" name=\"user_ID_to_display\" value=\"$user_ID_to_display\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" tabindex=\"18\" name=\"Submit\" value=\"Apply Changes\">";
	echo "</form>";
	
	/**
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"DeleteCard\">";
	echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
	echo "<input type=\"submit\" tabindex=\"19\" name=\"Submit\" value=\"DeleteCard\">";
	echo "</form>";
	*/
	}
echo "</div>";
}
function Main() {	
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
	/**
	$dbst = new dbSession();
	$sqlt = "SELECT * from config WHERE ConfigID = 1 LIMIT 0, 30";
	
	$Resultst = $dbst->getResult($sqlt);
	
	while ($rowt = $dbst->getArray($Resultst)) {
	
	$config_time_zone = $rowt['config_time_zone'];
	$_POST['config_time_zone'] = $config_time_zone;
	} 
	*/
	// echo "\$config_time_zone  in user_card_with_time_limits_ajax_functions.php in Main() = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";
	
//****************************************************************************** TIME ZONE - END
//**********************************************************************************************

	if ($callOrder == 1) {
	LocCallOrderUpdate();
	}
	// echo "<H1>History</H1>";
	// echo "Choose from active users<BR>";

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
	
	//echo "UserLogin = $UserLogin<BR>";

	}
	echo "<BR>";
	
//**********************************************************************************************
//************************************************************************** TIME ZONE 2 - START
	
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
	$Start_time_with_offset = $StartTime + $Start_time_offset - (3600*2) - 604800;
	
	
	$_POST['Start_time_with_offset'] = $Start_time_with_offset;
	
//**************************************************************************** TIME ZONE 2 - END
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
/**		
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
	"; */
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
	
	
	/**
	
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
	$user_ID_to_display = $_POST['user_ID_to_display'];
	
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
	        echo "<input type=\"hidden\" name=\"user_ID_to_display\" value=\"$user_ID_to_display\">";
	        include ("log_in_authentication_form_vars.php");
		echo "<input type=\"submit\" name=\"Submit\" value=\"Set Date Range2\">";
		echo "</form>";
	
	echo "
		</TD>
	</TR>
	</TABLE>
	"; */
}
function ShowActions(){
	
	
	$Start_time_with_offset = $_POST['Start_time_with_offset'];
	$finish_time_with_offset = $_POST['finish_time_with_offset'];
	$config_time_zone = $_POST['config_time_zone'];
	$ActionFromFkUserID = $_POST['ActionFromFkUserID'];
        // echo "\$ActionFromFkUserID first = $ActionFromFkUserID<BR>";
        $user_ID_to_display = $_POST['user_ID_to_display'];
       //  echo "\$user_ID_to_display first = $user_ID_to_display<BR>";
        //**********************************************************************************************
        //*************************************************************** DEBUG 1 VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {
	        // $debug = $_POST['debug'];
	        $debugMsg .= "At the start of ShowActions()<BR>";
	        $debugMsg .= "\$config_time_zone = $config_time_zone<BR>";
	        $debugMsg .= "\$Start_time_with_offset = $Start_time_with_offset<BR>";
	        $debugMsg .= "\$finish_time_with_offset = $finish_time_with_offset<BR>";
	        $debugMsg .= "\$ActionTotalSecs = $ActionTotalSecs<BR>";
	        $debugMsg .= "\$user_ID_to_display = $user_ID_to_display<BR>";
	        include("config/debug.php");
	        }
        //***************************************************************** DEBUG 1 VARIABLES HERE - END
        //**********************************************************************************************
	
//**********************************************************************************************
//**************************************************************************** TIME ZONE - START
	// echo "\$callOrder = $callOrder";
	
	$dbst = new dbSession();
	$sqlt = "SELECT user_time_zone from user WHERE UserID = '$user_ID_to_display' LIMIT 0, 30";
	
	$Resultst = $dbst->getResult($sqlt);
	
	while ($rowt = $dbst->getArray($Resultst)) {
	
	$config_time_zone = $rowt['user_time_zone'];
	$_POST['config_time_zone'] = $config_time_zone;
	}
	
	// echo "\$config_time_zone in user_card_with_time_limits_ajax_functions in ShowActions() = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";
	
//****************************************************************************** TIME ZONE - END
//**********************************************************************************************
        $dbs = new dbSession();
	$sql = "SELECT * from action WHERE ActionDateSecs  >= \"$Start_time_with_offset\" AND ActionDateSecs <= \"$finish_time_with_offset\" AND ActionFromFkUserID = \"$user_ID_to_display\" ORDER BY ActionDateSecs DESC LIMIT 0, 300";
	
	$Results = $dbs->getResult($sql);
	
	$aColor = 1;
	
	echo "<DIV align=\"center\">";
	echo "<TABLE>";

	echo "<TR>";
	echo "<TD align=\"middle\"><B>Edit</B></TD>";
	// echo "<TD align=\"middle\"><B>User</B></TD>";
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
			$ActionFromFkUserID= $row['ActionFromFkUserID'];
			// echo "\$ActionFromFkUserID blue = $ActionFromFkUserID<BR>";
			$ActionDateSecs = $row['ActionDateSecs'];
			
			
			$config_time_zone = $_POST['config_time_zone'];
			// echo "\$config_time_zone = $config_time_zone<BR>";
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
			
			// $ActionFromFkUserID = $row['ActionFromFkUserID'];
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
			/**
			        echo "<form method=\"post\" action=\"./editAction.php\">";
                                echo "<input type=\"hidden\" name=\"ActionID\" value=\"" . $ActionID . "\">";
                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">";
                                echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"" . $JobCardNumberFkJobID . "\">";
                                echo "<input type=\"hidden\" name=\"ActionRelToFkClientID\" value=\"" . $ActionRelToFkClientID . "\">";
                                echo "<input type=\"hidden\" name=\"ActionDateSecs\" value=\"" . $ActionDateSecs . "\">";
                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                include("log_in_authentication_form_vars.php");
                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Edit\">";
                                echo "</form>";
                                echo "$\ActionID = $ActionID<BR>";
                                echo "$\ClientID = $ClientID<BR>";
                                echo "$\JobCardNumberFkJobID = $JobCardNumberFkJobID<BR>";
                                echo "$\ActionRelToFkClientID = $ActionRelToFkClientID<BR>";
                                echo "$\ActionDateSecs = $ActionDateSecs<BR>";
                                echo "$\StartTime = $StartTime<BR>";*/
                                edit_button($ActionID,$ClientID,$JobCardNumberFkJobID,$ActionRelToFkClientID,$ActionDateSecs,$StartTime);
                        echo "</TD>"; 
                        
			//echo "<TD align=\"middle\" bgcolor=\"$setColor\" width=\"8%\">";
			// echo "<a href=\"userCard.php?JobID=$JobCardNumberFkJobID\">$UserFirstname";
			        /**
			        echo "<form method=\"post\" action=\"./userCard.php\">";
                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobCardNumberFkJobID . "\">";
                                echo "<input type=\"hidden\" name=\"ActionFromFkUserID\" value=\"" . $ActionFromFkUserID . "\">";
                                include("log_in_authentication_form_vars.php");
                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"$UserFirstname\">";
                                echo "</form>"; */
                        //        user_button($ActionFromFkUserID);
			// echo "</TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\" width=\"8%\">";
			if ( ! empty($JobCardNumberFkJobID) ) {
			        job_button($JobCardNumberFkJobID,'',$JobCardNumber);
			}
			echo "</TD>";
			
			echo "<TD align=\"middle\" bgcolor=\"$setColor\">$ActionDateTime</TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\">";
			// echo "<a href=\"clientcard2.php?ActionID=$ActionID&StartTime=$StartTime&id=$ActionFkClientID&ActionFkJobID=$JobCardNumberFkJobID&ActionRelToFkClientID=$ActionRelToFkClientID&name=$ClientName\">$ClientName</a>";
			client_button($ActionFkClientID,$ClientName);
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

user_card_details();

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
	$user_ID_to_display = $_POST['user_ID_to_display'];
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
	        echo "<input type=\"hidden\" name=\"user_ID_to_display\" value=\"$user_ID_to_display\">";
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
		
		ShowActions();
	}
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
exit;
}
Function show_actions_text_only(){
	
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
	/**
	$dbst = new dbSession();
	$sqlt = "SELECT * from config WHERE ConfigID = 1 LIMIT 0, 30";
	
	$Resultst = $dbst->getResult($sqlt);
	
	while ($rowt = $dbst->getArray($Resultst)) {
	
	$config_time_zone = $rowt['config_time_zone'];
	$_POST['config_time_zone'] = $config_time_zone;
	}
	*/
	//echo "\$config_time_zone in user_card_with_time_limits_ajax_functions.php in show_actions_text_only() = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";
	
//****************************************************************************** TIME ZONE - END
//**********************************************************************************************

	$sql = "SELECT * from action WHERE ActionDateSecs  >= \"$Start_time_with_offset\" AND ActionDateSecs <= \"$finish_time_with_offset\" ORDER BY ActionDateSecs DESC LIMIT 0, 300";
	
	$Results = $dbs->getResult($sql);
	
	$aColor = 1;
	
	echo "<DIV align=\"center\">";
	echo "<TABLE>";

	echo "<TR>";
		echo "<TD align=\"middle\"><B>User</B></TD>";
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
			
			
			$config_time_zone = $_POST['config_time_zone'];
			// echo "\$config_time_zone text only = $config_time_zone<BR>";
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
/**
function EditDetails() {
	// Edit the cards details
	global $id;
	$UserID = $_POST['UserID'];
	$user_ID_to_display = $_POST['user_ID_to_display'];
	$userAllreadyActive = $_POST['userAllreadyActive'];
	global $name;
	global $InsertIntoDatabase;
	global $UserActive;
	global $UserLogin;
  	global $UserPassword;
  	global $UserDate;
  	global $UserFirstname;
  	global $UserLastname;
  	global $UserAddress1;
  	global $UserAddress2;
  	global $UserCity;
  	global $UserState;
  	global $UserPostcode;
  	global $UserCountry;
  	global $UserPhone1;
  	$UserPhone1 = $_POST['UserPhone1'];
  	global $UserPhone2;
  	global $UserFax;
  	global $UserEmail;
  	global $UserUrl;
  	$happy = 0;
  	Actua();
  	$happy = $_POST['happy'];
  	//*************************************************************************************************
        //******************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {
	        global $debug;
	        $debugMsg .= "In the EditDetails() funtion.<BR>";
	        $debugMsg .= "\$_POST[\'happy\'] = " . $_POST['happy'] . "<BR>";
	        $debugMsg .= "\$happy = $happy<BR>";
	        $debugMsg .= "\$_POST[\'userAllreadyActive\'] = " . $_POST['userAllreadyActive'] . "<BR>";
	        $debugMsg .= "\$userAllreadyActive = $userAllreadyActive<BR>";
	        $debugMsg .= "\$user_ID_to_display = $user_ID_to_display<BR>";
	        $debugMsg .= "\$_POST[\'user_ID_to_display\'] = " . $_POST['user_ID_to_display'] . "<BR>";
	        include("config/debug.php");
        }
        //********************************************************************** DEBUG VARIABLES HERE - END
        //*************************************************************************************************
  	
  	
  	if ($happy == 1) {
		echo "<DIV align=\"center\">";
		$dbs = new dbSession();

		// $sql = "UPDATE user SET UserActive = '$UserActive', UserDate = '$UserDate', UserLogin = '$UserLogin', UserPassword = '$UserPassword', UserLastname = '$UserLastname', UserFirstname = '$UserFirstname', UserAddress1 = '$UserAddress1', UserAddress2 = '$UserAddress2', UserCity = '$UserCity', UserState = '$UserState', UserPostcode = '$UserPostcode', UserCountry = '$UserCountry', UserPhone1 = '$UserPhone1', UserPhone2 = '$UserPhone2', UserFax = '$UserFax', UserEmail = '$UserEmail', UserUrl = '$UserUrl' WHERE UserID = '$user_ID_to_display'";
		
		$sql = "UPDATE user SET UserPhone1 = '$UserPhone1' WHERE UserID = '$user_ID_to_display'";

					if ($dbs->getResult($sql)) {
						$msg = "Card Edited333.";
						echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT>";
						echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";
						user_card_details();
						main();
						LocEndCallAddAction();
						ShowActions();
						echo "<DIV align=\"center\">";
						echo "<BR>";
						echo "<FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"\"><A href=\"index.php\">Home</A></FONT>";
						echo "</DIV>";
					} else {
						$msg = $dbs->printError();
						echo "<BR>$msg 333";
					}
		echo "<BR>";
		echo "</DIV>";
  	}

} */
//********************************************************************** FUNCTIONS - END
//**********************************************************************************************

?>
