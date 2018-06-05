<?php
/**
 *	desc;	The page taht comes up on a new install.
 *  note:   Before you enter the credentials here you need to create a MySQL user and an empty
 *          database. If you use PHPMyAdmin create the user first and there's a checkbox which
 *          allows a database to be made with the same name at the same time.
 *          You'll put in a MySQL db name, a MySQL username and password and it
 *  by:     7rocks.com
 *  file:	install.php
 *	auth:	Dion Patelis.
 *	date:	3/3/2012 - Dion Patelis
 *	last:	3/6/2018 - Dion Patelis
 */

//**********************************************************************************************
//***************************************************************************** INCLUDES - START
include("create_db_functions.php");
//******************************************************************************* INCLUDES - END
//**********************************************************************************************

create_db_form();

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;         //Set this to 1 if you'd like to echo variables in the browser.
if ($turn_this_debug_on == 1) {
    include("debug_array.php");
}
//******************************************************************* DEBUG VARIABLES HERE - END

?>