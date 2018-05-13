<?PHP 

//***********************************************************************************************
//********************************************************************** TITLE - START
/**
*	file:	addJob3.php
*	auth:	Dion Patelis (owner)
*	desc;	Add a job
*	date:	28 Feb 2003 - Dion Patelis
*	last:	5th August 2008 - Dion Patelis
*/
//********************************************************************** TITLE - END
//**********************************************************************************************

//**********************************************************************************************
//********************************************************************** TITLE - START
// This must be included for the login to work on 
// each page.
//**********************************************************************
	//session_start();
//********************************************************************** TITLE - END
//**********************************************************************************************

//**********************************************************************************************
//********************************************************************** INCLUDES - START
		include("config/headAndBody001.php");
		$user_authenticated = $_POST['user_authenticated'];
	        $login_instance_token = $_POST['login_instance_token'];
	        $login_name = $_POST['name'];
		$login_pass = $_POST['pass'];
		$login_UserID = $POST['UserID'];
		include("config/config.php");
		include("config/tpl_bodystart.php");
		include("config/dbSession.class");
		include("config/standardPageBits.class");
		include("log_in_authentication_check.php");
		include("config/topIndex002.php");
		include("config/ssl.php");
		include("searchFunctions.php");
		include("config/class.child.php");
		// Not sure about this one
		//include("searchFunctions.php");
		include("config/ht.inc");
//********************************************************************** INCLUDES - END
//**********************************************************************************************

//**********************************************************************************************
//********************************************************************** LOGIN 1ST SECTION - START
// This works with the LOGIN 2ND SECTION to form the basis
// of the page. Inbetween the 2 LOGIN sections you may insert
// whatever HTML or Scripts you like and they should appear
// inside the display box on the web page.
//**********************************************************************

//--------------------------------------------------------
//-------------------------------------------- UN - START
// Check if a user has logged in properly
//--------------------------------------------
	/**
	if (isset($_POST['name'])){
		include("sessionIncForm002.php");
	}
	*/
	include("log_in_authentication_form.php");
//-------------------------------------------- UN - END
//--------------------------------------------------------

//--------------------------------------------------------
//-------------------------------------------- MAIN LOGIN OK - START
	//if($_SESSION['peopleLoggedIn'] == 1)  {

	?>

<div align="center">

	<?PHP
	//include ("logOffLink.php");
	?>

	<table id="Table_01" align="center" >

	
	<tr>
		<TD style="background:url(images/spacer.gif)" height="2"></TD>
	</tr>

	<tr>
		<td>
			
			<div class="myBox2" align="centre">

				<?PHP
//********************************************************************** LOGIN 1ST SECTION - END
//**********************************************************************************************

//**********************************************************************************************
//****************************************************************** CONNECT TO DATABASE - START
				$dbs = new dbSession();
//******************************************************************** CONNECT TO DATABASE - END
//**********************************************************************************************


				// START GLOBALS
					$SearchClientName = $_POST['SearchClientName'];
					$fieldName = $_POST['fieldName'];

				// END GLOBALS
				
				$debug = $_POST['debug'];
				$debugMsg .= "\$OptionCatcd = $OptionCatch<BR>";
				$debugMsg .= "This " . $_POST['OptionCatch'] . " is the \$OptionCatch<BR>";
				$debugMsg .= "This " . $_POST['JobParent'] . " is the \$JobParent<BR>";
				include("config/debug.php");

//**********************************************************************************************
//*************************************************************** SWITCHING POST AND GET - START	
if ($_POST['OptionCatch'] == "SearchClient6") {
	$_POST['OptionCatch'] = "SearchClient6";
}
//***************************************************************** SWITCHING POST AND GET - END
//**********************************************************************************************


//**********************************************************************************************
//****************************************************************************** CATCHES - START
				// If adduser is slected then goto the adduser function
				// $OptionCatch="AddUser";
					switch ($_POST['OptionCatch']) {
						case "insertJob";
							insertJob();
							break;
						case "SearchClient6";
							echo "I'm here";
							SearchClient6();
							break;
						case "SearchClient";
						if($SearchClientName==""){
							echo "<A href=\"index.php\">    Home</A>";
							echo "<BR><BR>";
							echo "You can not have a blank entry! Try again.";
						}
						else{
							SearchClient3();
						}
						exit();
						break;
					}
//******************************************************************************** CATCHES - END
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

//**********************************************************************************************
//************************************************************************** TIME ZONE 2 - START
	
	$config_time_zone = $_POST['config_time_zone'];
	//echo "\$config_time_zone = $config_time_zone <BR>";
	
	$MNTTZ = new DateTimeZone($config_time_zone);

	$dt = new DateTime();

	$dt->setTimezone($MNTTZ);

	$StartTime = $dt->format('U');
	$_POST['StartTime'] = $StartTime;
	
	$date = new DateTime("@$StartTime");
	$date->setTimezone($MNTTZ);
	
	// echo "  Current Start Time edg = ";
	// echo $date->format(DATE_RFC1123);
	//echo date("H:i:s", $StartTime);
	
//**************************************************************************** TIME ZONE 2 - END
//**********************************************************************************************

				// START MAIN
					//echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";
					
					echo "<DIV align=\"center\">";
					$message = "<BR><B>Add Job</B>";
					if (empty($AddMessageTermination)) {
						Main();
						//LocEndCallAddAction();
						//ShowActions();
					}

					//Show the clients info in a new window
					// LocHtmlPageEnd();

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

//-------------------------------------------- MAIN LOGIN OK - END
//--------------------------------------------------------

/**	}else{

//--------------------------------------------------------
//-------------------------------------------- MAIN LOGIN DENIED - START
include("config/headAndBody001.php");
?>
<BR>
<DIV align="center">

<?PHP
include("logIn.php");
include("footer001.php");
?>

</DIV>
</body>
</html>

<?PHP
} */
//-------------------------------------------- MAIN LOGIN DENIED - END
//--------------------------------------------------------
//********************************************************************** LOGIN 2ND SECTION- END
//**********************************************************************************************


//**********************************************************************************************
//********************************************************************** FUNCTIONS - START
Function Main() {
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
echo "<H1>Add Job</H1>";
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
				
	
	//	} else {
	//		echo "<BR><BR>Not a valid Job Card Number. Please type it again.";
	//	}
	
	echo "$msg<BR><BR>";
	$ClientID = $JobFkClientID;
	// echo " <a href=\"clientcard2.php?id=$ClientID&StartTime=$StartTime\">Back to Client Card</a> ";
	/**
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"AddUser\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Add User\">";
	echo "</form>";
	echo "<BR><BR>"; */
	
	

	LocAddActionWhenJobInserted();
	echo "<form method=\"post\" action=\"./whiteBoard.php\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"whiteBoard\">";
        include ("log_in_authentication_form_vars.php");
        echo "<input class=\"top_buttons\"  type=\"submit\" name=\"action\" value=\"Job Board 1\">";
	exit();
}

function LocAddActionWhenJobInserted() {
	// Get data from the database where the name variable = ????
	$id = $_POST['id'];
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
Function LocEndCallAddAction(){
	global $StartTime;
	global $UserID;
  	global $ColumnUserName;
  	global $name;
  	global $UserID;
  	global $id;
	global $ActionRelToFkClientID;
  	
  	global $debug;
  	$debugMsg .= "for LocEndCallAddAction<BR />\n<BR>";
	$debugMsg .= "\$UserID = $UserID<BR />\n<BR>";
	$debugMsg .= "\$id = $id<BR />\n<BR>";
	$debugMsg .= "\$StartTime = $StartTime<BR />\n<BR>";
	include("config/tpl_bodystart.php");
	
	if (empty($StartTime)) {
				$StartTime = time();
			}
			//else{
			//	LocEndCallAddAction();
			//}
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"0\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"StartCall\">";
	echo "<input type=\"submit\" tabindex=\"20\" name=\"Submit\" value=\"Restart Action timer\">";
	echo "  Current Start Time = ";
	echo date("H:i:s");
	echo "</form>";
	
	echo "Add Action................. ";

	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	
	echo "<select tabindex=\"21\" name=\"ColumnUserName\">";
	// echo "<OPTION value=\"\">";
	$dbs = new dbSession();
	$sql = "SELECT * from user WHERE UserActive = 1";
	$Results = $dbs->getResult($sql);
	
		while ($row = $dbs->getArray($Results)) {
			$optValue = $row['UserID'];				
			echo "<OPTION value=\"$row[UserID]\">$row[UserFirstname]";
			}
	echo "</SELECT>";	
	
	echo " <a href=\"addJob3.php?OptionCatch=AddJob&UserID=$id&UserLogin=$name&StartTime=$StartTime\"  tabindex=\"22\">JID - JCN</a> ";

	// echo "<form method=\"post\" action=\"$PHP_SELF\">";
	
	echo "<select tabindex=\"23\" name=\"ColumnJobID\">";
	echo "<OPTION value=\"\">";
	$dbs = new dbSession();
	$sql = "SELECT * from job WHERE JobToFkUserID = '$id' OR JobFromFkUserID = '$id' 
	ORDER BY JobCardNumber, JobID ASC";
	$Results = $dbs->getResult($sql);
	
		while ($row = $dbs->getArray($Results)) {
			$optValue = $row['JobID'];				
			echo "<OPTION value=\"$row[JobID]\">$row[JobID] - $row[JobCardNumber]";
			}
	echo "</SELECT>";
	
	echo "<TEXTAREA tabindex=\"24\" rows=\"5\" cols=\"45\" name=\"AddAction\" WRAP=\"virtual\"></TEXTAREA>";
	
	echo "<BR><BR>";
	
	// echo "Related to client  ";
	
	$dbs = new dbSession();
	$sql = "SELECT UserID, UserLogin from user WHERE UserID = '$JobToFkUserID' ORDER BY 'UserLogin' ASC";
	$Results = $dbs->getResult($sql);
	$row = $dbs->getArray($Results);
	$UserLogin = $row['UserLogin'];

	echo "<a href=\"clientcard2.php?OptionCatch=SearchClient5&StartTime=$StartTime&AddMessageTermination=1&id=$id\">Related to client </a> -   .$UserLogin.    .";

	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	//echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"EndCall\">";
	echo "<input  tabindex=\"27\" type=\"submit\" name=\"OptionCatch\" value=\"End Call\">";
	// echo "</form>";
	// echo "<BR>";
	
	
	// echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	// echo "<input type=\"hidden\" name=\"OptionCatch2\" value=\"InsertAction\">";
	echo "<input tabindex=\"28\" type=\"submit\" name=\"OptionCatch\" value=\"Add Untimed Action\">";
	echo "</form>";
	// echo "<BR><BR>";
}
function EditDetails() {
	// Edit the cards details
	global $id;
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
  	global $UserPhone2;
  	global $UserFax;
  	global $UserEmail;
  	global $UserUrl;
  	
  	$happy = 0;
  	Actua();

  	if ($happy = 1) {
		echo "<DIV align=\"center\">";
		//LocHtmlPageStart();
		
		$dbs = new dbSession();
		// $sql = "UPDATE Client SET (UserLogin, UserPassword, UserDate, UserFirstname, UserLastname, UserAddress1, UserAddress2, UserCity, UserState, UserPostcode, UserCountry, UserPhone1, UserPhone2, UserFax, UserEmail, UserUrl) = (\'$UserLogin\', \'reg\', \'\', \'0000-00-00\', \'0\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\') WHERE UserID = '$id'";
		
		// $sql = "UPDATE Client SET UserLogin = '$UserLogin' WHERE UserID = '$id'";
		
		/**
		$sql = "UPDATE User SET UserActive = '$UserActive', 
				UserLogin = '$UserLogin', UserPassword = '$UserPassword', 
				UserDate = '$UserDate', UserFirstname = '$UserFirstname', 
				UserLastname = '$UserLastname', UserAddress1 = '$UserAddress1', 
				UserAddress2 = '$UserAddress2', UserCity = '$UserCity', 
				UserState = '$UserState', UserPostcode = '$UserPostcode', 
				UserCountry = '$UserCountry', UserPhone2 = '$UserPhone2', 
				UserPhone1 = '$UserPhone1', UserFax = '$UserFax', UserEmail = '$UserEmail', 
				UserUrl = '$UserUrl' WHERE UserID = '$id'";
		*/
		
		/**
		$sql = "UPDATE User SET UserActive = '$UserActive', 
				UserLogin = '$UserLogin', UserPassword = '$UserPassword', 
				UserDate = '$UserDate', UserFirstname = '$UserFirstname', 
				UserLastname = '$UserLastname', UserAddress1 = '$UserAddress1', 
				UserAddress2 = '$UserAddress2', UserCity = '$UserCity', 
				UserState = '$UserState', UserPostcode = '$UserPostcode', 
				UserCountry = '$UserCountry', UserPhone2 = '$UserPhone2', 
				UserPhone1 = '$UserPhone1', UserFax = '$UserFax', UserEmail = '$UserEmail', 
				UserUrl = '$UserUrl' WHERE UserID = '$id'";
		*/

		$sql = "UPDATE user SET UserActive = '$UserActive', UserDate = '$UserDate', UserLogin = '$UserLogin', UserPassword = '$UserPassword', UserLastname = '$UserLastname', UserFirstname = '$UserFirstname', UserAddress1 = '$UserAddress1', UserAddress2 = '$UserAddress2', UserCity = '$UserCity', UserState = '$UserState', UserPostcode = '$UserPostcode', UserCountry = '$UserCountry', UserPhone1 = '$UserPhone1', UserPhone2 = '$UserPhone2', UserFax = '$UserFax', UserEmail = '$UserEmail', UserUrl = '$UserUrl' WHERE UserID = '$id'";

					if ($dbs->getResult($sql)) {
						$msg = "Card Edited.";
						echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT>";
						echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";
						main();
						LocEndCallAddAction();
						ShowActions();
						echo "<DIV align=\"center\">";
						echo "<BR>";
						echo "<FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"\"><A href=\"index.php\">Home</A></FONT>";
						echo "</DIV>";
					} else {
						$msg = $dbs->printError();
						echo "<BR>$msg";
					}
		echo "<BR>";
		echo "</DIV>";
  	}

}

Function ShowActions(){
	global $id;
	global $StartTime;
	
	// echo "* test2	\$SearchUserLogin= $SearchUserLogin<BR>";
	// echo "\$id= $id<BR>";
	$dbs = new dbSession();
	// echo "* test3	\$dbs= $dbs<BR>";
	$sql = "SELECT * from action WHERE ActionToFkUSerID  = \"$id\" OR 
	ActionFromFkUserID  = \"$id\" ORDER BY ActionDateSecs DESC LIMIT 0, 30";

	$Results = $dbs->getResult($sql);
	//$row = $dbs->getArray($Results);
	//$ActionText = $row['ActionText'];
	
	$aColor = 1;
	
	echo "<DIV align=\"center\">";
	echo "<TABLE>";

	echo "<TR>";
	echo "<TD align=\"middle\"><B>Edit</B></TD>";
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
			$ActionDateTime = date("H:i:s l d-M-Y",$ActionDateSecs);
			$ActionTotalSecs = $row['ActionTotalSecs'];
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
			echo "<TD align=\"middle\" bgcolor=\"$setColor\"><a href=\"editAction.php?ActionID=$ActionID&StartTime=$StartTime&id=$id&ActionFkJobID=$JobCardNumberFkJobID&ActionRelToFkClientID=$ActionRelToFkClientID\">Edit</a></TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\" width=\"8%\"><a href=\"JobDetails.php?JobID=$JobCardNumberFkJobID\">$JobCardNumberFkJobID-$JobCardNumber </TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\">$ActionDateTime</TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\"><a href=\"clientcard2.php?ActionID=$ActionID&StartTime=$StartTime&id=$ActionFkClientID&ActionFkJobID=$JobCardNumberFkJobID&ActionRelToFkClientID=$ActionRelToFkClientID&name=$ClientName\">$ClientName</a></TD>";
			echo "<TD align=\"middle\" bgcolor=\"$setColor\" width=\"15%\">$ActionTotalTime</TD>";
			echo "<TD bgcolor=\"$setColor\" width=\"50%\">$ActionText</TD>";
			echo "</TR>";
	}	
	echo "</TABLE>";
	echo "</DIV>";
}

function LocStartCall(){
	global $StartTime;
	// $StartTime = date ("h:i:s");
	$StartTime = time();
	// time();
	
	global $debug;
	$debugMsg .= "StartTime now = $StartTime<BR />\n<BR>";
	include("config/tpl_bodystart.php");
}

function SearchClient6() {
	// Get data from the database where the name variable = ????
	//global $SearchClientName;
	//global $StartTime;
	//global $fieldName;
	//global $id;
echo "Results is $Results<BR>";
//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
				$debug = $_POST['debug'];
				$debugMsg .= "Start Time = $StartTime<BR>";
				$debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
				$debugMsg .= "\$fieldName= $fieldName<BR>";
				include("config/debug.php");
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************
	
	// LocHtmlPageStart();
echo "Results is $Results<BR>";
	$dbs = new dbSession();
	$sql = "SELECT ClientID, ClientName, ClientContactName from client ORDER BY ClientName ASC";
	//$sql = "SELECT ClientID from Client where ClientName REGEXP \'f\'";
	$Results = $dbs->getResult($sql);
echo "Results is $Results<BR>";
//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
				$debug = $_POST['debug'];
				$debugMsg .= "Results is $Results<BR>";
				include("config/debug.php");
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************
	
	$StartTime = time();
	
		while ($row = $dbs->getArray($Results)) {
			$ClientID = $row['ClientID'];
			echo "  ClientName is ";
			$name = $row['ClientName'];
			$ClientContactName = $row['ClientContactName'];
			echo "<a href=\"addJob3.php?ClientName=$name&id=$id&ClientID=$ClientID&StartTime=$StartTime&name=$name\">$name</a>";
			// echo "  ClientContactName is";
			echo " $ClientContactName";
			echo "  ClientID is $ClientID";
			//<A href="page_01.htm">page_01.htm</A>
			//echo $row['ClientName'];
			echo "<BR>";
			
		/* Backup just incase I stuff up the above
		while ($row = $dbs->getArray($Results)) {
			echo "ClientID is ";
			echo $row['ClientID'];
			echo "  ClientName is ";
			echo $row['ClientName'];
			echo "<BR>";
		*/
		}
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"Nothing\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Start Over\">";
	echo "</form>";
	echo "<BR><BR>";
	
}
//********************************************************************** FUNCTIONS - END
//**********************************************************************************************


