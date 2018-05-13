<?PHP

//***********************************************************************************************
//********************************************************************** TITLE - START
/**
*	file:	ssl.php
*	auth:	Dion Patelis (owner)
*	desc;	Functions to turn https off or on.
*	date:	17 July 2008 - Dion Patelis
*	last:	17 July 2008 - Dion Patelis
*/
//********************************************************************** TITLE - END
//**********************************************************************************************

//***********************************************************************************************
//**********************************************************************  TURN ON OR OFF HTTPS - START
//==== - Detect if HTTPS, if not on, then turn on HTTPS:
if ($_POST['SSLon'] == 'yes') {
	SSLon();
}
//**********************************************************************  TURN ON OR OFF HTTPS - END
//**********************************************************************************************

//**********************************************************************************************
//********************************************************************** FUNCTIONS - START


//**********************************************************************
//***************************************  TURN ON OR OFF HTTPS - START
//==== - Detect if HTTPS, if not on, then turn on HTTPS:
//This works in 5.2.3
//First function turns SSL on if it is off.
//Second function detects if SSL is on, if it is, turns it off.

//===================================================
//===========================  REDIRECT - START
// Try PHP header redirect, then Java redirect, then try http redirect.:
function redirect($url){
    if (!headers_sent()){    //If headers not sent yet... then do php redirect
        header('Location: '.$url); exit;
    }else{                    //If headers are sent... do java redirect... if java disabled, do html redirect.
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}
//===========================  REDIRECT - END
//===================================================

//===================================================
//===========================  TURN ON HTTPS - START
function SSLon(){
    if($_SERVER['HTTPS'] != 'on'){
		echo "Funky monkey";
        $url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        redirect($url);
    }
}
//===========================   TURN ON HTTPS - END
//===================================================


//===================================================
//===========================  TURN OFF HTTPS - START
// -- Detect if HTTPS, if so, then turn off HTTPS:
function SSLoff(){
    if($_SERVER['HTTPS'] == 'on'){
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        redirect($url);
    }
}
//===========================  TURN OFF HTTPS - END
//===================================================

//***************************************  TURN ON OR OFF HTTPS - END
//*******************************************************************

//********************************************************************** FUNCTIONS - END
//**********************************************************************************************

?>