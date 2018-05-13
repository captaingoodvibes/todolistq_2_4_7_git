<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/skeleton.css">
<?PHP 

/**
*	file:	searchFunctions.php
*	auth:	Dion Patelis (owner)
*	desc;	Dions messaging system 
*	date:	26 Feb 2003 - Dion Patelis
*	last:	Monday 19th Jan 2015 - Dion Patelis
*/

$dbs = new dbSession();

// END CONNECT TO DATABASE

//*************************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
	global $debug;
	$debugMsg .= "Start Time = $StartTime<BR>";
	$debugMsg .= "Test Global Vars On \$OptionCatch= $_POST[$OptionCatch]<BR>";
	$debugMsg .= "\$OptionCatch = $OptionCatch<BR />\n";
	$debugMsg .= "\$SearchClientName = $SearchClientName<BR>";
	include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************

$SearchClientName = $_POST['fieldName'];


//**********************************************************************************************
//**************************************************************************** FUNCTIONS - START
function show_user() {
	// Get data from the database where the name variable = ????
	// echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";	
	echo "<DIV align=\"center\">";
	$header_size = $_POST['header_size'];
	echo "<H" . $header_size . ">List Users</H" . $header_size . ">";
	
	global $debug;
	$debugMsg .= "Start Time = $StartTime<BR>";
	$debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
	$debugMsg .= "\$fieldName wwwwwwq= $fieldName<BR>";
	include("config/debug.php");
	
	$message = "";
	// LocHtmlPageStart();
	// echo "</DIV><BR>";
	$dbs = new dbSession();
	$sql = "SELECT UserID, UserActive, UserLogin FROM user ORDER BY UserLogin ASC";
	//$sql = "SELECT ClientID from Client where ClientName REGEXP \'f\'";
	$Results = $dbs->getResult($sql);
	$debugMsg .= "Results is $Results<BR>";
	$StartTime = time();
	echo "<TABLE>";
	        
	        while ($row = $dbs->getArray($Results)) {
		        $user_ID_to_display = $row['UserID'];
		        $UserLogin = $row['UserLogin'];
		        $UserActive = $row['UserActive'];
		        if ($UserActive == 1){
		                $user_active_css = "edit_success_solid";
		        }else{
		                $user_active_css = "generalFontOnWhite";
		        }
		
		        // echo "<a href=\"clientcard2.php?id=$UniqueIdentifier&StartTime=$StartTime&name=$name\">$name</a>";
		                echo "<TR>";
		                        echo "<TD>";
		                        echo "<form method=\"post\" action=\"./user_card_with_time_limits_ajax.php\">";
                                        echo " <FONT class=\"" . $user_active_css . "\">" . $UserLogin . "</FONT>";
                                        echo "</TD>";
                                        echo "<TD>";
                                        echo "<input type=\"hidden\" name=\"user_ID_to_display\" value=\"" . $user_ID_to_display . "\">";
                                        echo "<input type=\"hidden\" name=\"page_load\" value=\"1\">";
                                        include("log_in_authentication_form_vars.php");
                                        echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\" Go \">";
                                        echo "</form>";
                                        echo "</TD>";
                                echo "</TR>";
		        // echo "<BR>";
	        }
        echo "</TABLE>";
	// echo "<DIV align=\"center\"><BR>";
	// LocHtmlPageEnd();
	echo "<BR><BR>";
	echo "</DIV>";
	echo "</LINK>";
}
function user_button($user_ID_to_display) {
        
        $dbsUserFirstName = new dbSession();
        
	$sql_user_first_name = "SELECT UserFirstname from user WHERE UserID = \"$user_ID_to_display\" LIMIT 1";
	$ResultsUser = $dbsUserFirstName->getResult($sql_user_first_name);
	// echo "\$user_ID_to_display = $user_ID_to_display<BR>";
	$row_user_first_name = $dbsUserFirstName->getArray($ResultsUser);
	$User_first_name = $row_user_first_name['UserFirstname'];
			
        // echo "<form method=\"post\" action=\"./userCard.php\">";
        echo "<form method=\"post\" class=\"form-inline\" id=\"user_button_form" . $user_ID_to_display . "\" action=\"./user_card_with_time_limits_ajax.php\">";
        echo "<input type=\"hidden\" name=\"user_ID_to_display\" value=\"" . $user_ID_to_display . "\">";
        echo "<input type=\"hidden\" name=\"page_load\" value=\"1\">";
        include("log_in_authentication_form_vars.php");
        if ($User_first_name == 'Everyone') {
                echo "$User_first_name";
        }else{
                // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"$User_first_name\">";
                echo "<button type=\"submit\" class=\"link_styled_button\" form=\"user_button_form" . $user_ID_to_display . "\" value=\"submit\">$User_first_name</button>";
        }
        echo "</form>";
}
function job_button($JobID,$JobFkClientID,$JobCardNumber,$JobParent) {
        echo "<form method=\"post\" id=\"job_button_form" . $JobID . "\" action=\"./index.php\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_card\">";
        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID . "\">";
        echo "<input type=\"hidden\" name=\"JobCardNumber\" value=\"" . $JobCardNumber . "\">";
        echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobParent . "\">";
        include("log_in_authentication_form_vars.php");
        echo "<button type=\"submit\" class=\"link_styled_button\" form=\"job_button_form" . $JobID . "\" title=\"The JobID is the internal system job number. The JobCardNumber is your existing paper job card number.\" value=\"submit\">$JobID - $JobCardNumber</button>";
        // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" title=\"The JobID is the internal system job number. The JobCardNumber is your existing paper job card number.\" value=\"" . $JobID . "-" . $JobCardNumber . "\">";
        echo "</form>";
}
function job_button_standard_style($JobID,$JobFkClientID,$JobCardNumber,$JobParent) {
        echo "<form method=\"post\" id=\"job_button_form" . $JobID . "\" action=\"./index.php\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_card\">";
        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID . "\">";
        echo "<input type=\"hidden\" name=\"JobCardNumber\" value=\"" . $JobCardNumber . "\">";
        echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobParent . "\">";
        include("log_in_authentication_form_vars.php");
        echo "<button type=\"submit\" form=\"job_button_form" . $JobID . "\" title=\"The JobID is the internal system job number. The JobCardNumber is your existing paper job card number.\" value=\"submit\">$JobID - $JobCardNumber</button>";
        // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" title=\"The JobID is the internal system job number. The JobCardNumber is your existing paper job card number.\" value=\"" . $JobID . "-" . $JobCardNumber . "\">";
        echo "</form>";
}
function client_button($ClientID,$clientName) {
        echo "<form method=\"post\" id=\"client_button_form" . $ClientID . "\" action=\"./index.php\">";
        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">";
        echo "<input type=\"hidden\" name=\"clientName\" value=\"" . $clientName . "\">";
        include("log_in_authentication_form_vars.php");
        // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
        echo "<button type=\"submit\" class=\"link_styled_button\" form=\"client_button_form" . $ClientID . "\" value=\"submit\">$clientName</button>";
        // echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"" . $clientName . "\">";
        echo "</form>";
}
function client_button_with_start_time($ClientID,$StartTime) {
        $dbs = new dbSession();
	$sql = "SELECT ClientName from client WHERE ClientID = \"$ClientID\" LIMIT 1";
	$Results = $dbs->getResult($sql);
	// echo "\$user_ID_to_display = $user_ID_to_display<BR>";
	$row = $dbs->getArray($Results);
	$ClientName = $row['ClientName'];
	
        echo "<form method=\"post\" id=\"client_button_form_start" . $ClientID . "\" action=\"./index.php\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"client_details\">";
        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">";
        echo "<input type=\"hidden\" name=\"clientName\" value=\"" . $ClientName . "\">";
        echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
        include("log_in_authentication_form_vars.php");
        // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
        echo "<button type=\"submit\" class=\"link_styled_button\" form=\"client_button_form_start" . $ClientID . "\" value=\"submit\">$ClientName</button>";
        // echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"" . $ClientName . "\">";
        echo "</form>";
}
function client_button_with_start_time_href($ClientID,$StartTime) {
    $dbs = new dbSession();
    $sql = "SELECT ClientName from client WHERE ClientID = \"$ClientID\" LIMIT 1";
    $Results = $dbs->getResult($sql);
    // echo "\$user_ID_to_display = $user_ID_to_display<BR>";
    $row = $dbs->getArray($Results);
    $ClientName = $row['ClientName'];

    /*    
    echo "<form method=\"post\" id=\"client_button_form_start" . $ClientID . "\" action=\"./index.php\">";
    echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"client_details\">";
    echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">";
    echo "<input type=\"hidden\" name=\"clientName\" value=\"" . $ClientName . "\">";
    echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
    include("log_in_authentication_form_vars.php");
    // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
    echo "<button type=\"submit\" class=\"link_styled_button\" form=\"client_button_form_start" . $ClientID . "\" value=\"submit\">$ClientName</button>";
    // echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"" . $ClientName . "\">";
    echo "</form>"; */
    echo "<a class=\"blue\" href=\"index.php?OptionCatch=client_details&ClientID=$ClientID&StartTime=$StartTime&ClientName=$ClientName\">$ClientName fff</a><br>";
}
function client_phone($ClientID,$StartTime) {
        $dbs = new dbSession();
	$sql = "SELECT ClientPhone1, ClientPhone2 from client WHERE ClientID = \"$ClientID\" LIMIT 1";
	$Results = $dbs->getResult($sql);
	// echo "\$user_ID_to_display = $user_ID_to_display<BR>";
	$row = $dbs->getArray($Results);
	$ClientPhone1 = $row['ClientPhone1'];
	$ClientPhone2 = $row['ClientPhone2'];
	
        echo "Ph: $ClientPhone1<BR>$ClientPhone2 ";
}
function edit_button($ActionID,$ClientID,$JobCardNumberFkJobID,$ActionRelToFkClientID,$ActionDateSecs,$StartTime) {
        ?> <link rel="stylesheet" href="css/skeleton.css"> <?PHP 
        echo "<form method=\"post\" action=\"./index.php\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"action_card\">";
        echo "<input type=\"hidden\" name=\"ActionID\" value=\"" . $ActionID . "\">";
        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">";
        echo "<input type=\"hidden\" name=\"ActionFkJobID\" value=\"" . $JobCardNumberFkJobID . "\">";
        echo "<input type=\"hidden\" name=\"ActionRelToFkClientID\" value=\"" . $ActionRelToFkClientID . "\">";
        echo "<input type=\"hidden\" name=\"ActionDateSecs\" value=\"" . $ActionDateSecs . "\">";
        echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
        include("log_in_authentication_form_vars.php");
        echo "<input class=\"action_buttons\" type=\"submit\" name=\"action\" value=\"Edit\">";
        echo "</form>";
}
function SearchClient3() {
	// Get data from the database where the name variable = ????
	?>                      
        <div class="container">
                <div class="row">
                        <div class="twelve columns" style="margin-top: 5%; text-align: center">
                                <?PHP 
	                        $fieldName = $_POST['fieldName'];
	                        $SearchClientName = $_POST['SearchClientName'];
	                        $StartTime = $_POST['StartTime'];
	                        $message = $_POST['message'];
	                        echo "<DIV align=\"center\">";
	                        $message = "";
	                        // LocHtmlPageStart();
	                        echo "</DIV><BR>";
	                        $dbs = new dbSession();
	                        // $sql = "SELECT ClientID, ClientName, ClientContactName, ClientPhone1, ClientPhone2 from client WHERE $fieldName REGEXP \"$SearchClientName\" ORDER BY ClientName ASC";
	                        $sql = "SELECT ClientID, ClientName, ClientContactName, ClientPhone1, ClientPhone2 from client WHERE ( ($fieldName REGEXP \"$SearchClientName\") || (ClientContactName REGEXP \"$SearchClientName\") ) ORDER BY ClientName ASC";
	                        //**********************************************************************************************
                                //***************************************************************** DEBUG VARIABLES HERE - START
                                $turn_this_debug_on = 0;
                                if ($turn_this_debug_on == 1) {
                                        foreach($_POST as $key => $value) {
                                        echo $key." = ". $value."<br>";
                                        echo "\$sql = $sql<BR>";
                                        } 
                                }
                                //******************************************************************* DEBUG VARIABLES HERE - END
                                //**********************************************************************************************
	                        //$sql = "SELECT ClientID from Client where ClientName REGEXP \'f\'";
	                        $Results = $dbs->getResult($sql);
	                        $StartTime = time();
		                        while ($row = $dbs->getArray($Results)) {
			                        $UniqueIdentifier = $row['ClientID'];
			                        $name = $row['ClientName'];
			                        $ClientPhone1 = $row['ClientPhone1'];
			                        $ClientPhone2 = $row['ClientPhone2'];
			                        $ClientContactName = $row['ClientContactName'];
			                        // echo "<a href=\"clientcard2.php?id=$UniqueIdentifier&StartTime=$StartTime&name=$name\">$name</a>";
			                                echo "<form method=\"post\" action=\"$PHP_SELF\">";
                                                        include ("log_in_authentication_form_vars.php");
                                                        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $UniqueIdentifier . "\">";
                                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"client_details\">";
                                                        echo "  <B>Client </B>" . $name;
			                                if ( ! empty($ClientContactName)) {
			                                        echo "  <B>Contact name :</B>  $ClientContactName ";
			                                }
			                                if ( ! empty($ClientPhone1)) {
			                                        echo "  <B>Phone 1 :</B>  $ClientPhone1 ";
			                                }
			                                if ( ! empty($ClientPhone2)) {
			                                        echo "  <B>Phone 2 :</B> $ClientPhone2 ";
			                                }
                                                        echo "<input type=\"hidden\" name=\"name\" value=\"" . $name . "\">";
                                                        echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\" Go \">";
                                                        echo "</form>";
			                        echo "<BR>";
		                        }
	                        echo "<DIV align=\"center\"><BR>";
	                        // LocHtmlPageEnd();
	                        echo "<BR><BR>";
	                        echo "</DIV>";
	                         ?>
                        </div>
                </div>
        </div>
        <?PHP
}
function Actua() {
        /** Tuesday 20th Jan 2015 - Dion
        I actually can't exactly remember why I wrote this snippet of code.
        I thought someone hacked me initially  Maybe they did as the VPS is 
        really busy sometimes and I don't know why the vaiable $hackerMsg 
        is here.??????
        I think I may hae written this to control the amount of MAU (Maximum
        Active Users) ..... Well that's how it appears.
        */ 
	
	$userAllreadyActive = $_POST['userAllreadyActive'];
	$UserActive = $_POST['UserActive'];
	
	//*************************************************************************************************
        //******************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {
	        global $debug;
	        $debugMsg .= "In the Actua() funtion.<BR>";
	        $debugMsg .= "\$_POST[\'userAllreadyActive\'] = " . $_POST['userAllreadyActive'] . "<BR>";
	        $debugMsg .= "\$userAllreadyActive = $userAllreadyActive<BR>";
	        $debugMsg .= "\$UserActive = $UserActive<BR>";
	        include("config/debug.php");
        }
        //********************************************************************** DEBUG VARIABLES HERE - END
        //*************************************************************************************************
	
	
	$au = 0;
	$mau = 7;
	
	$dbsActua = new dbSession();
	$sqlActua = "SELECT UserActive from User WHERE UserActive = '1'";
	$ResultsActua = $dbsActua->getResult($sqlActua);
	
	$hackerMsg = "";
	
	while ($rowActua = $dbsActua->getArray($ResultsActua)) {
		$au = $au + 1;
	}
	
	if ($au > $mau) {
		echo "<DIV align=\"center\"><BR>";
		echo "</DIV>";
		$happy = 0;
		$UserActive = 0;
	} elseif ( ($au == $mau) AND ($UserActive == 1) AND ($userAllreadyActive == 0) ) {
		$happy = 1;
		$UserActive = 0;
		echo "<DIV align=\"center\"><BR>";
	} elseif ($au <= $mau) {
		$happy = 1;
	} else {
		echo "<DIV align=\"center\"><BR>";
		$UserActive = 0;
	}
	
	$inital = 7;
	if ($inital != $mau) {
		echo "<DIV align=\"center\"><BR>";
		echo "</DIV>";
		$happy = 0;
		$UserActive = 0;
		exit();
	}
	$_POST['happy'] = $happy;
}
function SearchClient5() {
	// Get data from the database where the name variable = ????
	global $SearchClientName;
	global $StartTime;
	global $fieldName;
	global $id;
	$ClientID = $_POST['ClientID'];
	$name = $_POST['name'];
	$StartTime = $_POST['StartTime'];
	$id = $_GET['id'];
	
//*************************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "<BR>********************************************************************<BR>";
        $debugMsg .= "In the SearchClient5() function.<BR>";
        $debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
        $debugMsg .= "\$fieldName= $fieldName<BR>";
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
        $debugMsg .= "\$ClientID = $ClientID<BR>";
        $debugMsg .= "\$id = $id<BR>";
        $debugMsg .= "\$StartTime = $StartTime<BR>";
        $debugMsg .= "********************************************************************<BR>";
        include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************

	$dbs = new dbSession();
	$sql = "SELECT ClientID, ClientName, ClientContactName from client ORDER BY ClientName ASC";
	//$sql = "SELECT ClientID from Client where ClientName REGEXP \'f\'";
	$Results = $dbs->getResult($sql);
	$debugMsg .= "Results is $Results<BR>";
	// $StartTime = time();
	
		while ($row = $dbs->getArray($Results)) {
			$UniqueIdentifier = $row['ClientID'];
			// echo "  ClientName is ";
			$related_to_other_client_name = $row['ClientName'];
			$related_to_other_client_ContactName = $row['ClientContactName'];
			// echo "<a href=\"clientcard2.php?id=$id&ActionRelToFkClientID=$UniqueIdentifier&StartTime=$StartTime&name=$name\">$name</a>";
			// echo "  ClientContactName is";
			// echo " $ClientContactName";
			// echo " ClientID is $UniqueIdentifier";
			//<A href="page_01.htm">page_01.htm</A>
			//echo $row['ClientName'];
			echo "<BR>";
		                echo "<form method=\"post\" action=\"./clientcard2.php\">";
		                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
		                echo "<input type=\"hidden\" name=\"related_to_other_client_name\" value=\"" . $related_to_other_client_name . "\" >";
                                echo "<input type=\"hidden\" name=\"ActionRelToFkClientID\" value=\"" . $UniqueIdentifier . "\">";
                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">";
                                // echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"SearchClient5\">";
                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                include("log_in_authentication_form_vars.php");
                                echo $UniqueIdentifier . " -- " .$related_to_other_client_name . " --- " . $related_to_other_client_ContactName;
                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Connect this client to the action. \">";
                                
                                echo "</form>";
		}
	/**
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"Nothing\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Start Over\">";
	echo "</form>";
	echo "<BR><BR>";
	*/
}

function list_clients_connected_to_reminder() {
	// Get data from the database where the name variable = ????
	global $SearchClientName;
	global $StartTime;
	global $fieldName;
	global $id;
	$ClientID = $_POST['ClientID'];
	$name = $_POST['name'];
	$StartTime = $_POST['StartTime'];
	$id = $_GET['id'];
	$JobID = $_POST['JobID'];
	
//*************************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "<BR>********************************************************************<BR>";
        $debugMsg .= "In the SearchClient5() function.<BR>";
        $debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
        $debugMsg .= "\$fieldName= $fieldName<BR>";
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
        $debugMsg .= "\$ClientID = $ClientID<BR>";
        $debugMsg .= "\$id = $id<BR>";
        $debugMsg .= "\$StartTime = $StartTime<BR>";
        $debugMsg .= "********************************************************************<BR>";
        include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************

	$dbs = new dbSession();
	$sql = "SELECT ClientID, ClientName, ClientContactName from client ORDER BY ClientName ASC";
	//$sql = "SELECT ClientID from Client where ClientName REGEXP \'f\'";
	$Results = $dbs->getResult($sql);
	$debugMsg .= "Results is $Results<BR>";
	// $StartTime = time();
	
		while ($row = $dbs->getArray($Results)) {
			$ClientID = $row['ClientID'];
			// echo "  ClientName is ";
			$related_to_other_client_name = $row['ClientName'];
			$related_to_other_client_ContactName = $row['ClientContactName'];
			// echo "<a href=\"clientcard2.php?id=$id&ActionRelToFkClientID=$UniqueIdentifier&StartTime=$StartTime&name=$name\">$name</a>";
			// echo "  ClientContactName is";
			// echo " $ClientContactName";
			// echo " ClientID is $UniqueIdentifier";
			//<A href="page_01.htm">page_01.htm</A>
			//echo $row['ClientName'];
			echo "<BR>";
		                echo "<form method=\"post\" action=\"./index.php\">";
		                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_reminder\">";
		                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
		                echo "<input type=\"hidden\" name=\"related_to_other_client_name\" value=\"" . $related_to_other_client_name . "\" >";
                                echo "<input type=\"hidden\" name=\"ActionRelToFkClientID\" value=\"" . $UniqueIdentifier . "\">";
                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $ClientID . "\">";
                                // echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"SearchClient5\">";
                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                echo "<input type=\"hidden\" name=\"JobID\" value=\"$JobID\">";
                                include("log_in_authentication_form_vars.php");
                                echo $related_to_other_client_name . " ";
                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Connect this client to the reminder. \">";
                                
                                echo "</form>";
		}
	/**
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"Nothing\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Start Over\">";
	echo "</form>";
	echo "<BR><BR>";
	*/
}
function list_clients_connected_to_reminder_and_back_to_reminder_card() {
	// Get data from the database where the name variable = ????
	global $SearchClientName;
	global $StartTime;
	global $fieldName;
	global $id;
	$ClientID = $_POST['ClientID'];
	$name = $_POST['name'];
	$StartTime = $_POST['StartTime'];
	$ReminderID = $_POST['ReminderID'];
	$id = $_GET['id'];
	$JobID = $_POST['JobID'];
	
//*************************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "<BR>********************************************************************<BR>";
        $debugMsg .= "In the SearchClient5() function.<BR>";
        $debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
        $debugMsg .= "\$fieldName= $fieldName<BR>";
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
        $debugMsg .= "\$ClientID = $ClientID<BR>";
        $debugMsg .= "\$id = $id<BR>";
        $debugMsg .= "\$StartTime = $StartTime<BR>";
        $debugMsg .= "********************************************************************<BR>";
        include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************

	$dbs = new dbSession();
	$sql = "SELECT ClientID, ClientName, ClientContactName from client ORDER BY ClientName ASC";
	//$sql = "SELECT ClientID from Client where ClientName REGEXP \'f\'";
	$Results = $dbs->getResult($sql);
	$debugMsg .= "Results is $Results<BR>";
	// $StartTime = time();
	
		while ($row = $dbs->getArray($Results)) {
			$ClientID = $row['ClientID'];
			// echo "  ClientName is ";
			$related_to_other_client_name = $row['ClientName'];
			$related_to_other_client_ContactName = $row['ClientContactName'];
			// echo "<a href=\"clientcard2.php?id=$id&ActionRelToFkClientID=$UniqueIdentifier&StartTime=$StartTime&name=$name\">$name</a>";
			// echo "  ClientContactName is";
			// echo " $ClientContactName";
			// echo " ClientID is $UniqueIdentifier";
			//<A href="page_01.htm">page_01.htm</A>
			//echo $row['ClientName'];
			echo "<BR>";
		                echo "<form method=\"post\" action=\"./index.php\">";
		                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"reminder_card\">";
		                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
		                echo "<input type=\"hidden\" name=\"related_to_other_client_name\" value=\"" . $related_to_other_client_name . "\" >";
                                echo "<input type=\"hidden\" name=\"ActionRelToFkClientID\" value=\"" . $UniqueIdentifier . "\">";
                                echo "<input type=\"hidden\" name=\"ReminderFkClientID\" value=\"" . $ClientID . "\">";
                                echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
                                // echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"SearchClient5\">";
                                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                                echo "<input type=\"hidden\" name=\"JobID\" value=\"$JobID\">";
                                include("log_in_authentication_form_vars.php");
                                echo $related_to_other_client_name . " ";
                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"Connect this client to the reminder.. \">";
                                
                                echo "</form>";
		}
	/**
	echo "<form method=\"post\" action=\"$PHP_SELF\">";
	echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"\">";
	echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"Nothing\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Start Over\">";
	echo "</form>";
	echo "<BR><BR>";
	*/
}
//****************************************************************************** FUNCTIONS - END
//**********************************************************************************************


// QUICK LISTING
// INCLUDES
// SECURITY (OPTIONAL)
// DATABASE CONNECTION

// START CATCHES
// 	$option_catch
// END CATCHES

// START MAIN
// END MAIN

// START LOCAL FUNCTIONS

// END LOCAL FUNCTIONS

?>
