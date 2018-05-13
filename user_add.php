<?PHP

//***********************************************************************************************
//********************************************************************************* TITLE - START
/**
*	file:	index.php
*	auth:	Dion Patelis (owner)
*	desc;	index files with basic search functions
*	date:	15 April 2003 - Dion Patelis
*	last:	17 July 2008 - Dion Patelis
*/
//********************************************************************************** TITLE - END
//**********************************************************************************************

//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
        /**
        $option_catch_test = $_POST['OptionCatch'];
        echo "<BR><BR><BR><BR>\$OptionCatch = $option_catch_test<BR>";
	*/
	
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************
/**
switch ($_POST['OptionCatch']) {
        case "jump_to_db";
                session_start();
	        session_unset();
                session_destroy();
	        break;
}
*/

//**********************************************************************************************
//******************************************************************************** TITLE - START
// This must be included for the login to work on 
// each page.
//**********************************************************************
	// session_start();
//********************************************************************************** TITLE - END
//**********************************************************************************************

//***********************************************************************************************
//********************************************************************************* TITLE - START
	
//********************************************************************************** TITLE - END
//**********************************************************************************************


//**********************************************************************************************
//********************************************************************** INCLUDES - START
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
		
		/**
		include("config/class_blank_logon.php");
		$blo_me = new blo; 
		$blo_me->check_blo_config(); 
		$config_blank_login = $blo_me->config_blank_login;
		//echo "\$config_blank_login = $config_blank_login";
		if ($config_blank_login == 0 || $_POST['top_index'] == 1 ) {			
			include("config/topIndex002.php");
		}
		*/
		include("log_in_authentication_check.php");
		include("config/topIndex002.php");
		// echo "<BR><BR>\$_POST['user_authenticated'] after topIndex002 =" . $_POST['user_authenticated'] . "<BR>";
		include("config/ssl.php");
		include("searchFunctions.php");		
		//include("config/class_time.php");
//********************************************************************** INCLUDES - END
//**********************************************************************************************


//**********************************************************************************************
//******************************************************************** LOGIN 1ST SECTION - START
// This works with the LOGIN 2ND SECTION to form the basis
// of the page. Inbetween the 2 LOGIN sections you may insert
// whatever HTML or Scripts you like and they should appear
// inside the display box on the web page.
//**********************************************************************

//--------------------------------------------------------
//-------------------------------------------- UN - START
// Check if a user has logged in properly
//--------------------------------------------
	//if (isset($_POST['name'])){
		// include("sessionIncForm002.php");
		//include ("logOffLink.php");
                include("log_in_authentication_form.php");
		
	//}
//-------------------------------------------- UN - END
//--------------------------------------------------------
// echo "<BR><BR>\$_POST['user_authenticated'] =" . $_POST['user_authenticated'] . "<BR>";
	//if($_POST['peopleLoggedIn'] == 1)  {
?>

<DIV align="center">

				<?PHP
				// include ("logOffLink.php");
				?>

	<table id="Table_01" align="center" >

	
	<TR>
		<TD style="background:url(images/spacer.gif)" height="2"></TD>
	</TR>
	
	
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
				$debugMsg .= "\$OptionCatch = $OptionCatch<BR>";
				$debugMsg .= "This " . $_POST['OptionCatch'] . " is the \$OptionCatch";
				include("config/debug.php");

				
//**********************************************************************************************
//********************************************************************** CATCHES - START
				// If adduser is slected then goto the adduser function
				// $OptionCatch="AddUser";
				switch ($_POST['OptionCatch']) {
					case "AddClient";
						AddClient();
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
					case "Main";
						Main();
						break;
					case "InsertClient";
						// echo "Inside InsertClient catch statment";
						InsertClient();
						break;
					case "StartCall";
						LocStartCall();
						break;
					case "EndCall";
						LocEndCall();
						break;
					case "SearchClient4";
						SearchClient4();
						break;
					case "show_users";
						show_user();
						include("logged_in_end_of_page.php");
						exit();
						break;
				}
//********************************************************************** CATCHES - END
//**********************************************************************************************

				// START MAIN
					//echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";

					if (empty($AddMessageTermination)) {
					        if ($user_authenticated == 1) {
					        ?>
                                                <div class="container_with_border">
                                                    <div class="row">
                                                      <div class="twelve columns" style="margin-top: 1%;">
                                                        <?PHP
						                AddClient();
						                echo "<BR><BR>";
					                ?>
                                                      </div>
                                                    </div>
                                                  </div>
                                                <?PHP
						}
					}

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
if ($config_blank_login == 0) {
	include("footer001.php");
}
?>


</DIV>
</body>
</html>







<?PHP
	/** }else{
?>








<?PHP
include("config/headAndBody001.php");
?>
<BR>
<DIV align="center">


<?PHP

//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
	$debug = $_POST['debug'];
	$debugMsg .= "<BR><BR>\$login_fail = $login_fail<BR>";
	$debugMsg .= "<BR><BR>\$login_name in index = $login_name<BR>";
	include("config/debug.php");
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************

$fail_delay_in_mins = 30;
include("class_time.php");
$time_1 = new time;
$time_1->first_fail($login_fail,$login_name);
$time_1->next_fails($login_fail,$fail_delay_in_mins,$login_name);
$time_1->three_fails($login_fail,$fail_delay_in_mins,$login_name);
$time_1->reset_fail($login_fail,$fail_delay_in_mins);
$lock_outs = $time_1->lock_out;
// echo "lock_out in index.php = $lock_outs<BR>";
$lock_out_message = $time_1->lock_out_message;
// echo $lock_out_message . " hey<BR><BR>";


if ($lock_outs == 1) {
	echo $lock_out_message;
} else {

	/**	
	if ($config_blank_login == 0 ) {	
		include("logIn.php");
	} elseif ($config_blank_login == 1 ) {
		include("logIn_no_words.php");
	} */
	/**
	include("logIn.php");

}



?>

<?PHP
if ($config_blank_login == 0) {
	include("footer001.php");
}
?>


</DIV>
</body>
</html>






<?PHP
}
*/
?>


<?PHP



//**********************************************************************************************
//********************************************************************** FUNCTIONS - START

function AddClient() {
        $dbs = new dbSession();
        $dbs->max_active_users_exceeded();
        $active_users = $dbs->active_users;
        $max_active_users_exceeded = $dbs->max_active_users_exceeded;
        $max_active_users_allowed = $dbs->max_active_users_allowed;
        //*************************************************************************************************
        //******************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {
                $debugMsg .= "<BR>********************************************************************<BR>";
                $debugMsg .= "Debug in AddClient() in user_add.php<BR>";
                $debugMsg .= "\$max_active_users_exceeded = $max_active_users_exceeded<BR>";
                $debugMsg .= "\$active_users = $active_users <BR>";
                $debugMsg .= "********************************************************************<BR>";
                include("config/debug.php");
        }
        //********************************************************************** DEBUG VARIABLES HERE - END
        //*************************************************************************************************
        if($active_users < $max_active_users_allowed){
	        ?>
	        <TABLE align="center">
	        <TR>
		        <TD>
	
	        <?PHP
	        $StartTime = time();
	        $debug = $_POST['debug'];
	        $debugMsg .= "inside addClient()<br></br>";
	        $debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
	        $debugMsg .= "\$fieldName= $fieldName<BR>";
	        include("config/debug.php");
	        $header_size = $_POST['header_size'];
	        echo "<H" . $header_size . ">Add User</H" . $header_size . ">";
	        echo "<form method=\"post\" action=\"$PHP_SELF\">";
	        echo "name...................... ";
	        echo "<input type=\"text\" name=\"InsertIntoDatabase\" value=\"\">";
	        echo "<BR>";
	
	        echo "Add Password......... ";
	        echo "<input type=\"text\" name=\"ClientContactName\" value=\"\">";
	        echo "<BR>";

	        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"InsertClient\">";
	        echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	        include ("log_in_authentication_form_vars.php");
	        echo "<input type=\"submit\" name=\"Submit\" value=\"Add User\">";
	        echo "</form>";
	
	
	        ?>
		        </TD>
	        </TR>
	        </TABLE>
	        <?PHP
	}else{
	        echo    "You are only allowed " . $max_active_users_allowed . " active users at one time.<BR><BR>
	                Please purchase an upgrade here or disable a user in order to add another.<BR>";
	                show_user();
	}
}

// Page 2 in Adding a new message
Function Main() {
	$debug = $_POST['debug'];
	$debugMsg .= "Start Time = $StartTime<BR>";
	include("config/debug.php");
	
	echo "<font class=\"generalFontOnWhite\">";
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<span class=\"generalFontOnWhite\">Search ";

	echo "<select tabindex=\"3\" name=\"fieldName\">";
	// echo "<OPTION value=\"\">";
	echo "<OPTION value=\"ClientID\">ClientID";
	echo "<OPTION value=\"ClientName\" SELECTED >ClientName";
	echo "<OPTION value=\"ClientContactName\">ClientContactName";
	echo "<OPTION value=\"ClientName2\">ClientName2";
	echo "<OPTION value=\"ClientType\">ClientType";
	echo "<OPTION value=\"ClientDate\">ClientDate";
	echo "<OPTION value=\"ClientPriority\">ClientPriority";
	echo "<OPTION value=\"ClientAddress1\">ClientAddress1";
	echo "<OPTION value=\"ClientAddress2\">ClientAddress2";
	echo "<OPTION value=\"ClientCity\">ClientCity";
	echo "<OPTION value=\"ClientState\">ClientState";
	echo "<OPTION value=\"ClientPostcode\">ClientPostcode";
	echo "<OPTION value=\"ClientPhone1\">ClientPhone1";
	echo "<OPTION value=\"ClientPhone12\">ClientPhone2";
	echo "<OPTION value=\"ClientFax\">ClientFax";
	echo "<OPTION value=\"ClientEmail\">ClientEmail";
	echo "<OPTION value=\"ClientUrl\">ClientUrl";
	echo "<OPTION value=\"ClientCity\">ClientCity";
	echo "</SELECT>";
	// Client Name 
	
	//echo "  (ie : 'trac' in the word 'Contractors')";
	echo "for   <input tabindex=\"1\" type=\"text\" name=\"SearchClientName\" value=\"\">";
	// echo "<BR><BR>";

	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"SearchClient\">";
	echo "<input tabindex=\"2\" type=\"submit\" name=\"Submit\" value=\"Go\">";
	echo "</form>";
	// echo "</span>";
	// echo "<BR>";
	
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"AddClient\">";
	echo "<input tabindex=\"2\" type=\"submit\" name=\"Submit\" value=\"Add Client\">";
	echo "</form>";

}

function InsertClient() {
	// Get data from the database where the name variable = ????
//*************************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
       $debug = $_POST['debug'];
        $debugMsg .= "<BR>********************************************************************<BR>";
        $debugMsg .= "Debug in InsertClient() in index.php<BR>";
        $debugMsg .= "\$_POST['name'] =" . $_POST['name'] . "<BR>";
        $debugMsg .= "\$_POST['pass'] = " . $_POST['pass'] . "<BR>";
        $debugMsg .= "\$peopleName = $peopleName<BR>";
        $debugMsg .= "\$peoplePwd = $peoplePwd<BR>";
        $debugMsg .= "\$UserID = $UserID<BR>";
        $debugMsg .= "\$user_authenticated = $user_authenticated<BR>";
        $debugMsg .= "\$_POST['user_authenticated'] = " . $_POST['user_authenticated'] . "<BR>";
        $debugMsg .= "\$tab_cluster = $tab_cluster<BR>";
        $debugMsg .= "\$_POST['login_instance_token'] = " . $_POST['login_instance_token'] . "<BR>"; 
        $debugMsg .= "\$login_instance_token = " . $login_instance_token . "<BR>";
        $debugMsg .= "\$_POST['User_db_token'] = " . $_POST['User_db_token'] . "<BR>"; 
        $debugMsg .= "\$User_db_token = " . $User_db_token . "<BR>";
        $debugMsg .= "\$login_name = " . $login_name . "<BR>";
        $debugMsg .= "********************************************************************<BR>";
        include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************
                
//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {				
        $debug = $_POST['debug'];
        $debugMsg .= "<b>Inside InsertClient()</b><BR>";
        $debugMsg .= "This " . $_POST['StartTime'] . " is the \$StartTime in index.php<BR><BR>";
        include("config/debug.php");
}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************
	
	// echo"Table Data<BR>";
	echo "<div align=\"center\">";
	$InsertIntoDatabase = $_POST['InsertIntoDatabase'];
	//echo "<br></br>\$InsertIntoDatabase = $InsertIntoDatabase";

	$ClientContactName = $_POST['ClientContactName'];
	//echo "<br></br>\$ClientContactName = $ClientContactName";

	$ClientPhone1 = $_POST['ClientPhone1'];
	//echo "<br></br>\$ClientPhone1 = $ClientPhone1>";

	$ClientInsertDate = $_POST['StartTime'];
	$StartTime = time();

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {				
        $debug = $_POST['debug'];
        $debugMsg .= "<b>Inside InsertClient()</b><BR>";
        $debugMsg .= "This " . $ClientInsertDate . " is the \$ClientInsertDate in index.php<BR><BR>";
        include("config/debug.php");
}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************

	
	$dbs = new dbSession();

		if ($InsertIntoDatabase != "") {
			$sql = "INSERT INTO user (user_time_zone, UserActive, UserDate, UserLogin, UserPassword, UserFirstname) VALUES ('Australia/Sydney', '1', '$StartTime', '$InsertIntoDatabase', '$ClientContactName', '$InsertIntoDatabase')";
			
				if ($dbs->getResult($sql)) {
					$msg = "User Added.";
					echo "$msg<BR>";
					$dbs = new dbSession();
					$sql = "SELECT UserID, UserLogin from user WHERE UserLogin = \"$InsertIntoDatabase\"";
					$Results = $dbs->getResult($sql);
					$row = $dbs->getArray($Results);
					$UniqueIdentifier = $row['UserID'];
					$UserLogin = $row['UserLogin'];
					$GotoClientCard = "1";
					/**
					echo "Goto card for ";
					        echo "<form method=\"post\" action=\"./user_card_with_time_limits_ajax.php\">";
                                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $UniqueIdentifier . "\">";
                                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                                include("log_in_authentication_form_vars.php");
                                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"" . $UserLogin . "\">";
                                                echo "</form>";
					echo "<BR>"; */
					user_button($UniqueIdentifier);
					echo "<BR><BR><form method=\"post\" action=\"./user_add.php\">";
                                        include ("log_in_authentication_form_vars.php");
                                        echo "<input class=\"top_buttons\" type=\"submit\" name=\"action\" value=\"Add another User\">";
                                        echo "</form>";
				} else {
					$msg = $dbs->printError();
					echo "$msg<BR>";
				}
		} else {
			echo "<BR><BR>Not a valid name. Please type it again.";
		}

?>
			</FONT>

			</div>
	
		</td>
	</tr>

</table>

<BR>

<?PHP
if ($config_blank_login == 0) {
	include("footer001.php");
}
?>

</DIV>
</body>
</html>
<?PHP
exit;

}
/**
function show_users() {
	// Get data from the database where the name variable = ????
//*************************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
       $debug = $_POST['debug'];
        $debugMsg .= "<BR>********************************************************************<BR>";
        $debugMsg .= "Debug in show_userst() in user_add.php<BR>";
        $debugMsg .= "\$_POST['name'] =" . $_POST['name'] . "<BR>";
        $debugMsg .= "\$_POST['pass'] = " . $_POST['pass'] . "<BR>";
        $debugMsg .= "\$peopleName = $peopleName<BR>";
        $debugMsg .= "\$peoplePwd = $peoplePwd<BR>";
        $debugMsg .= "\$UserID = $UserID<BR>";
        $debugMsg .= "\$user_authenticated = $user_authenticated<BR>";
        $debugMsg .= "\$_POST['user_authenticated'] = " . $_POST['user_authenticated'] . "<BR>";
        $debugMsg .= "\$tab_cluster = $tab_cluster<BR>";
        $debugMsg .= "\$_POST['login_instance_token'] = " . $_POST['login_instance_token'] . "<BR>"; 
        $debugMsg .= "\$login_instance_token = " . $login_instance_token . "<BR>";
        $debugMsg .= "\$_POST['User_db_token'] = " . $_POST['User_db_token'] . "<BR>"; 
        $debugMsg .= "\$User_db_token = " . $User_db_token . "<BR>";
        $debugMsg .= "\$login_name = " . $login_name . "<BR>";
        $debugMsg .= "********************************************************************<BR>";
        include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************
                
//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {				
				$debug = $_POST['debug'];
				$debugMsg .= "<b>Inside InsertClient()</b><BR>";
				$debugMsg .= "This " . $_POST['StartTime'] . " is the \$StartTime in index.php<BR><BR>";
				include("config/debug.php");
				}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************
	
	// echo"Table Data<BR>";
	echo "<div align=\"center\">";
	$InsertIntoDatabase = $_POST['InsertIntoDatabase'];
	//echo "<br></br>\$InsertIntoDatabase = $InsertIntoDatabase";

	$ClientContactName = $_POST['ClientContactName'];
	//echo "<br></br>\$ClientContactName = $ClientContactName";

	$ClientPhone1 = $_POST['ClientPhone1'];
	//echo "<br></br>\$ClientPhone1 = $ClientPhone1>";

	$ClientInsertDate = $_POST['StartTime'];
	$StartTime = time();

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {				
        $debug = $_POST['debug'];
        $debugMsg .= "<b>Inside InsertClient()</b><BR>";
        $debugMsg .= "This " . $ClientInsertDate . " is the \$ClientInsertDate in index.php<BR><BR>";
        include("config/debug.php");
}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************

	
	$dbs = new dbSession();


					$msg = "User List.";
					echo "$msg<BR>";
					$dbs = new dbSession();
					$sql = "SELECT UserID, UserLogin from user WHERE UserLogin = \"$InsertIntoDatabase\"";
					while ($Results = $dbs->getResult($sql)) {
					        $row = $dbs->getArray($Results);
					        $UniqueIdentifier = $row['UserID'];
					        $UserLogin = $row['UserLogin'];
					        $GotoClientCard = "1";
					        user_button($UniqueIdentifier);
					}


?>
			</FONT>

			</div>
	
		</td>
	</tr>

</table>

<BR>

<?PHP
if ($config_blank_login == 0) {
	include("footer001.php");
}
?>

</DIV>
</body>
</html>
<?PHP
exit;

} */

//****************************************************************************** FUNCTIONS - END
//**********************************************************************************************

?>
