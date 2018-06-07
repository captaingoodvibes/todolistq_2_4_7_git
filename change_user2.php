<?php
//**********************************************************************************************
//***************************************************************************** INCLUDES - START
// include("config/headAndBody001.php");
/**$user_authenticated = $_POST['user_authenticated'];
$login_instance_token = $_POST['login_instance_token'];
$login_name = $_POST['name'];
$login_pass = $_POST['pass'];
$login_UserID = $_POST['UserID']; */
// include("config/config.php");
// include("config/tpl_bodystart.php");
include("config/dbSession.class");
//include("config/standardPageBits.php");
//include("log_in_authentication_check.php");
//include("config/topIndex002.php");
//include("config/ssl.php");
//include("searchFunctions.php");
//include("user_card_with_time_limits_ajax_functions.php");
//include("log_in_authentication_form.php");
//include("logged_in_start_of_page.php"); */
//******************************************************************************* INCLUDES - END
//**********************************************************************************************


//**********************************************************************************************
//*************************************************************** SWITCHING POST AND GET - START
if ($_GET['OptionCatch'] == "show_user") {
	$_POST['OptionCatch'] = "show_user";
}
if ($_GET['OptionCatch'] == "SearchClient5") {
	$_POST['OptionCatch'] = "SearchClient5";
}
if ($_GET['OptionCatch'] == "EditDetails") {
	$_POST['OptionCatch'] = "EditDetails";
}
//***************************************************************** SWITCHING POST AND GET - END
//**********************************************************************************************

//**********************************************************************************************
//********************************************************************* GLOBAL VARIABLES - START
$page_load = $_GET['page_load'];
//*********************************************************************** GLOBAL VARIABLES - END
//**********************************************************************************************


//**********************************************************************************************
//****************************************************************************** CATCHES - START
// If adduser is slected then goto the adduser function
// $OptionCatch="AddUser";
switch ($_POST['OptionCatch']) {
	case "show_user";
		show_user();
		break;
	case "EditDetails";
		edit_details();
		break;
}
//******************************************************************************** CATCHES - END
//**********************************************************************************************


//**********************************************************************************************
//********************************************************************************** MAIN- START


//*********************************************************************************** MAIN - END
//**********************************************************************************************


function show_user(){
//**********************************************************************************************
//********************************************************************* GLOBAL VARIABLES - START
$user_ID_to_display =$_GET['user_ID_to_display'];
$UserFirstName_to_display =$_GET['UserFirstName_to_display'];
$field_to_display =$_GET['field_to_display'];
$field_contents_to_display =$_GET['field_contents_to_display'];
$page_load = $_GET['page_load'];
//*********************************************************************** GLOBAL VARIABLES - END
//**********************************************************************************************
// $q = intval($_GET['q']);
$q = $_GET['q'];
//**********************************************************************************************
//********************************************************************************* DEBUG- START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
echo "Inside change_user2.php<BR>";
echo "\$_GET['UserID'] = " . $_GET['UserID'] . "<BR>";
echo "\$q first instance = " . $q. "<BR>";
}
//*********************************************************************************** DEBUG- END
//**********************************************************************************************

//*************************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
       $debug = $_POST['debug'];
        $debugMsg .= "<BR>********************************************************************<BR>";
        $debugMsg .= "Debug in InsertClient() in change_user2.php top section<BR>";
        $debugMsg .= "\$_POST['page_load'] = " . $_POST['page_load'] . "<BR>";
        $debugMsg .= "\$_GET['page_load'] = " . $_GET['page_load'] . "<BR>";
        $debugMsg .= "\$page_load = " . $page_load . "<BR>";
        $debugMsg .= "\$_GET['field_to_display'] = " . $_GET['field_to_display'] . "<BR>";
        $debugMsg .= "\$_GET['field_contents_to_display'] = " . $_GET['field_contents_to_display'] . "<BR>";
        $debugMsg .= "\$q intal = " . $q. "<BR>";
        $debugMsg .= "\$_POST['user_ID_to_display'] = " . $_POST['user_ID_to_display'] . "<BR>";
        $debugMsg .= "\$_GET['user_ID_to_display'] = " . $_GET['user_ID_to_display'] . "<BR>";
        $debugMsg .= "\$_GET['q'] = " . $_GET['q'] . "<BR>";
        $debugMsg .= "\$_GET['UserFirstName_to_display'] = " . $_GET['UserFirstName_to_display'] . "<BR>";
        $debugMsg .= "\$_POST['OptionCatch'] = " . $_POST['OptionCatch'] . "<BR>";
        $debugMsg .= "\$_GET['OptionCatch'] = " . $_GET['OptionCatch'] . "<BR>";
        $debugMsg .= "\$sql = $sql<BR>";
        $debugMsg .= "********************************************************************<BR>";
        //include("config/debug.php");
        echo $debugMsg;
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************

//$con2 = mysqli_connect('localhost','live','Ramjet44','live');
$dbs_display = new dbSession();
//mysqli_select_db($con2,"live");
$sql2="SELECT * FROM user WHERE UserID = '$user_ID_to_display'";
//*************************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
       $debug = $_POST['debug'];
        $debugMsg .= "<BR>********************************************************************<BR>";
        $debugMsg .= "Debug in InsertClient() in change_user2.php bottom section.<BR>";
        $debugMsg .= "\$q intal = " . $q. "<BR>";
        $debugMsg .= "\$_POST['user_ID_to_display'] = " . $_POST['user_ID_to_display'] . "<BR>";
        $debugMsg .= "\$_GET['user_ID_to_display'] = " . $_GET['user_ID_to_display'] . "<BR>";
        $debugMsg .= "\$_GET['q'] = " . $_GET['q'] . "<BR>";
        $debugMsg .= "\$_GET['UserFirstName_to_display'] = " . $_GET['UserFirstName_to_display'] . "<BR>";
        $debugMsg .= "\$_POST['OptionCatch'] = " . $_POST['OptionCatch'] . "<BR>";
        $debugMsg .= "\$_GET['OptionCatch'] = " . $_GET['OptionCatch'] . "<BR>";
        $debugMsg .= "\$sql = $sql<BR>";
        $debugMsg .= "\$sql2 = $sql2<BR>";
        $debugMsg .= "********************************************************************<BR>";
        //include("config/debug.php");
        echo $debugMsg;
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************
//$result2 = mysqli_query($con2,$sql2);
$Results_display = $dbs_display->getResult($sql2);
// while($row = mysqli_fetch_array($result2)) {
while ($row = $dbs_display->getArray($Results_display)) {
//**********************************************************************************************
//********************************************************************************* DEBUG- START
/**
echo "\$q just before this name is= " . $q . "<BR>"; 
echo "\$$UserID  just before this name is= " . $UserID  . "<BR>"; 

echo "\$_GET['q'] = " . $_GET['q'] . "<BR>";
*/
//*********************************************************************************** DEBUG- END
//**********************************************************************************************
$UserActive = $row[UserActive];

$user_creation_second = $row[UserDate];
$user_creation_date = date("H:i:s d-M-Y",$user_creation_second);
	
if ($UserActive == 1) {
	$userAllreadyActive = 1;
} else {
	$userAllreadyActive = 0;
}


if ($UserActive == 1) {
	$UserActiveYes = "checked";
	$UserActiveNo = "";
} else {
	$UserActiveYes = "";
	$UserActiveNo = "checked";
}
echo "  <div align=\"center\">
        
        <!-- <H1>User Card</H1> -->";
$header_size = $_POST['header_size'];
echo "<H" . $header_size . ">User Card</H" . $header_size . ">";
        
?>                      
<div class="container">
        <div class="row">
                <div class="six columns box" style="margin-top: 5%; text-align: center">
                        <?PHP 
                        echo "
                        <input type=\"hidden\" name=\"OptionCatch\" value=\"EditDetails\">
                        <input type=\"hidden\" name=\"user_ID_to_display\" value=\"$user_ID_to_display\">
	                <TABLE>
		                <TR>
			                <TD>UserLogin</TD>
			                <TD>
			                <input type=\"text\" name=\"UserLogin_to_display\" tabindex=\"1\"  value=\"$row[UserLogin]\" onchange=\"change_user('UserLogin',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserPassword</TD>
			                <TD>
			                <input type=\"password\" name=\"UserPassword_to_display\" tabindex=\"2\"  value=\"$row[UserPassword]\" onchange=\"change_user('UserPassword',this.value,$user_ID_to_display)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>Creation Date</TD>
			                <TD>$user_creation_date</TD>
		                </TR>
		                <TR>
			                <TD>UserFirstname</TD>
			                <TD>
			                <input type=\"text\" name=\"UserFirstName_to_display\" tabindex=\"4\"  value=\"$row[UserFirstname]\" onchange=\"change_user('UserFirstName',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserLastname</TD>
			                <TD>
			                <input type=\"text\" name=\"UserLastname_to_display\" tabindex=\"5\"  value=\"$row[UserLastname]\" onchange=\"change_user('UserLastname',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserAddress1</TD>
			                <TD>
			                <input type=\"text\" name=\"UserAddress1_to_display\" tabindex=\"6\"  value=\"$row[UserAddress1]\" onchange=\"change_user('UserAddress1',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserAddress2</TD>
			                <TD>
			                <input type=\"text\" name=\"UserAddress2_to_display\" tabindex=\"7\"  value=\"$row[UserAddress2]\" onchange=\"change_user('UserAddress2',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserCity</TD>
			                <TD>
			                <input type=\"text\" name=\"UserCity_to_display\" tabindex=\"8\"  value=\"$row[UserCity]\" onchange=\"change_user('UserCity',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserState</TD>
			                <TD>
			                <input type=\"text\" name=\"UserState_to_display\" tabindex=\"9\"  value=\"$row[UserState]\" onchange=\"change_user('UserState',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD></TD>
			                <TD></TD>
		                </TR>
	                </TABLE>"; 
                ?>
                </div>
                <div class="six columns" style="margin-top: 5%; text-align: center">
                <?PHP 
                        echo "
	                <TABLE>
		                <TR>
			                <TD>UserPostcode</TD>
			                <TD>
			                <input type=\"text\" name=\"UserPostcode_to_display\" tabindex=\"10\"  value=\"$row[UserPostcode]\" onchange=\"change_user('UserPostcode',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserCountry.</TD>
			                <TD>
			                <input type=\"text\" name=\"UserCountry_to_display\" tabindex=\"12\"  value=\"$row[UserCountry]\" onchange=\"change_user('UserCountry',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserPhone1</TD>
			                <TD>
			                <input type=\"text\" name=\"UserPhone1_to_display\" tabindex=\"13\"  value=\"$row[UserPhone1]\" onchange=\"change_user('UserPhone1',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserPhone2</TD>
			                <TD>
			                <input type=\"text\" name=\"UserPhone2_to_display\" tabindex=\"14\"  value=\"$row[UserPhone2]\" onchange=\"change_user('UserPhone2',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserFax</TD>
			                <TD>
			                <input type=\"text\" name=\"UserFax_to_display\" tabindex=\"15\"  value=\"$row[UserFax]\" onchange=\"change_user('UserFax',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserEmail</TD>
			                <TD>
			                <input type=\"text\" name=\"UserEmail_to_display\" tabindex=\"16\"  value=\"$row[UserEmail]\" onchange=\"change_user('UserEmail',this.value,$user_ID_to_display,0)\"></input>
			                <a tabindex=\"16.5\" href=\"mailto:" . $row['UserEmail'] . "\">Send</a>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserUrl</TD>
			                <TD>
			                <input type=\"text\" name=\"UserUrl_to_display\" tabindex=\"17\"  value=\"$row[UserUrl]\" onchange=\"change_user('UserUrl',this.value,$user_ID_to_display,0)\"></input>
			                <A  tabindex=\"17.5\" href=\"http://" . $row['UserUrl'] . "\"target=\"_blank\">Go</A>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserActive</TD>
			                <TD>
			                <input type=\"radio\" name=\"UserActive_to_display\" tabindex=\"17\"  value=\"0\" onchange=\"change_user('UserActive',this.value,$user_ID_to_display,0)\" $UserActiveNo>No 
			                <input type=\"radio\" name=\"UserActive_to_display\" tabindex=\"17.5\"  value=\"1\" onchange=\"change_user('UserActive',this.value,$user_ID_to_display,0)\" $UserActiveYes>Yes 
			                </TD>
		                </TR>
		                <TR>
			                <TD>User ID</TD>
			                <TD>$user_ID_to_display</TD>
		                </TR>
		                <TR>
			                <TD colspan=\"2\">Time Zone
			                ";
				
			                $dbs_time_zone = new dbSession();
			                $sql = "SELECT user_time_zone FROM user WHERE UserID = '$user_ID_to_display' ";
			                $Results = $dbs_time_zone->getResult($sql);
			                $row = $dbs_time_zone->getArray($Results);
			                //echo "\$row = $row<BR>";
			                $user_time_zone = $row['user_time_zone'];
			                //echo "\$user_time_zone = $user_time_zone<BR>";
			                echo "  <SELECT name=\"user_time_zone\" tabindex=\"18\" onchange=\"change_user('user_time_zone',this.value,$user_ID_to_display,0)\">"; 
			                echo "  <OPTION value=\"$user_time_zone\" selected=\"selected\">$user_time_zone"; 
			                // echo "  <OPTION value=\"Australia/Perth\">Australia/Perth";
			                // echo "  <OPTION value=\"Australia/Sydney\">Australia/Sydney";
			                // echo "  <OPTION value=\"Australia/Adelaide\">Australia/Adelaide";
        ?>
                                                <option value="Pacific/Midway">(UTC-11:00) Midway Island</option>
                                                <option value="Pacific/Samoa">(UTC-11:00) Samoa</option>
                                                <option value="Pacific/Honolulu">(UTC-10:00) Hawaii</option>
                                                <option value="US/Alaska">(UTC-09:00) Alaska</option>
                                                <option value="America/Los_Angeles">(UTC-08:00) Pacific Time (US &amp; Canada)</option>
                                                <option value="America/Tijuana">(UTC-08:00) Tijuana</option>
                                                <option value="US/Arizona">(UTC-07:00) Arizona</option>
                                                <option value="America/Chihuahua">(UTC-07:00) Chihuahua</option>
                                                <option value="America/Chihuahua">(UTC-07:00) La Paz</option>
                                                <option value="America/Mazatlan">(UTC-07:00) Mazatlan</option>
                                                <option value="US/Mountain">(UTC-07:00) Mountain Time (US &amp; Canada)</option>
                                                <option value="America/Managua">(UTC-06:00) Central America</option>
                                                <option value="US/Central">(UTC-06:00) Central Time (US &amp; Canada)</option>
                                                <option value="America/Mexico_City">(UTC-06:00) Guadalajara</option>
                                                <option value="America/Mexico_City">(UTC-06:00) Mexico City</option>
                                                <option value="America/Monterrey">(UTC-06:00) Monterrey</option>
                                                <option value="Canada/Saskatchewan">(UTC-06:00) Saskatchewan</option>
                                                <option value="America/Bogota">(UTC-05:00) Bogota</option>
                                                <option value="US/Eastern">(UTC-05:00) Eastern Time (US &amp; Canada)</option>
                                                <option value="US/East-Indiana">(UTC-05:00) Indiana (East)</option>
                                                <option value="America/Lima">(UTC-05:00) Lima</option>
                                                <option value="America/Bogota">(UTC-05:00) Quito</option>
                                                <option value="Canada/Atlantic">(UTC-04:00) Atlantic Time (Canada)</option>
                                                <option value="America/Caracas">(UTC-04:30) Caracas</option>
                                                <option value="America/La_Paz">(UTC-04:00) La Paz</option>
                                                <option value="America/Santiago">(UTC-04:00) Santiago</option>
                                                <option value="Canada/Newfoundland">(UTC-03:30) Newfoundland</option>
                                                <option value="America/Sao_Paulo">(UTC-03:00) Brasilia</option>
                                                <option value="America/Argentina/Buenos_Aires">(UTC-03:00) Buenos Aires</option>
                                                <option value="America/Argentina/Buenos_Aires">(UTC-03:00) Georgetown</option>
                                                <option value="America/Godthab">(UTC-03:00) Greenland</option>
                                                <option value="America/Noronha">(UTC-02:00) Mid-Atlantic</option>
                                                <option value="Atlantic/Azores">(UTC-01:00) Azores</option>
                                                <option value="Atlantic/Cape_Verde">(UTC-01:00) Cape Verde Is.</option>
                                                <option value="Africa/Casablanca">(UTC+00:00) Casablanca</option>
                                                <option value="Europe/London">(UTC+00:00) Edinburgh</option>
                                                <option value="Etc/Greenwich">(UTC+00:00) Greenwich Mean Time : Dublin</option>
                                                <option value="Europe/Lisbon">(UTC+00:00) Lisbon</option>
                                                <option value="Europe/London">(UTC+00:00) London</option>
                                                <option value="Africa/Monrovia">(UTC+00:00) Monrovia</option>
                                                <option value="UTC">(UTC+00:00) UTC</option>
                                                <option value="Europe/Amsterdam">(UTC+01:00) Amsterdam</option>
                                                <option value="Europe/Belgrade">(UTC+01:00) Belgrade</option>
                                                <option value="Europe/Berlin">(UTC+01:00) Berlin</option>
                                                <option value="Europe/Berlin">(UTC+01:00) Bern</option>
                                                <option value="Europe/Bratislava">(UTC+01:00) Bratislava</option>
                                                <option value="Europe/Brussels">(UTC+01:00) Brussels</option>
                                                <option value="Europe/Budapest">(UTC+01:00) Budapest</option>
                                                <option value="Europe/Copenhagen">(UTC+01:00) Copenhagen</option>
                                                <option value="Europe/Ljubljana">(UTC+01:00) Ljubljana</option>
                                                <option value="Europe/Madrid">(UTC+01:00) Madrid</option>
                                                <option value="Europe/Paris">(UTC+01:00) Paris</option>
                                                <option value="Europe/Prague">(UTC+01:00) Prague</option>
                                                <option value="Europe/Rome">(UTC+01:00) Rome</option>
                                                <option value="Europe/Sarajevo">(UTC+01:00) Sarajevo</option>
                                                <option value="Europe/Skopje">(UTC+01:00) Skopje</option>
                                                <option value="Europe/Stockholm">(UTC+01:00) Stockholm</option>
                                                <option value="Europe/Vienna">(UTC+01:00) Vienna</option>
                                                <option value="Europe/Warsaw">(UTC+01:00) Warsaw</option>
                                                <option value="Africa/Lagos">(UTC+01:00) West Central Africa</option>
                                                <option value="Europe/Zagreb">(UTC+01:00) Zagreb</option>
                                                <option value="Europe/Athens">(UTC+02:00) Athens</option>
                                                <option value="Europe/Bucharest">(UTC+02:00) Bucharest</option>
                                                <option value="Africa/Cairo">(UTC+02:00) Cairo</option>
                                                <option value="Africa/Harare">(UTC+02:00) Harare</option>
                                                <option value="Europe/Helsinki">(UTC+02:00) Helsinki</option>
                                                <option value="Europe/Istanbul">(UTC+02:00) Istanbul</option>
                                                <option value="Asia/Jerusalem">(UTC+02:00) Jerusalem</option>
                                                <option value="Europe/Helsinki">(UTC+02:00) Kyiv</option>
                                                <option value="Africa/Johannesburg">(UTC+02:00) Pretoria</option>
                                                <option value="Europe/Riga">(UTC+02:00) Riga</option>
                                                <option value="Europe/Sofia">(UTC+02:00) Sofia</option>
                                                <option value="Europe/Tallinn">(UTC+02:00) Tallinn</option>
                                                <option value="Europe/Vilnius">(UTC+02:00) Vilnius</option>
                                                <option value="Asia/Baghdad">(UTC+03:00) Baghdad</option>
                                                <option value="Asia/Kuwait">(UTC+03:00) Kuwait</option>
                                                <option value="Europe/Minsk">(UTC+03:00) Minsk</option>
                                                <option value="Africa/Nairobi">(UTC+03:00) Nairobi</option>
                                                <option value="Asia/Riyadh">(UTC+03:00) Riyadh</option>
                                                <option value="Europe/Volgograd">(UTC+03:00) Volgograd</option>
                                                <option value="Asia/Tehran">(UTC+03:30) Tehran</option>
                                                <option value="Asia/Muscat">(UTC+04:00) Abu Dhabi</option>
                                                <option value="Asia/Baku">(UTC+04:00) Baku</option>
                                                <option value="Europe/Moscow">(UTC+04:00) Moscow</option>
                                                <option value="Asia/Muscat">(UTC+04:00) Muscat</option>
                                                <option value="Europe/Moscow">(UTC+04:00) St. Petersburg</option>
                                                <option value="Asia/Tbilisi">(UTC+04:00) Tbilisi</option>
                                                <option value="Asia/Yerevan">(UTC+04:00) Yerevan</option>
                                                <option value="Asia/Kabul">(UTC+04:30) Kabul</option>
                                                <option value="Asia/Karachi">(UTC+05:00) Islamabad</option>
                                                <option value="Asia/Karachi">(UTC+05:00) Karachi</option>
                                                <option value="Asia/Tashkent">(UTC+05:00) Tashkent</option>
                                                <option value="Asia/Calcutta">(UTC+05:30) Chennai</option>
                                                <option value="Asia/Kolkata">(UTC+05:30) Kolkata</option>
                                                <option value="Asia/Calcutta">(UTC+05:30) Mumbai</option>
                                                <option value="Asia/Calcutta">(UTC+05:30) New Delhi</option>
                                                <option value="Asia/Calcutta">(UTC+05:30) Sri Jayawardenepura</option>
                                                <option value="Asia/Katmandu">(UTC+05:45) Kathmandu</option>
                                                <option value="Asia/Almaty">(UTC+06:00) Almaty</option>
                                                <option value="Asia/Dhaka">(UTC+06:00) Astana</option>
                                                <option value="Asia/Dhaka">(UTC+06:00) Dhaka</option>
                                                <option value="Asia/Yekaterinburg">(UTC+06:00) Ekaterinburg</option>
                                                <option value="Asia/Rangoon">(UTC+06:30) Rangoon</option>
                                                <option value="Asia/Bangkok">(UTC+07:00) Bangkok</option>
                                                <option value="Asia/Bangkok">(UTC+07:00) Hanoi</option>
                                                <option value="Asia/Jakarta">(UTC+07:00) Jakarta</option>
                                                <option value="Asia/Novosibirsk">(UTC+07:00) Novosibirsk</option>
                                                <option value="Asia/Hong_Kong">(UTC+08:00) Beijing</option>
                                                <option value="Asia/Chongqing">(UTC+08:00) Chongqing</option>
                                                <option value="Asia/Hong_Kong">(UTC+08:00) Hong Kong</option>
                                                <option value="Asia/Krasnoyarsk">(UTC+08:00) Krasnoyarsk</option>
                                                <option value="Asia/Kuala_Lumpur">(UTC+08:00) Kuala Lumpur</option>
                                                <option value="Australia/Perth">(UTC+08:00) Perth</option>
                                                <option value="Asia/Singapore">(UTC+08:00) Singapore</option>
                                                <option value="Asia/Taipei">(UTC+08:00) Taipei</option>
                                                <option value="Asia/Ulan_Bator">(UTC+08:00) Ulaan Bataar</option>
                                                <option value="Asia/Urumqi">(UTC+08:00) Urumqi</option>
                                                <option value="Asia/Irkutsk">(UTC+09:00) Irkutsk</option>
                                                <option value="Asia/Tokyo">(UTC+09:00) Osaka</option>
                                                <option value="Asia/Tokyo">(UTC+09:00) Sapporo</option>
                                                <option value="Asia/Seoul">(UTC+09:00) Seoul</option>
                                                <option value="Asia/Tokyo">(UTC+09:00) Tokyo</option>
                                                <option value="Australia/Adelaide">(UTC+09:30) Adelaide</option>
                                                <option value="Australia/Darwin">(UTC+09:30) Darwin</option>
                                                <option value="Australia/Brisbane">(UTC+10:00) Brisbane</option>
                                                <option value="Australia/Canberra">(UTC+10:00) Canberra</option>
                                                <option value="Pacific/Guam">(UTC+10:00) Guam</option>
                                                <option value="Australia/Hobart">(UTC+10:00) Hobart</option>
                                                <option value="Australia/Melbourne">(UTC+10:00) Melbourne</option>
                                                <option value="Pacific/Port_Moresby">(UTC+10:00) Port Moresby</option>
                                                <option value="Australia/Sydney">(UTC+10:00) Sydney</option>
                                                <option value="Asia/Yakutsk">(UTC+10:00) Yakutsk</option>
                                                <option value="Asia/Vladivostok">(UTC+11:00) Vladivostok</option>
                                                <option value="Pacific/Auckland">(UTC+12:00) Auckland</option>
                                                <option value="Pacific/Fiji">(UTC+12:00) Fiji</option>
                                                <option value="Pacific/Kwajalein">(UTC+12:00) International Date Line West</option>
                                                <option value="Asia/Kamchatka">(UTC+12:00) Kamchatka</option>
                                                <option value="Asia/Magadan">(UTC+12:00) Magadan</option>
                                                <option value="Pacific/Fiji">(UTC+12:00) Marshall Is.</option>
                                                <option value="Asia/Magadan">(UTC+12:00) New Caledonia</option>
                                                <option value="Asia/Magadan">(UTC+12:00) Solomon Is.</option>
                                                <option value="Pacific/Auckland">(UTC+12:00) Wellington</option>
                                                <option value="Pacific/Tongatapu">(UTC+13:00) Nuku'alofa</option>
                                                <?PHP
			                echo "  </SELECT>
                                        </TD>
		                </TR>
	                </TABLE>"; 
                ?>
                </div>
        </div>
</div>
<?PHP  
                        
}
mysqli_close($con);
}

function edit_details(){
//**********************************************************************************************
//********************************************************************* GLOBAL VARIABLES - START
$user_ID_to_display =$_GET['user_ID_to_display'];
$UserFirstName_to_display =$_GET['UserFirstName_to_display'];
$field_to_display =$_GET['field_to_display'];
$field_contents_to_display =$_GET['field_contents_to_display'];
$page_load = $_GET['page_load'];
//*********************************************************************** GLOBAL VARIABLES - END
//**********************************************************************************************
// $q = intval($_GET['q']);
$q = $_GET['q'];
//**********************************************************************************************
//********************************************************************************* DEBUG- START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
echo "Inside change_user2.php<BR>";
echo "\$_GET['UserID'] = " . $_GET['UserID'] . "<BR>";
echo "\$q first instance = " . $q. "<BR>";
echo "here in edit_details()<BR>";
echo "\$field_to_display = $field_to_display <BR>";
echo "\$field_contents_to_display = $field_contents_to_display <BR>";
echo "\$user_ID_to_display = $user_ID_to_display <BR>";
}
//*********************************************************************************** DEBUG- END
//**********************************************************************************************
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
        $debugMsg .= "Debug in edit_details() in change_user2.php<BR>";
        $debugMsg .= "\$max_active_users_exceeded = $max_active_users_exceeded<BR>";
        $debugMsg .= "\$active_users = $active_users <BR>";
        $debugMsg .= "********************************************************************<BR>";
        include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************
if($active_users < $max_active_users_allowed){
}else{
        echo    "You are only allowed " . $max_active_users_allowed . " active users at one time.<BR><BR>
                Please purchase an upgrade here or disable a user in order to add another.<BR>";
        if ($field_to_display == 'UserActive'){
                $field_contents_to_display = 0;
        }
}
        $dbs_u2 = new dbSession();
        //$sql="UPDATE user SET UserFirstname = '$UserFirstName_to_display' WHERE UserID = '$user_ID_to_display'";
        $sql_u2="UPDATE user SET $field_to_display = '$field_contents_to_display' WHERE UserID = '$user_ID_to_display' ";

        //$sql = "UPDATE user SET UserActive = '$UserActive' WHERE UserID = '$id'";
        // $Results = $dbs->getResult($sql);
        // $sdfgsd = $dbs_u2->getResult($sql_u2);

        if($dbs_u2->getResult($sql_u2)) {
                echo "<font class=\"edit_success\">Card Edited</font>";
        } else {
	        $msg = $dbs_u2->printError();
	        echo "<BR>$msg";
	        echo "<font class=\"edit_fail\">Card Edit failed</font>";
                $page_load = 0;
                echo "wahoo<BR>";
        }
        /**
        if (mysqli_query($con,$sql) ) {
                echo "<font class=\"edit_success\">Card Edited</font>";
        }elseif ($page_load != 1){
                echo "<font class=\"edit_fail\">Card Edit failed</font>";
                $page_load = 0;
        }else{
                echo "<BR>";
        } */

        // while($row = mysqli_fetch_array($result))
        /** while($row = mysqli_query($result))
          {
                
        mysqli_close($con2); */

        //*************************************************************************************************
        //******************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
               $debug = $_POST['debug'];
                $debugMsg .= "<BR>********************************************************************<BR>";
                $debugMsg .= "Debug in InsertClient() in change_user2.php top section<BR>";
                $debugMsg .= "\$_POST['page_load'] = " . $_POST['page_load'] . "<BR>";
                $debugMsg .= "\$_GET['page_load'] = " . $_GET['page_load'] . "<BR>";
                $debugMsg .= "\$page_load = " . $page_load . "<BR>";
                $debugMsg .= "\$_GET['field_to_display'] = " . $_GET['field_to_display'] . "<BR>";
                $debugMsg .= "\$_GET['field_contents_to_display'] = " . $_GET['field_contents_to_display'] . "<BR>";
                $debugMsg .= "\$q intal = " . $q. "<BR>";
                $debugMsg .= "\$_POST['user_ID_to_display'] = " . $_POST['user_ID_to_display'] . "<BR>";
                $debugMsg .= "\$_GET['user_ID_to_display'] = " . $_GET['user_ID_to_display'] . "<BR>";
                $debugMsg .= "\$_GET['q'] = " . $_GET['q'] . "<BR>";
                $debugMsg .= "\$_GET['UserFirstName_to_display'] = " . $_GET['UserFirstName_to_display'] . "<BR>";
                $debugMsg .= "\$_POST['OptionCatch'] = " . $_POST['OptionCatch'] . "<BR>";
                $debugMsg .= "\$_GET['OptionCatch'] = " . $_GET['OptionCatch'] . "<BR>";
                $debugMsg .= "\$sql = $sql<BR>";
                $debugMsg .= "********************************************************************<BR>";
                //include("config/debug.php");
                echo $debugMsg;
        }
        //********************************************************************** DEBUG VARIABLES HERE - END
        //*************************************************************************************************

        //$con2 = mysqli_connect('localhost','live','Ramjet44','live');
        $dbs_display = new dbSession();
        //mysqli_select_db($con2,"live");
        $sql2="SELECT * FROM user WHERE UserID = '$user_ID_to_display'";
        //*************************************************************************************************
        //******************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
               $debug = $_POST['debug'];
                $debugMsg .= "<BR>********************************************************************<BR>";
                $debugMsg .= "Debug in InsertClient() in change_user2.php bottom section.<BR>";
                $debugMsg .= "\$q intal = " . $q. "<BR>";
                $debugMsg .= "\$_POST['user_ID_to_display'] = " . $_POST['user_ID_to_display'] . "<BR>";
                $debugMsg .= "\$_GET['user_ID_to_display'] = " . $_GET['user_ID_to_display'] . "<BR>";
                $debugMsg .= "\$_GET['q'] = " . $_GET['q'] . "<BR>";
                $debugMsg .= "\$_GET['UserFirstName_to_display'] = " . $_GET['UserFirstName_to_display'] . "<BR>";
                $debugMsg .= "\$_POST['OptionCatch'] = " . $_POST['OptionCatch'] . "<BR>";
                $debugMsg .= "\$_GET['OptionCatch'] = " . $_GET['OptionCatch'] . "<BR>";
                $debugMsg .= "\$sql = $sql<BR>";
                $debugMsg .= "\$sql2 = $sql2<BR>";
                $debugMsg .= "********************************************************************<BR>";
                //include("config/debug.php");
                echo $debugMsg;
        }
        //********************************************************************** DEBUG VARIABLES HERE - END
        //*************************************************************************************************
        //$result2 = mysqli_query($con2,$sql2);
        $Results_display = $dbs_display->getResult($sql2);
        // while($row = mysqli_fetch_array($result2)) {
        while ($row = $dbs_display->getArray($Results_display)) {
        //**********************************************************************************************
        //********************************************************************************* DEBUG- START
        /**
        echo "\$q just before this name is= " . $q . "<BR>"; 
        echo "\$$UserID  just before this name is= " . $UserID  . "<BR>"; 

        echo "\$_GET['q'] = " . $_GET['q'] . "<BR>";
        */
        //*********************************************************************************** DEBUG- END
        //**********************************************************************************************
        $UserActive = $row[UserActive];

        $user_creation_second = $row[UserDate];
        $user_creation_date = date("H:i:s d-M-Y",$user_creation_second);
	
        if ($UserActive == 1) {
	        $userAllreadyActive = 1;
        } else {
	        $userAllreadyActive = 0;
        }


        if ($UserActive == 1) {
	        $UserActiveYes = "checked";
	        $UserActiveNo = "";
        } else {
	        $UserActiveYes = "";
	        $UserActiveNo = "checked";
        }
        echo "  <div align=\"center\">
                
                <!-- <H1>User Card</H1> -->";
        $header_size = $_POST['header_size'];
	echo "<H" . $header_size . ">User Card</H" . $header_size . ">";
?>                      
<div class="container">
        <div class="row">
                <div class="six columns box" style="margin-top: 5%; text-align: center">
                        <?PHP 
                        echo "
                        <input type=\"hidden\" name=\"OptionCatch\" value=\"EditDetails\">
                        <input type=\"hidden\" name=\"user_ID_to_display\" value=\"$user_ID_to_display\">
	                <TABLE>
		                <TR>
			                <TD>UserLogin</TD>
			                <TD>
			                <input type=\"text\" name=\"UserLogin_to_display\" tabindex=\"1\"  value=\"$row[UserLogin]\" onchange=\"change_user('UserLogin',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserPassword</TD>
			                <TD>
			                <input type=\"password\" name=\"UserPassword_to_display\" tabindex=\"2\"  value=\"$row[UserPassword]\" onchange=\"change_user('UserPassword',this.value,$user_ID_to_display)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>Creation Date</TD>
			                <TD>$user_creation_date</TD>
		                </TR>
		                <TR>
			                <TD>UserFirstname</TD>
			                <TD>
			                <input type=\"text\" name=\"UserFirstName_to_display\" tabindex=\"4\"  value=\"$row[UserFirstname]\" onchange=\"change_user('UserFirstName',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserLastname</TD>
			                <TD>
			                <input type=\"text\" name=\"UserLastname_to_display\" tabindex=\"5\"  value=\"$row[UserLastname]\" onchange=\"change_user('UserLastname',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserAddress1</TD>
			                <TD>
			                <input type=\"text\" name=\"UserAddress1_to_display\" tabindex=\"6\"  value=\"$row[UserAddress1]\" onchange=\"change_user('UserAddress1',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserAddress2</TD>
			                <TD>
			                <input type=\"text\" name=\"UserAddress2_to_display\" tabindex=\"7\"  value=\"$row[UserAddress2]\" onchange=\"change_user('UserAddress2',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserCity</TD>
			                <TD>
			                <input type=\"text\" name=\"UserCity_to_display\" tabindex=\"8\"  value=\"$row[UserCity]\" onchange=\"change_user('UserCity',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserState</TD>
			                <TD>
			                <input type=\"text\" name=\"UserState_to_display\" tabindex=\"9\"  value=\"$row[UserState]\" onchange=\"change_user('UserState',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD></TD>
			                <TD></TD>
		                </TR>
	                </TABLE>"; 
                ?>
                </div>
                <div class="six columns" style="margin-top: 5%; text-align: center">
                <?PHP 
                        echo "
	                <TABLE>
		                <TR>
			                <TD>UserPostcode</TD>
			                <TD>
			                <input type=\"text\" name=\"UserPostcode_to_display\" tabindex=\"10\"  value=\"$row[UserPostcode]\" onchange=\"change_user('UserPostcode',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserCountry</TD>
			                <TD>
			                <input type=\"text\" name=\"UserCountry_to_display\" tabindex=\"12\"  value=\"$row[UserCountry]\" onchange=\"change_user('UserCountry',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserPhone1</TD>
			                <TD>
			                <input type=\"text\" name=\"UserPhone1_to_display\" tabindex=\"13\"  value=\"$row[UserPhone1]\" onchange=\"change_user('UserPhone1',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserPhone2</TD>
			                <TD>
			                <input type=\"text\" name=\"UserPhone2_to_display\" tabindex=\"14\"  value=\"$row[UserPhone2]\" onchange=\"change_user('UserPhone2',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserFax</TD>
			                <TD>
			                <input type=\"text\" name=\"UserFax_to_display\" tabindex=\"15\"  value=\"$row[UserFax]\" onchange=\"change_user('UserFax',this.value,$user_ID_to_display,0)\"></input>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserEmail</TD>
			                <TD>
			                <input type=\"text\" name=\"UserEmail_to_display\" tabindex=\"16\"  value=\"$row[UserEmail]\" onchange=\"change_user('UserEmail',this.value,$user_ID_to_display,0)\"></input>
			                <a tabindex=\"16.5\" href=\"mailto:" . $row['UserEmail'] . "\">Send</a>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserUrl</TD>
			                <TD>
			                <input type=\"text\" name=\"UserUrl_to_display\" tabindex=\"17\"  value=\"$row[UserUrl]\" onchange=\"change_user('UserUrl',this.value,$user_ID_to_display,0)\"></input>
			                <A  tabindex=\"17.5\" href=\"http://" . $row['UserUrl'] . "\"target=\"_blank\">Go</A>
			                </TD>
		                </TR>
		                <TR>
			                <TD>UserActive</TD>
			                <TD>
			                <input type=\"radio\" name=\"UserActive_to_display\" tabindex=\"17\"  value=\"0\" onchange=\"change_user('UserActive',this.value,$user_ID_to_display,0)\" $UserActiveNo>No 
			                <input type=\"radio\" name=\"UserActive_to_display\" tabindex=\"17.5\"  value=\"1\" onchange=\"change_user('UserActive',this.value,$user_ID_to_display,0)\" $UserActiveYes>Yes 
			                </TD>
		                </TR>
		                <TR>
			                <TD>User ID</TD>
			                <TD>$user_ID_to_display</TD>
		                </TR>
		                <TR>
			                <TD colspan=\"2\">Time Zone
			                ";
				
			                $dbs_time_zone = new dbSession();
			                $sql = "SELECT user_time_zone FROM user WHERE UserID = '$user_ID_to_display' ";
			                $Results = $dbs_time_zone->getResult($sql);
			                $row = $dbs_time_zone->getArray($Results);
			                //echo "\$row = $row<BR>";
			                $user_time_zone = $row['user_time_zone'];
			                //echo "\$user_time_zone = $user_time_zone<BR>";
			                echo "  <SELECT name=\"user_time_zone\" tabindex=\"18\" onchange=\"change_user('user_time_zone',this.value,$user_ID_to_display,0)\">"; 
			                echo "  <OPTION value=\"$user_time_zone\" selected=\"selected\">$user_time_zone"; 
			                // echo "  <OPTION value=\"Australia/Perth\">Australia/Perth";
			                // echo "  <OPTION value=\"Australia/Sydney\">Australia/Sydney";
			                // echo "  <OPTION value=\"Australia/Adelaide\">Australia/Adelaide";
        ?>
                                                <option value="Pacific/Midway">(UTC-11:00) Midway Island</option>
                                                <option value="Pacific/Samoa">(UTC-11:00) Samoa</option>
                                                <option value="Pacific/Honolulu">(UTC-10:00) Hawaii</option>
                                                <option value="US/Alaska">(UTC-09:00) Alaska</option>
                                                <option value="America/Los_Angeles">(UTC-08:00) Pacific Time (US &amp; Canada)</option>
                                                <option value="America/Tijuana">(UTC-08:00) Tijuana</option>
                                                <option value="US/Arizona">(UTC-07:00) Arizona</option>
                                                <option value="America/Chihuahua">(UTC-07:00) Chihuahua</option>
                                                <option value="America/Chihuahua">(UTC-07:00) La Paz</option>
                                                <option value="America/Mazatlan">(UTC-07:00) Mazatlan</option>
                                                <option value="US/Mountain">(UTC-07:00) Mountain Time (US &amp; Canada)</option>
                                                <option value="America/Managua">(UTC-06:00) Central America</option>
                                                <option value="US/Central">(UTC-06:00) Central Time (US &amp; Canada)</option>
                                                <option value="America/Mexico_City">(UTC-06:00) Guadalajara</option>
                                                <option value="America/Mexico_City">(UTC-06:00) Mexico City</option>
                                                <option value="America/Monterrey">(UTC-06:00) Monterrey</option>
                                                <option value="Canada/Saskatchewan">(UTC-06:00) Saskatchewan</option>
                                                <option value="America/Bogota">(UTC-05:00) Bogota</option>
                                                <option value="US/Eastern">(UTC-05:00) Eastern Time (US &amp; Canada)</option>
                                                <option value="US/East-Indiana">(UTC-05:00) Indiana (East)</option>
                                                <option value="America/Lima">(UTC-05:00) Lima</option>
                                                <option value="America/Bogota">(UTC-05:00) Quito</option>
                                                <option value="Canada/Atlantic">(UTC-04:00) Atlantic Time (Canada)</option>
                                                <option value="America/Caracas">(UTC-04:30) Caracas</option>
                                                <option value="America/La_Paz">(UTC-04:00) La Paz</option>
                                                <option value="America/Santiago">(UTC-04:00) Santiago</option>
                                                <option value="Canada/Newfoundland">(UTC-03:30) Newfoundland</option>
                                                <option value="America/Sao_Paulo">(UTC-03:00) Brasilia</option>
                                                <option value="America/Argentina/Buenos_Aires">(UTC-03:00) Buenos Aires</option>
                                                <option value="America/Argentina/Buenos_Aires">(UTC-03:00) Georgetown</option>
                                                <option value="America/Godthab">(UTC-03:00) Greenland</option>
                                                <option value="America/Noronha">(UTC-02:00) Mid-Atlantic</option>
                                                <option value="Atlantic/Azores">(UTC-01:00) Azores</option>
                                                <option value="Atlantic/Cape_Verde">(UTC-01:00) Cape Verde Is.</option>
                                                <option value="Africa/Casablanca">(UTC+00:00) Casablanca</option>
                                                <option value="Europe/London">(UTC+00:00) Edinburgh</option>
                                                <option value="Etc/Greenwich">(UTC+00:00) Greenwich Mean Time : Dublin</option>
                                                <option value="Europe/Lisbon">(UTC+00:00) Lisbon</option>
                                                <option value="Europe/London">(UTC+00:00) London</option>
                                                <option value="Africa/Monrovia">(UTC+00:00) Monrovia</option>
                                                <option value="UTC">(UTC+00:00) UTC</option>
                                                <option value="Europe/Amsterdam">(UTC+01:00) Amsterdam</option>
                                                <option value="Europe/Belgrade">(UTC+01:00) Belgrade</option>
                                                <option value="Europe/Berlin">(UTC+01:00) Berlin</option>
                                                <option value="Europe/Berlin">(UTC+01:00) Bern</option>
                                                <option value="Europe/Bratislava">(UTC+01:00) Bratislava</option>
                                                <option value="Europe/Brussels">(UTC+01:00) Brussels</option>
                                                <option value="Europe/Budapest">(UTC+01:00) Budapest</option>
                                                <option value="Europe/Copenhagen">(UTC+01:00) Copenhagen</option>
                                                <option value="Europe/Ljubljana">(UTC+01:00) Ljubljana</option>
                                                <option value="Europe/Madrid">(UTC+01:00) Madrid</option>
                                                <option value="Europe/Paris">(UTC+01:00) Paris</option>
                                                <option value="Europe/Prague">(UTC+01:00) Prague</option>
                                                <option value="Europe/Rome">(UTC+01:00) Rome</option>
                                                <option value="Europe/Sarajevo">(UTC+01:00) Sarajevo</option>
                                                <option value="Europe/Skopje">(UTC+01:00) Skopje</option>
                                                <option value="Europe/Stockholm">(UTC+01:00) Stockholm</option>
                                                <option value="Europe/Vienna">(UTC+01:00) Vienna</option>
                                                <option value="Europe/Warsaw">(UTC+01:00) Warsaw</option>
                                                <option value="Africa/Lagos">(UTC+01:00) West Central Africa</option>
                                                <option value="Europe/Zagreb">(UTC+01:00) Zagreb</option>
                                                <option value="Europe/Athens">(UTC+02:00) Athens</option>
                                                <option value="Europe/Bucharest">(UTC+02:00) Bucharest</option>
                                                <option value="Africa/Cairo">(UTC+02:00) Cairo</option>
                                                <option value="Africa/Harare">(UTC+02:00) Harare</option>
                                                <option value="Europe/Helsinki">(UTC+02:00) Helsinki</option>
                                                <option value="Europe/Istanbul">(UTC+02:00) Istanbul</option>
                                                <option value="Asia/Jerusalem">(UTC+02:00) Jerusalem</option>
                                                <option value="Europe/Helsinki">(UTC+02:00) Kyiv</option>
                                                <option value="Africa/Johannesburg">(UTC+02:00) Pretoria</option>
                                                <option value="Europe/Riga">(UTC+02:00) Riga</option>
                                                <option value="Europe/Sofia">(UTC+02:00) Sofia</option>
                                                <option value="Europe/Tallinn">(UTC+02:00) Tallinn</option>
                                                <option value="Europe/Vilnius">(UTC+02:00) Vilnius</option>
                                                <option value="Asia/Baghdad">(UTC+03:00) Baghdad</option>
                                                <option value="Asia/Kuwait">(UTC+03:00) Kuwait</option>
                                                <option value="Europe/Minsk">(UTC+03:00) Minsk</option>
                                                <option value="Africa/Nairobi">(UTC+03:00) Nairobi</option>
                                                <option value="Asia/Riyadh">(UTC+03:00) Riyadh</option>
                                                <option value="Europe/Volgograd">(UTC+03:00) Volgograd</option>
                                                <option value="Asia/Tehran">(UTC+03:30) Tehran</option>
                                                <option value="Asia/Muscat">(UTC+04:00) Abu Dhabi</option>
                                                <option value="Asia/Baku">(UTC+04:00) Baku</option>
                                                <option value="Europe/Moscow">(UTC+04:00) Moscow</option>
                                                <option value="Asia/Muscat">(UTC+04:00) Muscat</option>
                                                <option value="Europe/Moscow">(UTC+04:00) St. Petersburg</option>
                                                <option value="Asia/Tbilisi">(UTC+04:00) Tbilisi</option>
                                                <option value="Asia/Yerevan">(UTC+04:00) Yerevan</option>
                                                <option value="Asia/Kabul">(UTC+04:30) Kabul</option>
                                                <option value="Asia/Karachi">(UTC+05:00) Islamabad</option>
                                                <option value="Asia/Karachi">(UTC+05:00) Karachi</option>
                                                <option value="Asia/Tashkent">(UTC+05:00) Tashkent</option>
                                                <option value="Asia/Calcutta">(UTC+05:30) Chennai</option>
                                                <option value="Asia/Kolkata">(UTC+05:30) Kolkata</option>
                                                <option value="Asia/Calcutta">(UTC+05:30) Mumbai</option>
                                                <option value="Asia/Calcutta">(UTC+05:30) New Delhi</option>
                                                <option value="Asia/Calcutta">(UTC+05:30) Sri Jayawardenepura</option>
                                                <option value="Asia/Katmandu">(UTC+05:45) Kathmandu</option>
                                                <option value="Asia/Almaty">(UTC+06:00) Almaty</option>
                                                <option value="Asia/Dhaka">(UTC+06:00) Astana</option>
                                                <option value="Asia/Dhaka">(UTC+06:00) Dhaka</option>
                                                <option value="Asia/Yekaterinburg">(UTC+06:00) Ekaterinburg</option>
                                                <option value="Asia/Rangoon">(UTC+06:30) Rangoon</option>
                                                <option value="Asia/Bangkok">(UTC+07:00) Bangkok</option>
                                                <option value="Asia/Bangkok">(UTC+07:00) Hanoi</option>
                                                <option value="Asia/Jakarta">(UTC+07:00) Jakarta</option>
                                                <option value="Asia/Novosibirsk">(UTC+07:00) Novosibirsk</option>
                                                <option value="Asia/Hong_Kong">(UTC+08:00) Beijing</option>
                                                <option value="Asia/Chongqing">(UTC+08:00) Chongqing</option>
                                                <option value="Asia/Hong_Kong">(UTC+08:00) Hong Kong</option>
                                                <option value="Asia/Krasnoyarsk">(UTC+08:00) Krasnoyarsk</option>
                                                <option value="Asia/Kuala_Lumpur">(UTC+08:00) Kuala Lumpur</option>
                                                <option value="Australia/Perth">(UTC+08:00) Perth</option>
                                                <option value="Asia/Singapore">(UTC+08:00) Singapore</option>
                                                <option value="Asia/Taipei">(UTC+08:00) Taipei</option>
                                                <option value="Asia/Ulan_Bator">(UTC+08:00) Ulaan Bataar</option>
                                                <option value="Asia/Urumqi">(UTC+08:00) Urumqi</option>
                                                <option value="Asia/Irkutsk">(UTC+09:00) Irkutsk</option>
                                                <option value="Asia/Tokyo">(UTC+09:00) Osaka</option>
                                                <option value="Asia/Tokyo">(UTC+09:00) Sapporo</option>
                                                <option value="Asia/Seoul">(UTC+09:00) Seoul</option>
                                                <option value="Asia/Tokyo">(UTC+09:00) Tokyo</option>
                                                <option value="Australia/Adelaide">(UTC+09:30) Adelaide</option>
                                                <option value="Australia/Darwin">(UTC+09:30) Darwin</option>
                                                <option value="Australia/Brisbane">(UTC+10:00) Brisbane</option>
                                                <option value="Australia/Canberra">(UTC+10:00) Canberra</option>
                                                <option value="Pacific/Guam">(UTC+10:00) Guam</option>
                                                <option value="Australia/Hobart">(UTC+10:00) Hobart</option>
                                                <option value="Australia/Melbourne">(UTC+10:00) Melbourne</option>
                                                <option value="Pacific/Port_Moresby">(UTC+10:00) Port Moresby</option>
                                                <option value="Australia/Sydney">(UTC+10:00) Sydney</option>
                                                <option value="Asia/Yakutsk">(UTC+10:00) Yakutsk</option>
                                                <option value="Asia/Vladivostok">(UTC+11:00) Vladivostok</option>
                                                <option value="Pacific/Auckland">(UTC+12:00) Auckland</option>
                                                <option value="Pacific/Fiji">(UTC+12:00) Fiji</option>
                                                <option value="Pacific/Kwajalein">(UTC+12:00) International Date Line West</option>
                                                <option value="Asia/Kamchatka">(UTC+12:00) Kamchatka</option>
                                                <option value="Asia/Magadan">(UTC+12:00) Magadan</option>
                                                <option value="Pacific/Fiji">(UTC+12:00) Marshall Is.</option>
                                                <option value="Asia/Magadan">(UTC+12:00) New Caledonia</option>
                                                <option value="Asia/Magadan">(UTC+12:00) Solomon Is.</option>
                                                <option value="Pacific/Auckland">(UTC+12:00) Wellington</option>
                                                <option value="Pacific/Tongatapu">(UTC+13:00) Nuku'alofa</option>
                                                <?PHP
			                echo "  </SELECT>
                                        </TD>
		                </TR>
	                </TABLE>"; 
                ?>
                </div>
        </div>
</div>
<?PHP 
        }

mysqli_close($con);
}
?> 

