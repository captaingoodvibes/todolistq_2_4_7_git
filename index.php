<?PHP
//***********************************************************************************************
//********************************************************************************* TITLE - START
/**
 * 	desc;	Main ToDolist page.
 *  file:   index.php
 *  note:   The server database settings can be found in dbsession.class
 *          This is the main file, although a lot happens out of whiteboard.php as well.
 *	auth:	Dion Patelis (owner)
 *	date:	10th Feb 2015 - Dion Patelis
 *	last:	2nd June 2018 - Dion Patelis
 */
//********************************************************************************** TITLE - END
//**********************************************************************************************



//**********************************************************************************************
//***************************************************************************** INCLUDES - START
include("config/dbSession.class");      // Test putting this include at the top so that the html
// title in the tab shows the dbname. DP

include("config/headAndBody001_with_db_name_in_tab.php");

/**
 The following section is what's run when you first install TDLQ. It brings up a web page
 asking for the database credentials. It then runs scripts to alter dbSession.class to
 setup the database name, username, and password.
 */
$new_install = $_POST['new_install'];
//echo "\$new_install = " . $new_install . "<br>";
//echo "\$db_has_been_setup = " . $db_has_been_setup . "<br>";
if ($new_install == 1) {
} elseif ($db_has_been_setup == "no") {
    include ("install.php");
    exit;
}

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
include("log_in_authentication_form.php");
include("logged_in_start_of_page.php");
include("class_lib_backup.php");

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
//**************************************************************************** GET to POST - END
//**********************************************************************************************


/** ********************************************************************************************
 ***************************************************************** START GLOBAL VARIABLES - START
$Job_imp_urg_set = $_POST['Job_imp_urg_set'];
$SearchClientName = $_POST['SearchClientName'];
$fieldName = $_POST['fieldName'];
$JobID = $_POST['JobID'];
$JobPriorityUp = $_POST['JobPriorityUp'];
$Job_imp_urg_set = $_POST['Job_imp_urg_set'];
 ********************************************************************* END GLOBAL VARIABLES - END
 ********************************************************************************************* */


/** ********************************************************************************************
 ****************************************************************************** TIME ZONE - START
$dbst = new dbSession();
$sqlt = "SELECT * from config WHERE ConfigID = 1 LIMIT 0, 30";

$Resultst = $dbst->getResult($sqlt);

while ($rowt = $dbst->getArray($Resultst)) {

//$config_time_zone = $rowt['config_time_zone'];
$config_time_zone = $_POST['user_time_zone'];
$_POST['config_time_zone'] = $config_time_zone;
}
//echo "\$config_time_zone = $config_time_zone and " . $_POST['config_time_zone'] . " <BR>";
 ******************************************************************************** TIME ZONE - END
 ********************************************************************************************* */


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
    switch ($_POST['OptionCatch']) {
        case "SearchClient";
            if($_POST['SearchClientName'] == ""){
                echo "<BR><BR>";
                echo "<H3>You can not have a blank entry! Try again.</H3><BR><BR><BR>";
            }else{
                SearchClient3();                                    // In searchFunctions.php
            }
            break;
        case "search_client_in_add_reminder";
            list_clients_connected_to_reminder();                   // In searchFunctions.php
            add_reminder();                                         // Found in reminder_functions.php
            break;
        case "search_client_in_reminder_card";
            list_clients_connected_to_reminder_and_back_to_reminder_card(); // In searchFunctions.php
            reminder_card();                                        // Found in reminder_functions.php
            break;
        case "backup_db";
            // if (file_exists("/var/www/html/todolistq.com/247installer/" . $file)) {
            $backup_go = new class_lib_movedb();
            $backup_go->backup_db();// Found in class_lib_backup.php
            // echo $backup_go->backup_db() . "<br><br>";
            // echo $backup_go->whats_the_status() . "<br><br>";
            //echo "Stefan's full name: " . $stefan->get_name() . "<br><br>";
            break;
        case "restore_db";
            // echo "In restore_db case statement<br>";
            file_browse();          // Found in file_functions.php
            break;
        case "upload_sql";
            $target_file_only = upload();                                   // Found in file_functions.php
            $restore_go = new class_lib_movedb();       // Found in class_lib_backup.php
            $restore_go->restore_db($target_file_only);
            // echo $restore_go->whats_the_status() . "<br><br>";
            break;
        /* case "";

            include("whiteBoard.php");              // In index.php --> Doesn't do anything ATM.
            break; */
        case "client_details";
            client_details();                       // Found in client_functions.php
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
            ShowActions(0,0,0);     // In action_functions.php
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
        case "update_config_file";
            update_config_file();   // Found in create_db_functions.php
            break;
        case "populate_2";
            populate_db();          // Found in create_db_functions.php
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
            insert_user();          // Found in user_functions.php
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
            slip();                                     // Found in slip_functions.php
            break;
        case "upload";
            job_card();                                 // Found in JobDetails_functions.php
            $_POST['in_job_card'] = 1;
            upload();                                   // Found in file_functions.php
            LocEndCallAddAction();                      // Found in action_functions.php
            ShowActions(1,0,0);
            break;
        case "dl";
            $_POST['in_job_card'] = 1;
            echo "<BR>";
            file_browse();                              // Found in file_functions.php
            break;
        /* default;
            include("whiteBoard.php");                  // Found in index.php
            break; */
    }

    switch ($_GET['OptionCatch']) {
        case "";
            include("whiteBoard.php");                  // In index.php --> Doesn't do anything ATM.
            break;
        case "client_details";

            client_details();                           // Found in client_functions.php
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
            ShowActions(0,0,0);                         // In action_functions.php
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
