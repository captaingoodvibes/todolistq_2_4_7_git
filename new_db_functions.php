<?PHP
function refresh_db() {

    $db_name = '';
    $mysqlDatabaseName = '';
    $new_admin_user_name = '';
    $new_admin_user_pwd = '';
    $mysqlUserName = 'demo';
    $mysqlPassword = '';
    $mysqlHostName = 'localhost';
    $mysqlImportFilename ='base_database_20150211_generic.sql';

    $db_folder = 'demo_db';

    $db_host_other_db = $mysqlHostName;
    $db_user_other_db = $mysqlUserName;
    $db_pass_other_db = $mysqlPassword;
    $db_name_other_db = $mysqlDatabaseName;

    $dbs = new dbSession();
    $sql = "SELECT config_time_demo_db from config WHERE configID = 1 LIMIT 1";
    $Results = $dbs->getResult($sql);
    // echo "\$user_ID_to_display = $user_ID_to_display<BR>";
    $row = $dbs->getArray($Results);
    $config_time_demo_db = $row['config_time_demo_db'];

    $config_time_demo_db_plus = $config_time_demo_db + (3600 * 24);
    //$config_time_demo_db_plus = $config_time_demo_db + 60;
    // echo "\$config_time_demo_db_plus = $config_time_demo_db_plus<BR>";
    $now = time();

    if ($now >= $config_time_demo_db_plus) {
        $dbs = new dbSession;
        $dbs->dbSession_other_db($db_host_other_db, $db_user_other_db, $db_pass_other_db, $db_name_other_db);

        $sql = "DROP TABLE `action`, `client`, `clock`, `config`, `job`, `reminder`, `user`";
        if ($dbs->getResult($sql)) {
            $msg = "Tables Dropped.";
            // echo "<FONT class=\"edit_success_solid\">$msg<BR><BR></FONT>";
            $create_user_fail = 0;

        } else {
            $msg = $dbs->printError();
            echo "$msg <BR><BR>
			        Tables NOT dropped.<BR>";
            $create_user_fail = 1;
        }



        //DO NOT EDIT BELOW THIS LINE
        //Export the database and output the status to the page

        $command='mysql -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < /var/www/html/' . $db_folder . '/' . $mysqlImportFilename;
        exec($command,$output=array(),$worked);
        if($worked != 0) {
            echo "\$worked on sql file import of tables - mysql -h error code = $worked <BR>";
        }
        switch($worked){
            case 0:
                // echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";

                // echo "<FONT class=\"edit_success_solid\">Import file <b>" .$mysqlImportFilename ."</b> successfully imported to database </FONT><b>" .$mysqlDatabaseName ."</b><BR>";
                $check_num = "5";
                $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                // echo "<FONT class=\"edit_success_solid\">$msg<BR><BR></FONT>";
                break;
            case 1:
                echo '<FONT class="edit_fail">There was an error during import. Please make sure the import file is saved in the same folder as this script and check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>MySQL Import Filename:</td><td><b>' .$mysqlImportFilename .'</FONT></b></td></tr></table>';
                break;
            case 2:
                echo "<FONT class=\"edit_fail\">Import file <b>" .$mysqlImportFilename .'</b> did not find the path. </FONT><b>' .$mysqlDatabaseName .'</b>';
                break;
        }
        $dbs = new dbSession();
        $sql = "UPDATE config SET
			        config_time_demo_db = $now
			        WHERE configID = 1";
        if ($dbs->getResult($sql)) {
            //echo "\$now = $now<BR>";
        } else {
            $msg = $dbs->printError();
            echo "<BR>$msg<BR>";
        }
    }
}
?>
