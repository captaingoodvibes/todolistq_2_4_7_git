<?PHP
//***********************************************************************************************
//********************************************************************************* TITLE - START
/**
*	file:	index.php new versioni based on the version from the main
*               website folder /web_site_1_0_0_fire_up_paypal/
*	auth:	Dion Patelis (owner)
*	desc;	Main Spiros Task Manager page.
*	date:	10th Feb 2015 - Dion Patelis
*	last:	13th Feb 2015 - Dion Patelis
*/
//********************************************************************************** TITLE - END
//**********************************************************************************************


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
include("reminder_functions.php");
include("action_functions.php");
include("job_board_functions.php");
include("history_functions.php");
include("config/class.child.php");
include("slip_functions.php");
include("file_functions.php");
?>
<!-- <div class="container">
    <div class="row">
      <div class="one.column column" style="margin-top: 1%;"> -->
<?PHP
include("log_in_authentication_form.php");
?>

<!--</div>
</div>
</div> -->
<?PHP
include("logged_in_start_of_page.php");
//******************************************************************************* INCLUDES - END
//**********************************************************************************************


//**********************************************************************************************
//****************************************************************** CONNECT TO DATABASE - START
$dbs = new dbSession();
//******************************************************************** CONNECT TO DATABASE - END
//**********************************************************************************************


//**********************************************************************************************
//************************************************************************** GET to POST - START
if ( ! empty($_POST['JobID']) ){
    $_POST['JobID'] = $_POST['JobID'];
}
// echo "\$_POST['JobID'] = " . $_POST['JobID'] . "<BR>";
//**************************************************************************** GET to POST - END
//**********************************************************************************************

//**********************************************************************************************
//*************************************************************** START GLOBAL VARIABLES - START
$Job_imp_urg_set = $_POST['Job_imp_urg_set'];
$SearchClientName = $_POST['SearchClientName'];
$fieldName = $_POST['fieldName'];
$JobID = $_POST['JobID'];
$JobPriorityUp = $_POST['JobPriorityUp'];
$Job_imp_urg_set = $_POST['Job_imp_urg_set'];
//******************************************************************* END GLOBAL VARIABLES - END
//**********************************************************************************************


//**********************************************************************************************
//**************************************************************************** TIME ZONE - START
// echo "\$callOrder = $callOrder";
/**
$dbst = new dbSession();
$sqlt = "SELECT * from config WHERE ConfigID = 1 LIMIT 0, 30";

$Resultst = $dbst->getResult($sqlt);

while ($rowt = $dbst->getArray($Resultst)) {

//$config_time_zone = $rowt['config_time_zone'];
$config_time_zone = $_POST['user_time_zone'];
$_POST['config_time_zone'] = $config_time_zone;
}
 */
//echo "\$config_time_zone = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";

//****************************************************************************** TIME ZONE - END
//**********************************************************************************************


//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
    include("debug_array.php");
}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************


//**********************************************************************************************
//********************************************************************************* MAIN - START

echo "<DIV align=\"center\">";
if (empty($AddMessageTermination)) {
    echo "<BR>";
    echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";

    //**********************************************************************************************
    //**************************************************************************** CATCHES 2 - START
    // echo "\$OptionCatch = $OptionCatch<BR>";
    switch ($_POST['OptionCatch']) {
        case "SearchClient";
            if($SearchClientName==""){
                echo "<BR><BR>";
                echo "<H3>You can not have a blank entry! Try again.</H3><BR><BR><BR>";
            }else{
                SearchClient3(); // In searchFunctions.php
            }
            break;
        case "search_client_in_add_reminder";
            list_clients_connected_to_reminder(); // In searchFunctions.php
            add_reminder();  // Found in reminder_functions.php
            break;
        case "search_client_in_reminder_card";
            list_clients_connected_to_reminder_and_back_to_reminder_card(); // In searchFunctions.php
            reminder_card();  // Found in reminder_functions.php
            break;
        /* case "";

            include("whiteBoard.php");  // In index.php --> Doesn't do anything ATM.
            break; */
        case "client_details";
            client_details();       // Found in client_functions.php
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
            ShowActions(0,0,0);          // In action_functions.php
            break;
        case "EditDetails";
            EditDetails();          // Found in client_functions.php
            break;
        case "AddClient";
            AddClient();            // Found in client_functions.php
            break;
        case "InsertClient";
            InsertClient();         // Found in client_functions.php
            break;
        case "create_db_form";
            create_db_form();       // Found in create_db_functions.php
            break;
        case "create_db";
            create_db();            // Found in create_db_functions.php
            break;
        case "choose_db";
            choose_db();            // Found in create_db_functions.php
            break;
        case "log_into_external_db";
            log_into_external_db(); // Found in create_db_functions.php
            break;
        case "pricing";
            pricing();              // Found in create_db_functions.php
            break;
        case "add_reminder";
            add_reminder();         // Found in reminder_functions.php
            break;
        case "insert_reminder";
            insert_reminder();      // Found in reminder_functions.php
            break;
        case "reminder_card";
            $ReminderID = $_POST['ReminderID'];
            //echo "\$ReminderID = $ReminderID <BR>";
            reminder_card();        // Found in reminder_functions.php
            break;
        case "locUpdateReminder";
            locUpdateReminder();    // Found in reminder_functions.php
            break;
        case "OK";
            dismiss_ok_reminder();  // Found in reminder_functions.php
            break;
        case "postpone";
            postpone_reminder();    // Found in reminder_functions.php
            break;
        case "postpone_and_update_reminder";
            postpone_and_update_reminder();
            // Found in reminder_functions.php
            break;
        case "StartCall";
            StartCall2();           // Found in action_functions.php
            break;
        case "End Call";
            insert_action_at_end_of_call();
            // Found in action_functions.php
            break;
        case "DeleteCardQuestion";
            DeleteCardQuestion();   // Found in action_functions.php
            break;
        case "action_card";
            action_card();          // Found in action_functions.php
            break;
        case "edit_action_card";
            edit_action_card();     // Found in action_functions.php
            break;
        case "DeleteCard";
            DeleteCard();           // Found in client_functions.php
            break;
        case "DeleteActionQuestion";
            DeleteActionQuestion();
            break;
        case "DeleteAction";
            // LocHtmlPageStart();
            DeleteAction();
            break;
        case "job_card";
            job_card();             // Found in JobDetails_functions.php
            $_POST['in_job_card'] = 1;
            echo "<BR>";
            //file_browse();          // Found in file_functions.php
            LocEndCallAddAction();  // Found in action_functions.php
            ShowActions(1,0,0);
            break;
        case "edit_job_card";
            edit_job_card();        // Found in JobDetails_functions.php
            break;
        case "delete_job_card_question";
            delete_job_card_question();
            // Found in JobDetails_functions.php
            break;
        case "delete_job_card";
            delete_job_card();      // Found in JobDetails_functions.php
            break;
        case "SearchClient7";
            SearchClient7();        // Found in JobDetails_functions.php
            break;
        case "client_changed_for_job";
            job_card();             // Found in JobDetails_functions.php
            break;
        case "job_board";
            locReminderCheck();     // Found in reminder_functions.php
            job_board();            // Found in job_board_functions.php
            break;
        case "add_job";
            add_job();              // Found in jobDetails_functions.php
            break;
        case "insertJob";
            insertJob();            // Found in jobDetails_functions.php
            break;
        case "branch";
            loc_update_branch();    // Found in job_board_functions.php
            break;
        case "priority_up";
            priority_up();          // Found in job_board_functions.php
            break;
        case "priority_down";
            priority_down();        // Found in job_board_functions.php
            break;
        case "history_list";
            history_list();         // Found in history_functions.php
            // show_history_actions(); // Found in history_functions.php
            ShowActions(0,1,1);     // Found in action_functions.php
            break;
        case "date_range";
            date_range();           // Found in history_functions.php
            break;
        case "add_user";
            add_user();             // Found in user_functions.php
            break;
        case "insert_user";
            insert_user();             // Found in user_functions.php
            break;
        case "list_users";
            show_user();            // Found in user_functions.php
            break;
        case "job_complete";
            echo "Here in index.php <BR>";
            //**********************************************************************************************
            //***************************************************************** DEBUG VARIABLES HERE - START
            $turn_this_debug_on = 1;
            if ($turn_this_debug_on == 1) {
                $debug = $_POST['debug'];
                $debugMsg .= "In the optionCatch the we are in the job_complete section.<BR>";
                include("config/debug.php");
            }
            //******************************************************************* DEBUG VARIABLES HERE - END
            //**********************************************************************************************
            job_complete();
            break;
        case "slip";
            slip();                 // Found in slip_functions.php
            break;
        case "upload";
            job_card();             // Found in JobDetails_functions.php
            $_POST['in_job_card'] = 1;
            upload();               // Found in file_functions.php
            LocEndCallAddAction();  // Found in action_functions.php
            ShowActions(1,0,0);
            break;
        /* default;
            include("whiteBoard.php");                // Found in index.php
            break; */
    }

    switch ($_GET['OptionCatch']) {
        case "";
            include("whiteBoard.php");  // In index.php --> Doesn't do anything ATM.
            break;
        case "client_details";

            client_details();       // Found in client_functions.php
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
            ShowActions(0,0,0);          // In action_functions.php
            break;
        default;
            include("whiteBoard.php");                // Found in index.php
            break;
    }

    if ( ! empty($JobPriorityUp)) {

        $dbs = new dbSession();

        $sql = "UPDATE job SET JobPriority = '$JobPriorityUp' WHERE JobID = '$JobID'";

        if ($dbs->getResult($sql)) {
            $msg = "Card Edited.";
            echo "<BR>";
        } else {
            $msg = $dbs->printError();
        }
        // echo "msg = $msg";
        locReminderCheck();     // Found in reminder_functions.php
        job_board();            // Found in job_board_functions.php

    }

    if ( ! empty($Job_imp_urg_set)) {

        $dbs = new dbSession();

        $sql = "UPDATE job SET JobImpUrg = '$Job_imp_urg_set' WHERE JobID = '$JobID'";

        if ($dbs->getResult($sql)) {
            $msg = "Importance Urgency Matrix Edited.";
            echo "<BR>";
        } else {
            $msg = $dbs->printError();

        }
        // echo "msg = $msg";
        locReminderCheck();     // Found in reminder_functions.php
        job_board();            // Found in job_board_functions.php

    }
    //****************************************************************************** CATCHES 2 - END
    //**********************************************************************************************
    echo "</DIV>";
}

//*********************************************************************************** MAIN - END
//**********************************************************************************************

include("logged_in_end_of_page.php");

//**********************************************************************************************
//**************************************************************************** FUNCTIONS - START


function Main() {

}


//****************************************************************************** FUNCTIONS - END
//**********************************************************************************************

?>
