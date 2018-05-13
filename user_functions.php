<?PHP
function add_user() {
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
	        echo "<form method=\"post\" action=\"./index.php\">";
	        echo "name...................... ";
	        echo "<input type=\"text\" name=\"InsertIntoDatabase\" value=\"\">";
	        echo "<BR>";
	
	        echo "Add Password......... ";
	        echo "<input type=\"text\" name=\"ClientContactName\" value=\"\">";
	        echo "<BR>";

	        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"insert_user\">";
	        echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	        include ("log_in_authentication_form_vars.php");
	        echo "<input type=\"submit\" name=\"Submit\" value=\"Add User\">";
	        echo "</form>";
	
	
	        ?>
		        </TD>
	        </TR>
	        </TABLE>
	        <BR><BR>
	        <?PHP
	}else{
	        echo    "You are only allowed " . $max_active_users_allowed . " active users at one time.<BR><BR>
	                Please purchase an upgrade here or disable a user in order to add another.<BR>";
	                show_user();
	}
}

function insert_user() {
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
					echo "<BR><BR><form method=\"post\" action=\"./index.php\">";
					echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_user\">";
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

?>
