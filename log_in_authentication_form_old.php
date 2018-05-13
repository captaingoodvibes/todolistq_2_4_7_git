<?PHP
        //echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";
        $user_authenticated = $_POST['user_authenticated'];
        

//******************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
        // $debug = $_POST['debug'];
        $debugMsg .= "<BR>********************************************************************<BR>";
        $debugMsg .= "Debug vars within log_in_authentication_form.php<BR>";
        $debugMsg .= "\$_POST['login_instance_token'] = " . $_POST['login_instance_token'] . "<BR>";
        $debugMsg .= "\$user_authenticated = $user_authenticated<BR>";
        $debugMsg .= "********************************************************************<BR>";
        // include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************
 
$dbs = new dbSession();
	$sql = "SELECT UserFirstname, UserID from user WHERE UserLogin = '$login_name'";
	$Results = $dbs->getResult($sql);
	$row = $dbs->getArray($Results);
	$UserFirstname = $row[UserFirstname];
	$UserID = $row['UserID'];
	$_POST['UserID'] = $UserID;
	$user_authenticated = $_POST['user_authenticated'];
	//echo $_SESSION['login'] . "s#";
	//echo $_SESSION['active'] . " active";
	
	if (empty($user_authenticated)) {
	        $user_authenticated = 0;
	        $_POST['user_authenticated'] = $user_authenticated;
	        
	}
	
	if ($user_authenticated  == 0){
                        ?>                      
                        <div class="container">
                                <div class="row">
                                        <div class="four columns" style="margin-top: 5%; text-align: center">
                                                <?PHP 
                                                echo "<form method=\"post\" class=\"form-inline\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\">";
                                                echo "<input type=\"hidden\" name=\"login_instance_token\" value=\"$login_instance_token\">";
                                                echo "<input placeholder=\"Name\" type=\"text\" name=\"name\" size=\"9\">"; 
                                                ?>                                      
                                        </div>
                                        <div class="four columns" style="margin-top: 5%; text-align: center">
                                                <?PHP 
                                                echo "<input placeholder=\"Pass\" type=\"password\" name=\"pass\" size=\"9\">"; 
                                                ?>
                                        </div>
                                        <div class="four columns" style="margin-top: 5%; text-align: center">
                                                <?PHP 
                                                echo "<input type=\"submit\" name=\"action\" value=\"login\">";
	                                        echo "</form>"; 
	                                        ?>
                                        </div>
                                </div>
                        </div>
                        <?PHP
		exit;
		                
	}elseif ($user_authenticated  == 1){
        // $_POST['login_instance_token'] = 45673; //Test with a faulty token.
	        //*************************************************************************************************
                //***************************************************************************** TOKEN CHECK - START
                        $login_instance_token = $_POST['login_instance_token'];
                        $UserID = $_POST['UserID'];
                        
                        if ($_POST['user_authenticated'] == 1) {
                                // First get the token from the DB. 
                                $dbs_token = new dbSession(); 
	                        $sqllog = "SELECT * from user WHERE UserID = $UserID";
	                        
	                        $Resultslog = $dbs_token->getResult($sqllog);
	                        
	                        while ($rowlog = $dbs_token->getArray($Resultslog)) {
		                        $UserLogin = $rowlog['UserLogin'];
		                        $UserPassword= $rowlog['UserPassword']; 
		                        $UserID = $rowlog['UserID'];
		                        $User_db_token = $rowlog['User_db_token'];
	                                
	                                // Compare the DB token with the POST one passed from the previous page.
                                        if ($User_db_token == $login_instance_token) {
                                                ?>
                                                <!-- <img src="images/spacer.gif" width="265" height="10" alt="" FACE="Arial" SIZE="" COLOR="white"> -->
                                                <div class="container">
                                                        <div class="row">
                                                                <div class="six columns" style="margin-top: 1%; text-align: center">
                                                                <?PHP
                                                                //*************************************************************************************************
                                                                //******************************************************************** DEBUG VARIABLES HERE - START
                                                                $turn_this_debug_on = 0;
                                                                if ($turn_this_debug_on == 1) {
                                                                        $debug = $_POST['debug'];
                                                                        $debugMsg .= "<BR>********************************************************************<BR>";
                                                                        $debugMsg .= "Debug vars withing log_in_authentication_form.php START<BR>";
                                                                        $debugMsg .= "<FONT COLOR=\"#4e9a06\">Token is valid for the user $UserLogin</FONT><BR>";
                                                                        $debugMsg .= "********************************************************************<BR>";
                                                                        // include("config/debug.php");
                                                                }      
                                                                //********************************************************************** DEBUG VARIABLES HERE - END
                                                                //*************************************************************************************************
                                                                // echo "You\'re already logged in as " . $login_name;
                                                               //echo "<TABLE>";
                                                               //echo "  <TR>";
                                                               // echo "          <TD>":
                                                                                include ("logOffLink.php");
                                                                                //echo "<DIV align=\"center\">";
                                                                //echo "          </TD>":
                                                                //echo "          <TD>":
                                                                                echo "<img src=\"images/spacer.gif\" width=\"20\" height=\"0\" alt=\"\" FACE=\"Arial\" SIZE=\"\"; COLOR=\"white\">";
                                                                ?>
                                                                </div>
                                                                <div class="six columns" style="margin-top: 1%; text-align: center">
                                                                <?PHP
                                                                echo "<TABLE>";
                                                                echo "  <TR>";
                                                                                user_button($UserID);
                                                                                echo "<img src=\"images/spacer.gif\" width=\"5\" height=\"0\" alt=\"\" FACE=\"Arial\" SIZE=\"\"; COLOR=\"white\">";
                                                                //echo "          </TD>":
                                                                //echo "          <TD>":
                                                                                // echo "<FONT color=\"blue\">\$UserID = $UserID</FONT><BR>";
                                                                                // echo "<form method=\"post\" action=\"$PHP_SELF\">";
                                                                                echo "  <form method=\"post\" class=\"form-inline\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\">";
                                                                                echo "  <input type=\"hidden\" name=\"user_authenticated\" value=\"\">";
                                                                                echo "  <input type=\"hidden\" name=\"login_instance_token\" value=\"\">";
                                                                                echo "  <input type=\"hidden\" name=\"name\" value=\"\">";
                                                                                echo "  <input type=\"hidden\" name=\"pass\" value=\"\">";
                                                                                echo "  <input type=\"hidden\" name=\"login_UserID\" value=\"\">";
                                                                                // echo "$login_name <input class=\"inputA\" type=\"submit\" name=\"action\" value=\" Log Off\">";
                                                                                echo "  <input class=\"inputA\" type=\"submit\" name=\"action\" style=\"padding: 0px 20px;\" value=\" Log Off\">";
                                                                                echo "  </form>";
                                                                                // echo "</div> ";
                                                                //echo "          </TD>":
                                                                echo "  </TR>";
                                                                echo "</TABLE>";
                                                                // echo "<A href=\"./peopleDetail001.php\"> view profile-> </A>" . $_SESSION['loginMsg'] . "</div>";
                                                                ?>
                                                                </div>
                                                        </div>
                                                </div>
                                                <?PHP
                                        } else {
                                                echo "<FONT COLOR=\"#FF0000\">Invalid token for the user $UserLogin</FONT><BR>";
                                                // echo "<FONT class=\"error_codes\">Invalid token for the user $UserLogin</FONT><BR>";
                                                // echo "Log Indd<br></br>";
                                                $_POST['login_instance_token'] = mt_rand(10000,99999);
		                                // echo "<form class=\"formB\" action=" . $_SERVER['PHP_SELF']; . " method=\"post\">";
		                                // echo "<form method=\"post\" action=\"$PHP_SELF\">";
		                                /**
		                                echo "<form method=\"post\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\">";
		                                        echo "<input type=\"hidden\" name=\"login_instance_token\" value=\"$login_instance_token\">";
		                                        echo "Name <input class=\"inputA\" type=\"text\" name=\"name\" size=\"5\">";
			                                echo "Pass <input class=\"inputA\" type=\"password\" name=\"pass\" size=\"5\">";
			                                echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"login\">";
		                                echo "</form>";
		                                echo "</div> ";
		                                */
		                                ?>                      
                                                <div class="container">
                                                        <div class="row">
                                                                <div class="four columns" style="margin-top: 5%; text-align: center">
                                                                        <?PHP 
                                                                        echo "<form method=\"post\" class=\"form-inline\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\">";
                                                                        echo "<input type=\"hidden\" name=\"login_instance_token\" value=\"$login_instance_token\">";
                                                                        echo "<input placeholder=\"Name\" type=\"text\" name=\"name\" size=\"9\">"; 
                                                                        ?>                                      
                                                                </div>
                                                                <div class="four columns" style="margin-top: 5%; text-align: center">
                                                                        <?PHP 
                                                                        echo "<input placeholder=\"Pass\" type=\"password\" name=\"pass\" size=\"9\">"; 
                                                                        ?>
                                                                </div>
                                                                <div class="four columns" style="margin-top: 5%; text-align: center">
                                                                        <?PHP 
                                                                        echo "<input type=\"submit\" name=\"action\" value=\"login\">";
	                                                                echo "</form>"; 
	                                                                ?>
                                                                </div>
                                                        </div>
                                                </div>
                                                <?PHP
		                                exit;
                                        } 
                                }    
                        } 
                //******************************************************************************* TOKEN CHECK - END
                //*************************************************************************************************
			
	}
				
//*************************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
	/** $debug = $_POST['debug'];
	$turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
	$debugMsg .= "<BR>********************************************************************<BR>";
	$debugMsg .= "Debug vars withing log_in_authentication_form.php START<BR>";
	$debugMsg .= "\$UserID = $UserID<BR>";
	$debugMsg .= "\$user_authenticated = $user_authenticated<BR>";
	$debugMsg .= "\$tab_cluster = $tab_cluster<BR>";
	$debugMsg .= "\$_POST['login_instance_token'] = " . $_POST['login_instance_token'] . "<BR>"; 
	$debugMsg .= "\$login_instance_token = " . $login_instance_token . "<BR>";
	$debugMsg .= "\$_POST['User_db_token'] = " . $_POST['User_db_token'] . "<BR>"; 
	$debugMsg .= "\$User_db_token = " . $User_db_token . "<BR>";
	$debugMsg .= "\$login_name = " . $login_name . "<BR>";
	$debugMsg .= "Debug vars withing log_in_authentication_check.php END<BR>";
	$debugMsg .= "********************************************************************<BR>";
	// include("config/debug.php"); 
	}
	*/
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************


	/** Old form code being kept just in case
			if( $user_authenticated  == 1 ) {
				// $_SESSION['active'] = "yes";
				$login_msg = " $login_name  <A class=\"linkPlainInWhiteAreas\" href=\"./sessionLogout.php\">LogOff </A>";
				$_SESSION['UserID'] = $UserID;
			
			}elseif((isset($_POST['name']) && isset($_POST['pass']))&&($login_name==$_POST['name'] && $login_pass==$_POST['pass'])){
				echo "Why does this section of the elseif statement exist?<BR><BR>";
				// $_SESSION['peopleLoggedIn'] = 1;
				// $_SESSION['peopleLoggedInName'] = $login_name;
				// $_SESSION['active'] = "yes";
				// $_SESSION['loginMsg'] =  " <A class=\"linkPlainInWhiteAreas\" href=\"./sessionLogout.php\">LogOff </A>  $login_name ";

                        }else{
				// $_SESSION['peopleLoggedIn'] = 0;
				$user_authenticated  = 0;
				loginMsg =  "Access Denied!! Please check your username and password or sign up <A class=\"linkPlainInWhiteAreas\" href=\"./join001.php\">here </A>";
			} */
				
				
?>
