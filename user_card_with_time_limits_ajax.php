<?PHP

//**********************************************************************************************
//******************************************************************************** TITLE - START
/**
*	file:	history_01.php
*	auth:	Dion Patelis (owner)
*	desc;	Be able to check the history for a user over a date range.
*	date:	16th June 2014 - Dion Patelis
*	last:	Mon 19th Jan 2015 - Dion Patelis
*/
//********************************************************************************** TITLE - END
//**********************************************************************************************


//**********************************************************************************************
//***************************************************************************** INCLUDES - START
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
include("log_in_authentication_check.php");
include("config/topIndex002.php");
include("config/ssl.php");
include("searchFunctions.php");
include("user_card_with_time_limits_ajax_functions.php");
include("log_in_authentication_form.php");
include("logged_in_start_of_page.php");
// echo "\$config_time_zone top in user_card_with_time_limits_ajax.php = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";
//******************************************************************************* INCLUDES - END
//**********************************************************************************************


//**********************************************************************************************
//****************************************************************************** GLOBALS - START
$SearchClientName = $_POST['SearchClientName'];
$fieldName = $_POST['fieldName'];
$user_ID_to_display = $_POST['user_ID_to_display'];
$page_load =$_POST['page_load'];
//******************************************************************************** GLOBALS - END
//**********************************************************************************************



//**********************************************************************************************
//********************************************************************** EQUATING SUBMIT - START
// This is fixing up the option catch variable when editing
// a card. A bit dodgy but will figure out a smoother coding
// technique later. Cased by the change in php from globals 
// to no globals
//**********************************************************************
if ($_POST['Submit'] == "Apply Changes") {
	$_POST['OptionCatch'] = 'EditDetails';
} elseif ($_POST['Submit'] == "DeleteCard") {
	$_POST['OptionCatch'] = 'DeleteCardQuestion';
}
//********************************************************************** EQUATING SUBMIT - END
//**********************************************************************************************


//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {        
        // $debug = $_POST['debug'];
        $debugMsg .= "<font class=\"generalFontOnWhite\"><BR>********************************************************************<BR>";
        $debugMsg .= "Debug vars within user_card_with_time_limits_ajax.php<BR>";
        $debugMsg .= "\$_POST['page_load'] = " . $_POST['page_load'] . "<BR>";
        $debugMsg .= "\$_POST['ClientID'] = " . $_POST['ClientID'] . "<BR>";
        $debugMsg .= "\$_POST['login_instance_token'] = " . $_POST['login_instance_token'] . "<BR>"; 
        $debugMsg .= "\$_POST['User_db_token'] = " . $_POST['User_db_token'] . "<BR>"; 
        $debugMsg .= "\$_POST['name'] = " . $_POST['name'] . "<BR>"; 
        $debugMsg .= "\$_POST['pass'] = " . $_POST['pass'] . "<BR>"; 
        $debugMsg .= "\$user_authenticated = $user_authenticated<BR>";
        $debugMsg .= "\$OptionCatch = $OptionCatch<BR><BR>";
	$debugMsg .= "This -->" . $_POST['OptionCatch'] . "<-- is the \$OptionCatch <BR>";
        $debugMsg .= "********************************************************************<BR></font>";
        echo $debugMsg;
}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************


//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "\$_POST['page_load'] = " . $_POST['page_load'] . "<BR>";
        $debugMsg .= "\$OptionCatch = $OptionCatch<BR><BR>";
        $debugMsg .= "This " . $_POST['OptionCatch'] . " is the \$OptionCatch in user_card_with_time_limits_ajax.php<BR><BR>";
        $debugMsg .= "\$Submit = $Submit<BR><BR>";
        $debugMsg .= "This " . $_POST['Submit'] . " is the \$Submit<BR><BR>";
        include("config/debug.php");
}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "\$OptionCatch = $OptionCatch<BR>";
        $debugMsg .= "This " . $_POST['OptionCatch'] . " is the \$OptionCatch";
        include("config/debug.php");
}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************


//**********************************************************************************************
//****************************************************************************** CATCHES - START
//******************************************************************************** CATCHES - END
//**********************************************************************************************

//**********************************************************************************************
//********************************************************************************* MAIN - START
?>


<script>

var UserFirstName_to_display;
var user_ID_to_display;
var field_to_display;
var field_contents_to_display;
/**
function show_user(str,page_load)
{
if (str=="")
  {
  document.getElementById("UserFirstName_to_display").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","change_user2.php);
xmlhttp.send();
}
*/
function change_user(field_to_display,field_contents_to_display,str,page_load)
{
if (str=="")
  {
  document.getElementById("UserFirstName_to_display").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","change_user2.php?OptionCatch=EditDetails&field_to_display="+field_to_display+"&field_contents_to_display="+field_contents_to_display+"&user_ID_to_display="+str+"&page_load="+page_load,true);
xmlhttp.send();
}

function show_user(field_to_display,field_contents_to_display,str,page_load)
{
if (str=="")
  {
  document.getElementById("UserFirstName_to_display").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","change_user2.php?OptionCatch=show_user&field_to_display="+field_to_display+"&field_contents_to_display="+field_contents_to_display+"&user_ID_to_display="+str+"&page_load="+page_load,true);
xmlhttp.send();
}

</script>

<!--

<form>
<select name="users" onchange="showUser(this.value)">
<option value="">Select a person:</option>
<option value="1">Dion</option>
<option value="2">Lois Griffin</option>
<option value="3">Scott</option>
<option value="4">Mike</option>
</select>
</form>

-->

<br>

<div id="txtHint"><b></b></div>

<?PHP
// $_POST['user_ID_to_display'] = 10;
$user_ID_to_display = $_POST['user_ID_to_display'];
// echo "\$user_ID_to_display first oi oi = $user_ID_to_display<BR>";

?>
<script>
//showUser(<?PHP echo $user_ID_to_display; ?>);
// show_user(<?PHP echo $user_ID_to_display . "," , $page_load; ?>);
// change_user('','', <?PHP echo $user_ID_to_display . "," , $page_load; ?>);

show_user('','', <?PHP echo $user_ID_to_display . "," , $page_load; ?>);
</script>

<!--<div id="txt_UserFirstname"><input type="text" name="ClientName" tabindex="1" value="" onchange="showUser(this.value)"></input></div>

<input type="text" name="ClientName" tabindex="1" value="$row[UserFirstname]" onchange="showUser(this.value)" 

The User ... <input type="text" name="ClientName" tabindex="1" value=" <?PHP echo $row[UserFirstname]; ?> " onchange="change_user(this.value)" 
-->


<?PHP 
// echo "\$config_time_zone bottom in user_card_with_time_limits_ajax.php = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";
Main();
// ShowActions();
	
include("logged_in_end_of_page.php");
//*********************************************************************************** MAIN - END
//**********************************************************************************************



//**********************************************************************************************
//**************************************************************************** FUNCTIONS - START

//****************************************************************************** FUNCTIONS - END
//**********************************************************************************************

?>
