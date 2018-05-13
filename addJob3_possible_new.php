ƒadd<?PHP 

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


