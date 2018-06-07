<?PHP
/**
 *	desc;	Job manager or ToDoList.
 *  note:   Originally created in the office to mimic the office
 *          white board where we'd have our morning meetings and plan out the day for
 *          all the staff in the office.
 *  by:     7rocks.com
 *  file:	whiteBoard.php
 *	auth:	Dion Patelis (owner)
 *	date:	15th April 2003 - Dion Patelis
 *	last:	16th Jan 2015 - Dion Patelis
 */

//**********************************************************************************************
//***************************************************************************** INCLUDES - START
include("config/dbSession.class");
// include("config/headAndBody001.php");
include("config/headAndBody001_with_db_name_in_tab.php");
?>
<!-- <link rel="stylesheet" href="css/reset.css" type="text/css">
<link rel="stylesheet" href="css/main.css" type="text/css"> -->
<?PHP
// include("config/headAndBody001_with_db_name_in_tab.php"); 
$user_authenticated = $_POST['user_authenticated'];
$login_instance_token = $_POST['login_instance_token'];
$login_name = $_POST['name'];
$login_pass = $_POST['pass'];
$login_UserID = $_POST['UserID'];
include("config/config.php");
include("config/tpl_bodystart.php");
//include("config/class_detect.php");
//include("config/dbSession.class");
include("config/standardPageBits.php");
include("log_in_authentication_check.php");
include("config/topIndex002.php");
include("config/ssl.php");
include("config/ht.inc");
include("searchFunctions.php");
include("config/class.child.php");
include("log_in_authentication_form.php");
// include("logged_in_start_of_page_for_whiteboard.php"); */
include("logged_in_start_of_page.php");
//******************************************************************************* INCLUDES - END
//**********************************************************************************************


//**********************************************************************************************
//****************************************************************** CONNECT TO DATABASE - START
$dbs = new dbSession();
//******************************************************************** CONNECT TO DATABASE - END
//**********************************************************************************************


//**********************************************************************************************
//*************************************************************** START GLOBAL VARIABLES - START
$SearchClientName = $_POST['SearchClientName'];
$fieldName = $_POST['fieldName'];
$JobID = $_POST['JobID'];
$JobPriorityUp = $_POST['JobPriorityUp'];
$Job_imp_urg_set = $_POST['Job_imp_urg_set'];
//******************************************************************* END GLOBAL VARIABLES - END
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
//***************************************************************** DEBUG VARIABLES HERE - START

$turn_this_debug_on = 0;
if ($turn_this_debug_on == 1) {
    foreach($_POST as $key => $value) {
        echo $key." = ". $value."<br>";
    }
    $debug = $_POST['debug'];
    $debugMsg .= "\$OptionCatch = $OptionCatch<BR><BR>";
    $debugMsg .= "This -->" . $_POST['OptionCatch'] . "<-- is the \$OptionCatch in whiteboard.php<BR><BR>";
    $debugMsg .= "\$Submit = $Submit<BR><BR>";
    $debugMsg .= "\$JobID = $JobID<BR><BR>";
    $debugMsg .= "\$Job_imp_urg_set = $Job_imp_urg_set<BR><BR>";
    $debugMsg .= "This " . $_POST['Submit'] . " is the \$Submit<BR><BR>";
    $debugMsg .= "This " . $_POST['xx'] . " is the \$Job_imp_urg_set and POST is " . $_POST['Job_imp_urg_set'] . "<BR><BR>";
    include("config/debug.php");
}
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************


//**********************************************************************************************
//****************************************************************************** CATCHES - START
switch ($_POST['OptionCatch']) {
    case "job_complete";
        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 0;
        if ($turn_this_debug_on == 1) {
            $debug = $_POST['debug'];
            $debugMsg .= "In the optionCatch the we are in the job_complete section.<BR>";
            include("config/debug.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
        job_complete();
        break;
    case "EditDetails";
        EditDetails();
        break;
    case "OK";
        locUpdateReminder();
        break;
    case "OK_b";
        locUpdateReminder_b();
        break;
    case "SearchClient";
        if($SearchClientName==""){
            echo "<A href=\"index.php\">    Home</A>";
            echo "<BR><BR>";
            echo "You can not have a blank entry! Try again.";
        }else{
            // echo "Inside catchall";
            SearchClient3();
        }
        exit();
        break;
    case "postponeUpdate";
        postponeUpdate();
        exit();
        break;
    case "postponeUpdate_b";
        postponeUpdate_b();
        exit();
        break;
    case "postpone";
        postpone();
        exit();
        break;
    case "postpone_b";
        postpone_b();
        exit();
        break;
    case "whiteBoard_public";
        echo "<DIV align=\"center\">";
        echo "<BR>";
        echo "<LINK rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\">";
        Main();
        echo "</DIV>";
        include("logged_in_end_of_page.php");
        exit();
        break;
    case "reminders_all";
        echo "<DIV align=\"center\">";
        echo "<BR>";
        echo "<LINK rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\">";
        loc_Show_all_Reminders();
        echo "</DIV>";
        include("logged_in_end_of_page.php");
        exit();
        break;
    case "CurrentlyLoggedInAs";
        echo "<DIV align=\"center\">";
        $message = "<BR><B>WhiteBoard Task/Job Manager</B>";
        // echo "\$AddMessageTermination = $AddMessageTermination<BR>";
        if (empty($AddMessageTermination)) {

            echo "<BR>";
            echo "<LINK rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\">";

            locReminderCheck();

            // DP 11th May 2016 - Remove the Main() function below as it caused a double
            // job list in the whiteboard when running the demo from the todolistq.com WS.
            // Main();
            // Onsite();

            echo "</DIV>";
        }
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


}
if ($_POST['OptionCatch'] == "postpone") {
    postpone();
    exit();
}
switch ($_POST['OptionCatch']) {
    case "branch";
        loc_update_branch();
        include("logged_in_end_of_page.php");
        exit();
        break;
}
//******************************************************************************** CATCHES - END
//**********************************************************************************************

//**********************************************************************************************
//********************************************************************************* MAIN - START

echo "<DIV align=\"center\">";
$message = "<BR><B>WhiteBoard Task/Job Manager</B>";
if (empty($AddMessageTermination)) {
    if ($user_authenticated == 1) {
        echo "<BR>";
        echo "<LINK rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\">";
        // echo "In MAIN - START<BR>";
        locReminderCheck();
        Main();
        //Onsite();
        echo "</DIV>";
    }
}

//*********************************************************************************** MAIN - END
//**********************************************************************************************

include("logged_in_end_of_page.php");


//**********************************************************************************************
//**************************************************************************** FUNCTIONS - START
function Main() {
    echo "<style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid white;
        }
        </style>
        ";
    ?>
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <!-- <link rel="stylesheet" href="css/main.css" type="text/css">-->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/slip.css">
    <link rel="stylesheet" type="text/css" href="jqueryslidemenu.css" />
    <?PHP
    $CurrentlyLoggedInAs = $_POST['CurrentlyLoggedInAs'];
    $CurrentlyLoggedInAsName = $_POST['CurrentlyLoggedInAsName'];
    $user_authenticated = $_POST['user_authenticated'];

    $job_tree = $_POST['job_tree'];
    // $job_tree = "";
    if (empty($job_tree)) {
        // echo "The job tree is empty.<BR>";
        $job_tree = 0;
    }
    // $CurrentlyLoggedInAs = 1;
    echo "<DIV align=\"center\">";
    /**
    echo "<form method=\"post\" action=\"$PHP_SELF\">";
    echo "Show jobs for ";
    echo "<SELECT name=\"CurrentlyLoggedInAs\">";


    if (empty($JobFromFkUserID)) {
    $JobFromFkUserID = 1;
    }


    echo "<OPTION value=\"$JobFromFkUserID\">$FromUserFirstname";
    echo "<OPTION value=\"\">Everyone";

    $dbs = new dbSession();
    $sql = "SELECT UserFirstname, UserID from user";
    $Results = $dbs->getResult($sql);

    while ($row = $dbs->getArray($Results)) {
    // $optValue = $row['UserID'];
    echo "<OPTION value=\"$row[UserID]\">$row[UserFirstname]";
    }
    echo "</SELECT>";
    echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
    //echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"DeleteCardQuestion\">";
    //echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
    echo "<input type=\"submit\" tabindex=\"19\" name=\"Submit\" value=\"Go\">";
    echo "</form>";
     */


    // echo "<BR> \$CurrentlyLoggedInAs = $CurrentlyLoggedInAs";
    // echo "<BR> \$CurrentlyLoggedInAsName = $CurrentlyLoggedInAsName";
    echo "<DIV align=\"center\">";

    //include("config/class_detect.php");
    $box_vars = new detect;
    $box_vars->my_box();
    $mybox_width = $box_vars->mybox_width;
    /** $job_board_col_1 = $box_vars->job_board_col_1;
    $job_board_User = $box_vars->job_board_User;
    $job_board_Priority = $box_vars->job_board_Priority;
    $job_board_Client = $box_vars->job_board_Client;
    $job_board_job_title = $box_vars->job_board_job_title;
    $job_board_JID = $box_vars->job_board_JID; */
    $job_board_col_1 = 2;
    $job_board_User = 2;
    $job_board_Priority = 16;
    if ($user_authenticated == 1) {
        $job_board_Client = 16;
        $job_board_job_title = 54;
    }else{
        $job_board_Client = 0;
        $job_board_job_title = 70;
    }
    $job_board_JID = 10;
    $cols_for_textarea = $box_vars->cols_for_textarea;
    $job_title_length_divisor = $box_vars->job_title_length_divisor;



    // echo "<B><H3>Task / Job List</H3></B>";
    $header_size = $_POST['header_size'];
    echo "<H" . $header_size . ">To Do List</H" . $header_size . ">";
    $dbs = new dbSession();
    if ($CurrentlyLoggedInAs == "") {
        $sqlAdjustment = "";
    }else{
        $sqlAdjustment = "AND JobToFkUserID = \"$CurrentlyLoggedInAs\"";
    }

    if ($user_authenticated == 0) {
        $sqlAdjustment_2 = "AND Job_visibility = 2";
    }else{
        $sqlAdjustment_2 = "";
    }
    // echo "<BR> \$sqlAdjustment = $sqlAdjustment";
    $sql = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" $sqlAdjustment $sqlAdjustment_2 ORDER BY JobPriority DESC";
    // echo "<BR> \$sql = $sql";

    $Results = $dbs->getResult($sql);

    $aColor = 1;

    echo "<TABLE>";
    echo "<TR>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_col_1%\"></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_User%\"><B>For</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_Priority%\"><B>Priority</B></TD>";
    if ($user_authenticated == 1) {
        echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_Client%\"><B>Client</B></TD>";
    }
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_job_title%\"><B>JobTitle</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_JID%\"><B>ToDoID</B></TD>";
    echo "</TR>";




    $jobNumber = 0;
    while ($row = $dbs->getArray($Results)) {



        //This $jobNumber variable will need to be put back below this line instead of line 213 and line
        // 152  removed : $jobNumber = 0;
        // And line 144 in priorityUp.php to go back to $jobNumber = 1;



        // $jobNumber = $jobNumber + 1;
        $JobParent = $row['JobParent'];
        $JobChild = $row['JobChild'];
        $JobBranch = $row['JobBranch'];
        $JobTitle = $row['JobTitle'];
        $_POST['JobTitle'] = $JobTitle;
        $JobID = $row['JobID'];
        $JobFkClientID = $row['JobFkClientID'];
        $_POST['JobID'] = $JobID;
        $JobCardNumber = $row['JobCardNumber'];
        $JobPriority = $row['JobPriority'];
        $JobImpUrg = $row['JobImpUrg'];
        $JobStatus = $row['JobStatus'];
        $JobType = $row['JobType'];
        $JobToFkUserID = $row['JobToFkUserID'];

        $dbs9UserFirstName = new dbSession();
        $sql9 = "SELECT UserFirstname from user WHERE UserID = \"$JobToFkUserID\" LIMIT 1";
        $Results9User = $dbs9UserFirstName->getResult($sql9);
        $row9User = $dbs9UserFirstName->getArray($Results9User);
        $UserFirstname = $row9User['UserFirstname'];

        $dbsClientName = new dbSession();
        $sql = "SELECT ClientName from client WHERE ClientID = \"$JobFkClientID\" LIMIT 1";
        $ResultsClient = $dbs->getResult($sql);
        $rowClient = $dbs->getArray($ResultsClient);
        $clientName = $rowClient['ClientName'];

        switch ($JobImpUrg) {
            case "0";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#4775D1";
                break;
            case "A";
                $color_imp_urg_A = "#FF5050";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#4775D1";
                break;
            case "B";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#FF9933";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#4775D1";
                break;
            case "C";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#FFBD7D";
                $color_imp_urg_D = "#4775D1";
                break;
            case "D";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#FFFF00";
                break;
        }


        if (empty($JobParent)) {

            if ($aColor == 1) {
                $aColor = 0;
                $setColor = "#99ccff";
            }
            else {
                $aColor = 1;
                $setColor = "#99ccff";
            }
            echo "<TR>";
            if ($JobChild == 1) {
                $setColor = "#99ccff";
                $aColor = 1;
            }


            //********************************************************************
            //************************************************ BRANCH MAIN - START
            //if (empty($job_tree)) {
            //$job_tree = 0;
            //}
            $job_tree = $_POST['job_tree'];
            echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"3%\" colspan=\"2\">";
            //********************************************************************
            //********************** CHECK TO SEE IF THIS JOB HAS CHILDREN - START
            //echo "\$JobID = $JobID<BR>";
            $JobChild = 0;
            $dbs_find_children = new dbSession();
            $sql_find_children = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" AND JobParent = \"$JobID\" ORDER BY JobPriority DESC";
            $Results_find_children = $dbs_find_children->getResult($sql_find_children);
            while ($row_find_children = $dbs_find_children->getArray($Results_find_children)) {
                $JobChild = 1;
            }
            //echo "\$JC = $JobChild<BR>";
            //************************ CHECK TO SEE IF THIS JOB HAS CHILDREN - END
            //********************************************************************
            // echo " \$job_tree == $job_tree<BR>";
            if ($JobBranch == 0 && $JobStatus == "Active") {

                if ($JobChild == 1 ) {

                    //echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"3%\" colspan=\"2\">";
                    /**
                    echo "
                    <a href='whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriority&JobType=$JobType&JobToFkUserID
                    = $CurrentlyLoggedInAs&jobNumber=$jobNumber&job_tree=1&OptionCatch=branch'><img src=\"images/plus.png\" height=\"10\" width=\"9\" border=\"0\" title=\"Expand Branch\"></a>  $UserFirstname";
                     */
                    echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                    echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                    echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                    echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                    echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                    echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                    echo "<input type=\"hidden\" name=\"job_tree\" value=\"1\">";
                    echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                    include("log_in_authentication_form_vars.php");
                    // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                    echo "<input class=\"inputA\" type=\"image\" src=\"images/plus.png\" title=\"Expand branch.\"  name=\"action\" value=\"CBM\">";
                    echo "$UserFirstname</form>";
                    // user_button($JobToFkUserID);
                    $job_tree = 0;
                } else {
                    // echo "<TD bgcolor=\"$setColor\" align=\"middle\" colspan=\"2\">$UserFirstname";
                    // user_button($JobToFkUserID);
                    echo "$UserFirstname";
                }

            } elseif ($JobBranch == 1 && $JobStatus == "Active") {
                if ($JobChild == 1) {
                    //echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"3%\" colspan=\"2\">";
                    // echo "<a href='whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriority&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber&job_tree=0&OptionCatch=branch'><img src=\"images/minus.png\" height=\"10\" width=\"9\" border=\"0\" title=\"Collapse Branch\"></a>  ";
                    echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                    echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                    echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                    echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                    echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                    echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                    echo "<input type=\"hidden\" name=\"job_tree\" value=\"0\">";
                    echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                    include("log_in_authentication_form_vars.php");
                    // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                    echo "<input class=\"inputA\" type=\"image\" src=\"images/minus.png\" title=\"Collapse branch.\" name=\"action\" value=\"CBM\">";
                    echo "$UserFirstname</form>";
                    // user_button($JobToFkUserID);
                    $job_tree = 1;
                } else {
                    // echo "<TD bgcolor=\"$setColor\" align=\"middle\" colspan=\"2\">$UserFirstname";
                    // user_button($JobToFkUserID);
                    echo "$UserFirstname";
                }
            } else {
                $job_tree = 0;
            }
            echo "</TD>";

            //************************************************** BRANCH MAIN - END
            //********************************************************************

            echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
            //echo "<a href='priorityUp.php?JobID=$JobID&JobPriorityUp=$JobPriority&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber' class=\"linkPlainInWhiteAreas\"> </a>";
            echo "$jobNumber";
            if ($user_authenticated == 1) {
                echo "<form method=\"post\" action=\"./priorityUp.php\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                include("log_in_authentication_form_vars.php");
                echo "<input class=\"inputA\" type=\"image\" src=\"./images/up_pointer.png\" title=\"Raise the priority of this job.\" name=\"action\" value=\"\">";
                echo "</form>";

                // echo "	<img src=\"images/up_pointer.png\" height=\"10\" width=\"12\" border=\"0\">";
                /** echo "	<a href='priorityDwn.php?JobID=$JobID&JobPriorityUp=$JobPriority&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber'>
                <img src=\"images/down_pointer.png\" height=\"10\" width=\"12\" border=\"0\">
                </a>";
                 */
                echo "<form method=\"post\" action=\"./priorityDwn.php\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                include("log_in_authentication_form_vars.php");
                echo "<input type=\"image\" src=\"./images/down_pointer.png\" title=\"Lower the priority of this job.\" name=\"action\" value=\"\">";
                echo "</form>";

                include("whiteboard_imp_urg_matrix.php");
            }
            echo "	</TD>";

            $job_title_length = strlen($JobTitle);
            $rows_for_textarea = $job_title_length / $job_title_length_divisor;
            $rows_for_textarea = floor($rows_for_textarea);
            if ($rows_for_textarea < 1) {
                $rows_for_textarea = 1;
            }
            if ($user_authenticated == 1) {
                echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
                if (empty($JobFkClientID)) {
                }else{
                    client_button_with_start_time($JobFkClientID,$StartTime);
                }
                echo "</TD>";
            }
            // echo "<TD bgcolor=\"$setColor\"><pre>$JobTitle </pre></TD>";
            // echo "<TD bgcolor=\"$setColor\"><font face=\"arial\" size=\"3\"><pre><TEXTAREA rows=\"5\" cols=\"57\" name=\"ActionText\">" . wordwrap($JobTitle, 63, "<br>", true) . "</TEXTAREA></pre></font></TD>";
            // echo "<TD bgcolor=\"$setColor\"><font face=\"arial\" size=\"3\"><pre><TEXTAREA rows=\"$rows_for_textarea\" cols=\"$cols_for_textarea\" name=\"ActionText\">$JobTitle</TEXTAREA></pre></font></TD>";
            // echo "<TD bgcolor=\"$setColor\"><font face=\"arial\" size=\"3\"><pre>$JobTitle</pre></font></TD>";
            echo "<TD bgcolor=\"$setColor\"><font face=\"arial\" size=\"3\"><div style=\"white-space: pre-wrap; word-wrap: break-word; word-break: break-all;\">$JobTitle</div></font></TD>";
            echo "<TD bgcolor=\"$setColor\" align=\"middle\">";

            //echo "<a class=\"linkPlainInWhiteAreas\" href=\"JobDetails.php?JobID=$JobID&id=$JobFkClientID&JobCardNumber=$JobCardNumber\">$JobID-$JobCardNumber</a><BR><BR>";
            // echo "\$JobFkClientID = $JobFkClientID";
            if ($user_authenticated == 0) {
                echo "$JobID";
            }else{
                job_button($JobID,$JobFkClientID,$JobCardNumber);
            }
            // echo "<a href=\"./addJob3.php?OptionCatch=AddJob&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID&JobID=$JobID&JobParent=$JobID\"><img src=\"images/child2.gif\" width=\"20\" height=\"20\" title=\"Add child Job\"></img></a>";
            if ($user_authenticated == 1) {
                echo "<form method=\"post\" action=\"./index.php\">";
                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_job\">";
                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID . "\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
                include("log_in_authentication_form_vars.php");
                echo "<input type=\"image\" src=\"./images/child2.gif\" width=\"20\" height=\"20\" title=\"Add child Job\" name=\"action\">";
                echo "</form>";
                // echo "<a href=\"./whiteBoard.php?OptionCatch=job_complete&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID&JobID=$JobID&JobParent=$JobID\"><img src=\"images/tick.gif\" width=\"20\" height=\"20\" title=\"Job Complete\"></img></a>";
                echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_complete\">";
                echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
                echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID . "\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobTitle\" value=\"" . $JobTitle . "\">";
                include("log_in_authentication_form_vars.php");
                echo "<input class=\"inputA\" type=\"image\" src=\"./images/tick.gif\" width=\"20\" height=\"20\" title=\"Complete this job.\" name=\"action\" value=\"\">";
                echo "</form>";
            }
            echo "</TD>";

            echo "</TR>";

            if ($JobChild == 1 && $job_tree == 1) {
                cascade_job($job_board_col_1, $job_board_User, $job_board_Priority, $job_board_Client, $job_board_job_title, $job_board_JID);
            }

            $jobNumber = $jobNumber + 1;

        }
    }

    echo "</TABLE>";
    echo "</DIV>";
    echo "<BR><BR>";

// include("logged_in_end_of_page.php");
}

function job_complete() {
    $JobID = $_POST['JobID'];
    $UserID = $_POST['UserID'];
    $ClientID = $_POST['ClientID'];
    $JobTitle = addslashes($_POST['JobTitle']);
    $StartTime = time();
    //**********************************************************************************************
    //***************************************************************** DEBUG VARIABLES HERE - START
    $turn_this_debug_on = 0;
    if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "In the function job_complete on the whiteboard the \$JobID = $JobID<BR>";
        include("config/debug.php");
    }
    //******************************************************************* DEBUG VARIABLES HERE - END
    //**********************************************************************************************
    $update_job = new child;
    $update_job->job_complete($JobID);
    $jobStatus = $update_job->jobStatus;




    $update_action_job_complete = new child;
    $update_action_job_complete->make_action_saying_the_job_is_complete($JobID, $ClientID, $UserID, $JobTitle, $StartTime);
    $action_status = $update_action_job_complete->action_status;
    echo "<DIV align=\"center\" ><FONT SIZE=\"4\" COLOR=\"#009933\">$jobStatus $action_status</FONT></DIV>";
}

function cascade_job($job_board_col_1, $job_board_User, $job_board_Priority, $job_board_Client, $job_board_job_title, $job_board_JID) {
//**********************************************************************************************
//**************************************************************************** CASCADE 2 - START
    $user_authenticated = $_POST['user_authenticated'];
    $JobID = $_POST['JobID'];
    $job_tree = $_POST['job_tree'];

    $x = $_POST['JobID'];

    //include("config/class_detect.php");
    $box_vars = new detect;
    $box_vars->my_box();
    $mybox_width = $box_vars->mybox_width;
    // $job_board_col_1 = $box_vars->job_board_col_1;
    //$job_board_User = 15%;
    //$job_board_Priority = 15%;
    //$job_board_Client = 15%;
    //$job_board_job_title = 15%;
    //$job_board_JID = 15%;
    $cols_for_textarea = $box_vars->cols_for_textarea;
    // $branch_spacer_total_from_class = $box_vars->branch_spacer_total_from_class; // Removed because running class_detect.php caused page to hang in this new version.
    $branch_spacer_total_from_class = 10;
    // $branch_increment_from_class = $box_vars->branch_increment_from_class;
    $branch_increment_from_class = 10;
    $job_title_length_divisor = $box_vars->job_title_length_divisor;
    // echo "<BR>\$x in cascade 2 = $x";


    //$job_tree = "";
    if (empty($job_tree)) {
        //echo "<BR> The job tree in cascade 2 is empty.<BR>";
        $job_tree = 0;
    }
    // echo "<BR>\$job_ID in the beginning of cascade 2 = $Job_ID<BR>";
    //echo "\$job_tree = $job_tree";
    echo "<TR height=\"\">";
    echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"7\">";



//***********************************			
//********************** here 2	START

    $dbs2 = new dbSession();
    if ($CurrentlyLoggedInAs == "") {
        $sqlAdjustment = "";
    }else{
        $sqlAdjustment = "AND JobToFkUserID = \"$CurrentlyLoggedInAs\"";
    }

    if ($user_authenticated == 0) {
        $sqlAdjustment_2 = "AND Job_visibility = 2";
    }else{
        $sqlAdjustment_2 = "";
    }
    // echo "<BR> \$sqlAdjustment = $sqlAdjustment";

    $sql2 = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" AND JobParent = $JobID $sqlAdjustment $sqlAdjustment_2 ORDER BY JobPriority DESC";
    // echo "<BR> \$sql = $sql";

    $Results2 = $dbs2->getResult($sql2);

    $aColor = 1;

    $branch_spacer_total = $_POST['branch_spacer_total'];
    if ($branch_spacer_total < $branch_spacer_total_from_class) {
        $branch_spacer_total = $branch_spacer_total_from_class;
    }

    echo "<TABLE style=\"width: 100%;\">";

    echo "<TR>";
    //echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" colspan=\"7\" width=\"684\"></TD>";
    // DP 20th May 2016 - to make the indentations visible change the style border below to 1px
    echo "<TD bgcolor=\"#FFFFFF\"><img src=\"images/spacer.gif\" style=\"border: 0px solid black;\" width=\"$branch_spacer_total\" height=\"5\" title=\"\"></TD>";
    // $job_board_col_1, $job_board_User, $job_board_Priority, $job_board_Client, $job_board_job_title, $job_board_JID
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_col_1%\"></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_User%\"></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_Priority%\"></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_Client%\"></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_job_title%\"></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_JID%\"></TD>";

    echo "</TR>";


    $jobNumber2 = 0;
    while ($row2 = $dbs2->getArray($Results2)) {



        //This $jobNumber2 variable will need to be put back below this line instead of line 213 and line
        // 152  removed : $jobNumber2 = 0;
        // And line 144 in priorityUp.php to go back to $jobNumber2 = 1;



        // $jobNumber2 = $jobNumber2 + 1;

        $JobParent = $row2['JobParent'];
        $JobChild = $row2['JobChild'];
        $JobBranch = $row2['JobBranch'];
        $JobTitle = $row2['JobTitle'];
        $JobID = $row2['JobID'];
        //echo "\$JobID i hope 2 == $JobID<BR>";
        $JobID2 = $row2['JobID'];
        $_POST['JobID2'] = $JobID2;
        $JobFkClientID2 = $row2['JobFkClientID'];
        $JobCardNumber = $row2['JobCardNumber'];
        $JobPriority2 = $row2['JobPriority'];
        $JobImpUrg = $row2['JobImpUrg'];
        $JobStatus = $row2['JobStatus'];
        $JobType = $row2['JobType'];

        $JobToFkUserID = $row2['JobToFkUserID'];
        $dbs2UserFirstName = new dbSession();
        $sql2 = "SELECT UserFirstname from user WHERE UserID = \"$JobToFkUserID\" LIMIT 1";
        $Results2User = $dbs2->getResult($sql2);
        $row2User = $dbs2->getArray($Results2User);
        $UserFirstname = $row2User['UserFirstname'];

        $JobFkClientID = $row2['JobFkClientID'];
        $dbs2ClientName = new dbSession();
        $sql2 = "SELECT ClientName from client WHERE ClientID = \"$JobFkClientID\" LIMIT 1";
        $Results2Client = $dbs2->getResult($sql2);
        $row2Client = $dbs2->getArray($Results2Client);
        $clientName = $row2Client['ClientName'];



        if ($aColor == 1) {
            $aColor = 0;
            $setColor2 = "#B8B8FF";
        }
        else {
            $aColor = 1;
            $setColor2 = "#B8B8FF";
        }



        switch ($JobImpUrg) {
            case "0";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#4775D1";
                break;
            case "A";
                $color_imp_urg_A = "#FF5050";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#4775D1";
                break;
            case "B";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#FF9933";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#4775D1";
                break;
            case "C";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#FFBD7D";
                $color_imp_urg_D = "#4775D1";
                break;
            case "D";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#FFFF00";
                break;
        }

        // In cascade 2
        //echo "<BR>\$brt2 nxt = $branch_spacer_total";
        echo "<TR>";
        echo "<TD></TD>";
        echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"2\">";
        //********************************************************************
        //********************** CHECK TO SEE IF THIS JOB HAS CHILDREN - START
        //echo "\$JobID = $JobID<BR>";
        $JobChild = 0;
        $dbs_find_children = new dbSession();
        $sql_find_children = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" AND JobParent = \"$JobID\" ORDER BY JobPriority DESC";
        $Results_find_children = $dbs_find_children->getResult($sql_find_children);
        while ($row_find_children = $dbs_find_children->getArray($Results_find_children)) {
            $JobChild = 1;
        }
        //echo "\$JC = $JobChild<BR>";
        //************************ CHECK TO SEE IF THIS JOB HAS CHILDREN - END
        //********************************************************************
        if ($JobChild == 1) {
            $setColor2 = "#B8B8FF";
            $aColor = 0;
        }
        //********************************************************************
        //*************************************************** BRANCH 2 - START
        //if (empty($job_tree)) {
        //$job_tree = 0;
        //}
        $job_tree = $_POST['job_tree'];

        // echo " \$job_tree == $job_tree<BR>";
        if ($JobBranch == 0 ) {
            if ($JobChild == 1 ) {
                //echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"2\">";
                /** echo "<a href='whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriority2&JobType=$JobType&JobToFkUserID
                = $CurrentlyLoggedInAs&jobNumber=$jobNumber2&job_tree=1&OptionCatch=branch'><img src=\"images/plus.png\" height=\"10\" width=\"9\" border=\"0\" title=\"Expand Branch\"></a>  $UserFirstname"; */
                $job_tree = 0;
                echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority2 . "\">";
                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                echo "<input type=\"hidden\" name=\"job_tree\" value=\"1\">";
                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                include("log_in_authentication_form_vars.php");
                // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                echo "<input class=\"inputA\" type=\"image\" src=\"images/plus.png\" title=\"Expand branch.\" name=\"action\" value=\"CBM\">";
                echo "</form>";
                // user_button($JobToFkUserID);
                echo "$UserFirstname";
                //echo "</TD>";

            } else {
                //echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"2\">";
                //user_button($JobToFkUserID);
                echo "$UserFirstname";
                //echo "</TD>";
            }
        } elseif ($JobBranch == 1) {
            if ($JobChild == 1 ) {
                //echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"2\">";
                /** echo "<a href='whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriority2&JobType=$JobType&JobToFkUserID
                = $CurrentlyLoggedInAs&jobNumber=$jobNumber2&job_tree=0&OptionCatch=branch'>
                <img src=\"images/minus.png\" title=\"Collapse branch.\" height=\"10\" width=\"9\" border=\"0\" title=\"Collapse Branch\">
                </a>  $UserFirstname";
                 */
                echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority2 . "\">";
                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber2 . "\">";
                echo "<input type=\"hidden\" name=\"job_tree\" value=\"0\">";
                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                include("log_in_authentication_form_vars.php");
                // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                echo "<input class=\"inputA\" type=\"image\" src=\"images/minus.png\" title=\"Collapse branch.\" name=\"action\" value=\"CBM\"><BR>";
                // user_button($JobToFkUserID);
                echo "$UserFirstname";
                echo "</form>";
                //echo "</TD>";
                $job_tree = 1;
            } else {
                //echo "<TD bgcolor=\"$setColor2\" align=\"middle\" colspan=\"2\">";
                // user_button($JobToFkUserID);
                echo "$UserFirstname";
                //echo "</TD>";
            }
        } else {
            $job_tree = 0;
        }

        echo "</TD>";
        //***************************************************** BRANCH 2 - END
        //********************************************************************
        echo "<TD bgcolor=\"$setColor2\" align=\"middle\">";

        // echo "<a href='priorityUp.php?JobID=$JobID&JobPriorityUp=$JobPriority2&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber2' class=\"linkPlainInWhiteAreas\"> $jobNumber2</a><img src=\"images/up_pointer.png\" height=\"10\" width=\"12\" border=\"0\">";
        echo $jobNumber2;
        if ($user_authenticated == 1) {
            echo "<form method=\"post\" action=\"./priorityUp.php\">";
            echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
            echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority2 . "\">";
            echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
            echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
            echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber2 . "\">";
            echo "<input type=\"hidden\" name=\"job_tree\" value=\"" . $job_tree . "\">";
            include("log_in_authentication_form_vars.php");
            echo "<input class=\"inputA\" type=\"image\" src=\"./images/up_pointer.png\" title=\"Raise the priority of this job.\" name=\"action\" value=\"\">";
            echo "</form>";

            //echo "<a href='priorityDwn.php?JobID=$JobID&JobPriorityUp=$JobPriority2&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber2&JobParent=$JobParent'><img src=\"images/down_pointer.png\" height=\"10\" width=\"12\" border=\"0\"></a>";
            echo "<form method=\"post\" action=\"./priorityDwn.php\">";
            echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
            echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority2 . "\">";
            echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
            echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
            echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber2 . "\">";
            echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobParent . "\">";
            include("log_in_authentication_form_vars.php");
            echo "<input class=\"inputA\" type=\"image\" src=\"./images/down_pointer.png\" title=\"Lower the priority of this job.\" name=\"action\" value=\"\">";
            echo "</form>";

            include("whiteboard_imp_urg_matrix.php");
        }


        echo "		</TD>";

        $job_title_length = strlen($JobTitle);
        $rows_for_textarea = $job_title_length / $job_title_length_divisor;
        $rows_for_textarea = floor($rows_for_textarea);
        if ($rows_for_textarea < 1) {
            $rows_for_textarea = 1;
        }
        if ($user_authenticated == 1) {
            echo "<TD bgcolor=\"$setColor2\" align=\"middle\">";
            // echo "<a class=\"linkPlainInWhiteAreas\" href=\"clientcard2.php?id=$JobFkClientID&name=$clientName\">$clientName</a>";
            /**
            echo "<form method=\"post\" action=\"./clientcard2.php\">";
            echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID . "\">";
            echo "<input type=\"hidden\" name=\"clientName\" value=\"" . $clientName . "\">";
            include("log_in_authentication_form_vars.php");
            // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
            echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"" . $clientName . "\">";
            echo "</form>"; */
            client_button_with_start_time($JobFkClientID,$StartTime);
            echo "</TD>";
        }
        // echo "<TD bgcolor=\"$setColor2\"><pre>$JobTitle </pre></TD>";
        // echo "<TD bgcolor=\"$setColor2\"><font face=\"arial\" size=\"3\"><pre><TEXTAREA rows=\"5\" cols=\"57\" name=\"ActionText\">" . wordwrap($JobTitle, 63, "<br>", true) . "</TEXTAREA></pre></font></TD>";
        //echo "<TD bgcolor=\"$setColor2\"><font face=\"arial\" size=\"3\"><pre><TEXTAREA rows=\"$rows_for_textarea\" cols=\"$cols_for_textarea\" name=\"ActionText\">$JobTitle</TEXTAREA></pre></font></TD>";
        if ($user_authenticated == 1) {
            echo "<TD bgcolor=\"$setColor2\"><font face=\"arial\" size=\"3\"><div style=\"white-space: pre-wrap; word-wrap: break-word; word-break: break-all;\">$JobTitle</div></font></TD>";
        }else{
            echo "<TD bgcolor=\"$setColor2\" colspan=\"2\"><font face=\"arial\" size=\"3\"><div style=\"white-space: pre-wrap; word-wrap: break-word; word-break: break-all;\">$JobTitle</div></font></TD>";
        }
        echo "<TD bgcolor=\"$setColor2\" align=\"middle\">";
        // echo "<a class=\"linkPlainInWhiteAreas\" href=\"JobDetails.php?JobID=$JobID&id=$JobFkClientID&JobCardNumber=$JobCardNumber&JobParent=$JobParent\">$JobID-$JobCardNumber</a><BR><BR>";
        if ($user_authenticated == 0) {
            echo "$JobID";
        }else{
            /** echo "\$JobFkClientID = $JobFkClientID<BR>";
            echo "\$JobCardNumber = $JobCardNumber<BR>";
            echo "\$JobParent in branch 2 = $JobParent"; */
            job_button($JobID,$JobFkClientID,$JobCardNumber,$JobParent);
        }
        // echo "<a href=\"./addJob3.php?OptionCatch=AddJob&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID2&JobID=$JobID&JobParent=$JobID\"><img src=\"images/child2.gif\" width=\"20\" height=\"20\" title=\"Add child Job\"></img></a>";
        if ($user_authenticated == 1) {
            echo "<form method=\"post\" action=\"./index.php\">";
            echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_job\">";
            echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
            echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
            echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID2 . "\">";
            echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
            echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
            include("log_in_authentication_form_vars.php");
            echo "<input class=\"inputA\" type=\"image\" src=\"./images/child2.gif\" width=\"20\" height=\"20\" title=\"Add child Job\" name=\"action\" value=\"\">";
            echo "</form>";
            // echo "<a href=\"./whiteBoard.php?OptionCatch=job_complete&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID2&JobID=$JobID&JobParent=$JobID\"><img src=\"images/tick.gif\" width=\"20\" height=\"20\" title=\"Job Complete\"></img></a>";
            echo "<form method=\"post\" action=\"./whiteBoard.php\">";
            echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_complete\">";
            echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
            echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
            echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID2 . "\">";
            echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
            echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
            echo "<input type=\"hidden\" name=\"JobTitle\" value=\"" . $JobTitle . "\">";
            include("log_in_authentication_form_vars.php");
            echo "<input class=\"inputA\" type=\"image\" src=\"./images/tick.gif\" width=\"20\" height=\"20\" title=\"Complete this job.\" name=\"action\" value=\"\">";
            echo "</form>";
        }
        $_POST['JobID'] = $JobID;
        $x = $_POST['JobID'];
        $JobID = $_POST['JobID'];
        $JobID2 = $_POST['JobID2'];
        //echo "<BR>\$JobID at end of cascade 2 = $JobID";
        //echo "<BR>\$JobID2 at end of cascade 2 = $JobID2";
        //echo "<BR>\$JobBranch at end of cascade 2 = $JobBranch";
        //echo "<BR>\$brt2 = $branch_spacer_total";

        echo "</TD>";

        echo "</TR>";



        if ($JobChild == 1 && $job_tree == 1) {
            // $branch_increment = branch_increment_from_class;
            $branch_increment = 5;
            $_POST['$branch_increment'] = $branch_increment;
            $branch_spacer_total = $branch_spacer_total + $branch_increment;
            $_POST['branch_spacer_total'] = $branch_spacer_total;
            cascade_job3($job_board_col_1, $job_board_User, $job_board_Priority, $job_board_Client, $job_board_job_title, $job_board_JID);
        }

        $jobNumber2 = $jobNumber2 + 1;


    }

    echo "</TABLE>";
    // echo "</DIV>";

//*********************** here 2 END			
//***********************************			
    echo "</TD>";

    echo "</TR>";
    $aColor = 1;
    $branch_spacer_total = 0;
    $_POST['branch_spacer_total'] = $branch_spacer_total;
//****************************************************************************** CASCADE 2 - END			
//**********************************************************************************************
}
function cascade_job3($job_board_col_1, $job_board_User, $job_board_Priority, $job_board_Client, $job_board_job_title, $job_board_JID) {
//**********************************************************************************************
//**************************************************************************** CASCADE 3 - START		
    $user_authenticated = $_POST['user_authenticated'];
    $JobID = $_POST['JobID'];
    $job_tree = $_POST['job_tree'];
    $JobID2 = $_POST['JobID2'];

    $x = $_POST['JobID'];
    //include("config/class_detect.php");
    $box_vars = new detect;
    $box_vars->my_box();
    $mybox_width = $box_vars->mybox_width;
    /** $job_board_col_1 = $box_vars->job_board_col_1;
    $job_board_User = $box_vars->job_board_User;
    $job_board_Priority = $box_vars->job_board_Priority;
    $job_board_Client = $box_vars->job_board_Client;
    $job_board_job_title = $box_vars->job_board_job_title;
    $job_board_JID = $box_vars->job_board_JID; */
    $cols_for_textarea = $box_vars->cols_for_textarea;
    // $branch_spacer_total_from_class = $box_vars->branch_spacer_total_from_class;
    // $branch_increment_from_class = $box_vars->branch_increment_from_class;
    $branch_spacer_total_from_class = 10;
    $branch_increment_from_class = 10;
    $job_title_length_divisor = $box_vars->job_title_length_divisor;
    //echo "<BR>\$JobID in beginning of cascade 3 = $JobID";
    //echo "<BR>\$JobID2 at end of cascade 3 = $JobID2";

    echo "<TR>";
    echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"7\">";

//***********************************			
//********************** here 3	START

    $dbs3 = new dbSession();
    if ($CurrentlyLoggedInAs == "") {
        $sqlAdjustment = "";
    }else{
        $sqlAdjustment = "AND JobToFkUserID = \"$CurrentlyLoggedInAs\"";
    }

    if ($user_authenticated == 0) {
        $sqlAdjustment_2 = "AND Job_visibility = 2";
    }else{
        $sqlAdjustment_2 = "";
    }
    // echo "<BR> \$sqlAdjustment = $sqlAdjustment";
    // echo "\$JobID just before sql == $JobID<BR>";
    // echo "\$JobID2 just before sql == $JobID2<BR>";
    $sql3 = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" AND JobParent = $JobID2 $sqlAdjustment $sqlAdjustment_2 ORDER BY JobPriority DESC";
    // echo "<BR> \$sql = $sql";

    $Results3 = $dbs3->getResult($sql3);

    $aColor = 1;

    $branch_spacer_total = $_POST['branch_spacer_total'];

    echo "<TABLE style=\"width: 100%;\">";
    echo "<TR>";
    //echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" colspan=\"7\" width=\"684\"></TD>";
    // DP 20th May 2016 - to make the indentations visible change the style border below to 1px
    echo "<TD bgcolor=\"#FFFFFF\"><img src=\"images/spacer.gif\"  style=\"border: 0px solid black; padding: 0;\" width=\"$branch_spacer_total\" height=\"10\" title=\"\"></TD>";
    // $job_board_col_1, $job_board_User, $job_board_Priority, $job_board_Client, $job_board_job_title, $job_board_JID
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_col_1%\"></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_User%\"></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_Priority%\"></TD>";
    if ($user_authenticated == 1) {
        echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_Client%\"></TD>";
    }
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_job_title%\"></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"$job_board_JID%\"></TD>";

    echo "</TR>";

    $jobNumber3 = 0;
    while ($row3 = $dbs3->getArray($Results3)) {



        //This $jobNumber3 variable will need to be put back below this line instead of line 213 and line
        // 152  removed : $jobNumber3 = 0;
        // And line 144 in priorityUp.php to go back to $jobNumber3 = 1;



        // $jobNumber3 = $jobNumber3 + 1;

        $JobParent = $row3['JobParent'];
        $JobChild = $row3['JobChild'];

        $JobBranch = $row3['JobBranch'];
        $JobTitle = $row3['JobTitle'];
        $JobID = $row3['JobID'];
        $JobFkClientID3 = $row3['JobFkClientID'];
        $JobCardNumber = $row3['JobCardNumber'];
        $JobPriority3 = $row3['JobPriority'];
        $JobImpUrg = $row3['JobImpUrg'];
        $JobStatus = $row3['JobStatus'];
        $JobType = $row3['JobType'];

        $JobToFkUserID = $row3['JobToFkUserID'];
        $dbs3UserFirstName = new dbSession();
        $sql3 = "SELECT UserFirstname from user WHERE UserID = \"$JobToFkUserID\" LIMIT 1";
        $Results3User = $dbs3->getResult($sql3);
        $row3User = $dbs3->getArray($Results3User);
        $UserFirstname = $row3User['UserFirstname'];

        $JobFkClientID = $row3['JobFkClientID'];
        $dbs3ClientName = new dbSession();
        $sql3 = "SELECT ClientName from client WHERE ClientID = \"$JobFkClientID\" LIMIT 1";
        $Results3Client = $dbs3->getResult($sql3);
        $row3Client = $dbs3->getArray($Results3Client);
        $clientName = $row3Client['ClientName'];



        if ($aColor == 1) {
            $aColor = 0;
            $setColor3 = "#CC99FF";
        }
        else {
            $aColor = 1;
            $setColor3 = "#CC99FF";
        }




        switch ($JobImpUrg) {
            case "0";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#4775D1";
                break;
            case "A";
                $color_imp_urg_A = "#FF5050";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#4775D1";
                break;
            case "B";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#FF9933";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#4775D1";
                break;
            case "C";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#FFBD7D";
                $color_imp_urg_D = "#4775D1";
                break;
            case "D";
                $color_imp_urg_A = "#4775D1";
                $color_imp_urg_B = "#4775D1";
                $color_imp_urg_C = "#4775D1";
                $color_imp_urg_D = "#FFFF00";
                break;
        }




        // In cascade 3
        //echo "<BR>\$brt3 next to set = $branch_spacer_total";
        echo "<TR>";

        echo "<TD>";


        echo "</TD>";
        echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"2\">";
        //********************************************************************
        //********************** CHECK TO SEE IF THIS JOB HAS CHILDREN - START
        //echo "\$JobID = $JobID<BR>";
        $JobChild = 0;
        $dbs_find_children = new dbSession();
        $sql_find_children = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" AND JobParent = \"$JobID\" ORDER BY JobPriority DESC";
        $Results_find_children = $dbs_find_children->getResult($sql_find_children);
        while ($row_find_children = $dbs_find_children->getArray($Results_find_children)) {
            $JobChild = 1;
        }
        //echo "\$JC = $JobChild<BR>";
        //************************ CHECK TO SEE IF THIS JOB HAS CHILDREN - END
        //********************************************************************

        if ($JobChild == 1) {
            $setColor3 = "#CC99FF";
            $aColor = 0;
        }



        //********************************************************************
        //*************************************************** BRANCH 3 - START
        //if (empty($job_tree)) {
        //$job_tree = 0;
        //}
        $job_tree = $_POST['job_tree'];

        // echo " \$job_tree == $job_tree<BR>";
        if ($JobBranch == 0 ) {
            if ($JobChild == 1) {
                //echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"2\">";
                /** echo "
                <a href='whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriority3&JobType=$JobType&JobToFkUserID
                = $CurrentlyLoggedInAs&jobNumber=$jobNumber3&job_tree=1&OptionCatch=branch'><img src=\"images/plus.png\" height=\"10\" width=\"9\" border=\"0\" title=\"Expand Branch\"></a>  $UserFirstname </TD>"; */
                $job_tree = 0;
                echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber3 . "\">";
                echo "<input type=\"hidden\" name=\"job_tree\" value=\"1\">";
                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                include("log_in_authentication_form_vars.php");
                // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                echo "<input class=\"inputA\" type=\"image\" src=\"images/plus.png\" title=\"Expand branch.\" name=\"action\" value=\"CBM\">";
                echo "</form>";
                // user_button($JobToFkUserID);
                echo "$UserFirstname";
                //echo "</TD>";


            } else {
                //echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"2\">";
                // user_button($JobToFkUserID);
                echo "$UserFirstname";
                //echo "</TD>";
            }
        } elseif ($JobBranch == 1 ) {
            if ($JobChild == 1) {
                //echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"2\">";
                /** echo "
                <a href='whiteBoard.php?JobID=$JobID&JobPriorityUp=$JobPriority3&JobType=$JobType&JobToFkUserID
                = $CurrentlyLoggedInAs&jobNumber=$jobNumber3&job_tree=0&OptionCatch=branch'>
                <img src=\"images/minus.png\" height=\"10\" width=\"9\" border=\"0\" title=\"Collapse Branch\">
                </a>  $UserFirstname </TD>"; */
                echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority3 . "\">";
                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber3 . "\">";
                echo "<input type=\"hidden\" name=\"job_tree\" value=\"0\">";
                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                include("log_in_authentication_form_vars.php");
                // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
                echo "<input class=\"inputA\" type=\"image\" src=\"images/minus.png\" title=\"Collapse branch.\" name=\"action\" value=\"CBM\">";
                echo "</form>";
                // user_button($JobToFkUserID);
                echo "$UserFirstname";
                //echo "</TD>";
                $job_tree = 1;
            } else {
                //echo "<TD bgcolor=\"$setColor3\" align=\"middle\" colspan=\"2\">";
                // user_button($JobToFkUserID);
                echo "$UserFirstname";
                //echo "</TD>";
            }
        } else {
            $job_tree = 0;
        }

        echo "</TD>";
        //***************************************************** BRANCH 3 - END
        //********************************************************************
        echo "<TD bgcolor=\"$setColor3\" align=\"middle\">";
        // echo "<a href='priorityUp.php?JobID=$JobID&JobPriorityUp=$JobPriority3&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber3&job_tree=$job_tree' class=\"linkPlainInWhiteAreas\"> $jobNumber3</a><img src=\"images/up_pointer.png\" height=\"10\" width=\"12\" border=\"0";
        echo "$jobNumber3";
        if ($user_authenticated == 1) {
            echo "<form method=\"post\" action=\"./priorityUp.php\">";
            echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
            echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority3 . "\">";
            echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
            echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
            echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber3 . "\">";
            echo "<input type=\"hidden\" name=\"job_tree\" value=\"" . $job_tree . "\">";
            include("log_in_authentication_form_vars.php");
            echo "<input class=\"inputA\" type=\"image\" src=\"./images/up_pointer.png\" title=\"Raise the priority of this job.\" name=\"action\" value=\"\">";
            echo "</form>";

            // echo "<img src=\"images/down_pointer.png\" height=\"10\" width=\"12\" border=\"0\"></a> ";
            echo "<form method=\"post\" action=\"./priorityDwn.php\">";
            echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
            echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority3 . "\">";
            echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
            echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
            echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber3 . "\">";
            echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobParent . "\">";
            include("log_in_authentication_form_vars.php");
            echo "<input class=\"inputA\" type=\"image\" src=\"./images/down_pointer.png\" title=\"Lower the priority of this job.\" name=\"action\" value=\"\">";
            echo "</form>";


            include("whiteboard_imp_urg_matrix.php");
        }

        echo "				</TD>";
        $job_title_length = strlen($JobTitle);
        $rows_for_textarea = $job_title_length / $job_title_length_divisor;
        $rows_for_textarea = floor($rows_for_textarea);
        if ($rows_for_textarea < 1) {
            $rows_for_textarea = 1;
        }
        if ($user_authenticated == 1) {
            echo "<TD bgcolor=\"$setColor3\" align=\"middle\">";
            // echo "<a class=\"linkPlainInWhiteAreas\" href=\"clientcard2.php?id=$JobFkClientID&name=$clientName\">$clientName</a>";
            /**
            echo "<form method=\"post\" action=\"./clientcard2.php\">";
            echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID . "\">";
            echo "<input type=\"hidden\" name=\"clientName\" value=\"" . $clientName . "\">";
            include("log_in_authentication_form_vars.php");
            // echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"CBM\">";
            echo "<input class=\"inputA\" type=\"submit\" name=\"submit\" value=\"" . $clientName . "\">";
            echo "</form>"; */
            client_button_with_start_time($JobFkClientID,$StartTime);
            echo "</TD>";
        }
        // echo "<TD bgcolor=\"$setColor3\"><pre>$JobTitle </pre></TD>";
        // echo "<TD bgcolor=\"$setColor3\"><font face=\"arial\" size=\"3\"><pre><TEXTAREA rows=\"5\" cols=\"57\" name=\"ActionText\">" . wordwrap($JobTitle, 63, "<br>", true) . "</TEXTAREA></pre></font></TD>";
        // echo "<TD bgcolor=\"$setColor3\"><pre><TEXTAREA rows=\"$rows_for_textarea\" cols=\"$cols_for_textarea\" name=\"ActionText\">$JobTitle</TEXTAREA></pre></TD>";
        echo "<TD bgcolor=\"$setColor3\"><font face=\"arial\" size=\"3\"><div style=\"white-space: pre-wrap; word-wrap: break-word; word-break: break-all;\">$JobTitle</div></font></TD>";
        echo "<TD bgcolor=\"$setColor3\" align=\"middle\">";
        // echo "<a class=\"linkPlainInWhiteAreas\" href=\"JobDetails.php?JobID=$JobID&id=$JobFkClientID&JobCardNumber=$JobCardNumber&JobParent=$JobParent\">$JobID-$JobCardNumber</a><BR><BR>";

        // echo "\$JobFkClientID in branch 3 = $JobFkClientID";
        if ($user_authenticated == 0) {
            echo "$JobID";
        }else{
            job_button($JobID,$JobFkClientID,$JobCardNumber,$JobParent);
        }
        // echo "<a href=\"./addJob3.php?OptionCatch=AddJob&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID3&JobID=$JobID&JobParent=$JobID\"><img src=\"images/child2.gif\" width=\"20\" height=\"20\" title=\"Add child Job\"></img></a>";
        if ($user_authenticated == 1) {
            echo "<form method=\"post\" action=\"./index.php\">";
            echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_job\">";
            echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
            echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
            echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID3 . "\">";
            echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
            echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
            include("log_in_authentication_form_vars.php");
            echo "<input class=\"inputA\" type=\"image\" src=\"./images/child2.gif\" width=\"20\" height=\"20\" title=\"Add child Job\" name=\"action\" value=\"\">";
            echo "</form>";
            // echo "<a href=\"./whiteBoard.php?OptionCatch=job_complete&StartTime=$StartTime&ClientName=$clientName&ClientID=$JobFkClientID3&JobID=$JobID&JobParent=$JobID\"><img src=\"images/tick.gif\" width=\"20\" height=\"20\" title=\"Job Complete\"></img></a>";
            echo "<form method=\"post\" action=\"./whiteBoard.php\">";
            echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"job_complete\">";
            echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
            echo "<input type=\"hidden\" name=\"ClientName\" value=\"" . $clientName . "\">";
            echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID3 . "\">";
            echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
            echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobID . "\">";
            echo "<input type=\"hidden\" name=\"JobTitle\" value=\"" . $JobTitle . "\">";
            include("log_in_authentication_form_vars.php");
            echo "<input class=\"inputA\" type=\"image\" src=\"./images/tick.gif\" width=\"20\" height=\"20\" title=\"Complete this job.\" name=\"action\" value=\"\">";
            echo "</form>";
        }
        $_POST['JobID'] = $JobID;
        $x = $_POST['JobID'];
        $JobID = $_POST['JobID'];
        $JobID2 = $_POST['JobID2'];
        //echo "<BR>\$JobID at end of cascade 3 = $JobID";
        //echo "<BR>\$JobID2 at end of cascade 3 = $JobID2";
        //echo "<BR>\$JobBranch at end of cascade 3 = $JobBranch";
        //echo "<BR>\$JobChild at end of cascade 3 = $JobChild";
        //echo "<BR>\$brt3 = $branch_spacer_total";

        echo "</TD>";

        echo "</TR>";



        if ($JobChild == 1 && $job_tree == 1) {
            $branch_increment = $_POST['$branch_increment'];
            $branch_spacer_total = $branch_spacer_total + $branch_increment;
            $_POST['branch_spacer_total'] = $branch_spacer_total;
            cascade_job($job_board_col_1, $job_board_User, $job_board_Priority, $job_board_Client, $job_board_job_title, $job_board_JID);
        }

        $jobNumber3 = $jobNumber3 + 1;


    }

    echo "</TABLE>";
    // echo "</DIV>";

//*********************** here 3 END			
//***********************************			
    echo "</TD>";

    echo "</TR>";
    $aColor = 1;
    $branch_spacer_total = 0;
    $_POST['branch_spacer_total'] = $branch_spacer_total;
//****************************************************************************** CASCADE 3 - END			
//**********************************************************************************************


}
function Onsite() {

    echo "<BR><B>Onsite Jobs</B>";
    $dbs = new dbSession();
    $sql = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = 
	\"Onsite\" ORDER BY JobPriority DESC";
    $Results = $dbs->getResult($sql);

    $aColor = 1;

    echo "<TABLE>";
    echo "<TR>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"3%\"><B>User</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"3%\"><B>Priority</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"10%\"><B>Client</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\"><B>JobTitle</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"8%\"><B>JID-EHN</B></TD>";
    echo "</TR>";

    while ($row = $dbs->getArray($Results)) {

        $JobTitle = $row['JobTitle'];
        $JobID = $row['JobID'];
        $JobCardNumber = $row['JobCardNumber'];
        $JobPriority = $row['JobPriority'];
        $JobType = $row['JobType'];

        $JobToFkUserID = $row['JobToFkUserID'];
        $dbsUserFirstName = new dbSession();
        $sql = "SELECT UserFirstname from user WHERE UserID = \"$JobToFkUserID\" LIMIT 1";
        $ResultsUser = $dbs->getResult($sql);
        $rowUser = $dbs->getArray($ResultsUser);
        $UserFirstname = $rowUser['UserFirstname'];

        $JobFkClientID = $row['JobFkClientID'];
        $dbsClientName = new dbSession();
        $sql = "SELECT ClientName from client WHERE ClientID = \"$JobFkClientID\" LIMIT 1";
        $ResultsClient = $dbs->getResult($sql);
        $rowClient = $dbs->getArray($ResultsClient);
        $clientName = $rowClient['ClientName'];

        if ($aColor == 1) {
            $aColor = 0;
            $setColor = "#99ccff";
        }
        else {
            $aColor = 1;
            $setColor = "#FFFFFF";
        }

        echo "<TR>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">$UserFirstname</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">
				<a href='priorityUp.php?JobID=$JobID&JobPriorityUp=$JobPriority&JobType=$JobType'>
				<img src=\"images/up_pointer.png\" height=\"10\" width=\"12\" border=\"0\">
				</a>
				<a href='priorityDwn.php?JobID=$JobID&JobPriorityUp=$JobPriority&JobType=$JobType'>
				<img src=\"images/down_pointer.png\" height=\"10\" width=\"12\" border=\"0\">
				</a>
				</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\"><a href=\"clientcard2.php?
				id=$JobFkClientID&name=$clientName\">$clientName</a></TD>";
        echo "<TD bgcolor=\"$setColor\">$JobTitle</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\"><a href=\"JobDetails.php?JobID=$JobID&$id=$JobFkClientID\">$JobID-$JobCardNumber</a></TD>";

        echo "</TR>";

    }

    echo "</TABLE>";

}
function locReminderCheck() {
    $UserID = $_POST['UserID'];
    $currentTime = time();
//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
    $turn_this_debug_on = 0;
    if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "\$currentTime = $currentTime<BR><BR>";
        include("config/debug.php");
    }
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************
    $dbsReminder = new dbSession();
    $sql = "SELECT ReminderID, ReminderSchedTimeInSecs, ReminderTimeDismissedInSecs from reminder WHERE ReminderTimeDismissedInSecs = '0' AND ReminderSchedTimeInSecs <= '$currentTime' AND (ReminderToFkUserID = '$UserID' OR ReminderToFkUserID = 2) ORDER BY ReminderSchedTimeInSecs DESC";
    $Results = $dbsReminder->getResult($sql);
    // $row = $dbsReminder->getArray($Results);
    //echo "dismis test<BR>";
    // echo "ReminderID = " . $row['ReminderID'] . "<BR>";
    $proceed = 1;
    // echo "\$row = $row";

    while ($row = $dbsReminder->getArray($Results)) {
        $ReminderTimeDismissedInSecs = $row['ReminderTimeDismissedInSecs'];
        $proceed = 0;
    }
    if ($proceed == 0) {
        locShowReminder();
    }

}
function locShowReminder() {
    echo "<BR>";
    echo "<LINK rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\">";
    $UserID = $_POST['UserID'];
    $user_log_in_name = $_POST['name'];
    // echo "<FONT SIZE=\"5\" COLOR=\"#CC3300\"><B>!!Reminders!!</B></FONT><BR>";
    echo "<span class=\"red_header\"><h5>!!Reminders!!</h5></span><BR>";
    $currentTime = time();
    $dbs = new dbSession();
    // $sql = "SELECT * from reminder WHERE ReminderTimeDismissedInSecs = '0'  AND ReminderSchedTimeInSecs <= '$currentTime' ORDER BY ReminderSchedTimeInSecs DESC";
    // $sql = "SELECT * from reminder WHERE ReminderTimeDismissedInSecs = '0'  AND ReminderSchedTimeInSecs <= '$currentTime' AND ReminderToFkUserID = '$UserID' ORDER BY ReminderSchedTimeInSecs DESC";
    $sql = "SELECT * from reminder WHERE ReminderTimeDismissedInSecs = '0'  AND ReminderSchedTimeInSecs <= '$currentTime' AND (ReminderToFkUserID = '$UserID' OR ReminderToFkUserID = '2') ORDER BY ReminderSchedTimeInSecs DESC";

    $Results = $dbs->getResult($sql);

    $aColor = 1;

    echo "<TABLE>";
    echo "<TR>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"6%\"><B>From</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"10%\"><B>Client</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\"><B>Details</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"3%\"><B>OK</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"3%\"><B>Postpone</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"8%\" title=\"Job IDentification Number.\"><B>JID</B></TD>";
    echo "</TR>";

    while ($row = $dbs->getArray($Results)) {


        $ReminderSchedTimeInSecs = $row['ReminderSchedTimeInSecs'];
        $ReminderTitle = $row['ReminderTitle'];
        $ReminderID = $row['ReminderID'];
        $ReminderFkJobID = $row['ReminderFkJobID'];
        // $JobCardNumber = $row['JobCardNumber'];
        // $JobPriority = $row['JobPriority'];
        // $JobType = $row['JobType'];


        $dbsJobNumber = new dbSession();
        $sql = "SELECT JobID, JobCardNumber from job WHERE JobID = \"$ReminderFkJobID\" LIMIT 1";
        $ResultsClient = $dbsJobNumber->getResult($sql);
        $rowJob = $dbsJobNumber->getArray($ResultsClient);
        $JobCardNumber = $rowJob['JobCardNumber'];

        $ReminderToFkUserID = $row['ReminderToFkUserID'];


        $ReminderFromFkUserID = $row['ReminderFromFkUserID'];

        $dbsUserFirstName = new dbSession();
        $sql = "SELECT UserFirstname, UserLogin from user WHERE UserID = \"$ReminderFromFkUserID\" LIMIT 1";
        $ResultsUser = $dbsUserFirstName->getResult($sql);
        $rowUser = $dbsUserFirstName->getArray($ResultsUser);
        $UserFirstname = $rowUser['UserFirstname'];
        $user_login_from_db_for_reminder = $rowUser['UserLogin'];

        $ReminderFkClientID = $row['ReminderFkClientID'];
        $dbsClientName = new dbSession();
        $sql = "SELECT ClientName from client WHERE ClientID = \"$ReminderFkClientID\" LIMIT 1";
        $ResultsClient = $dbsClientName->getResult($sql);
        $rowClient = $dbsClientName->getArray($ResultsClient);
        $clientName = $rowClient['ClientName'];



        //global $debug;
        //$debugMsg .= "\$ReminderFkClientID = $ReminderFkClientID<BR>";
        //$debugMsg .= "\$ReminderSchedTimeInSecs = $ReminderSchedTimeInSecs<BR>";
        //include("config/tpl_bodystart.php");

        if ($aColor == 1) {
            $aColor = 0;
            $setColor = "#FFCCCC";
        }
        else {
            $aColor = 1;
            $setColor = "#ffe8e8";
        }

        echo "<TR>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        //echo "\$user_log_in_name = $user_log_in_name<BR>";
        //echo "\$UserFirstname = $UserFirstname<BR>";
        //echo "\$user_login_from_db_for_reminder = $user_login_from_db_for_reminder<BR>";
        if(($user_log_in_name == $user_login_from_db_for_reminder) && ($ReminderToFkUserID == 2)) {
            echo "Me to Everyone.";
        }elseif($ReminderToFkUserID == 2) {
            user_button($ReminderFromFkUserID);
            echo "to Everyone.";
        }elseif ($user_log_in_name == $user_login_from_db_for_reminder) {
            // echo "Me";
        }else{
            user_button($ReminderFromFkUserID);
        }
        echo "</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        // echo "<a href=\"clientcard2.php?id=$ReminderFkClientID&name=$clientName\" class=\"linkPlainInWhiteAreas\">$clientName</a>";
        // echo "\$ReminderFkClientID = $ReminderFkClientID<BR>";
        if (empty($ReminderFkClientID)){

        }else{
            client_button_with_start_time($ReminderFkClientID,'');
        }
        echo "</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        // echo "<a href='reminderCard.php?OptionCatch=&AddMessageTermination=&ReminderID=$ReminderID&JobPriorityUp=$JobPriority&JobType=$JobType' class=\"linkPlainInWhiteAreas\">$ReminderTitle</a>";
        echo "<form method=\"post\" action=\"./index.php\">$ReminderTitle";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"reminder_card\">";
        echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
        include("log_in_authentication_form_vars.php");
        echo "<input class=\"inputA\" type=\"submit\" name=\"action\" title=\"Edit Reminder.\" value=\"Edit\">";
        echo "</form>";
        echo "</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        // echo "<a href='whiteBoard.php?OptionCatch=OK&AddMessageTermination=1&ReminderID=$ReminderID&JobPriorityUp=$JobPriority&JobType=$JobType'><img src=\"images/sort_none.png\" height=\"10\" width=\"12\" border=\"0\"></a>";
        echo "<form method=\"post\" action=\"./whiteBoard.php\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"OK\">";
        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
        echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
        include("log_in_authentication_form_vars.php");
        echo "<input type=\"image\" src=\"./images/sort_none.png\"  title=\"Confirm Reminder and hide it permanently.\" name=\"action\">";
        echo "</form>";
        echo "</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        // echo "<a href='whiteBoard.php?OptionCatch=postpone&AddMessageTermination=1&ReminderTitle=$ReminderTitle&ReminderID=$ReminderID&ReminderSchedTimeInSecs=$ReminderSchedTimeInSecs'><img src=\"images/sort_none.png\" height=\"10\" width=\"12\" border=\"0\"></a>";
        echo "<form method=\"post\" action=\"./whiteBoard.php\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"postpone\">";
        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
        echo "<input type=\"hidden\" name=\"ReminderTitle\" value=\"" . $ReminderTitle . "\">";
        echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
        echo "<input type=\"hidden\" name=\"ReminderSchedTimeInSecs\" value=\"" . $ReminderSchedTimeInSecs . "\">";
        include("log_in_authentication_form_vars.php");
        echo "<input type=\"image\" src=\"./images/sort_none.png\"  title=\"Postpone.\" name=\"action\">";
        echo "</form>";
        echo "</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        if ($ReminderFkJobID == "0") {

        }else{
            // echo "<a href=\"JobDetails.php?JobID=$ReminderFkJobID\">$ReminderFkJobID-$JobCardNumber</a>";
            job_button($ReminderFkJobID,'','','');
        }
        echo "</TD>";
        echo "</TR>";

    }

    echo "</TABLE><BR>";

}
function loc_Show_all_Reminders() {
    echo "<BR>";
    echo "<LINK rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\">";
    $UserID = $_POST['UserID'];
    $limit = $_POST['limit'];
    //echo "\$limit= " . $limit . "<br>";
    $user_log_in_name = $_POST['name'];
    echo "<h5>!!All Reminders!!</h5><BR>";
    echo "Green = future, Red = due now, Grey = dismissed<br>";
    //echo "..... posts" . $_POST['lower'] . "  ---  " . $_POST['upper'] . "<br>";
    if (empty($_POST['lower']) || $_POST['lower'] <= 0) {
        $_POST['lower'] = 0;
        $_POST['upper'] = 29;
        $lower = 0;
        $upper = 29;
    }
    $factor = 30;
    if($limit == 'plus') {
        //echo "in plus<br>";
        $_POST['lower'] = $_POST['lower'] + $factor;
        $_POST['upper'] = $_POST['upper'] + $factor;
        $lower = $_POST['lower'];
        $upper = $_POST['upper'];
    }
    if($limit == 'minus' && $_POST['upper'] >= 59) {
        //echo "in minus<br>";
        $_POST['lower'] = $_POST['lower'] - $factor;
        $_POST['upper'] = $_POST['upper'] - $factor;
        $lower = $_POST['lower'];
        $upper = $_POST['upper'];
    }
    // echo "lower and upper = $lower and $upper <br>";
    //echo "..... posts" . $_POST['lower'] . "---" . $_POST['upper'] . "<br>";

    echo "<TABLE>
            <TR>
                <TD valign=\"bottom\">";
                echo "<<";
                echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"reminders_all\">";
                echo "<input type=\"hidden\" name=\"limit\" value=\"minus\">";
                echo "<input type=\"hidden\" name=\"lower\" value=\"" . $lower . "\">";
                echo "<input type=\"hidden\" name=\"upper\" value=\"" . $upper . "\">";
                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                echo "<input type=\"hidden\" name=\"ReminderTitle\" value=\"" . $ReminderTitle . "\">";
                echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
                echo "<input type=\"hidden\" name=\"ReminderSchedTimeInSecs\" value=\"" . $ReminderSchedTimeInSecs . "\">";
                include("log_in_authentication_form_vars.php");
                echo "<input type=\"image\" src=\"./images/sort_none.png\"  title=\"Last 30\" name=\"action\">";
                echo "</form>";
                echo "</TD>
                      <TD> <image src=\"images/spacer.gif\" width=\"42\"></image></TD>
                      <TD valign=\"bottom\">";
                echo "<br>";
                echo ">>";
                echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"reminders_all\">";
                echo "<input type=\"hidden\" name=\"limit\" value=\"plus\">";
                echo "<input type=\"hidden\" name=\"lower\" value=\"" . $lower . "\">";
                echo "<input type=\"hidden\" name=\"upper\" value=\"" . $upper . "\">";
                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                echo "<input type=\"hidden\" name=\"ReminderTitle\" value=\"" . $ReminderTitle . "\">";
                echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
                echo "<input type=\"hidden\" name=\"ReminderSchedTimeInSecs\" value=\"" . $ReminderSchedTimeInSecs . "\">";
                include("log_in_authentication_form_vars.php");
                echo "<input type=\"image\" src=\"./images/sort_none.png\"  title=\"Next 30\" name=\"action\">";
                echo "</form>";
    echo "      </TD>
            </TR>
        </TABLE>";
    echo "<br>";


    $currentTime = time();
    $dbs = new dbSession();
    // $sql = "SELECT * from reminder WHERE ReminderTimeDismissedInSecs = '0'  AND ReminderSchedTimeInSecs <= '$currentTime' ORDER BY ReminderSchedTimeInSecs DESC";
    // $sql = "SELECT * from reminder WHERE ReminderTimeDismissedInSecs = '0'  AND ReminderSchedTimeInSecs <= '$currentTime' AND ReminderToFkUserID = '$UserID' ORDER BY ReminderSchedTimeInSecs DESC";
    $sql = "SELECT * from reminder WHERE (ReminderToFkUserID = '$UserID' OR ReminderToFkUserID = '2') ORDER BY ReminderSchedTimeInSecs DESC LIMIT $lower , $factor";

    $Results = $dbs->getResult($sql);

    $aColor = 1;

    echo "<TABLE>";
    echo "<TR>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"6%\"><B>From</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"10%\"><B>Client</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\"><B>Details</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"3%\"><B>OK</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"3%\"><B>Postpone</B></TD>";
    echo "<TD bgcolor=\"#FFFFFF\" align=\"middle\" width=\"8%\" title=\"Job IDentification Number.\"><B>JID</B></TD>";
    echo "</TR>";

    while ($row = $dbs->getArray($Results)) {


        $ReminderSchedTimeInSecs = $row['ReminderSchedTimeInSecs'];
        $ReminderTitle = $row['ReminderTitle'];
        $ReminderID = $row['ReminderID'];
        $ReminderFkJobID = $row['ReminderFkJobID'];
        $ReminderTimeAddedInSecs = $row['ReminderTimeAddedInSecs'];
        $ReminderTimeDismissedInSecs = $row['ReminderTimeDismissedInSecs'];
        // $JobCardNumber = $row['JobCardNumber'];
        // $JobPriority = $row['JobPriority'];
        // $JobType = $row['JobType'];


        $dbsJobNumber = new dbSession();
        $sql = "SELECT JobID, JobCardNumber from job WHERE JobID = \"$ReminderFkJobID\" LIMIT 1";
        $ResultsClient = $dbsJobNumber->getResult($sql);
        $rowJob = $dbsJobNumber->getArray($ResultsClient);
        $JobCardNumber = $rowJob['JobCardNumber'];

        $ReminderToFkUserID = $row['ReminderToFkUserID'];


        $ReminderFromFkUserID = $row['ReminderFromFkUserID'];

        $dbsUserFirstName = new dbSession();
        $sql = "SELECT UserFirstname, UserLogin from user WHERE UserID = \"$ReminderFromFkUserID\" LIMIT 1";
        $ResultsUser = $dbsUserFirstName->getResult($sql);
        $rowUser = $dbsUserFirstName->getArray($ResultsUser);
        $UserFirstname = $rowUser['UserFirstname'];
        $user_login_from_db_for_reminder = $rowUser['UserLogin'];

        $ReminderFkClientID = $row['ReminderFkClientID'];
        $dbsClientName = new dbSession();
        $sql = "SELECT ClientName from client WHERE ClientID = \"$ReminderFkClientID\" LIMIT 1";
        $ResultsClient = $dbsClientName->getResult($sql);
        $rowClient = $dbsClientName->getArray($ResultsClient);
        $clientName = $rowClient['ClientName'];



        //global $debug;
        //$debugMsg .= "\$ReminderFkClientID = $ReminderFkClientID<BR>";
        //$debugMsg .= "\$ReminderSchedTimeInSecs = $ReminderSchedTimeInSecs<BR>";
        //include("config/tpl_bodystart.php");

        if ($aColor == 1) {
            $aColor = 0;
            $setColor = "#FFCCCC";
            if ($ReminderSchedTimeInSecs > $currentTime){
                $setColor = '#baffc0';
            }
            if ($ReminderTimeDismissedInSecs != 0){
                $setColor = '#b3b6bc';
            }
        }
        else {
            $aColor = 1;
            $setColor = "#ffe8e8";
            if ($ReminderSchedTimeInSecs > $currentTime){
                $setColor = '#dbfcde';
            }
            if ($ReminderTimeDismissedInSecs != 0){
                $setColor = '#cbd0d8';
            }
        }

        echo "<TR>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        //echo "\$user_log_in_name = $user_log_in_name<BR>";
        //echo "\$UserFirstname = $UserFirstname<BR>";
        //echo "\$user_login_from_db_for_reminder = $user_login_from_db_for_reminder<BR>";
        if(($user_log_in_name == $user_login_from_db_for_reminder) && ($ReminderToFkUserID == 2)) {
            echo "Me to Everyone.";
        }elseif($ReminderToFkUserID == 2) {
            user_button($ReminderFromFkUserID);
            echo "to Everyone.";
        }elseif ($user_log_in_name == $user_login_from_db_for_reminder) {
            // echo "Me";
        }else{
            user_button($ReminderFromFkUserID);
        }
        echo "</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        // echo "<a href=\"clientcard2.php?id=$ReminderFkClientID&name=$clientName\" class=\"linkPlainInWhiteAreas\">$clientName</a>";
        // echo "\$ReminderFkClientID = $ReminderFkClientID<BR>";
        if (empty($ReminderFkClientID)){

        }else{
            client_button_with_start_time($ReminderFkClientID,'');
        }
        echo "</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        // echo "<a href='reminderCard.php?OptionCatch=&AddMessageTermination=&ReminderID=$ReminderID&JobPriorityUp=$JobPriority&JobType=$JobType' class=\"linkPlainInWhiteAreas\">$ReminderTitle</a>";
        echo "<form method=\"post\" action=\"./index.php\">$ReminderTitle";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"reminder_card\">";
        echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
        include("log_in_authentication_form_vars.php");
        echo "<input class=\"inputA\" type=\"submit\" name=\"action\" title=\"Edit Reminder.\" value=\"Edit\">";
        echo "</form>";
        echo "</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        // echo "<a href='whiteBoard.php?OptionCatch=OK&AddMessageTermination=1&ReminderID=$ReminderID&JobPriorityUp=$JobPriority&JobType=$JobType'><img src=\"images/sort_none.png\" height=\"10\" width=\"12\" border=\"0\"></a>";
        if ($ReminderTimeDismissedInSecs == 0) {
            echo "<form method=\"post\" action=\"./whiteBoard.php\">";
            echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"OK_b\">";
            echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
            echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
            echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
            echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
            include("log_in_authentication_form_vars.php");
            echo "<input type=\"image\" src=\"./images/sort_none.png\"  title=\"Confirm Reminder and hide it permanently.\" name=\"action\">";
            echo "</form>";
        }
        echo "</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        // echo "<a href='whiteBoard.php?OptionCatch=postpone&AddMessageTermination=1&ReminderTitle=$ReminderTitle&ReminderID=$ReminderID&ReminderSchedTimeInSecs=$ReminderSchedTimeInSecs'><img src=\"images/sort_none.png\" height=\"10\" width=\"12\" border=\"0\"></a>";
        echo "<form method=\"post\" action=\"./whiteBoard.php\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"postpone_b\">";
        echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
        echo "<input type=\"hidden\" name=\"ReminderTitle\" value=\"" . $ReminderTitle . "\">";
        echo "<input type=\"hidden\" name=\"ReminderID\" value=\"" . $ReminderID . "\">";
        echo "<input type=\"hidden\" name=\"ReminderSchedTimeInSecs\" value=\"" . $ReminderSchedTimeInSecs . "\">";
        include("log_in_authentication_form_vars.php");
        echo "<input type=\"image\" src=\"./images/sort_none.png\"  title=\"Postpone.\" name=\"action\">";
        echo "</form>";
        echo "</TD>";
        echo "<TD bgcolor=\"$setColor\" align=\"middle\">";
        if ($ReminderFkJobID == "0") {

        }else{
            // echo "<a href=\"JobDetails.php?JobID=$ReminderFkJobID\">$ReminderFkJobID-$JobCardNumber</a>";
            job_button($ReminderFkJobID,'','','');
        }
        echo "</TD>";
        echo "</TR>";

    }

    echo "</TABLE><BR>";

}
function postpone() {
    global $ReminderID;
    global $ReminderTitle;

    $ReminderID = $_POST['ReminderID'];
    $ReminderTitle = $_POST['ReminderTitle'];
    $reminderTimeHour = $_POST['reminderTimeHour'];
    $reminderTimeMinute = $_POST['reminderTimeMinute'];
    $ReminderSchedTimeInSecs = $_POST['ReminderSchedTimeInSecs'];

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
    $turn_this_debug_on = 0;
    if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "\$ReminderID = $ReminderID<BR>";
        $debugMsg .= "\$reminderTimeDay = $reminderTimeDay<BR>";
        $debugMsg .= "\$reminderTimeHour = $reminderTimeHour<BR>";
        $debugMsg .= "\$reminderTimeMinute = $reminderTimeMinute<BR>";
        $debugMsg .= "\$ReminderSchedTimeInSecs = $ReminderSchedTimeInSecs<BR>";
        include("config/debug.php");
    }
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************

    echo "<DIV align=\"center\">";
    echo "Postpone $ReminderTitle by";

    echo "
	<form method=\"post\" action=\"$PHP_SELF\">
	<TABLE>
		<TR>
			<TD></TD>
			<TD>
			<select name=\"reminderTimeDay\" tabindex=\"\">
";
    $timeDayOption = 0;
    echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
    while ($timeDayOption <= "30") {
        $timeDayOption = $timeDayOption + 1;
        echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
    }

    echo "
			</SELECT>Day(s)

			<select name=\"reminderTimeHour\" tabindex=\"3\"\">
";
    $timeHourOption = 0;
    echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
    while ($timeHourOption <= "22") {
        $timeHourOption = $timeHourOption + 1;
        echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
    }

    echo "
			</SELECT>
			
			hour(s)
			<select name=\"reminderTimeMinute\" tabindex=\"3\">
";
    echo "<OPTION  value=\"05\">05";
    $timeMinuteOption = "00";
    echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
    while ($timeMinuteOption <= "40") {
        $timeMinuteOption = $timeMinuteOption + 10;
        echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
    }

    echo "
			</SELECT>
			minutes
			</TD>
		</TR>
	</TABLE>
";

    echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
    echo "<input type=\"hidden\" name=\"ReminderFkClientID\" value=\"$ClientID\">";
    echo "<input type=\"hidden\" name=\"ReminderID\" value=\"$ReminderID\">";
    echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
    echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"postponeUpdate\">";
    echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
    echo "<input type=\"hidden\" name=\"JobStatus\" value=\"Active\">";
    include("log_in_authentication_form_vars.php");
    echo "<input type=\"submit\" tabindex=\"18\" name=\"Submit\" value=\"Postpone Reminder\">";
    echo "</form>";
    echo "</DIV>";
    $GET_['OptionCatch'] = "";
    include("logged_in_end_of_page.php");
}
function postpone_b() {
    global $ReminderID;
    global $ReminderTitle;

    $ReminderID = $_POST['ReminderID'];
    $ReminderTitle = $_POST['ReminderTitle'];
    $reminderTimeHour = $_POST['reminderTimeHour'];
    $reminderTimeMinute = $_POST['reminderTimeMinute'];
    $ReminderSchedTimeInSecs = $_POST['ReminderSchedTimeInSecs'];

//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
    $turn_this_debug_on = 0;
    if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "\$ReminderID = $ReminderID<BR>";
        $debugMsg .= "\$reminderTimeDay = $reminderTimeDay<BR>";
        $debugMsg .= "\$reminderTimeHour = $reminderTimeHour<BR>";
        $debugMsg .= "\$reminderTimeMinute = $reminderTimeMinute<BR>";
        $debugMsg .= "\$ReminderSchedTimeInSecs = $ReminderSchedTimeInSecs<BR>";
        include("config/debug.php");
    }
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************

    echo "<DIV align=\"center\">";
    echo "Postpone $ReminderTitle by";

    echo "
	<form method=\"post\" action=\"$PHP_SELF\">
	<TABLE>
		<TR>
			<TD></TD>
			<TD>
			<select name=\"reminderTimeDay\" tabindex=\"\">
";
    $timeDayOption = 0;
    echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
    while ($timeDayOption <= "30") {
        $timeDayOption = $timeDayOption + 1;
        echo "<OPTION  value=\"$timeDayOption\">$timeDayOption";
    }

    echo "
			</SELECT>Day(s)

			<select name=\"reminderTimeHour\" tabindex=\"3\"\">
";
    $timeHourOption = 0;
    echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
    while ($timeHourOption <= "22") {
        $timeHourOption = $timeHourOption + 1;
        echo "<OPTION  value=\"$timeHourOption\">$timeHourOption";
    }

    echo "
			</SELECT>
			
			hour(s)
			<select name=\"reminderTimeMinute\" tabindex=\"3\">
";
    echo "<OPTION  value=\"05\">05";
    $timeMinuteOption = "00";
    echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
    while ($timeMinuteOption <= "40") {
        $timeMinuteOption = $timeMinuteOption + 10;
        echo "<OPTION  value=\"$timeMinuteOption\">$timeMinuteOption";
    }

    echo "
			</SELECT>
			minutes
			</TD>
		</TR>
	</TABLE>
";

    echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
    echo "<input type=\"hidden\" name=\"ReminderFkClientID\" value=\"$ClientID\">";
    echo "<input type=\"hidden\" name=\"ReminderID\" value=\"$ReminderID\">";
    echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
    echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"postponeUpdate_b\">";
    echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
    echo "<input type=\"hidden\" name=\"JobStatus\" value=\"Active\">";
    include("log_in_authentication_form_vars.php");
    echo "<input type=\"submit\" tabindex=\"18\" name=\"Submit\" value=\"Postpone Reminder\">";
    echo "</form>";
    echo "</DIV>";
    $GET_['OptionCatch'] = "";
    include("logged_in_end_of_page.php");
}
function postponeUpdate() {
    global $ReminderID;
    global $reminderTimeDay;
    global $reminderTimeHour;
    global $reminderTimeMinute;
    global $ReminderSchedTimeInSecs;

    $ReminderID = $_POST['ReminderID'];
    $reminderTimeDay = $_POST['reminderTimeDay'];
    $reminderTimeHour = $_POST['reminderTimeHour'];
    $reminderTimeMinute = $_POST['reminderTimeMinute'];
    $ReminderSchedTimeInSecs = $_POST['ReminderSchedTimeInSecs'];

//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
    $turn_this_debug_on = 0;
    if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "\$ReminderID = $ReminderID<BR>";
        $debugMsg .= "\$reminderTimeDay = $reminderTimeDay<BR>";
        $debugMsg .= "\$reminderTimeHour = $reminderTimeHour<BR>";
        $debugMsg .= "\$reminderTimeMinute = $reminderTimeMinute<BR>";
        $debugMsg .= "\$ReminderSchedTimeInSecs = $ReminderSchedTimeInSecs<BR>";
        include("config/debug.php");
    }
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************


    $currentTime = time();
    //echo "\$currentTime = $currentTime<BR><BR>";
    $reminderTotalTimeToPostponeBy = (($reminderTimeDay * 86400) + ($reminderTimeHour * 3600) + ($reminderTimeMinute * 60));
    $newReminderSchedTimeInSecs = ($reminderTotalTimeToPostponeBy + $currentTime);
    //echo "\$newReminderSchedTimeInSecs = $newReminderSchedTimeInSecs<BR><BR>";
    echo "<DIV align=\"center\">";

    $dbs = new dbSession();

    $sql = "UPDATE reminder SET ReminderSchedTimeInSecs = '$newReminderSchedTimeInSecs' WHERE ReminderID = '$ReminderID'";

    // $sql = "UPDATE Reminder SET ReminderTimeDismissedInSecs = '$ReminderTimeDismissedInSecs' WHERE ReminderID = '$ReminderID'";


    if ($dbs->getResult($sql)) {
        $msg = "Reminder Postponed.";
        echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT><BR><BR>";
        locReminderCheck();
        Main();
        //Onsite();

    } else {
        $msg = $dbs->printError();
        echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#CC3300\">$msg</FONT>";
        locReminderCheck();
        Main();
        //Onsite();

    }
    echo "<BR>";
    echo "</DIV>";

}
function postponeUpdate_b() {
    global $ReminderID;
    global $reminderTimeDay;
    global $reminderTimeHour;
    global $reminderTimeMinute;
    global $ReminderSchedTimeInSecs;

    $ReminderID = $_POST['ReminderID'];
    $reminderTimeDay = $_POST['reminderTimeDay'];
    $reminderTimeHour = $_POST['reminderTimeHour'];
    $reminderTimeMinute = $_POST['reminderTimeMinute'];
    $ReminderSchedTimeInSecs = $_POST['ReminderSchedTimeInSecs'];

//**********************************************************************************************
//********************************************************************** DEBUG VARIABLES HERE - START
    $turn_this_debug_on = 0;
    if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "\$ReminderID = $ReminderID<BR>";
        $debugMsg .= "\$reminderTimeDay = $reminderTimeDay<BR>";
        $debugMsg .= "\$reminderTimeHour = $reminderTimeHour<BR>";
        $debugMsg .= "\$reminderTimeMinute = $reminderTimeMinute<BR>";
        $debugMsg .= "\$ReminderSchedTimeInSecs = $ReminderSchedTimeInSecs<BR>";
        include("config/debug.php");
    }
//********************************************************************** DEBUG VARIABLES HERE - END
//**********************************************************************************************


    $currentTime = time();
    //echo "\$currentTime = $currentTime<BR><BR>";
    $reminderTotalTimeToPostponeBy = (($reminderTimeDay * 86400) + ($reminderTimeHour * 3600) + ($reminderTimeMinute * 60));
    $newReminderSchedTimeInSecs = ($reminderTotalTimeToPostponeBy + $currentTime);
    //echo "\$newReminderSchedTimeInSecs = $newReminderSchedTimeInSecs<BR><BR>";
    echo "<DIV align=\"center\">";

    $dbs = new dbSession();

    $sql = "UPDATE reminder SET 
      ReminderSchedTimeInSecs = '$newReminderSchedTimeInSecs', 
      ReminderTimeDismissedInSecs = '0' 
      WHERE ReminderID = '$ReminderID'";

    // $sql = "UPDATE Reminder SET ReminderTimeDismissedInSecs = '$ReminderTimeDismissedInSecs' WHERE ReminderID = '$ReminderID'";


    if ($dbs->getResult($sql)) {
        $msg = "Reminder Postponed.";
        echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT><BR><BR>";
        loc_Show_all_Reminders();

    } else {
        $msg = $dbs->printError();
        echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#CC3300\">$msg</FONT>";
        loc_Show_all_Reminders();

    }
    echo "<BR>";
    echo "</DIV>";

}
function locUpdateReminder() {
    global $ReminderID;
    $ReminderID = $_POST['ReminderID'];

    echo "<DIV align=\"center\">";

    $ReminderTimeDismissedInSecs = time();

    $dbs = new dbSession();

    $sql = "UPDATE reminder SET ReminderTimeDismissedInSecs = '$ReminderTimeDismissedInSecs' WHERE ReminderID = '$ReminderID'";

    if ($dbs->getResult($sql)) {
        $msg = "<BR>Reminder Cleared.";
        echo "<FONT SIZE=\"4\" COLOR=\"#339900\">$msg</FONT><BR><BR>";
        locReminderCheck();
        Main();
        //Onsite();
        echo "<BR>";
    } else {
        $msg = $dbs->printError();
        echo "<FONT SIZE=\"4\" COLOR=\"#CC0000\">$msg</FONT>";
        locReminderCheck();
        Main();
        //Onsite();
        echo "<BR>";
    }
    echo "</DIV>";
}
function locUpdateReminder_b() {
    global $ReminderID;
    $ReminderID = $_POST['ReminderID'];

    echo "<DIV align=\"center\">";

    $ReminderTimeDismissedInSecs = time();

    $dbs = new dbSession();

    $sql = "UPDATE reminder SET 
      ReminderTimeDismissedInSecs = '$ReminderTimeDismissedInSecs' 
      WHERE ReminderID = '$ReminderID'";

    if ($dbs->getResult($sql)) {
        $msg = "<BR>Reminder Cleared.";
        echo "<FONT SIZE=\"4\" COLOR=\"#339900\">$msg</FONT><BR><BR>";
        loc_Show_all_Reminders();
        echo "<BR>";
        exit();
    } else {
        $msg = $dbs->printError();
        echo "<FONT SIZE=\"4\" COLOR=\"#CC0000\">$msg</FONT>";
        loc_Show_all_Reminders();
        echo "<BR>";
        exit();
    }
    echo "</DIV>";
}
function loc_update_branch() {

    $JobID    = $_POST['JobID'];
    $job_tree = $_POST['job_tree'];
    // echo "\$JobID == $JobID";

    $dbs_job_branch = new dbSession();
    $sql_branch = "UPDATE job SET JobBranch = $job_tree WHERE JobID = \"$JobID\" LIMIT 1";
    //$sql = "UPDATE reminder SET ReminderSchedTimeInSecs = '$newReminderSchedTimeInSecs' WHERE ReminderID = '$ReminderID'";

    if ($dbs_job_branch->getResult($sql_branch)) {
        //$msg = "<BR>Branch Updated.";
        //echo "<FONT SIZE=\"4\" COLOR=\"#339900\">$msg</FONT><BR><BR>";
        echo "<LINK rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\">";
        locReminderCheck();
        Main();
        //Onsite();
        echo "<BR>";
    } else {
        echo "<LINK rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\">";
        $msg = $dbs->printError();
        echo "<FONT SIZE=\"4\" COLOR=\"#CC0000\">$msg</FONT>";
        locReminderCheck();
        Main();
        //Onsite();
        echo "<BR>";
    }
    echo "</DIV>";
}
//********************************************************************** FUNCTIONS - END
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
