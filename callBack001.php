<?PHP
	session_start();
	
	// echo $_POST['name'] . " name POST<BR>";
	// echo $_SESSION['login'] . " login Session<BR>";
	// echo $_SESSION['ta'] . " ta Session<BR>";
	//$_SESSION['ta'] = 3;
	//echo session_is_registered('login') . " = session_is_registered";

	// START INCLUDES
	// include("config/headAndBody001.php");
	include("config/config.php");
	include("config/tpl_bodystart.php");
	include("config/dbSession.class");
	//include("config/topIndex.php");
	include("config/topIndex002.php");
	// END INCLUDES

	

	if (isset($_POST['name'])){
		include("sessionIncForm002.php");
	}

	if($_SESSION['peopleLoggedIn'] == 1)  {
?>

<?PHP
include("config/headAndBody001.php");
?>

<DIV align="center">


	<table id="Table_01" align="center" >

	
	<TR>
		<TD style="background:url(images/spacer.gif)" height="2"></TD>
	</TR>
	
	
	<tr>
		<td>
			
			<div class="myBox2" align="centre">
			
			
			<BR>

			<img src="images/spacer.gif" width="300" height="0" alt="">
			<!-- <FONT  style="position: absolute; top:<?PHP echo "$line001DistanceFromTop"; ?>px;" FACE="Arial" SIZE="" COLOR="black"> -->

			<FONT FACE="Arial" SIZE="" COLOR="black">
			
			<BR>you have logged in<BR>


				<?PHP



				echo "<A href=\"sessionLogout.php\">LogOff </A>";


				// START CONNECT TO DATABASE
				$dbs = new dbSession();
				// END CONNECT TO DATABASE


				// START GLOBALS
				global $firstName;
				global $surname;
				global $email;
				global $mobile;
				global $phone;
				global $fax;
				global $jobTimeDayA;
				global $jobTimeMonthA;
				global $jobTimeYearA;
				global $jobTimeDayB;
				global $jobTimeMonthB;
				global $jobTimeYearB;
				global $otherQuestions;
				// END GLOBALS

				// echo "\$OptionCatch = $OptionCatch<BR><BR>";
				// echo "This " . $_POST['OptionCatch'] . " is the \$OptionCatch<BR><BR>";

				// START CATCHES
				// If adduser is slected then goto the adduser function
				// $OptionCatch="AddUser";
				switch ($_POST['OptionCatch']) {
					case "email";
						locEmail();
						break;	
						case "";
						SearchClient3();
						break;
				}
				// END CATCHES

				// START MAIN
				echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";

				if (empty($AddMessageTermination)) {
					// LocHtmlPageStart();
					// Main();
				}

				//Show the clients info in a new window
				// LocHtmlPageEnd();

				// END MAIN

				?>

			</FONT>

			
			</div>
	
		</td>
	</tr>
	<TR>
		<TD>
		
		</TD>
	</TR>
</table>

<BR>



<?PHP
include("footer001.php");
?>


</DIV>
</body>
</html>

<?PHP
	}else{
?>

<?PHP
include("config/headAndBody001.php");
?>
<BR>
<DIV align="center">


<?PHP

include("logIn.php");



?>

<?PHP
include("footer001.php");
?>


</DIV>
</body>
</html>






<?PHP
}
?>


<?PHP



// START FUNCTIONS

function LocHtmlPageEnd() {
	global $ProgramName;
	global $ProgramTitle;
	global $StartTime;
	global $id;
	global $name;
	global $message;
	global $JobID;
	global $ClientID;
	
	if (empty($id)) {
		$id = $ClientID;
	}
		
	echo "<DIV align=\"center\">";
	// echo"<html>\n\n";
	// echo"	<head>\n";
	// echo"		<title>$ProgramTitle</title>\n";
	// echo"	</head>\n";
	// echo"	<body bgcolor=\"White\">\n\n";
	// echo "$ProgramName";
		echo " | <A href=\"index.php?OptionCatch=AddClient&AddMessageTermination=1&StartTime=$StartTime\"><FONT TABINDEX=\"100\" FACE=\"arial\" COLOR=\"\">Add Client</FONT></A>";
	echo " | <a href=\"actionStats.php\" tabindex=\"101\">   Action Statistics</a>";
	echo " | <a href=\"addJob3.php?OptionCatch=AddJob&StartTime=$StartTime&ClientID=$id&ClientName=$name\" tabindex=\"102\">Add Job</a> ";
	echo " | <a href=\"addReminder.php?JobID=$JobID&StartTime=$StartTime&ClientID=$id&ClientName=$name\" tabindex=\"103\">Add Reminder</a> ";
	echo " | <a href=\"calender.php?AddMessageTermination=&JobID=$JobID&StartTime=$StartTime&ClientID=$id&ClientName=$name\" tabindex=\"104\">Calender</a> ";
	echo " | <a href=\"userSearch.php\" tabindex=\"105\">   User Search</a>";
	echo " | <a href=\"jobManager.php\" tabindex=\"106\">   Job Manager</a>  ";
	echo " | <a href=\"whiteBoard.php?AddMessageTermination=\" tabindex=\"107\">   White Board</a>  ";
	echo " | <a href=\"http://barry.computable.com.au/cod/\" tabindex=\"108\">   COD</a>  ";
	echo " | <a href=\"http://barry.computable.com.au/sd/\" tabindex=\"109\">   Software Demos</a> | ";
	/**
	echo " | <A href=\"index.php\"><FONT TABINDEX=\"80\" FACE=\"arial\" SIZE=\"4\" COLOR=\"\">Home</FONT></A>";
	echo " | <a href=\"actionStats.php\" tabindex=\"81\">   Action Statistics</a>";
	echo " | <a href=\"addJob3.php?OptionCatch=AddJob&StartTime=$StartTime&ClientID=$id&ClientName=$name\" tabindex=\"82\">Add Job</a> ";
	echo " | <a href=\"addReminder.php?JobID=$JobID&StartTime=$StartTime&ClientID=$id&ClientName=$name\" tabindex=\"83\">Add Reminder</a> ";
	echo " | <a href=\"calender.php?AddMessageTermination=&JobID=$JobID&StartTime=$StartTime&ClientID=$id&ClientName=$name\" tabindex=\"84\">Calender</a> ";
	echo " | <a href=\"userSearch.php\" tabindex=\"85\">   User Search</a>";
	echo " | <a href=\"jobManager.php\" tabindex=\"86\">   Job Manager</a>  ";
	echo " | <a href=\"whiteBoard.php?AddMessageTermination=\" tabindex=\"87\">   White Board</a>  ";
	echo " | <a href=\"http://barry.computable.com.au/cod/\" tabindex=\"88\">   COD</a>  ";
	echo " | <a href=\"http://barry.computable.com.au/sd/\" tabindex=\"89\">   Software Demos</a> | ";
	*/
	/**
	switch ($message) {
		case "EditDetails";
			EditDetails();
			break;
	}
	*/
	// echo "$message";
	echo "</DIV>";
	echo"	</body>\n";
	echo"</html>\n";
	
}

function SearchClient3() {

	// Get data from the database where the name variable = ????
	global $SearchClientName;
	global $StartTime;
	global $fieldName;
	global $message;
		
	echo "<DIV align=\"center\">";
	
	global $debug;
	$debugMsg .= "Start Time = $StartTime<BR>";
	$debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
	$debugMsg .= "\$fieldName= $fieldName<BR>";
	include("config/tpl_bodystart.php");
	
	$message = "";
	//LocHtmlPageStart();
	echo "</DIV><BR>";
	$dbs = new dbSession();
	$sql = "SELECT Client.ClientID, Client.ClientName, Client.ClientContactName, Client.ClientPhone1, Client.ClientPhone2 from Client WHERE ClientCallBack = 1 ORDER BY Client.ClientCallOrder DESC LIMIT 0, 22";

	// $query = "SELECT family.Position, food.Meal " . "FROM family, food " . "WHERE family.Position = food.Position";

	//$sql = "SELECT ClientID from Client where ClientName REGEXP \'f\'";
	$Results = $dbs->getResult($sql);
	$debugMsg .= "Results is $Results<BR>";
	$StartTime = time();
	
		while ($row = $dbs->getArray($Results)) {
			$UniqueIdentifier = $row['ClientID'];
			echo "  ClientName is ";
			$name = $row['ClientName'];
			$ClientPhone1 = $row['ClientPhone1'];
			$ClientPhone2 = $row['ClientPhone2'];
			$ClientContactName = $row['ClientContactName'];
			echo "<a href=\"clientcard2.php?id=$UniqueIdentifier&StartTime=$StartTime&name=$name&callOrder=1\">$name</a>";
			echo " $ClientContactName";
			// echo "  ClientID is $UniqueIdentifier";
			echo "  Ph :  $ClientPhone1 or $ClientPhone2";
			echo "<BR>";
		}
	echo "<DIV align=\"center\"><BR>";
	//LocHtmlPageEnd();
	echo "<BR><BR>";
	echo "</DIV>";
}





function locEmail() {

global $firstName;
global $surname;
global $email;
global $mobile;
global $phone;
global $fax;
global $jobTimeDayA;
global $jobTimeMonthA;
global $jobTimeYearA;
global $jobTimeDayB;
global $jobTimeMonthB;
global $jobTimeYearB;
global $otherQuestions;


echo "<BR><BR>";

//Email :  <a tabindex=\"1\" href=\"mailto:$email\">$email</a>;

$to      = 'dion@7rocks.com';
$subject = 'Email Enquiry from Website from $firstName $surname';
$message = "This is a web enquiry message from
			the7rocks website enquiry form.';

			Enquiry details:
			Name :  $firstName $surname " . $_POST['firstName'] . " " . $_POST['surname'] . "
			Email :  $email " . $_POST['email'] . "
			Mobile : $mobile " . $_POST['mobile'] . "
			Phone : $phone " . $_POST['phone'] . "
			Fax : $fax " . $_POST['fax'] . "
			Message ; 
			$otherQuestions " . $_POST['otherQuestions'] . "
			";
$headers = 'From: enquiryPage@' . $_SERVER['SERVER_NAME'] . "\r\n" .
    'Reply-To: webmaster@' . $_SERVER['SERVER_NAME'] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


if (mail($to, $subject, $message, $headers)) {
	echo "<!-- <A class\"color: \#000000;\ A:visited\(color: \#000000\)\"SIZE=2\" href=\"index.php\">Home</A> -->
			
			
			<TABLE ID=\"Table_02\" width=\"684\" height=\"\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
				<TR>
					<TD style=\"background:url(images/BackgroundWhiteFade006.jpg);\" 
						BACKGROUND=\"\" width=\"684\" height=\"450\" alt=\"\" align=\"center\" COLOR=\"black\">
						Thankyou, Your enquiry has been successfully sent!!<BR>
						<BR><BR>
					</TD>
				</TR>

			</TABLE>
			
			";

	
} else {
	echo "
	
	<TABLE ID=\"Table_02\" width=\"684\" height=\"\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
				<TR>
					<TD class=\"linkC\" style=\"background:url(images/BackgroundWhiteFade006.jpg);\" 
						BACKGROUND=\"\" width=\"684\" height=\"450\" alt=\"\" align=\"center\" COLOR=\"black\">
						
						<p> Message Delivery failed.... please contact the <a href=\"mailto:dion@7rocks.com\">webmaster<img src=\"images/envelope.gif\" alt=\"\" border=\"0\"></a></p><BR>

					</TD>
				</TR>

			</TABLE>
	
	";
}


}

function locEmailForm() {

?>

<TABLE ID="Table_02" width="684" height="" border="0" cellpadding="0" cellspacing="0">
<TR>
	<TD style="background:url(images/BackgroundWhiteFade006.jpg);" 
		BACKGROUND="" width="684" height="450" alt="" align="center" COLOR="black">
		
		<FONT FACE="Arial" STYLE="font-size: 11px;" COLOR="">

			<FORM METHOD=POST ACTION="">
			
				<TABLE align="center">
				<TR>
					<TD align="center" colspan="2" FACE="Arial" CLASS="headerA" COLOR=""><B><I>Email Enquiry Form</I></B></TD>
				</TR>
				<TR>
					<TD FACE="Arial" CLASS="mainFontA" COLOR="">First Name</TD>
					<TD><INPUT TYPE="text" NAME="firstName" tabindex="1"></TD>
				</TR>
				<TR>
					<TD FACE="Arial" CLASS="mainFontA" COLOR="">Surname</TD>
					<TD><INPUT TYPE="text" NAME="surname" tabindex="2"></TD>
				</TR>
				<TR>
					<TD FACE="Arial" CLASS="mainFontA" COLOR="">Email</TD>
					<TD><INPUT TYPE="text" NAME="email" tabindex="3"></TD>
				</TR>
				<TR>
					<TD FACE="Arial" CLASS="mainFontA" COLOR="">Mobile</TD>
					<TD><INPUT TYPE="text" NAME="mobile" tabindex="4"></TD>
				</TR>
				<TR>
					<TD FACE="Arial" CLASS="mainFontA" COLOR="">Phone</TD>
					<TD><INPUT TYPE="text" NAME="phone" tabindex="5"></TD>
				</TR>
				<TR>
					<TD FACE="Arial" CLASS="mainFontA" COLOR="">Fax</TD>
					<TD><INPUT TYPE="text" NAME="fax" tabindex="6"></TD>
				</TR>
				<TR>
					<TD FACE="Arial" CLASS="mainFontA" COLOR="">Message</TD>
					<TD><TEXTAREA NAME="otherQuestions" ROWS="3" COLS="20" tabindex="13"></TEXTAREA></TD>
				</TR>
				<TR>
					<TD align="center" colspan="2" FACE="Arial" CLASS="mainFontA" COLOR="">
					<INPUT type="hidden" name="OptionCatch" value="email">
					<INPUT NAME="submit" TYPE="submit" VALUE="Email Query"  tabindex="14" FACE="Arial" CLASS="mainFontA" COLOR=""></TD>
				</TR>
				</TABLE>

			</FORM>
		
		</FONT>
	</TD>
</TR>

</TABLE>
<?PHP
}

// END FUNCTIONS

?>
