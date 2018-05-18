<?php
/**
 * Created using PhpStorm.
 * User: dionpatelis
 * Date: 18/05/2018
 * Time: 10:39 AM
 */

//**********************************************************************************************
//***************************************************************************** INCLUDES - START
include("config/dbSession.class");      // Test putting this include at the top so that the html
// title in the tab shows the dbname. DP
include("config/headAndBody001_with_db_name_in_tab.php");
include("config/config.php");
include("config/tpl_bodystart.php");
// include("config/class_detect.php");
// include("config/dbSession.class");   // Test putting this include at the top so that the
// html title in the tab shows the dbname. DP
include("config/standardPageBits.class");
include("log_in_authentication_check.php");
include("config/topIndex002.php");
include("config/ssl.php");
include("config/ht.inc");
include("searchFunctions.php");
include("client_functions.php");
include("user_functions.php");
include("JobDetails_functions.php");
include("create_db_functions.php");
/* include("reminder_functions.php");
include("action_functions.php");
include("job_board_functions.php");
include("history_functions.php");
include("config/class.child.php");
include("slip_functions.php");
include("file_functions.php");
include("log_in_authentication_form.php");
include("logged_in_start_of_page.php"); */
//******************************************************************************* INCLUDES - END
//**********************************************************************************************

echo "in the installer.<BR>";
// create_db_form();

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 1;  //Set this to 1 if you'd like to echo variables in the browser.
if ($turn_this_debug_on == 1) {
    include("debug_array.php");
}
//******************************************************************* DEBUG VARIABLES HERE - END

?>