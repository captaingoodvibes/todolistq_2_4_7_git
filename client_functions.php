<?PHP
function client_details() {
		$id = $_POST['id'];
		$ClientID = $_POST['ClientID'];
		$name = $_POST['name'];
		$StartTime = $_POST['StartTime'];
		$ActionRelToFkClientID = $_POST['ActionRelToFkClientID'];
//**********************************************************************************************
//********************************************************************* SETUP START TIME - START

			//$StartTime = $_GET['StartTime'];

			if( empty($_POST['StartTime']) )
			{
				$StartTime = time();
			}


//*********************************************************************** SETUP START TIME - END
//**********************************************************************************************
        //echo "<H3>Client Card</H3>";
        $header_size = $_POST['header_size'];
	echo "<H" . $header_size . ">Client Card</H" . $header_size . ">";
        ?>
        <div class="container">
                <div class="row">
                        <div class="six columns box" style="margin-top: 5%; text-align: center">
                                <?PHP
                                //**********************************************************************************************
                                //***************************************************************** DEBUG VARIABLES HERE - START
                                $turn_this_debug_on = 0;
                                if ($turn_this_debug_on == 1) {
                                        $debug = $_POST['debug'];
                                        $debugMsg .= "Debug in the main() function in clientcard2.php PART I<BR>";
                                        $debugMsg .= "\$name = $name<BR>";
                                        $debugMsg .= "This " . $_POST['StartTime'] . " is the \$_POST['StartTime']<BR>";
                                        $debugMsg .= "This " . $_POST['id'] . " is the \$_POST['id'] in Main.<BR>";
                                        $debugMsg .= "This --> " . $_POST['ClientID'] . " <--  is the \$_POST['ClientID'] in Main.<BR>";
                                        include("config/debug.php");
                                }
                                //******************************************************************* DEBUG VARIABLES HERE - END
                                //**********************************************************************************************

                                //*************************************************************************************************
                                //******************************************************************** DEBUG VARIABLES HERE - START
                                $turn_this_debug_on = 0;
                                if ($turn_this_debug_on == 1) {
                                        $debug = $_POST['debug'];
                                        $debugMsg .= "<BR>********************************************************************<BR>";
                                        $debugMsg .= "Debug in the main() function in clientcard2.php PART II<BR>";
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
                                //**************************************************************************** TIME ZONE - START
	                                // echo "\$callOrder = $callOrder";

	                                $dbst = new dbSession();
	                                $sqlt = "SELECT * from config WHERE ConfigID = 1 LIMIT 0, 30";

	                                $Resultst = $dbst->getResult($sqlt);

	                                while ($rowt = $dbst->getArray($Resultst)) {

	                                //$config_time_zone = $rowt['config_time_zone'];
	                                $config_time_zone = $_POST['user_time_zone'];
	                                $_POST['config_time_zone'] = $config_time_zone;
	                                }
	                                //echo "\$config_time_zone = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";

                                //****************************************************************************** TIME ZONE - END
                                //**********************************************************************************************

	                                if ($callOrder == 1) {
	                                LocCallOrderUpdate();
	                                }

	                                $dbs = new dbSession();
	                                $sql = "SELECT * from client WHERE ClientID = \"$ClientID\" LIMIT 0, 30";

	                                $Results = $dbs->getResult($sql);

	                                while ($row = $dbs->getArray($Results)) {

	                                $ActionDateSecs = $row[ClientDate];
	                                if ($ActionDateSecs == "") {
	                                $ActionDateTime = "Unknown";
	                                } else {
	                                $ActionDateTime = date("H:i:s d-M-Y",$ActionDateSecs);
	                                                $config_time_zone = $_POST['config_time_zone'];
			                                $Ad = new DateTime("@$ActionDateSecs");
			                                $zone_action = new DateTimeZone($config_time_zone);
			                                $Ad->setTimezone($zone_action);
			                                $ActionDateTime = $Ad->format(DATE_RFC1123);
	                                }
	                                $_POST['ActionDateTime'] = $ActionDateTime;
	                                echo "<form method=\"post\" action=\"$PHP_SELF\" >";
	                                $name = $row['ClientName'];

	                                echo "


		                                <TABLE>
		                                <TR>
			                                <TD>Name</TD>
			                                <TD><input type=\"text\" name=\"ClientName\" tabindex=\"1\" value=\"$row[ClientName]\"></input></TD>
		                                </TR>
		                                <TR>
			                                <!-- <TD>Type</TD>
			                                <TD><input type=\"text\" name=\"ClientType\" tabindex=\"2\"  value=\"$row[ClientType]\"></input></TD> -->
			                                <TD></TD>
			                                <TD></TD>
		                                </TR>
		                                <TR>
			                                <TD>Created</TD>
			                                <TD>$ActionDateTime</TD>
		                                </TR>
		                                <TR>
			                                <!--<TD>Priority</TD>
			                                <TD><input type=\"text\" name=\"ClientPriority\" tabindex=\"4\"  value=\"$row[ClientPriority]\"></input></TD> -->
			                                <TD></TD>
			                                <TD></TD>
		                                </TR>
		                                <TR>
			                                <TD>ContactName</TD>
			                                <TD><input type=\"text\" name=\"ClientContactName\" tabindex=\"5\"  value=\"$row[ClientContactName]\"></input></TD>
		                                </TR>
		                                <TR>
			                                <TD>Address1</TD>
			                                <TD><input type=\"text\" name=\"ClientAddress1\" tabindex=\"6\"  value=\"$row[ClientAddress1]\"></input></TD>
		                                </TR>
		                                <TR>
			                                <TD>Address2</TD>
			                                <TD><input type=\"text\" name=\"ClientAddress2\" tabindex=\"7\"  value=\"$row[ClientAddress2]\"></input></TD>
		                                </TR>
		                                <TR>
			                                <TD>City</TD>
			                                <TD><input type=\"text\" name=\"ClientCity\" tabindex=\"8\"  value=\"$row[ClientCity]\"></input></TD>
		                                </TR>
		                                <TR>
			                                <TD>Add to Callback List</TD>
			                                <TD><input type=\"text\" name=\"ClientCallBack\" tabindex=\"8.5\"  value=\"$row[ClientCallBack]\"></input></TD>
		                                </TR>
		                                <TR>

			                                <TD> Notes</TD>
			                                <TD ><TEXTAREA tabindex=\"24\" rows=\"2\" cols=\"16\" name=\"client_notes\" WRAP=\"virtual\">$row[client_notes]</TEXTAREA></TD>
		                                </TR>
		                                </TABLE>
	                                ";
	                         ?>
                        </div>
                        <div class="six columns" style="margin-top: 5%; text-align: center">
                        <?PHP
                        echo"                   <TABLE>
		                                <TR>
			                                <TD>State</TD>
			                                <TD><input type=\"text\" name=\"ClientState\" tabindex=\"9\"  value=\"$row[ClientState]\"></input></TD>
		                                </TR>
		                                <TR>
			                                <TD>Postcode</TD>
			                                <TD><input type=\"text\" name=\"ClientPostcode\" tabindex=\"10\"  value=\"$row[ClientPostcode]\"></input></TD>
		                                </TR>
		                                <TR>
			                                <TD>Country</TD>
			                                <TD><input type=\"text\" name=\"ClientCountry\" tabindex=\"12\"  value=\"$row[ClientCountry]\"></input></TD>
		                                </TR>
		                                <TR>
			                                <TD>Phone1</TD>
			                                <TD><input type=\"text\" name=\"ClientPhone1\" tabindex=\"13\"  value=\"$row[ClientPhone1]\"></input><a href=\"tel:$row[ClientPhone1]\"><img src=\"images/phone1.png\" alt=\"Call\"></a></TD>
		                                </TR>
		                                <TR>
			                                <TD>Phone2</TD>
			                                <TD><input type=\"text\" name=\"ClientPhone2\" tabindex=\"14\"  value=\"$row[ClientPhone2]\"></input><a href=\"tel:$row[ClientPhone2]\"><img src=\"images/phone1.png\" alt=\"Call\"></a></TD>
		                                </TR>
		                                <TR>
			                                <TD>Fax</TD>
			                                <TD><input type=\"text\" name=\"ClientFax\" tabindex=\"15\"  value=\"$row[ClientFax]\"></input></TD>
		                                </TR>
		                                <TR>
			                                <TD>Email</TD>
			                                <TD><input type=\"text\" name=\"ClientEmail\" tabindex=\"16\"  value=\"$row[ClientEmail]\"></input>
				                                <a class=\"linkPlainInWhiteAreas\" tabindex=\"16.5\" href=\"mailto:" . $row['ClientEmail'] . "\">Send</a></TD>
		                                </TR>
		                                <TR>
			                                <TD>Url</TD>
			                                <TD><input type=\"text\" name=\"ClientUrl\" tabindex=\"17\"  value=\"$row[ClientUrl]\"></input>
				                                <A class=\"linkPlainInWhiteAreas\" tabindex=\"17.5\" href=\"http://" . $row['ClientUrl'] . "\"target=\"_blank\">Go</A></TD>
		                                </TR>
		                                <TR>
			                                <TD>ID</TD>
			                                <TD>$ClientID</TD>
		                                </TR>
		                                </TABLE>
	                                ";

                        ?>
                        </div>
                </div>
        </div>
        <?PHP

	// echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<div align=\"center\"><input type=\"hidden\" name=\"AddMessageTermination\" value=\"\"></input>";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"EditDetails\"></input>";
	echo "<input type=\"hidden\" name=\"ActionRelToFkClientID\" value=\"" . $ActionRelToFkClientID . "\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\"></input>";
	echo "<input type=\"hidden\" name=\"name\" value=\"$name\"></input>";
	echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ClientID\"></input>";
	include ("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" tabindex=\"18\" name=\"Submit\" value=\"Apply Changes\"></input>";
	echo "</form></div>";

	echo "<div align=\"center\"><form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\"></input>";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"DeleteCardQuestion\"></input>";
	echo "<input type=\"hidden\" name=\"name\" value=\"$name\"></input>";
	echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ClientID\"></input>";
	include ("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" tabindex=\"19\" name=\"Submit\" value=\"DeleteCard\"></input>";
	echo "</form>
	</div>
	";
	}

}

function EditDetails() {
	// Edit the cards details

        //**********************************************************************************************
        //********************************************************************** SETUP START TIME - START
        $StartTime = $_GET['StartTime'];
        if( ($_POST['StartTime']) > ($StartTime) )
        {
	        $StartTime = $_POST['StartTime'];
        }
        else
        {
	        $StartTime = $_GET['StartTime'];
        }
        //********************************************************************** SETUP START TIME - END
        //**********************************************************************************************


        //**********************************************************************************************
        //********************************************************************** GRAB POSTED VARS - START

        $id = $_GET['id'];
        $ClientID = $_POST['ClientID'];
        $name = addslashes($_GET['name']);
        $ClientName = addslashes($_POST['ClientName']);
        $ClientType = addslashes($_POST['ClientType']);
        $ClientPriority = $_POST['ClientPriority'];
        $ClientContactName = addslashes($_POST['ClientContactName']);
        $ClientAddress1 = addslashes($_POST['ClientAddress1']);
        $ClientAddress2 = addslashes($_POST['ClientAddress2']);
        $ClientCity = addslashes($_POST['ClientCity']);
        $ClientCallBack = addslashes($_POST['ClientCallBack']);
        $client_notes = addslashes($_POST['client_notes']);
        $ClientState = addslashes($_POST['ClientState']);
        $ClientPostcode   = addslashes($_POST['ClientPostcode']);
        $ClientCountry = addslashes($_POST['ClientCountry']);
        $ClientPhone1 = addslashes($_POST['ClientPhone1']);
        $ClientPhone2 = addslashes($_POST['ClientPhone2']);
        $ClientFax = addslashes($_POST['ClientFax']);
        $ClientEmail = addslashes($_POST['ClientEmail']);
        $ClientUrl = addslashes($_POST['ClientUrl']);

        //********************************************************************** GRAB POSTED VARS - END
        //**********************************************************************************************

        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
	        $debug = $_POST['debug'];
	        $debugMsg .= "<BR>\$id = $id";
	        $debugMsg .= "<BR>\$ClientID = $ClientID";
	        $debugMsg .= "<BR>\$name = $name";
	        $debugMsg .= "<BR>\$ClientName = $ClientName";
	        $debugMsg .= "<BR>\$ClientType = $ClientType";
	        $debugMsg .= "<BR>\$ClientDate = $ClientDate";
	        $debugMsg .= "<BR>\$ClientPriority = $ClientPriority";
	        include("config/debug.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************

	echo "<div align=\"center\">";

	$dbs = new dbSession();

	$sql = "UPDATE client SET ClientName = '$ClientName', ClientType = '$ClientType',
			ClientPriority = '$ClientPriority',
			ClientContactName = '$ClientContactName', ClientAddress1 = '$ClientAddress1',
			ClientAddress2 = '$ClientAddress2', ClientCity = '$ClientCity',
			ClientCallBack = '$ClientCallBack', client_notes = '$client_notes',
			ClientState = '$ClientState', ClientPostcode = '$ClientPostcode',
			ClientCountry = '$ClientCountry', ClientPhone2 = '$ClientPhone2',
			ClientPhone1 = '$ClientPhone1', ClientFax = '$ClientFax', ClientEmail = '$ClientEmail',
			ClientUrl = '$ClientUrl' WHERE ClientID = '$ClientID'";

				if ($dbs->getResult($sql)) {
					$msg = "Card Edited.";
					echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT>";
					echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";
					client_details();
					?>
                                        <div class="container">
                                            <div class="row">
                                              <div class="one.column column" style="margin-top: 1%;">
                                                <?PHP
                                                LocEndCallAddAction();
                                                ?>
                                              </div>
                                            </div>
                                          </div>
                                        <?PHP
					ShowActions();
					echo "<div align=\"center\">";
					echo "<BR>";
					//echo "<FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"\"><A href=\"index.php\">Home</A></FONT>";
					echo "</div>";
				} else {
					$msg = $dbs->printError();
					echo "<br>$msg";
				}
	echo "<br>";
	echo "</div>";

}
function DeleteCardQuestion() {

	$ActionID = $_POST['ActionID'];
	$StartTime = $_POST['StartTime'];
	$ClientID = $_POST['ClientID'];
	$ActionFkJobID = $_POST['ActionFkJobID'];

//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
	$debug = $_POST['debug'];
	$debugMsg .= "<b>Inside DeleteCARDQuestion()</b><BR>";
	$debugMsg .= "\$ActionID = $ActionID<BR>";
	$debugMsg .= "\$StartTime = $StartTime<BR>";
	$debugMsg .= "\$ClientID = $ClientID<BR>";
	$debugMsg .= "\$ActionFkJobID = $ActionFkJobID<BR>";
	include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************


	echo "<DIV align=\"center\">";
	echo " Are you sure you want to delete this Client Card?<BR><BR>";
	/**
	echo "<A href=\"editAction.php?ActionID=$ActionID&StartTime=$StartTime&ClientID=$ClientID\">No</A><BR><BR>";
	echo "<A href=\"editAction.php?OptionCatch=DeleteAction&ActionID=$ActionID&StartTime=$StartTime&ClientID=$ClientID&ActionFkJobID=$ActionFkJobID\">Yes</A><BR><BR>";
	*/


	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"DeleteCard\">";
	echo "<input type=\"hidden\" name=\"ActionID\" value=\"$ActionID\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ClientID\">";
	include ("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" name=\"confirm_delete\" value=\"Yes\">";
	echo "</form>";

	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"DeleteCard\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"ActionID\" value=\"$ActionID\">";
	echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	echo "<input type=\"hidden\" name=\"ClientID\" value=\"$ClientID\">";
	include ("log_in_authentication_form_vars.php");
	echo "<input type=\"submit\" name=\"confirm_delete\" value=\"No\">";
	echo "</form>";


	echo "</DIV>";
/**
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
*/

}
function DeleteCard() {
        $confirm_delete = $_POST['confirm_delete'];
        if ($confirm_delete == Yes) {
	// Edit the cards details
	/**
	global $id;
	global $name;
	global $InsertIntoDatabase;
	global $ClientName;
	*/
	echo "<div align=\"center\"";
	$ClientID = $_POST['ClientID'];
	// echo "* test3	\$id= $id<BR>";
	// echo "* test4	\$name= $name<BR>";
	// echo "* test5	\$InsertIntoDatabase= $InsertIntoDatabase<BR>";
//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
	$debug = $_POST['debug'];
	$debugMsg .= "<b>Inside DeleteCard()</b><BR>";
	$debugMsg .= "\$ClientID = $ClientID<BR><BR>";
	include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************

	$dbs = new dbSession();

	$sql = "DELETE FROM client WHERE ClientID = '$ClientID'";

				if ($dbs->getResult($sql)) {
					$msg = "Card Deleted.";
				} else {
					$msg = $dbs->printError();
				}
	echo "<span><BR>$msg</span>";
	// echo "<A class=\"linkPlainInWhiteAreas\" href=\"index.php\">Home</A>";

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
        } else {
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
}
function AddClient() {

	$header_size = $_POST['header_size'];
	echo "<H" . $header_size . ">Add Client</H" . $header_size . ">";
	?>
	<!-- <H4>Add Client</H4> -->


	<TABLE align="center">
	<TR>
		<TD style="border-bottom: none;">
	                <?PHP
	                $StartTime = time();
	                $debug = $_POST['debug'];
	                $debugMsg .= "inside addClient()<br></br>";
	                $debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
	                $debugMsg .= "\$fieldName= $fieldName<BR>";
	                include("config/debug.php");

	                echo "<form method=\"post\" action=\"$PHP_SELF\">";
	                echo "Name ";
        echo "  </TD>";
        echo "  <TD style=\"border-bottom: none;\"> ";
	                echo "<input type=\"text\" name=\"InsertIntoDatabase\" value=\"\">";
	                //echo "<BR>";
        ?>
		</TD>
	</TR>
	<TR>
		<TD style="border-bottom: none;">
	<?PHP
	                echo "Contact Name ";
        echo "  </TD>";
        echo "  <TD style=\"border-bottom: none;\">";
	                echo "<input type=\"text\" name=\"ClientContactName\" value=\"\">";
	                echo "<BR>";
	?>
		</TD>
	</TR>
	<TR>
		<TD style="border-bottom: none;">
	<?PHP
	                echo "Phone ";
        echo "  </TD>";
        echo "  <TD style=\"border-bottom: none;\"> ";
	                echo "<input type=\"text\" name=\"ClientPhone1\" value=\"\">";
	                echo "<BR>";
        ?>
		</TD>
	</TR>
	<TR>
		<TD style="border-bottom: none;">.
		</TD>
		<TD style="border-bottom: none;">
	<?PHP
	                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
	                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"InsertClient\">";
	                echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
	                include ("log_in_authentication_form_vars.php");
	                echo "<input type=\"submit\" name=\"Submit\" value=\"Add Client\">";
	                echo "</form>";
	                ?>
		</TD>
	</TR>
	</TABLE>
	<?PHP
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
			$sql = "INSERT INTO client (ClientName, ClientContactName, ClientPhone1, ClientDate) VALUES ('$InsertIntoDatabase', '$ClientContactName', '$ClientPhone1', '$ClientInsertDate')";

				if ($dbs->getResult($sql)) {
					$msg = "Client Added.";
					echo "$msg<BR>";
					$dbs = new dbSession();
					$sql = "SELECT ClientID, ClientName from client WHERE ClientName = \"$InsertIntoDatabase\" AND ClientDate = \"$ClientInsertDate\"";
					$Results = $dbs->getResult($sql);
					$row = $dbs->getArray($Results);
					$UniqueIdentifier = $row['ClientID'];
					$name = $row['ClientName'];
					$GotoClientCard = "1";
					echo "Goto card for ";
					        echo "<form method=\"post\" action=\"./index.php\">";
					        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"client_details\">";
                                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $UniqueIdentifier . "\">";
                                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                                include("log_in_authentication_form_vars.php");
                                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"" . $name . "\">";
                                                echo "</form>";
					echo "<BR>";
				} else {
					$msg = $dbs->printError();
					echo "$msg<BR>";
				}
		} else {
			echo "<BR><BR>Not a valid name. Please type it again.";
		}
}


?>
