<?PHP
//echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";
$user_authenticated = $_POST['user_authenticated'];
$login_name = $_POST['name'];
$login_pass = $_POST['pass'];

//echo "\$user_authenticated at the top of log_in_authentication_check = " . $user_authenticated . "<BR>";
if (empty($user_authenticated)) {
    $user_authenticated = 0;
    $_POST['user_authenticated'] = $user_authenticated;
}

$dbslog = new dbSession();

$sqllog = "SELECT * from user WHERE UserLogin = '" . $_POST['name'] . "'";
//$sqllog = "SELECT * from user WHERE UserActive = 1";
$Resultslog = $dbslog->getResult($sqllog);

/**
Compare current $_POST username and password to the ones in the DB and return
$user_authenticated to say w
 */


while ($rowlog = $dbslog->getArray($Resultslog)) {
    $peopleName = $rowlog['UserLogin'];
    $peoplePwd = $rowlog['UserPassword'];
    $UserID = $rowlog['UserID'];
    $User_db_token = $rowlog['User_db_token'];
    $_POST['User_db_token'] = $User_db_token;

    // if ( $_SESSION['peopleLoggedIn'] == 1 ) {
    //$login_name = $_SESSION['peopleLoggedInName'];
    // $login_name = $_POST['name'];

    if ( empty($_POST['name']) || empty($_POST['pass']) ) {
        //echo "hello from log_in_auth_check.php 2<BR>";
        echo "You have not entered a username or password.<BR>";
        $login_name = 'noLogon';
        $peopleName = 'noLogon';
        $peoplePwd = 'noLogon';
        $user_authenticated  = 0;
        $_POST['user_authenticated'] = $user_authenticated;
        $_POST['name'] = 'noLogon';
        $_POST['pass'] = 'noLogon';
        $User_db_token = 0;
    }elseif ( ($peopleName == $_POST['name']) && ($peoplePwd == $_POST['pass']) && ($_POST['user_authenticated'] == 0) ) {
        $user_authenticated  = 1;
        $_POST['user_authenticated'] = $user_authenticated;
        //$_POST['login_instance_token'] = mt_rand(10000,99999);
        $login_instance_token = $_POST['login_instance_token'];
        $login_UserID = $row['UserID'];
        $dbs_insert_token = new dbSession();

        $sql_insert_token = "UPDATE user SET User_db_token = '$login_instance_token' WHERE UserID = '$UserID'";

        if ($dbs_insert_token->getResult($sql_insert_token)) {
            $msg = "Token created in DB.";
            //*************************************************************************************************
            //******************************************************************** DEBUG VARIABLES HERE - START
            $turn_this_debug_on = 1;
            if ($turn_this_debug_on == 1) {
                // $debug = $_POST['debug'];
                $debugMsg .= "<BR>********************************************************************<BR>";
                $debugMsg .= "Debug vars withing log_in_authentication_check.php START<BR>";
                $debugMsg .= "<FONT COLOR=\"#4e9a06\">Token message = $msg</FONT><BR>";
                $debugMsg .= "\$_POST['login_instance_token'] = " . $_POST['login_instance_token'] . "<BR>";
                $debugMsg .= "\$peoplePwd = $peoplePwd <BR>";
                $debugMsg .= "********************************************************************<BR>";
                // include("config/debug.php");
            }
            //********************************************************************** DEBUG VARIABLES HERE - END
            //*************************************************************************************************
        } else {
            $msg = $dbs_insert_token->printError();
            //*************************************************************************************************
            //******************************************************************** DEBUG VARIABLES HERE - START
            $turn_this_debug_on = 0;
            if ($turn_this_debug_on == 1) {
                // $debug = $_POST['debug'];
                $debugMsg .= "<BR>********************************************************************<BR>";
                $debugMsg .= "Debug vars withing log_in_authentication_check.php START<BR>";
                $debugMsg .= "<FONT COLOR=\"#a40000\">Token message = $msg</FONT><BR>";
                $debugMsg .= "********************************************************************<BR>";
                // include("config/debug.php");
            }
            //********************************************************************** DEBUG VARIABLES HERE - END
            //*************************************************************************************************
        }


    } elseif ( ($peopleName != $_POST['name']) || ($peoplePwd != $_POST['pass']) ) {
        /* echo "here at the end<br>"; */
        $user_authenticated  = 0;
        $User_db_token = 0;
        $_POST['user_authenticated'] = $user_authenticated;
    }

}
/* echo "\$user_authenticated at bottom of check = $user_authenticated <br>";
echo "\$user_authenticated POSTtttt = " . $_POST['user_authenticated'] . " <br>";
echo "\$User_db_token at bottom of check = $User_db_token <br>";
echo "\$User_db_token_POST at bottom of check = " .  $_POST[$User_db_token] . "<br>"; */
$dbslog = new dbSession();
$sqllog = "SELECT * from user WHERE UserID = $UserID";
$Resultslog = $dbslog->getResult($sqllog);
/**
Ge the current token now that it's been updated after logon.
 */
while ($rowlog = $dbslog->getArray($Resultslog)) {
    if ($user_authenticated == 1) {
        $User_db_token = $rowlog['User_db_token'];
    }
    $peopleName = $rowlog['UserLogin'];
    $peoplePwd = $rowlog['UserPassword'];
    $_POST['User_db_token'] = $User_db_token;
    $user_time_zone = $rowlog['user_time_zone'];
    $_POST['user_time_zone'] = $user_time_zone;
    $_POST['config_time_zone'] = $user_time_zone;
    if ( ($peopleName == $_POST['name']) && ($peoplePwd == $_POST['pass']) && ($User_db_token == $login_instance_token) ) {

        $user_authenticated  = 1;
        $_POST['user_authenticated'] = $user_authenticated;
    }else{
        $user_authenticated  = 0;
        $_POST['user_authenticated'] = $user_authenticated;
    }
}
//*************************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 1;
if ($turn_this_debug_on == 1) {
    $debug = $_POST['debug'];
    $debugMsg .= "<FONT class=\"generalFontOnWhite\"><BR>********************************************************************<BR>";
    $debugMsg .= "Debug at the end of log_in_authentication_check.php START<BR>";
    $debugMsg .= "\$_POST['name'] =" . $_POST['name'] . "<BR>";
    $debugMsg .= "\$_POST['pass'] = " . $_POST['pass'] . "<BR>";
    $debugMsg .= "\$_POST['user_time_zone'] = " . $_POST['user_time_zone'] . "<BR>";
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
    $debugMsg .= "********************************************************************<BR></FONT>";
    //include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************


?>
