<?PHP
function edit_action_card() {
	// Edit the cards details
	$config_time_zone = $_POST['config_time_zone'];
	$config_time_zone = $_POST['user_time_zone'];
	$in_job_card = $_POST['in_job_card'];
	echo "<div align=\"center\">";
	$dbs = new dbSession();
        // **********************************************************************
        // ********************* TIME CONVERSIONS INTO SOMETHING READABLE - START
	$ActionFkJobID = $_POST['ColumnJobID'];
	//echo "\$ColumnJobID = $ColumnJobID<BR><BR>";
	
        //**********************************************************************************************
        //*************************************************************** DEBUG 1 VARIABLES HERE - START
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {	
	        $debug = $_POST['debug'];
	        $debugMsg .= "in EditDetails <BR>";
	        $debugMsg .= "\$_POST['ColumnJobID'] =" . $_POST['ColumnJobID'] . "<BR>";
	        $debugMsg .= "\$ActionFkJobID just after setting =" . $ActionFkJobID . "<BR>";
	        include("config/debug.php");
        }
        //***************************************************************** DEBUG 1 VARIABLES HERE - END
        //**********************************************************************************************
	$JobTimeAmPm = $_POST['JobTimeAmPm'];
	//echo "<BR>\$JobTimeAmPm = $JobTimeAmPm<br>";

	$JobTimeHour = $_POST['JobTimeHour'];
	//echo "<BR>\$JobTimeHour = $JobTimeHour<br>";

	$ActionBreaksHours = $_POST['ActionBreaksHours'];
	//echo "<BR>\$ActionBreaksHours = $ActionBreaksHours<br>";

	$ActionBreaksMins = $_POST['ActionBreaksMins'];
	//echo "<BR>\$ActionBreaksMins = $ActionBreaksMins<br>";

	$ActionBreaksHours = $_POST['ActionBreaksHours'];
	//echo "<BR>\$ActionBreaksHours = $ActionBreaksHours<br>";

	$ActionHours = $_POST['ActionHours'];
	//echo "<BR>\$ActionHours = $ActionHours<br>";

	$ActionMins = $_POST['ActionMins'];
	//echo "<BR>\$ActionMins = $ActionMins<br>";

	$ActionSecs = $_POST['ActionSecs'];
	//echo "<BR>\$ActionSecs = $ActionSecs<br>";

	$JobTimeMinute = $_POST['JobTimeMinute'];
	//echo "<BR>\$JobTimeMinute = $JobTimeMinute<br>";

	$JobTimeMonth = $_POST['JobTimeMonth'];
	//echo "<BR>\$JobTimeMonth = $JobTimeMonth<br>";

	$JobTimeDay = $_POST['JobTimeDay'];
	//echo "<BR>\$JobTimeDay = $JobTimeDay<br>";

	$JobTimeYear = $_POST['JobTimeYear'];
	//echo "<BR>\$JobTimeYear = $JobTimeYear<br>";
        /**
	if (($JobTimeAmPm == "PM") AND ($JobTimeHour <= 12)) {

		$JobTimeMilitary = $JobTimeHour + 12;

	}else{
		$JobTimeMilitary = $JobTimeHour;
	} */
	$ConvertActionBreaksToSecs = ConvertToSeconds($ActionBreaksHours,$ActionBreaksMins,0);
  	$ConvertToSeconds = ConvertToSeconds($ActionHours,$ActionMins,$ActionSecs);

  	
	// $ActionDateSecs = mktime($JobTimeMilitary,$JobTimeMinute,0,$JobTimeMonth,$JobTimeDay,$JobTimeYear);
	//echo "<BR>\$ActionDateSecs = $ActionDateSecs<br>";
        /**
		if (($JobTimeAmPm == "PM") AND ($JobTimeHour <= 12)) {

		$JobTimeMilitary = $JobTimeHour + 12;

	}else{
		$JobTimeMilitary = $JobTimeHour;
	}
	*/
	
        
        
        $format = 'Y m d h i s a P';$xx = "$JobTimeYear $JobTimeMonth $JobTimeDay $JobTimeHour $JobTimeMinute 00 " . $JobTimeAmPm . " " . $config_time_zone;
        $Ad_scheduled_time = DateTime::createFromFormat($format, $xx );
        $ActionDateSecs = $Ad_scheduled_time->format('U');
        /**
        $Ad_scheduled_time = new DateTime("@$$Ad_scheduled_time");
        $zone_action = new DateTimeZone($config_time_zone);
        $Ad_scheduled_time->setTimezone($zone_action); */
        
	//echo "<BR>\$JobTimeMilitary = $JobTimeMilitary<br>";
	//echo "<BR>\$JobTimeMilitary = $JobTimeMilitary<br>";

        // *********************** TIME CONVERSIONS INTO SOMETHING READABLE - END
        // **********************************************************************
	

        //**********************************************************************************************
        //********************************************************************** GRAB POSTED VARS - START
	
	// $ActionFkJobID = $_POST['ActionFkJobID']; 
	//echo "<BR>\$ActionFkJobID = $ActionFkJobID<BR><BR>";
	//echo "<BR>\$ColumnJobID2 = " . $_POST['ColumnJobID'] . "<BR>";
	//**********************************************************************************************
	//********************************************************************** DEBUG VARIABLES HERE - START
	$turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {			
				// $debug = $_POST['debug'];
				$debugMsg .= "<b>Inside EditDetails()</b><br>";
				$debugMsg .= "\$ActionID = $ActionID<br>";
				$debugMsg .= "This " . $_POST['ActionID'] . " is the \$ActionID<BR>";
				$debugMsg .= "\$ActionText = $ActionText<br>";
				$debugMsg .= "\$ActionText = " . $_POST['ActionText'] . "<br>";
				$debugMsg .= "\$ColumnJobID post next = " . $_POST['ColumnJobID'] . "<br>";
				$debugMsg .= "\$ColumnJobID get = " . $_POST['ColumnJobID'] . "<br>";
				$debugMsg .= "\$ActionFkJobID POST = " . $_POST['ActionFkJobID'] . "<br>";
				$debugMsg .= "\$ActionFkJobID GET = " . $_POST['ActionFkJobID'] . "<br>";
				$debugMsg .= "\$ActionFkJobID next = " . $ActionFkJobID . "<br>";
				include("config/debug.php");
        }
	//********************************************************************** DEBUG VARIABLES HERE - END
	//**********************************************************************************************

	$ActionFkClientID = $_POST['id'];
	$ActionDateTime = $_POST['ActionDateTime'];
	$ActionID = $_POST['ActionID'];
	$ActionText = $_POST['ActionText'];
	$ActionText = stripslashes($ActionText);

	$ActionFromFkUserID = $_POST['ActionFromFkUserID'];
	$ActionToFkUSerID = $_POST['ActionToFkUSerID'];
	$ActionRelToFkClientID = $_POST['ActionRelToFkClientID'];
	$ClientID = $_POST['ClientID'];
        //********************************************************************** GRAB POSTED VARS - END
        //**********************************************************************************************

        //**********************************************************************************************
        //*************************************************************** DEBUG 1 VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {
	        $debug = $_POST['debug'];
	        $debugMsg .= "in EditDetails <BR>";
	        $debugMsg .= "\$_POST['ActionID']  =" . $_POST['ActionID'] . "<BR>";
	        $debugMsg .= "\$_POST['ClientID']  =" . $_POST['ClientID'] . "<BR>";
	        $debugMsg .= "\$_POST['JobCardNumberFkJobID']  =" . $_POST['JobCardNumberFkJobID'] . "<BR>";
	        $debugMsg .= "\$_POST['ColumnJobID']  =" . $_POST['ColumnJobID'] . "<BR>";
	        $debugMsg .= "\$_POST['ActionRelToFkClientID']  =" . $_POST['ActionRelToFkClientID'] . "<BR>";
	        $debugMsg .= "\$_POST['ActionDateSecs']  =" . $_POST['ActionDateSecs'] . "<BR>";
	        $debugMsg .= "\$_POST['StartTime']  =" . $_POST['StartTime'] . "<BR>";
	        include("config/debug.php");
        }
        //***************************************************************** DEBUG 1 VARIABLES HERE - END
        //**********************************************************************************************

	$ActionText = addslashes($ActionText);

        //**********************************************************************************************
        //********************************************************************** DEBUG 1 VARIABLES HERE - START
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
	        $debug = $_POST['debug'];
	        $debugMsg .= "in EditDetails <BR>";
	        $debugMsg .= "\$_POST['ColumnJobID'] =" . $_POST['ColumnJobID'] . "<BR>";
	        $debugMsg .= "\$ActionFkJobID =" . $ActionFkJobID . "<BR>";
	        include("config/debug.php");
        }
        //********************************************************************** DEBUG 1 VARIABLES HERE - END
        //**********************************************************************************************
	
	$sql = "UPDATE action SET 
			ActionText =				'$ActionText', 
			ActionFkJobID =				'$ActionFkJobID', 
			ActionFkClientID =			'$ClientID', 
			ActionRelToFkClientID =			'$ActionRelToFkClientID',  
			ActionDateSecs =			'$ActionDateSecs', 
			ActionFromFkUserID =			'$ActionFromFkUserID', 
			ActionToFkUSerID =			'$ActionToFkUSerID', 
			ActionTotalTime =			'$ActionTotalTime', 
			ActionTotalSecs =			'$ConvertToSeconds', 
			ActionTotalBreakSecs =			'$ConvertActionBreaksToSecs' 
	
			WHERE ActionID = '$ActionID' ";

		if ($dbs->getResult($sql)) {
			echo "Action Edited<BR>";
			} else {
				$msg = $dbs->printError();
			}
	echo "<BR>$msg";
	$StartTime = time();
	// echo "<BR />\n<A href=\"clientcard2.php?id=$ClientID&StartTime=$StartTime\" class=\"linkPlainInWhiteAreas\" >Back to Client Card</A><BR><BR>";
	                                        /** echo "<form method=\"post\" action=\"./index.php\">";
                                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">";
                                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                                include("log_in_authentication_form_vars.php");
                                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Back to Client Card\">";
                                                echo "</form>"; */
                                                client_button_with_start_time($ClientID,$StartTime);
	if ($ActionFkJobID != 0){
	
	// echo "<FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"\"><A href=\"JobDetails.php?JobID=$ActionFkJobID\" class=\"linkPlainInWhiteAreas\">Back to Job card</A></FONT><BR><BR>";
	                                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $ActionFkJobID . "\">";
                                                // echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                                include("log_in_authentication_form_vars.php");
                                                echo "Back to Job card ";
                                                job_button_standard_style($ActionFkJobID,'','','');
                                                echo "</form>";
	}
/**	?>
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
exit; */
}
function ConvertToSeconds($h,$m,$s){
		$hoursInSeconds = $h * 3600;
		$minutesInSeconds = $m * 60;
		$totalTimeinSeconds = $hoursInSeconds + $minutesInSeconds + $s;
		return $totalTimeinSeconds;
}
function action_card() {
        ?>                      
        <div class="container" style="border-radius: 4px; border: 1px solid #bbb; width: 100%;">
                
                                <?PHP 
	$id = $_POST['id'];
	$ClientID = $_POST['ClientID'];
	$name = $_POST['name'];
	$InsertIntoDatabase = $_POST['InsertIntoDatabase'];
	$StartTime = $_POST['StartTime'];
	$ActionID = $_POST['ActionID'];
	$ActionFkJobID = $_POST['ActionFkJobID'];
	$_POST['ActionFkJobID'] = $ActionFkJobID;
	$ActionRelToFkClientID = $_POST['ActionRelToFkClientID'];
	$JobSchedTimeInSecs = $_POST['JobSchedTimeInSecs'];
	$ActionDateTime = $_POST['ActionDateTime'];

        //**********************************************************************************************
        //*************************************************************** DEBUG 1 VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {
	        $debug = $_POST['debug'];
	        $debugMsg .= "in EditDetails <BR>";
	        $debugMsg .= "\$_POST['ActionID']  =" . $_POST['ActionID'] . "<BR>";
	        $debugMsg .= "\$_POST['ClientID']  =" . $_POST['ClientID'] . "<BR>";
	        $debugMsg .= "\$_POST['JobCardNumberFkJobID']  =" . $_POST['JobCardNumberFkJobID'] . "<BR>";
	        $debugMsg .= "\$_POST['ColumnJobID']  =" . $_POST['ColumnJobID'] . "<BR>";
	        $debugMsg .= "\$_POST['ActionRelToFkClientID']  =" . $_POST['ActionRelToFkClientID'] . "<BR>";
	        $debugMsg .= "\$_POST['ActionDateSecs']  =" . $_POST['ActionDateSecs'] . "<BR>";
	        $debugMsg .= "\$_POST['StartTime']  =" . $_POST['StartTime'] . "<BR>";
	        include("config/debug.php");
        }
        //***************************************************************** DEBUG 1 VARIABLES HERE - END
        //**********************************************************************************************
        
        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
	        // echo date ("Y", mktime (0,0,0,0,0,2004));
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
	        echo "Inside main() of editAction.php";
	        // $debug = $_POST['debug'];
	        $debugMsg .= "ActionID=$ActionID<BR />\n<BR>";
	        $debugMsg .= "This --> " . $_POST['ActionID'] . "<-- is the \$ActionID<BR><BR>";
	        $debugMsg .= "ActionFkJobID=$ActionFkJobID<BR />\n<BR>";
	        $debugMsg .= "ActionFkJobID_POST = " . $_POST['ActionFkJobID'] . "<BR />\n<BR>";
	        include("config/debug.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
        
	$dbs = new dbSession();
	// $sql = "SELECT * from client WHERE ClientID = \"$id\" LIMIT 0, 30";
	// $sql = "SELECT * from action WHERE ActionFkClientID  = \"$id\" ORDER BY ActionDateTime DESC";
	$sql = "SELECT * from action WHERE ActionID = \"$ActionID\" LIMIT 0, 1";
	
	$Results = $dbs->getResult($sql);
	while ($row = $dbs->getArray($Results)) {
	
	$JobCardNumberFkJobID = $row['ActionFkJobID'];
	$ActionFkClientID = $row[ActionFkClientID];
	$ActionFkJobID = $row[ActionFkJobID];
	
	// *****************************************************************************
	// ****************************************************** SCHEDULED TIME - START
	$config_time_zone = $_POST['user_time_zone'];
	$ActionActionDateSecs = $row[ActionDateSecs];
	if ( ($ActionActionDateSecs == 0) || empty($ActionActionDateSecs) ) {
		$ActionActionDateSecs = time();
                $update_cause_of_no_job_scehd_time = 1;
	}
	//****************************************************************
	//******************************************** UNNECESSARY - START
	// Unnecessary as timestamp is unaffected by time zone change.
	// After PHP 5.3 you can get human readable date/ times by 
	// setting the time zone. --> Although I have reinstated the bit
	// that spews back the human readable with the CORRECT time zone.
	$Ad_scheduled_time = new DateTime("@$ActionActionDateSecs");
        $zone_action = new DateTimeZone($config_time_zone);
        $Ad_scheduled_time->setTimezone($zone_action);
	//********************************************** UNNECESSARY - END
	//****************************************************************
	
	// ******************************************************** SCHEDULED TIME - END
	// *****************************************************************************
	$ActionText = $row[ActionText];
	$ActionFromFkUserID = $row[ActionFromFkUserID];
	$ActionToFkUSerID = $row[ActionToFkUSerID];
	$TotalSecs = $row[ActionTotalSecs];
	$TotalActionTotalBreakSecs = $row[ActionTotalBreakSecs];
	
        //**********************************************************************************************
        //********************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {
	        //$debug = $_POST['debug'];
	        $debugMsg .= "<b>Edittttssss</b><BR><BR>";
	        $debugMsg .= "\$ActionFkClientID in it = $ActionFkClientID<br>";
	        $debugMsg .= "\$TotalSecs in it = $TotalSecs<br>";
	        $debugMsg .= "\$TotalActionTotalBreakSecs in it = $TotalActionTotalBreakSecs<br>";
	        $debugMsg .= "\$ActionToFkUSerID in it = $ActionToFkUSerID<br>";
	        include("config/debug.php");
        }
        //********************************************************************** DEBUG VARIABLES HERE - END
        //**********************************************************************************************
			
	$name = $row['ClientName'];
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	$ReadableStartTime = date("H:i:s", $StartTime);
	$ReadableHours = date("H", $StartTime);
	$ReadableMins = date("i", $StartTime);
	$ReadableSec = date("s", $StartTime);
	
	$ConvertToSeconds = ConvertToSeconds($ReadableHours,$ReadableMins,$ReadableSec);
	
        //**********************************************************************************************
        //********************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
                $debugMsg .= "Hours= $ReadableHours<BR>";
                $debugMsg .= "Minutes= $ReadableMins<BR>";
                $debugMsg .= "Seconds= $ReadableSec<BR>";
                $debugMsg .= "\$ConvertToSecondszzzzzzz = $ConvertToSeconds<BR />\n<BR>";
                $debugMsg .= "<b>rreee</b><BR>";
                $debugMsg .= "\$TotalSecs in it = $TotalSecs<br>";
                $debugMsg .= "\$ActionToFkUSerID in it = $ActionToFkUSerID<br>";
                include("config/debug.php");
	        }
        //********************************************************************** DEBUG VARIABLES HERE - END
        //**********************************************************************************************

	$ActionHours = date("H", mktime(0,0,$TotalSecs));
	$ActionMins = date("i", mktime(0,0,$TotalSecs));
	$ActionSecs = date("s", mktime(0,0,$TotalSecs));

        //**********************************************************************************************
        //********************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
				        //$debug = $_POST['debug'];
				        $debugMsg .= "<b>Timesyyyyyyyz</b><BR><BR>";
				        $debugMsg .= "\$TotalSecs = $TotalSecs<br>";
				        $debugMsg .= "\$ActionHours = $ActionHours<br>";
				        $debugMsg .= "\$ActionMins = $ActionMins<br>";
				        $debugMsg .= "\$ActionSecs = $ActionSecs<br>";
				        $debugMsg .= "\$JobCardNumberFkJobID = $JobCardNumberFkJobID<br>";
				
				        include("config/debug.php");
				        }
        //********************************************************************** DEBUG VARIABLES HERE - END
        //**********************************************************************************************
	

	$ActionBreaksHours = date("H", mktime(0,0,$TotalActionTotalBreakSecs));
	$ActionBreaksMins = date("i", mktime(0,0,$TotalActionTotalBreakSecs));

	$CalcTotalSecs = $TotalSecs - $TotalActionTotalBreakSecs;
	// $CalcTotalReadable = date("H:i:s", $CalcTotalSecs);
	$CalcTotalReadable = date("H:i:s", mktime(0,0, $CalcTotalSecs));

	//$ActionFromFkUserID = $row[ActionFromFkUserID];
	$dbsFromUserFirstName = new dbSession();
	$sql = "SELECT UserFirstname, UserLogin from user WHERE UserID = \"$ActionFromFkUserID\" LIMIT 1";
	$ResultsFromUser = $dbsFromUserFirstName->getResult($sql);
	$rowFromUser = $dbsFromUserFirstName->getArray($ResultsFromUser);
	$FromUserFirstname = $rowFromUser['UserFirstname'];
	
	//$ActionToFkUSerID = $row[ActionToFkUSerID];
	$dbsToUserFirstName = new dbSession();
	$sql = "SELECT UserFirstname from user WHERE UserID = \"$ActionToFkUSerID\" LIMIT 1";
	$ResultsToUser = $dbsToUserFirstName->getResult($sql);
	$rowToUser = $dbsToUserFirstName->getArray($ResultsToUser);
	$ToUserFirstname = $rowToUser['UserFirstname'];
        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
	        $debugMsg .= "<b>Doodadsmmmppp</b><BR><BR>";
	        $debugMsg .= "\$ActionFromFkUserID = $ActionFromFkUserID<br>";
	        $debugMsg .= "\$ActionToFkUSerID = $ActionToFkUSerID<br>";
	        include("config/debug.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************

	// ****************************************************************
	// This is to convert the unix time to a readble 24hour clock - Start
		$ReadableJobSchedTime = $Ad_scheduled_time->format('Y m d h i s a P');
		$ReadableJobSchedHour = $Ad_scheduled_time->format('h');
		$ReadableJobSchedminute = $Ad_scheduled_time->format('i');
		$schedAmPm = $Ad_scheduled_time->format('a');
		$ReadableJobSchedDay = $Ad_scheduled_time->format('d');
		$ReadableJobSchedMonth = $Ad_scheduled_time->format('M');
		$ReadableJobSchedMonthDigit = $Ad_scheduled_time->format('m');
		$ReadableJobSchedYear = $Ad_scheduled_time->format('Y');
	// This is to convert the unix time to a readble 24hour clock - End
	// ****************************************************************
	
        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
	        $debugMsg .= "<b>24hour clock vars</b><BR><BR>";
	        $debugMsg .= "\$schedHourMadeTo12HourClock = $schedHourMadeTo12HourClock <BR>";
	        $debugMsg .= "\$ActionActionDateSecs = $ActionActionDateSecs <BR>";
	        include("config/debug.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
	// echo "<H3>Edit action.</H3>";
	$header_size = $_POST['header_size'];
	echo "<H" . $header_size . ">Edit action.</H" . $header_size . ">";
	/**
	echo "Total Time -";

	echo "Hours <input type=\"text\" name=\"ActionHours\" value=\"$ActionHours\">";
	echo "Minutes <input type=\"text\" name=\"ActionMins\" value=\"$ActionMins\">";
	echo "Seconds <input type=\"text\" name=\"ActionSecs\" value=\"$ActionSecs\">";
	echo "<BR>";
	*/
	
	        ?>    
                <div class="row">
                        <div class="two columns" style="margin-top: 0%; text-align: left">
                        <B>Start Time</B> 
                        </div>
                        <div class="ten columns" style="margin-top: 0%; text-align: center">
                        <?PHP 
                        echo "  <select name=\"JobTimeHour\" tabindex=\"3\"\">
		                <OPTION  value=\"$ReadableJobSchedHour\">$ReadableJobSchedHour";
		                $timeHourOption = "0";
		                while ($timeHourOption <= "11") {		
			                $timeHourOption = $timeHourOption + 1;
			                echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
		                }
                        echo "  </SELECT>
                                :
		                <select name=\"JobTimeMinute\" tabindex=\"4\">  
                                <OPTION  value=\"$ReadableJobSchedminute\">$ReadableJobSchedminute";
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

		
		                <SELECT name=\"JobTimeDay\" tabindex=\"6\">
		                <OPTION  value=\"$ReadableJobSchedDay\">$ReadableJobSchedDay
                        ";
		                $timeDayOption = 0;
		                while ($timeDayOption <= "30") {		
			                $timeDayOption = $timeDayOption + 1;
			                echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
		                }

                        echo "  </SELECT>
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
		                </SELECT>";
		                $timeYearOptionSeconds = time(); //echo date("H:i:s");
		                $timeYearOption = date("Y");
		                $timeYearOption = $timeYearOption - 3;
		                //echo "\$timeYearOption = $timeYearOption<BR>";
		                $timeYearOptionLimit = $timeYearOption + 5;
	                echo "	
		                <select name=\"JobTimeYear\" tabindex=\"8\"\">
		                <OPTION  value=\"$ReadableJobSchedYear\">$ReadableJobSchedYear
                        ";
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
		                ";
                                                
                        ?>
                        </div>
                </div>
                <div class="row">
                        <div class="two columns" style="margin-top: 1%; text-align: left">
                        <B>Total Time</B>
                        </div>
                        <div class="ten columns" style="margin-top: 1%; text-align: center">
                        <?PHP 
                        echo "
	                <TABLE>
	                        <TR>
		                        <TD>Hours</TD>
		                        <TD><input type=\"text\" name=\"ActionHours\" value=\"$ActionHours\"></TD>
	                        </TR>
	                        <TR>
		                        <TD>Minutes</TD>
		                        <TD><input type=\"text\" name=\"ActionMins\" value=\"$ActionMins\"></TD>
	                        </TR>
	                        <TR>
		                        <TD>Seconds</TD>
		                        <TD><input type=\"text\" name=\"ActionSecs\" value=\"$ActionSecs\"></TD>
	                        </TR>
	                </TABLE>
	                ";
                        ?>
                        </div>
                </div>
                <div class="row">
                        <div class="two columns" style="margin-top: 1%; text-align: left">
                        <B>Total Breaks</B> 
                        </div>
                        <div class="five columns" style="margin-top: 1%; text-align: center">
                        <?PHP 
                        echo "Hours  <input type=\"text\" name=\"ActionBreaksHours\" value=\"$ActionBreaksHours\"> ";
                        ?>
                        </div>
                        <div class="five columns" style="margin-top: 1%; text-align: center">
                        <?PHP 
                        echo "Minutes  <input type=\"text\" name=\"ActionBreaksMins\" value=\"$ActionBreaksMins\">";
                        ?>
                        </div>
                </div>
                <div class="row">
                        <div class="twelve columns" style="margin-top: 1%; text-align: left">
                        <?PHP  
                        echo "  <TABLE>
	                                <TR>
		                                <TD><B>Calculated Total Time -</B></TD>
		                                <TD></TD>
		                                <TD>$CalcTotalReadable</TD>
	                                </TR>
                                </TABLE>
	                        ";
                        ?>
                        </div>
                </div>
                <div class="row">
                        <div class="three columns" style="margin-top: 1%; text-align: left">
                        <B>Action Text </B>
                        </div>
                        <div class="nine columns" style="margin-top: 1%; text-align: left">
                        <?PHP 
                        echo "<TEXTAREA rows=\"5\" cols=\"35\" name=\"ActionText\">$ActionText</TEXTAREA>";
                        ?>
                        </div>
                </div>
                <div class="row">
                        <div class="twelve columns" style="margin-top: 1%; text-align: left">
                        <?PHP  
                        echo "  <TABLE>
	                                <!-- <TD>JobID - Job Card Number</TD> -->
		                        <TD><B>Related to JobID</B></TD>
		                        <TD></TD>
		                        <TD><input type=\"text\" name=\"ColumnJobID\" value=\"$JobCardNumberFkJobID\">
                                </TABLE>
	                        ";
                        ?>
                        </div>
                </div>
                <div class="row">
                        <div class="twelve columns" style="margin-top: 1%; text-align: left">
                        <?PHP  
                        echo "  <TABLE>
                                        <TR>
	                                        <TD><B>Created by</B></TD>
			                        <TD></TD>
			                        <TD>$FromUserFirstname
		                        </TR>
	                        </TABLE>
	                        ";
                        ?>
                        </div>
                </div>
                <div class="row">
                        <div class="twelve columns" style="margin-top: 1%; text-align: center">
                <?PHP
	echo "
	<TABLE>
	
		
	";	
	
		// $JobCardNumberFkJobID = $row['ActionFkJobID'];


		/**
		
		$dbsJobSheetNumber = new dbSession();
		$sqlJob = "SELECT JobCardNumber from job WHERE JobID = \"$JobCardNumberFkJobID\" LIMIT 1";
		$ResultsJob = $dbs->getResult($sqlJob);
		$rowJob = $dbs->getArray($ResultsJob);
		$JobCardNumber = $rowJob['JobCardNumber'];
		// $JobCardNumberFkJobID = $_POST['ColumnJobID'];
		
        //**********************************************************************************************
        //********************************************************************** DEBUG VARIABLES HERE - START
				        //$debug = $_POST['debug'];
				        $debugMsg .= "<b>Doodadsmmmppp</b><BR><BR>";
				        $debugMsg .= "\$JobCardNumberFkJobID right here = $JobCardNumberFkJobID<br>";
				        $debugMsg .= "\$ActionToFkUSerID = $ActionToFkUSerID<br>";
				        include("config/debug.php");
        //********************************************************************** DEBUG VARIABLES HERE - END
        //**********************************************************************************************
		
		echo "<SELECT name=\"ColumnJobID\">";
		echo "<OPTION value=\"$JobCardNumberFkJobID\">$ActionFkJobID - $JobCardNumber";
		// echo "<OPTION value=\"$JobCardNumberFkJobID\">$JobCardNumberFkJobID - $JobCardNumber";
		
		echo "<OPTION value=\"0\">0 - 0";
		$dbs = new dbSession();
		$sql = "SELECT JobID,JobCardNumber from job WHERE JobFkClientID = '$id' OR JobFkClientID = '$ActionRelToFkClientID' ORDER BY JobID ASC";
		// $sql = "SELECT JobID,JobCardNumber,JobFkClientID,ActionRelToFkClientID from Job,Action WHERE Job.JobFkClientID = '$id' OR Job.JobFkClientID = Action.ActionRelToFkClientID ORDER BY JobCardNumber ASC";
		$Results = $dbs->getResult($sql);
			while ($row = $dbs->getArray($Results)) {
				//$optValue = $row['JobID'];
				echo "<OPTION value=\"$row[JobID]\">$row[JobID] - $row[JobCardNumber]";
				//echo "<OPTION value=\"$row[UserID]\">$row[UserFirstname]";
				//echo "\$optValue1 = $optValue<BR>";
				}
		$dbs = new dbSession();
		$sql = "SELECT * from job WHERE JobFkClientID = '$id' ORDER BY JobCardNumber ASC";
		// $sql = "SELECT JobID,JobCardNumber,JobFkClientID,ActionRelToFkClientID from Job,Action WHERE Job.JobFkClientID = '$id' OR Job.JobFkClientID = Action.ActionRelToFkClientID ORDER BY JobCardNumber ASC";
		$Results = $dbs->getResult($sql);
			while ($row = $dbs->getArray($Results)) {
				//$optValue = $row['JobID'];
				echo "<OPTION value=\"$row[JobID]\">$row[JobID] - $row[JobCardNumber]";
				//echo "\$optValue2 = $optValue<BR>";
				}
		echo "</SELECT>";
		*/

	echo "";
	                        
                                //**********************************************************************************************
                                //********************************************************************** DEBUG VARIABLES HERE - START
                                $turn_this_debug_on = 0;
                                if ($turn_this_debug_on == 1) {
				                                //$debug = $_POST['debug'];\
				                                $debugMsg .= "\$ActionFromFkUserID in it = $ActionFromFkUserID<br>";
				                                $debugMsg .= "\$ActionToFkUSerID in it = $ActionToFkUSerID<br>";
				                                include("config/debug.php");
				                                }
                                //********************************************************************** DEBUG VARIABLES HERE - END
                                //**********************************************************************************************
				/**
				echo "<SELECT name=\"ActionFromFkUserID\">";
				if ($ActionFromFkUserID < 1) {
					$ActionFromFkUserID = 1;
				}
				
				echo "<OPTION value=\"$ActionFromFkUserID\">$FromUserFirstname";
				$dbs = new dbSession();
				$sql = "SELECT UserFirstname, UserID from user";
				$Results = $dbs->getResult($sql);

					while ($row = $dbs->getArray($Results)) {
						// $optValue = $row['UserID'];				
						echo "<OPTION value=\"$row[UserID]\">$row[UserFirstname]";
						}
				echo "</SELECT>";
				*/
	
	echo "	";
/**	echo "	
		<TR>
			<TD>AssignedTo</TD>
			<TD></TD>
			<TD>";
			

				echo "<SELECT name=\"ActionToFkUSerID\">";
				if ($ActionToFkUSerID < 1) {
					$ActionToFkUSerID = 1;
				}
				
				echo "<OPTION value=\"$ActionToFkUSerID\">$ToUserFirstname";
				$dbs = new dbSession();
				$sql = "SELECT UserFirstname, UserID from user";
				$Results = $dbs->getResult($sql);
				
					while ($row = $dbs->getArray($Results)) {
						// $optValue = $row['UserID'];				
						echo "<OPTION value=\"$row[UserID]\">$row[UserFirstname]";
						}
				echo "</SELECT>";
	
	echo "	
			</TD>
		</TR>"; */
		
/**	echo "  <TR>
		        <TD>Related to client</TD>
		        <TD></TD>
		        <TD>
	        ";
		        echo "<select name=\"ActionRelToFkClientID\">";
		        echo "<OPTION value=\"$ActionRelToFkClientID\">$ActionRelToFkClientID";
		        $dbs = new dbSession();
		        $sql = "SELECT ClientID, ClientName from client ORDER BY ClientName ASC";
		        $Results = $dbs->getResult($sql);
		
			        while ($row = $dbs->getArray($Results)) {
				        $optValue = $row['ClientName'];				
				        echo "<OPTION value=\"$row[ClientID]\">$row[ClientName]";
				        }
		        echo "</SELECT>";
	        echo "  </TD>
	        </TR>"; */
	        
	echo "  <TR>
		        <TD colspan=\"3\">
	        ";
	
		        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
		        echo "<input type=\"hidden\" name=\"ActionFromFkUserID\" value=\"$ActionFromFkUserID\">";
		        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"edit_action_card\">";
		        echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
		        echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"$ActionFkJobID\">";
		        // echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"$JobCardNumberFkJobID\">";
		        echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ActionFkClientID\">"; 
		        echo "<input type=\"hidden\" name=\"ActionID\" value=\"$ActionID\">"; 
		        //echo "<input type=\"hidden\" name=\"ColumnJobID\" value=\"$ActionFkJobID\">";
		        echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
		        include("log_in_authentication_form_vars.php");
		        echo "<input type=\"submit\" name=\"Submit\" value=\"Apply Changes\">";
		        echo "</form>";

		        echo "<form method=\"post\" action=\"$PHP_SELF\">";
		        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
		        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"DeleteActionQuestion\">";
		        echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
		        echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ActionFkClientID\">"; 
		        echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"$ActionFkJobID\">";
		        // echo "<input type=\"hidden\" name=\"ColumnJobID\" value=\"$ActionFkJobID\">";
		        echo "<input type=\"hidden\" name=\"ActionID\" value=\"$ActionID\">";
		        // echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
		        include("log_in_authentication_form_vars.php");
		        echo "<input type=\"submit\" tabindex=\"19\" name=\"Submit\" value=\"Delete Action\">";
		        echo "</form>";
	
	                echo "
		        </TD>
	        </TR>
	</TABLE>
	";
	}
                        ?>
                        </div>
                </div>
        </div>
        <?PHP

}
function LocEndCallAddAction(){
  	
	$ActionFkClientID = $_POST['ClientID'];
	$JobFkClientID = $_POST['JobFkClientID'];
	$JobID = $_POST['JobID'];
	$name = $_POST['name'];
	$UserID = $_POST['UserID'];
	$ColumnUserName = ['ColumnUserName'];
	$in_job_card = $_POST['in_job_card'];

        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
                include("debug_array.php");
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
	if ($in_job_card == 1) {
	        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_card\">";
	}else{
	        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"client_details\">";
	        $in_job_card = 0;
	}
	echo "<input type=\"hidden\" name=\"JobID\" value=\"$JobID\">";
	echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ActionFkClientID\">";
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
	
	
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	/**
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
	
	echo "<TEXTAREA tabindex=\"24\" rows=\"5\" cols=\"29\" name=\"AddAction\" WRAP=\"virtual\"></TEXTAREA>";
	
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
	// echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"end_call\">";
	echo "<input type=\"hidden\" name=\"ColumnJobID\" value=\"$JobID\">"; 
	echo "<input type=\"hidden\" name=\"JobID\" value=\"$JobID\">"; 
	echo "<input type=\"hidden\" name=\"in_job_card\" value=\"$in_job_card\">"; 
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";  
	echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"$JobID\">";
	echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ActionFkClientID\">";
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
function show_job_actions(){
        $ClientID = $_POST['ClientID'];
        $JobID = $_POST['JobID'];
	
	//include("config/class_detect.php");
	$box_vars_jd = new detect;
	$box_vars_jd->my_box();
	$jd_col_2 = $box_vars_jd->jd_col_2;
	$jd_col_3 = $box_vars_jd->jd_col_3;
	$jd_col_5 = $box_vars_jd->jd_col_5;
	$jd_col_6 = $box_vars_jd->jd_col_6;
	$jd_cols_for_textarea = $box_vars_jd->jd_cols_for_textarea;
	//**********************************************************************************************
	//********************************************************************** DEBUG VARIABLES HERE - START
	$turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {	
		$debugMsg .= "Inside ShowActions() in JobDetails.php<BR>";
		$debugMsg .= "\$ActionCumulativeTimeTotalReadableDay = $ActionCumulativeTimeTotalReadableDay<BR>";
		$debugMsg .= "In the function ShowActions \$jd_col_2 = $jd_col_2<BR>";
		$debugMsg .= "In the function ShowActions \$jd_col_3 = $jd_col_3<BR>";
		$debugMsg .= "In the function ShowActions \$jd_col_5 = $jd_col_5<BR>";
		$debugMsg .= "In the function ShowActions \$jd_col_6 = $jd_col_6<BR>";
		// include("config/debug.php");
		}
	//********************************************************************** DEBUG VARIABLES HERE - END
	//**********************************************************************************************
	
	//**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
                if ($turn_this_debug_on == 1) {	
                        $debugMsg .= "Inside ShowActions() in JobDetails.php<BR>";
                        $debugMsg .= "\$id = $id<BR>";
                        $debugMsg .= "\$JobID = $JobID<BR>";
                        $debugMsg .= "\$UserID = $UserID<BR>";
                        $debugMsg .= "\$ClientID = $ClientID<BR>";
                        $debugMsg .= "\$AddAction = $AddAction<BR>";
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
	
	// echo "* test2	\$SearchClientName= $SearchClientName<BR>";
	// echo "* test3	\$id= $id<BR>";
	$dbs = new dbSession();
	// echo "* test3	\$dbs= $dbs<BR>";
	$sql = "SELECT * from action WHERE ActionFkJobID = \"$JobID\" ORDER BY ActionDateSecs DESC";
	/*
	$categorysql = "SELECT pages_categories.category_id, categories.name 
	FROM pages_categories, categories WHERE pages_categories.pages_id = 
	'$row[id]' AND categories.id = pages_categories.category_id LIMIT 1";
	
	$sql = "SELECT action.*, User.UserFirstname 
			FROM action, User
			WHERE action.ActionFkClientID = '$id'
			ORDER BY ActionDateSecs DESC";
	*/
	$Results = $dbs->getResult($sql);
	//$row = $dbs->getArray($Results);
	//$ActionText = $row['ActionText'];
	
	$aColor = 1;
	
	echo "<DIV align=\"center\">";
	echo "<TABLE>";

	echo "<TR>";
	echo "<TD align=\"middle\"><B>Edit</B></TD>";
	// echo "<TD align=\"middle\" width=\"$jd_col_2\"><B>JID-EHN</B></TD>";
	echo "<TD align=\"middle\" width=\"$jd_col_3\"><B>Date & Time Added</B></TD>";
	echo "<TD align=\"middle\"><B>By User</B></TD>";
	echo "<TD align=\"middle\" width=\"$jd_col_5\"><B>Total Time</B></TD>";
	echo "<TD align=\"middle\" width=\"$jd_col_6\"><B>Detail</B></TD>";
	echo "</TR>";
		
		
	
	
	while ($row = $dbs->getArray($Results)) {
			
			$ActionText = $row['ActionText'];
			$ActionID = $row['ActionID'];
			$ActionFkJobID = $row['ActionFkJobID'];
			$ActionRelToFkClientID = $row['ActionRelToFkClientID'];
			
			
			$ActionDateSecs = $row['ActionDateSecs'];
			//$ActionDateTime = date("H:i:s l d-M-Y",$ActionDateSecs);
			$Ad = new DateTime("@$ActionDateSecs");
			//$config_time_zone = $_POST['config_time_zone'];
			$config_time_zone = $_POST['user_time_zone'];
			$zone_action = new DateTimeZone($config_time_zone);
			$Ad->setTimezone($zone_action);
			$ActionDateTime = $Ad->format(DATE_RFC1123);
			
			
			$ActionTotalSecs = $row['ActionTotalSecs'];
			$ActionTotalBreakSecs = $row['ActionTotalBreakSecs'];
			$ActionTotalSecsMinusBreak = $ActionTotalSecs - $ActionTotalBreakSecs;
			// echo "\$ActionTotalBreakSecs = $ActionTotalBreakSecs";
			$ActionTotalTime = date("H:i:s", mktime(0,0,$ActionTotalSecsMinusBreak));
			
			$ActionCumulativeTime = $ActionCumulativeTimeTotal;
			$ActionCumulativeTimeTotal = $ActionTotalSecs - $ActionTotalBreakSecs + $ActionCumulativeTime;
			// echo "\$ActionCumulativeTimeTotal $ActionCumulativeTimeTotal = \$ActionTotalSecs $ActionTotalSecs - \$ActionTotalBreakSecs $ActionTotalBreakSecs + \$ActionCumulativeTime $ActionCumulativeTime <BR><BR>";
			$ActionCumulativeTimeTotalReadable = date("H:i:s", mktime(0,0,$ActionCumulativeTimeTotal));
			$ActionCumulativeTimeTotalReadableDay = floor(($ActionCumulativeTimeTotal / 86400));
			// echo "\$ActionCumulativeTimeTotal = $ActionCumulativeTimeTotal";
			// echo "\$ActionCumulativeTimeTotalReadable = $ActionCumulativeTimeTotalReadable";
			global $debug;
			$debugMsg .= "\$ActionCumulativeTimeTotalReadableDay in While loop = $ActionCumulativeTimeTotalReadableDay<BR>";
			include("config/tpl_bodystart.php");
			
			$ActionFromFkUserID = $row['ActionFromFkUserID'];
			$dbsUserFirstName = new dbSession();
			$sql = "SELECT UserFirstname from user WHERE UserID = \"$ActionFromFkUserID\" LIMIT 1";
			$ResultsUser = $dbs->getResult($sql);
			$rowUser = $dbs->getArray($ResultsUser);
			$UserFirstname = $rowUser['UserFirstname'];
			
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
			echo "<TD align=\"middle\" bgcolor=\"$setColor\">";
			// echo "<a class=\"linkPlainInWhiteAreas\" href=\"editAction.php?ActionID=$ActionID&StartTime=$StartTime&id=$id&ActionFkJobID=$JobCardNumberFkJobID&ActionRelToFkClientID=$ActionRelToFkClientID\">Edit</a>";
			edit_button($ActionID,$ClientID,$JobCardNumberFkJobID,$ActionRelToFkClientID,$ActionDateSecs,$StartTime);
			echo "</TD>";
			
			// echo "<TD align=\"middle\" bgcolor=\"$setColor\" width=\"$jd_col_2\"><a class=\"linkPlainInWhiteAreas\" href=\"JobDetails.php?JobID=$JobCardNumberFkJobID\">$JobCardNumberFkJobID-$JobCardNumber </TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\">$ActionDateTime</TD>";
			//echo "<TD align=\"middle\" bgcolor=\"$setColor\"><a class=\"linkPlainInWhiteAreas\" href=\"userCard.php?ActionID=$ActionID&StartTime=$StartTime&id=$ActionFromFkUserID&ActionFkJobID=$JobCardNumberFkJobID&ActionRelToFkClientID=$ActionRelToFkClientID&name=$UserFirstname\">$UserFirstname</a></TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\">"; 
			user_button($ActionFromFkUserID); 
			echo "</TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\" width=\"$jd_col_5\">$ActionCumulativeTimeTotalReadableDay d $ActionTotalTime</TD>";
			//echo "<TD bgcolor=\"$setColor\" width=\"50%\"><PRE>$ActionText</PRE></TD>";
			//echo "<TD  bgcolor=\"$setColor\" width=\"50%\"><PRE>" . wordwrap($ActionText, 100, "<br />", true) . "</PRE></TD>";
			echo "<TD  bgcolor=\"$setColor\" width=\"$jd_col_6\"><PRE><TEXTAREA rows=\"5\" cols=\"$jd_cols_for_textarea\" name=\"ActionText\">$ActionText</TEXTAREA></PRE></TD>";
			echo "</TR>";
	}	
	echo "</TABLE>";
	echo "</DIV>";
	//exit;
	
}

function ShowActions($in_job_card,$show_client,$for_history_card) {
        $JobFkClientID = $_POST['JobFkClientID'];
        $ClientID = $_POST['ClientID'];
        $JobID = $_POST['JobID'];
	$box_vars_jd = new detect;
	$box_vars_jd->my_box();
	$jd_col_2 = $box_vars_jd->jd_col_2;
	$jd_col_3 = $box_vars_jd->jd_col_3;
	$jd_col_5 = $box_vars_jd->jd_col_5;
	$jd_col_6 = $box_vars_jd->jd_col_6;
	$jd_cols_for_textarea = $box_vars_jd->jd_cols_for_textarea;
	
	$Start_time_with_offset = $_POST['Start_time_with_offset'];
	$now_dudes = time();
	$finish_time_with_offset = $_POST['finish_time_with_offset'];
	$difference_to_current_time_from_finish_time = $finish_time_with_offset - $now_dudes;
	$difference_in_hours = $difference_to_current_time_from_finish_time / 3600;
	
        //**********************************************************************************************
        //********************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {	
                $debugMsg .= "Inside ShowActions() in JobDetails.php<BR>";
                $debugMsg .= "\$ActionCumulativeTimeTotalReadableDay = $ActionCumulativeTimeTotalReadableDay<BR>";
                $debugMsg .= "In the function ShowActions \$jd_col_2 = $jd_col_2<BR>";
                $debugMsg .= "In the function ShowActions \$jd_col_3 = $jd_col_3<BR>";
                $debugMsg .= "In the function ShowActions \$jd_col_5 = $jd_col_5<BR>";
                $debugMsg .= "In the function ShowActions \$jd_col_6 = $jd_col_6<BR>";
                // include("config/debug.php");
        }
        //********************************************************************** DEBUG VARIABLES HERE - END
        //**********************************************************************************************

        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {	
                $debugMsg .= "Inside ShowActions() in JobDetails.php<BR>";
                $debugMsg .= "\$id = $id<BR>";
                $debugMsg .= "\$JobID = $JobID<BR>";
                $debugMsg .= "\$UserID = $UserID<BR>";
                $debugMsg .= "\$ClientID = $ClientID<BR>";
                $debugMsg .= "\$AddAction = $AddAction<BR>";
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
        $dbs = new dbSession();
        
        if ($in_job_card == 1) {
                $sql = "SELECT * from action WHERE ActionFkJobID = \"$JobID\" ORDER BY ActionDateSecs DESC";
        }elseif ($for_history_card == 1) {
                $sql = "SELECT * from action WHERE ActionDateSecs  >= \"$Start_time_with_offset\" AND ActionDateSecs <= \"$finish_time_with_offset\" ORDER BY ActionDateSecs DESC LIMIT 0, 300";
        }else{
                $sql = "SELECT * from action WHERE ActionFkClientID = \"$ClientID\" ORDER BY ActionDateSecs DESC";
        }
        $Results = $dbs->getResult($sql);
        $aColor = 1;
        //echo "<div class=\"container\">";
        
        //echo "<div>";
                        
        echo "<div class=\"container\">";
                echo "<div class=\"row\">";
                        ?>
                        <div class="six columns" style="margin-top: 1%; ">
                        <?PHP
                        echo "<TABLE>";
                                echo "<TR class=\"hide_under_400\">";
                                        echo "<TD align=\"middle\" width=\"10%\"><B>Edit</B></TD>";
                                        if ($in_job_card == 1) {
                                                // echo "<TD align=\"middle\" class=\"hide_under_400\"><B>Client</B></TD>";
                                        }else{
                                                echo "<TD align=\"middle\" width=\"10%\"><B>JID-EHN</B></TD>";
                                        }
                                        echo "<TD align=\"middle\" width=\"10%\"><B>Date & Time Added</B></TD>";
                                        echo "<TD align=\"middle\" width=\"10%\"><B>By User</B></TD>";
                                echo "</TR>";
                        echo "</TABLE>";
                        ?>
                        </div>
                        <div class="six columns" style="margin-top: 1%;">
                        <?PHP
                        echo "<TABLE>";
                                echo "<TR class=\"hide_under_400\">";
                                        echo "<TD align=\"middle\" width=\"$jd_col_5\"><B>Total Time</B></TD>";
                                        if ($show_client == 1) {
                                                echo "<TD align=\"middle\"><B>Client</B></TD>";
                                        }
                                        echo "<TD align=\"middle\" width=\"$jd_col_6\"><B>Detail</B></TD>";
                                echo "</TR>";
                        echo "</TABLE>";
                        ?>
                        </div>
                </div>
        <?PHP
        while ($row = $dbs->getArray($Results)) {
                if ($aColor == 1) {
		        $aColor = 0;
		        $setColor = "#ccccff";
	        }
	        else {
		        $aColor = 1;
		        $setColor = "#FFFFFF";
	        }
                echo "<div class=\"row\" style=\"background-color: $setColor;\">";
                        ?>
                        <div class="six columns" style="margin-top: 1%; ">
                        <?PHP
		        $ActionText = $row['ActionText'];
		        $ActionID = $row['ActionID'];
		        $ActionFkJobID = $row['ActionFkJobID'];
		        $ActionFkClientID = $row['ActionFkClientID'];
		        $ActionRelToFkClientID = $row['ActionRelToFkClientID'];
		        $ActionDateSecs = $row['ActionDateSecs'];
		        $Ad = new DateTime("@$ActionDateSecs");
		        $config_time_zone = $_POST['user_time_zone'];
		        $zone_action = new DateTimeZone($config_time_zone);
		        $Ad->setTimezone($zone_action);
		        $ActionDateTime = $Ad->format(DATE_RFC1123);
		        $ActionTotalSecs = $row['ActionTotalSecs'];
		        $ActionTotalBreakSecs = $row['ActionTotalBreakSecs'];
		        $ActionTotalSecsMinusBreak = $ActionTotalSecs - $ActionTotalBreakSecs;
		        $ActionTotalTime = date("H:i:s", mktime(0,0,$ActionTotalSecsMinusBreak));
		        $ActionCumulativeTime = $ActionCumulativeTimeTotal;
		        $ActionCumulativeTimeTotal = $ActionTotalSecs - $ActionTotalBreakSecs + $ActionCumulativeTime;
		        $ActionCumulativeTimeTotalReadable = date("H:i:s", mktime(0,0,$ActionCumulativeTimeTotal));
		        $ActionCumulativeTimeTotalReadableDay = floor(($ActionCumulativeTimeTotal / 86400));
		        global $debug;
		        $debugMsg .= "\$ActionCumulativeTimeTotalReadableDay in While loop = $ActionCumulativeTimeTotalReadableDay<BR>";
		        include("config/tpl_bodystart.php");
		
		        $ActionFromFkUserID = $row['ActionFromFkUserID'];
		        $dbsUserFirstName = new dbSession();
		        $sql = "SELECT UserFirstname from user WHERE UserID = \"$ActionFromFkUserID\" LIMIT 1";
		        $ResultsUser = $dbs->getResult($sql);
		        $rowUser = $dbs->getArray($ResultsUser);
		        $UserFirstname = $rowUser['UserFirstname'];
		
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
		        echo "<TABLE class=\"hide_over_400\">";
                                /**echo "<TR class=\"hide_under_400\">";
                                        echo "<TD align=\"middle\" class=\"hide_under_400\"><B>Edit</B></TD>";
                                        echo "<TD align=\"middle\" class=\"hide_under_400\" width=\"$jd_col_2\"><B>JID-EHN</B></TD>";
                                        echo "<TD align=\"middle\" class=\"hide_under_400\" width=\"$jd_col_3\"><B>Date & Time Added</B></TD>";
                                        echo "<TD align=\"middle\" class=\"hide_under_400\"><B>By User</B></TD>";
                                echo "</TR class=\"hide_under_400\">"; */
		                echo "<TR class=\"hide_over_400\">";
		                        echo "<TD align=\"middle\" class=\"hide_over_400\">";
		                        edit_button($ActionID,$ClientID,$JobCardNumberFkJobID,$ActionRelToFkClientID,$ActionDateSecs,$StartTime); // Found in searchFunctions.php
		                        echo "</TD>";
		                        
		                        echo "<TD align=\"middle\" class=\"hide_over_400\">";
		                        if ($in_job_card == 1) {
                                                //client_button_with_start_time($JobFkClientID,'');
                                        }else{
                                                echo"   <TABLE>
                                                                <TR>
                                                                        <TD>";
                                                                        if ($JobCardNumberFkJobID == 0) {
                                                                                
                                                                        }else{
                                                                                echo "JID - JCN :";
                                                                        }
                                                                        
                                                                        echo "</TD>
                                                                        <TD>";
                                                                        if ($JobCardNumberFkJobID == 0) {
                                                                                
                                                                        }else{
                                                                                job_button($JobCardNumberFkJobID,'',$JobCardNumber,'');
                                                                        }
                                                                        echo "</TD>
                                                                </TR>
                                                        </TABLE>";
                                                // echo "<a class=\"linkPlainInWhiteAreas\" href=\"JobDetails.php?JobID=$JobCardNumberFkJobID\">$JobCardNumberFkJobID-$JobCardNumber</a>";
                                                
                                        }
                                        
                                        // echo"<BR>";
	                                echo "$ActionDateTime<BR>";
	                                echo "User : ";
	                                // echo "<a class=\"linkPlainInWhiteAreas\" href=\"userCard.php?ActionID=$ActionID&StartTime=$StartTime&id=$ActionFromFkUserID&ActionFkJobID=$JobCardNumberFkJobID&ActionRelToFkClientID=$ActionRelToFkClientID&name=$UserFirstname\">$UserFirstname</a><BR>";
	                                user_button($ActionFromFkUserID);
	                                echo "<BR>";
	                                echo "Total time : $ActionCumulativeTimeTotalReadableDay d $ActionTotalTime</TD>";
		                echo "</TR>";
                        echo "</TABLE>";
                        echo "<TABLE class=\"hide_under_400\">";
                                /**echo "<TR class=\"hide_under_400\">";
                                        echo "<TD align=\"middle\" class=\"hide_under_400\"><B>Edit</B></TD>";
                                        echo "<TD align=\"middle\" class=\"hide_under_400\" width=\"$jd_col_2\"><B>JID-EHN</B></TD>";
                                        echo "<TD align=\"middle\" class=\"hide_under_400\" width=\"$jd_col_3\"><B>Date & Time Added</B></TD>";
                                        echo "<TD align=\"middle\" class=\"hide_under_400\"><B>By User</B></TD>";
                                echo "</TR class=\"hide_under_400\">"; */
		                echo "<TR class=\"hide_under_400\">";
		                        echo "<TD align=\"middle\" width=\"10%\" class=\"hide_under_400\">";
		                        edit_button($ActionID,$ClientID,$JobCardNumberFkJobID,$ActionRelToFkClientID,$ActionDateSecs,$StartTime); // Found in searchFunctions.php
		                        echo "</TD>";
                                        // echo "<TD align=\"middle\"><a class=\"linkPlainInWhiteAreas\" href=\"JobDetails.php?JobID=$JobCardNumberFkJobID\">$JobCardNumberFkJobID-$JobCardNumber </TD>";
                                        if ($in_job_card == 1) {
                                                // echo "<TD align=\"middle\" class=\"hide_under_400\"><B>Client</B></TD>";
                                        }else{
                                                echo "<TD align=\"middle\" width=\"10%\">";
                                                if ($JobCardNumberFkJobID == 0) {
                                                                                
                                                }else{
                                                        job_button($JobCardNumberFkJobID,'',$JobCardNumber,'');
                                                }
                                                // echo "$JobCardNumberFkJobID-$JobCardNumber </TD>";
                                                echo "</TD>";
                                        }
                                        
	                                echo "<TD align=\"middle\" width=\"10%\">$ActionDateTime</TD>";
	                                echo "<TD align=\"middle\" width=\"10%\">";
	                                // echo "<a class=\"linkPlainInWhiteAreas\" href=\"userCard.php?ActionID=$ActionID&StartTime=$StartTime&id=$ActionFromFkUserID&ActionFkJobID=$JobCardNumberFkJobID&ActionRelToFkClientID=$ActionRelToFkClientID&name=$UserFirstname\">$UserFirstname</a>";
	                                user_button($ActionFromFkUserID);
	                                echo "</TD>";
	                                
		                echo "</TR>";
                        echo "</TABLE>";
                        ?>
                        </div>
                        <div class="six columns" style="margin-top: 1%;">
                        <?PHP
                        echo "<TABLE class=\"hide_over_400\">";
                                /** echo "<TR>";
                                        echo "<TD align=\"middle\" width=\"$jd_col_5\"><B>Total Time</B></TD>";
                                        echo "<TD align=\"middle\" width=\"$jd_col_6\"><B>Detail</B></TD>";
                                echo "</TR>"; */
		                echo "<TR class=\"hide_over_400\">";
		                        // echo "<TD width=\"$jd_col_6\"><PRE><TEXTAREA rows=\"5\" cols=\"$jd_cols_for_textarea\" name=\"ActionText\">$ActionText</TEXTAREA></PRE></TD>"; 
		                        echo "<TD align=\"middle\" name=\"ActionText\"><div style=\"white-space: pre-wrap;\">$ActionText</div></TD>";
		                echo "</TR>";
	                echo "</TABLE>";
                        echo "<TABLE class=\"hide_under_400\">";
                                /** echo "<TR>";
                                        echo "<TD align=\"middle\" width=\"$jd_col_5\"><B>Total Time</B></TD>";
                                        echo "<TD align=\"middle\" width=\"$jd_col_6\"><B>Detail</B></TD>";
                                echo "</TR>"; */
		                echo "<TR class=\"hide_under_400\">";
		                        echo "<TD align=\"middle\" width=\"$jd_col_5\">$ActionCumulativeTimeTotalReadableDay d $ActionTotalTime</TD>";
			                if ($show_client == 1) {
			                        echo "<TD align=\"middle\" bgcolor=\"$setColor\">";
			                        client_button_with_start_time($ActionFkClientID,'');
			                        echo "</TD>";
			                }
		                        // echo "<TD width=\"$jd_col_6\"><PRE><TEXTAREA rows=\"5\" cols=\"$jd_cols_for_textarea\" name=\"ActionText\">$ActionText</TEXTAREA></PRE></TD>"; 
		                        echo "<TD width=\"$jd_col_6\" name=\"ActionText\"><div style=\"white-space: pre-wrap;\">$ActionText</div></TD>";
		                echo "</TR>";
	                echo "</TABLE>";
                        ?>
                        </div>
                </div>
        <?PHP
        echo "<img src=\"images/spacer.gif\" height=\"1\" title=\"\">";
        }
        echo "<div>";	
}

function ShowActions_old(){
        $ClientID = $_POST['ClientID'];
        $JobID = $_POST['JobID'];
	
	//include("config/class_detect.php");
	$box_vars_jd = new detect;
	$box_vars_jd->my_box();
	$jd_col_2 = $box_vars_jd->jd_col_2;
	$jd_col_3 = $box_vars_jd->jd_col_3;
	$jd_col_5 = $box_vars_jd->jd_col_5;
	$jd_col_6 = $box_vars_jd->jd_col_6;
	$jd_cols_for_textarea = $box_vars_jd->jd_cols_for_textarea;
	?>
        <div class="container">
            <div class="row">
              <div class="one.column column" style="margin-top: 1%;">
                <?PHP
	        //**********************************************************************************************
	        //********************************************************************** DEBUG VARIABLES HERE - START
	        $turn_this_debug_on = 1;
                        if ($turn_this_debug_on == 1) {	
		        $debugMsg .= "Inside ShowActions() in JobDetails.php<BR>";
		        $debugMsg .= "\$ActionCumulativeTimeTotalReadableDay = $ActionCumulativeTimeTotalReadableDay<BR>";
		        $debugMsg .= "In the function ShowActions \$jd_col_2 = $jd_col_2<BR>";
		        $debugMsg .= "In the function ShowActions \$jd_col_3 = $jd_col_3<BR>";
		        $debugMsg .= "In the function ShowActions \$jd_col_5 = $jd_col_5<BR>";
		        $debugMsg .= "In the function ShowActions \$jd_col_6 = $jd_col_6<BR>";
		        // include("config/debug.php");
		        }
	        //********************************************************************** DEBUG VARIABLES HERE - END
	        //**********************************************************************************************
	
	        //**********************************************************************************************
                //***************************************************************** DEBUG VARIABLES HERE - START
                $turn_this_debug_on = 1;
                        if ($turn_this_debug_on == 1) {	
                                $debugMsg .= "Inside ShowActions() in JobDetails.php<BR>";
                                $debugMsg .= "\$id = $id<BR>";
                                $debugMsg .= "\$JobID = $JobID<BR>";
                                $debugMsg .= "\$UserID = $UserID<BR>";
                                $debugMsg .= "\$ClientID = $ClientID<BR>";
                                $debugMsg .= "\$AddAction = $AddAction<BR>";
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
	
	        // echo "* test2	\$SearchClientName= $SearchClientName<BR>";
	        // echo "* test3	\$id= $id<BR>";
	        $dbs = new dbSession();
	        // echo "* test3	\$dbs= $dbs<BR>";
	        $sql = "SELECT * from action WHERE ActionFkJobID = \"$JobID\" ORDER BY ActionDateSecs DESC";
	        /*
	        $categorysql = "SELECT pages_categories.category_id, categories.name 
	        FROM pages_categories, categories WHERE pages_categories.pages_id = 
	        '$row[id]' AND categories.id = pages_categories.category_id LIMIT 1";
	
	        $sql = "SELECT action.*, User.UserFirstname 
			        FROM action, User
			        WHERE action.ActionFkClientID = '$id'
			        ORDER BY ActionDateSecs DESC";
	        */
	        $Results = $dbs->getResult($sql);
	        //$row = $dbs->getArray($Results);
	        //$ActionText = $row['ActionText'];
	
	        $aColor = 1;
	
	        echo "<DIV align=\"center\">";
	        echo "<TABLE>";

	        echo "<TR>";
	        echo "<TD align=\"middle\"><B>Edit</B></TD>";
	        // echo "<TD align=\"middle\" width=\"$jd_col_2\"><B>JID-EHN</B></TD>";
	        echo "<TD align=\"middle\" width=\"$jd_col_3\"><B>Date & Time Added</B></TD>";
	        echo "<TD align=\"middle\"><B>By User</B></TD>";
	        echo "<TD align=\"middle\" width=\"$jd_col_5\"><B>Total Time</B></TD>";
	        echo "<TD align=\"middle\" width=\"$jd_col_6\"><B>Detail</B></TD>";
	        echo "</TR>";
		
		
	
	
	        while ($row = $dbs->getArray($Results)) {
			
			        $ActionText = $row['ActionText'];
			        $ActionID = $row['ActionID'];
			        $ActionFkJobID = $row['ActionFkJobID'];
			        $ActionRelToFkClientID = $row['ActionRelToFkClientID'];
			
			
			        $ActionDateSecs = $row['ActionDateSecs'];
			        //$ActionDateTime = date("H:i:s l d-M-Y",$ActionDateSecs);
			        $Ad = new DateTime("@$ActionDateSecs");
			        //$config_time_zone = $_POST['config_time_zone'];
			        $config_time_zone = $_POST['user_time_zone'];
			        $zone_action = new DateTimeZone($config_time_zone);
			        $Ad->setTimezone($zone_action);
			        $ActionDateTime = $Ad->format(DATE_RFC1123);
			
			
			        $ActionTotalSecs = $row['ActionTotalSecs'];
			        $ActionTotalBreakSecs = $row['ActionTotalBreakSecs'];
			        $ActionTotalSecsMinusBreak = $ActionTotalSecs - $ActionTotalBreakSecs;
			        // echo "\$ActionTotalBreakSecs = $ActionTotalBreakSecs";
			        $ActionTotalTime = date("H:i:s", mktime(0,0,$ActionTotalSecsMinusBreak));
			
			        $ActionCumulativeTime = $ActionCumulativeTimeTotal;
			        $ActionCumulativeTimeTotal = $ActionTotalSecs - $ActionTotalBreakSecs + $ActionCumulativeTime;
			        // echo "\$ActionCumulativeTimeTotal $ActionCumulativeTimeTotal = \$ActionTotalSecs $ActionTotalSecs - \$ActionTotalBreakSecs $ActionTotalBreakSecs + \$ActionCumulativeTime $ActionCumulativeTime <BR><BR>";
			        $ActionCumulativeTimeTotalReadable = date("H:i:s", mktime(0,0,$ActionCumulativeTimeTotal));
			        $ActionCumulativeTimeTotalReadableDay = floor(($ActionCumulativeTimeTotal / 86400));
			        // echo "\$ActionCumulativeTimeTotal = $ActionCumulativeTimeTotal";
			        // echo "\$ActionCumulativeTimeTotalReadable = $ActionCumulativeTimeTotalReadable";
			        global $debug;
			        $debugMsg .= "\$ActionCumulativeTimeTotalReadableDay in While loop = $ActionCumulativeTimeTotalReadableDay<BR>";
			        include("config/tpl_bodystart.php");
			
			        $ActionFromFkUserID = $row['ActionFromFkUserID'];
			        echo "\$ActionFromFkUserID = $ActionFromFkUserID <BR>";
			        $dbsUserFirstName = new dbSession();
			        $sql = "SELECT UserFirstname from user WHERE UserID = \"$ActionFromFkUserID\" LIMIT 1";
			        $ResultsUser = $dbs->getResult($sql);
			        $rowUser = $dbs->getArray($ResultsUser);
			        $UserFirstname = $rowUser['UserFirstname'];
			
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
			        echo "<TD align=\"middle\" bgcolor=\"$setColor\">";
			        // echo "<a class=\"linkPlainInWhiteAreas\" href=\"editAction.php?ActionID=$ActionID&StartTime=$StartTime&id=$id&ActionFkJobID=$JobCardNumberFkJobID&ActionRelToFkClientID=$ActionRelToFkClientID\">Edit</a>";
			        edit_button($ActionID,$ClientID,$JobCardNumberFkJobID,$ActionRelToFkClientID,$ActionDateSecs,$StartTime); // Found in searchFunctions.php
			        echo "</TD>";
			
			        // echo "<TD align=\"middle\" bgcolor=\"$setColor\" width=\"$jd_col_2\"><a class=\"linkPlainInWhiteAreas\" href=\"JobDetails.php?JobID=$JobCardNumberFkJobID\">$JobCardNumberFkJobID-$JobCardNumber </TD>";
			        echo "<TD align=\"middle\" bgcolor=\"$setColor\">$ActionDateTime</TD>";
			        //echo "<TD align=\"middle\" bgcolor=\"$setColor\"><a class=\"linkPlainInWhiteAreas\" href=\"userCard.php?ActionID=$ActionID&StartTime=$StartTime&id=$ActionFromFkUserID&ActionFkJobID=$JobCardNumberFkJobID&ActionRelToFkClientID=$ActionRelToFkClientID&name=$UserFirstname\">$UserFirstname</a></TD>";
			        echo "<TD align=\"middle\" bgcolor=\"$setColor\">"; 
			        user_button($ActionFromFkUserID); 
			        echo "</TD>";
			        echo "<TD align=\"middle\" bgcolor=\"$setColor\" width=\"$jd_col_5\">$ActionCumulativeTimeTotalReadableDay d $ActionTotalTime</TD>";
			        //echo "<TD bgcolor=\"$setColor\" width=\"50%\"><PRE>$ActionText</PRE></TD>";
			        //echo "<TD  bgcolor=\"$setColor\" width=\"50%\"><PRE>" . wordwrap($ActionText, 100, "<br />", true) . "</PRE></TD>";
			        echo "<TD  bgcolor=\"$setColor\" width=\"$jd_col_6\"><PRE><TEXTAREA rows=\"5\" cols=\"$jd_cols_for_textarea\" name=\"ActionText\">$ActionText</TEXTAREA></PRE></TD>";
			        echo "</TR>";
	        }	
	        echo "</TABLE>";
	        echo "</DIV>";
                ?>
              </div>
            </div>
          </div>
        <?PHP
	
}
function LocStartCall2(){
	echo "LocStartCall is working!<BR>";
	$_POST['StartTime'] = time();
}
function insert_action_at_end_of_call() {
	// Get data from the database where the name variable = ???
	$in_job_card = $_POST['in_job_card'];
	$ActionRelToFkClientID = $_POST['ActionRelToFkClientID'];
	$ColumnJobID = $_POST['ColumnJobID'];
	$JobID = $_POST['ColumnJobID'];
	$id = $_POST['id'];
	$ClientID = $_POST['ClientID'];
	// $AddAction = addslashes($AddAction);
	$AddAction = addslashes($_POST['AddAction']);
	$StartTime = $_POST['StartTime'];
	$ColumnUserName = $_POST['ColumnUserName'];
	$ReadableStartTime = $_POST['ReadableStartTime'];

        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {
                $debug = $_POST['debug'];
                $debugMsg .= "Inside LocInsertActionAtEndOfCall()<BR>";
                $debugMsg .= "\$ClientID = $ClientID<BR>";
                $debugMsg .= "ColumnJobID = $ColumnJobID<BR />\n<BR>";
                $debugMsg .= "ActionRelToFkClientID = $ActionRelToFkClientID<BR />\n<BR>";
                $debugMsg .= "-------------\$ActionRelToFkClientID = $ActionRelToFkClientID<BR>";
                $debugMsg .= "\$ColumnJobID = $ColumnJobID<BR>";
                $debugMsg .= "\$id = $id<BR>";
                $debugMsg .= "\$AddAction = $AddAction<BR>";
                $debugMsg .= "\$StartTime = $StartTime<BR>";
                $debugMsg .= "\$ColumnUserName = $ColumnUserName<BR><BR>";
                $debugMsg .= "---------------\$ReadableStartTime = $ReadableStartTime<BR>";
                include("config/debug.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
	
	$StartTime = $_POST['StartTime'];

	/*
	if ($_GET['StartTime'] == NULL) {
		$_GET['StartTime'] = 1;
	}

	if (($_POST['StartTime']) < ($_GET['StartTime'])) {
		$StartTime = $_GET['StartTime'];
	}else {
		$StartTime = $_POST['StartTime'];
	}
	**/

	//echo "<BR>\$StartTime = $StartTime";
	//echo "<BR>\$StartTime in editDeatils = " . $_GET['StartTime'];

	$ColumnUserName = $_POST['ColumnUserName'];
	$UserID = $_POST['UserID'];
	//echo "<BR>\$ColumnUserName = $ColumnUserName";
	//echo "<BR>\$ColumnUserName in LocInsertActionAtEndOfCall = " . $_POST['ColumnUserName'];

	$EndTime = time();
	
	$TotalTime = $EndTime - $StartTime;

	// New lines that should work on lindows systems as well as unix
	$TotalTimeHMS = date("H:i:s", $TotalTime);
	$ReadableStartTime = date("H:i:s", $StartTime);

	// echo "Total Time in h,m,s = $TotalTimeHMS<BR>";
	// echo "\$ColumnUserName = $ColumnUserName<BR>";
	
	echo "<DIV align=\"center\">";

	$id = $_GET['id'];
	//echo "<BR>\$id = $id";
	//echo "<BR>\$id in editDeatils = " . $_GET['id'];

	$AddAction = addslashes($_POST['AddAction']);
	//echo "<BR>\$AddAction = $AddAction";
	//echo "<BR>\$AddAction = " . $_POST['AddAction'];

	

	$dbs = new dbSession();
	// echo "* test3	\$dbs= $dbs<BR>";

		if ($AddAction != "Add current action or Event") {
			$sql = "INSERT INTO action (ActionText, ActionFkJobID, ActionFkClientID, ActionRelToFkClientID, ActionFromFkUserID, ActionDateSecs, ActionTotalSecs) VALUES ('$AddAction', '$ColumnJobID', '$ClientID', '$ActionRelToFkClientID', '$UserID', '$StartTime', '$TotalTime')";
			
				if ($dbs->getResult($sql)) {
					$msg = "Action Added.";
					//echo "<BR>\$StartTime = $ReadableStartTime";
					//echo "<BR>\$StartTime = $StartTime";
					//echo "<BR>\$StartTime post = " . $_POST['StartTime'];
					
					echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT>";
					//Main();
					//LocStartCall();
					//LocEndCallAddAction();
					//ShowActions();
					echo "<BR>";
					if ($in_job_card == 1) {
					        job_card();             // Found in JobDetails_functions.php
					        ?>
                                                <div class="container">
                                                    <div class="row">
                                                      <div class="one.column column" style="margin-top: 1%;">
                                                        <?PHP
                                                        LocEndCallAddAction();  
                                                                        // In action_functions.php
                                                        ?>
                                                      </div>
                                                    </div>
                                                  </div>
                                                <?PHP
		                                ShowActions(1);
					}else{
					        client_details();       // Fount in client_functions.php
					        ?>
                                                <div class="container">
                                                    <div class="row">
                                                      <div class="one.column column" style="margin-top: 1%;">
                                                        <?PHP
                                                        LocEndCallAddAction();  
                                                                        // In action_functions.php
                                                        ?>
                                                      </div>
                                                    </div>
                                                  </div>
                                                <?PHP
                                                ShowActions(0);          // In action_functions.php
					}
		                        
                                        
					
				} else {
					$msg = $dbs->printError();
					echo "<FONT SIZE=\"4\" COLOR=\"#CC0000\">$msg</FONT>";
					//Main();
					//LocStartCall();
					//LocEndCallAddAction();
					//ShowActions();
					echo "<BR>";
					client_details();       // Fount in client_functions.php
		                        ?>
                                        <div class="container">
                                            <div class="row">
                                              <div class="one.column column" style="margin-top: 1%;">
                                                <?PHP
                                                LocEndCallAddAction();  
                                                                // In action_functions.php
                                                ?>
                                              </div>
                                            </div>
                                          </div>
                                        <?PHP
                                        ShowActions();          // In action_functions.php
				}
		} else {
			echo "<BR><BR>Not a valid Action. Please type it again.";
		}
	echo "</DIV>";
	//include("footer001.php");
	/*
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
function DeleteActionQuestion() {
	global $ActionID;
	global $name;
	global $InsertIntoDatabase;
	global $ClientName;
	global $StartTime;
	global $ClientID;
	global $ActionFkJobID;
	
	$ActionID = $_POST['ActionID'];
	$StartTime = $_POST['StartTime'];
	$ClientID = $_POST['ClientID'];
	$ActionFkJobID = $_POST['ActionFkJobID'];
	$name = $_POST['name'];
	$InsertIntoDatabase = $_POST['InsertIntoDatabase'];
	$ClientName = $_POST['ClientName'];
	$ActionFkJobID = $_POST['ActionFkJobID'];

//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
				// $debug = $_POST['debug'];
				$debugMsg .= "<b>Inside DeleteActionQuestion()</b><BR>";
				$debugMsg .= "\$ActionID = $ActionID<BR>";
				$debugMsg .= "\$StartTime = $StartTime<BR>";
				$debugMsg .= "\$ClientID = $ClientID<BR>";
				$debugMsg .= "\$ActionFkJobID = $ActionFkJobID<BR>";
				include("config/debug.php");
				}
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************


	echo "<DIV align=\"center\">";
	echo " Are you sure you want to delete this Action?<BR><BR>";
	/**
	echo "<A href=\"editAction.php?ActionID=$ActionID&StartTime=$StartTime&ClientID=$ClientID\">No</A><BR><BR>";
	echo "<A href=\"editAction.php?OptionCatch=DeleteAction&ActionID=$ActionID&StartTime=$StartTime&ClientID=$ClientID&ActionFkJobID=$ActionFkJobID\">Yes</A><BR><BR>";
	*/
	
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"DeleteAction\">";
	echo "<input type=\"hidden\" name=\"ActionID\" value=\"$ActionID\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ClientID\">";
	echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"$ActionFkJobID\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" name=\"submit_delete_action\" value=\"Yes\">";
	echo "</form>";

	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"DeleteAction\">";
	echo "<input type=\"hidden\" name=\"ActionID\" value=\"$ActionID\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ClientID\">";
	echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"$ActionFkJobID\">";
	include("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" name=\"submit_delete_action\" value=\"No\">";
	echo "</form>";
	

	echo "</DIV>";

/**	?>
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
*/	
}
function DeleteAction() {
$submit_delete_action = $_POST['submit_delete_action'];
if ($submit_delete_action == "Yes") {
	$ActionID = $_POST['ActionID'];
	$StartTime = $_POST['StartTime'];
	$ClientID = $_POST['ClientID'];
	$ActionFkJobID = $_POST['ActionFkJobID'];

//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 1;
if ($turn_this_debug_on == 1) {
				// $debug = $_POST['debug'];
				$debugMsg .= "<b>Inside DeleteAction()</b><BR>";
				$debugMsg .= "\$ActionIDs = $ActionID<BR>";
				$debugMsg .= "\$StartTime = $StartTime<BR>";
				$debugMsg .= "\$ClientID = $ClientID<BR>";
				$debugMsg .= "\$ActionFkJobID = $ActionFkJobID<BR>";
				include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************
	
	echo "<DIV align=\"center\">";
	// echo "Delete Action";
	echo "</DIV>";
	
	$dbs = new dbSession();

	$sql = "DELETE FROM action WHERE ActionID = '$ActionID'";
	
				if ($dbs->getResult($sql)) {
					echo "<DIV align=\"center\">";
					$msg = "Action Deleted.<BR>";
					echo "<BR>$msg";
					echo "<BR>";
					// echo "<FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"\"><A class=\"linkPlainInWhiteAreas\" href=\"clientcard2.php?id=$ClientID\">Back to client card</A></FONT><BR><BR>";
					echo"Back to ";
					client_button_with_start_time($ClientID,'');
					if ($ActionFkJobID != 0){
					// echo "<FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"\"><A href=\"JobDetails.php?JobID=$ActionFkJobID\" class=\"linkPlainInWhiteAreas\">Back to Job card</A></FONT><BR><BR>";
					job_button($ActionFkJobID,'','','');
					}
					echo "</DIV>";
				} else {
					echo "<DIV align=\"center\">";
					$msg = $dbs->printError();
					echo "<BR>$msg";
					echo "<BR>";
					//echo "<FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"\"><A href=\"clientcard2.php?id=$ClientID\">Back to client card</A></FONT><BR><BR>";
					echo"Back to ";
					client_button_with_start_time($ClientID,'');
					
					if ($ActionFkJobID != 0){
					// echo "<FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"\"><A href=\"JobDetails.php?JobID=$ActionFkJobID\">Back to Job card</A></FONT><BR><BR>";
					job_button($ActionFkJobID,'','','');
					}
					echo "</DIV>";
				}
	// LocHtmlPageEnd();
	// exit();
	}else{
	        action_card();          // Founf in action_functions.php
	}
}

?>
