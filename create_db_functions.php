<?PHP
function create_db_form() {
    ?>
    <TABLE align="center">
        <TR>
            <TD>
                <?PHP
                $StartTime = time();
                $debug = $_POST['debug'];
                $debugMsg .= "inside addClient()<br></br>";
                $debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
                $debugMsg .= "\$fieldName= $fieldName<BR>";
                include("config/debug.php");

                echo "<form method=\"post\" action=\"$PHP_SELF\">";
                echo "DataBase name";
                echo "<input type=\"text\" name=\"db_name\" value=\"\">";
                echo "<BR>";
                echo "DataBase username .... ";
                echo "<input type=\"text\" name=\"db_username\" value=\"\">";
                echo "<BR>";
                echo "DataBase password...................... ";
                echo "<input type=\"password\" name=\"db_pwd\" value=\"\">";
                echo "<BR>";

                echo "<input type=\"hidden\" name=\"Config_OS\" value=\"Off\">";
                echo "<input type=\"hidden\" name=\"new_install\" value=\"1\">";
                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"populate_db\">";
                echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
                echo "<input type=\"submit\" name=\"Submit\" value=\"Create DB\">";
                echo "</form>";
                ?>
            </TD>
        </TR>
    </TABLE>
    <?PHP
}
function populate_db() {
    /**
    Desc    :   Overview of populated_db()
    Creator :   Dion Patelis
    Date    :   19/5/2018 09:39
    Details :
    This is much like the WordPress install.
    1. User creates a DB and user with MySQL.
    2. The main TDLQ file is unzipped to the web directory.
    3. index.php asks for
    a. DataBase name
    b. Username
    c. Password
    4. The DataBase is populated.
    5. Admin user is setup with another form.
     */
    /**  ********************************************************************************************
     ******************************************************************* DEBUG VARIABLES HERE - START
    $debug = $_POST['debug'];
    $debugMsg .= "<b>Inside create_db()</b><BR>";
    $debugMsg .= "This " . $_POST['StartTime'] . " is the \$StartTime in index.php<BR><BR>";
    include("config/debug.php");
    //******************************************************************* DEBUG VARIABLES HERE - END
    //******************************************************************************************* */

    // echo"Table Data<BR>";
    echo "<div align=\"center\">";
    $db_name = $_POST['db_name'];
    $db_username = $_POST['db_username'];
    $db_pwd = $_POST['db_pwd'];
    $Config_OS = $_POST['Config_OS'];
    $ClientInsertDate = $_POST['StartTime'];
    $StartTime = time();

    /**  *******************************************************************************************
     ******************************************************************* DEBUG VARIABLES HERE - START
    $debug = $_POST['debug'];
    $debugMsg .= "<b>Inside create_db()</b><BR>";
    $debugMsg .= "<b>\$db_pwd = $db_pwd</b><BR>";
    $debugMsg .= "<b>\$Config_OS = $Config_OS</b><BR>";
    $debugMsg .= "This " . $ClientInsertDate . " is the \$ClientInsertDate in index.php<BR><BR>";
    include("config/debug.php");
     ********************************************************************* DEBUG VARIABLES HERE - END
     ********************************************************************************************* */

    if ($db_name != "") {
        /**
        $dbs = new dbSession();
        $sql = "CREATE USER '$db_name'@'localhost' IDENTIFIED BY '$db_pwd'";
        if ($dbs->getResult($sql)) {
        $msg = "User $db_name created.";
        echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
        $create_user_fail = 0;

        } else {
        $msg = $dbs->printError();
        echo "$msg <BR><BR>
        Please try a different name as <B>" . $db_name . "</B> is already taken.<BR>";
        $create_user_fail = 1;
        }*/

        /**
        $dbs2 = new dbSession();
        $sql2 = "GRANT USAGE ON *.* TO '$db_name'@'localhost' IDENTIFIED BY '$db_pwd' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0";
        if ($dbs2->getResult($sql2)) {
        // $msg = "Usage granted for $db_name for connections, updates, queries.";
        $check_num = "2";
        $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
        echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
        } else {
        $msg = $dbs2->printError();
        echo "$msg<BR>";
        }

        $dbs3 = new dbSession();
        $sql3 = "CREATE DATABASE IF NOT EXISTS `$db_name`";
        if ($dbs3->getResult($sql3)) {
        // $msg = "$db_name database completed. <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
        $check_num = "3";
        $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
        echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";

        } else {
        $msg = $dbs3->printError();
        echo "$msg<BR>";
        }

        $dbs4 = new dbSession();
        $sql4 = "GRANT ALL PRIVILEGES ON $db_name.* TO $db_name@localhost IDENTIFIED by 'star'";
        // $sql4 = "GRANT ALL PRIVILEGES ON $db_name.* TO $db_name@localhost IDENTIFIED by 'star'";
        // $sql4 = "GRANT ALL PRIVILEGES ON `test78` . * TO 'test78'@'localhost' WITH GRANT OPTION";

        if ($dbs4->getResult($sql3)) {
        // $msg = "Priviliedges grandted for user $db_name on DB $db_name - next bit.";
        $check_num = "4";
        $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
        echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
        // echo "\$sql4 = $sql4<BR><BR>";

        } else {
        $msg = $dbs4->printError();
        echo "$msg<BR>";
        } */

        $dbs5 = new dbSession();
        $mysqlDatabaseName = $db_name;
        $new_admin_user_name = $db_username;
        $new_admin_user_pwd = $db_pwd;
        $mysqlUserName = $dbs5->dbUser;
        $mysqlPassword = $dbs5->dbPass;
        $mysqlHostName = 'localhost';
        $mysqlImportFilename ='base_database_20160520_generic.sql';
        $db_folder = "todolistq_2_4_7";
        $pwd = shell_exec('pwd');
        $pwd = trim($pwd);
        // echo "$pwd" . "<br>";
        //ENTER THE RELEVANT INFO BELOW
        /** Can't remember what this was. Thing I was just playing with the pwd shell command. DP 19/5/2018 10:25
        exec("ls",$output=array(),$worked);
        // echo "\$output = " . $output[0] . "<br>";
        if($worked != 0) {
            echo "\$worked on sql file import of tables - mysql -h error code = $worked <BR>";
        }
        echo "\$output = " . $output . "<br>";
        print_r($output);
        $result_array=explode(' ', $output);
        echo "<br>Output: ".$result_array."<br>";
        echo "Exit status: ".$return_var."<br>"; */

        /** ********************************************************************************************
        //********************************************************************** DEBUG VARIABLES HERE - START
        $debug = $_POST['debug'];
        $debugMsg .= "<b>\$mysqlDatabaseName = $mysqlDatabaseName</b><BR>";
        $debugMsg .= "<b>\$mysqlUserName = $mysqlUserName</b><BR>";
        $debugMsg .= "<b>\$mysqlPassword = $mysqlPassword</b><BR>";
        $debugMsg .= "<b>\$mysqlHostName = $mysqlHostName</b><BR>";
        $debugMsg .= "<b>\$mysqlImportFilename = $mysqlImportFilename</b><BR>";
        include("config/debug.php");
        //********************************************************************** DEBUG VARIABLES HERE - END
        //******************************************************************************************* */

        //DO NOT EDIT BELOW THIS LINE
        //Export the database and output the status to the page
        if ($Config_OS == "Off") {
            // This is for linux ubuntu
            // echo "<BR>This is for linux ubuntu - TDLQ 2.4.7<BR><BR>";
            $command = 'mysql -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' . $pwd . '/' . $mysqlImportFilename;
            echo "\$command for Ubuntu = $command<BR><BR>";
        } else {
            // echo "<BR>This is for OSX MAMP<BR><BR>";
            //echo exec('/applications/MAMP/library/bin/mysql -u live -pRamjet44 test47 < /Applications/MAMP/htdocs/s/spiros2_2_2_create_db/base_database_20131216_generic.sql ');
            $command='/applications/MAMP/library/bin/mysql -h ' . $mysqlHostName .' -u ' . $mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
        }

        exec($command,$output=array(),$worked);
        if($worked != 0) {
            echo "\$worked on sql file import of tables - mysql -h error code = $worked <BR>";
        }
        switch($worked){
            case 0:
                // echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";

                // echo "<span class=\"edit_success_solid\">Import file <b>" .$mysqlImportFilename ."</b> successfully imported to database </span><b>" .$mysqlDatabaseName ."</b><BR>";
                $check_num = "5";
                $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                break;
            case 1:
                echo '<span class="edit_fail">There was an error during import. Please make sure the import file is saved in the same folder as this script and check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>MySQL Import Filename:</td><td><b>' .$mysqlImportFilename .'</span></b></td></tr></table>';
                break;
            case 2:
                echo "<span class=\"edit_fail\">Import file <b>" .$mysqlImportFilename .'</b> did not find the path. </span><b>' .$mysqlDatabaseName .'</b>';
                break;
        }
        echo "<span class=\"generalspanOnWhite\">";
        $structure = ' /var/www/html/users/' . $db_name . '/';
        /*// $structure = ' /var/www/html/repository/';
        // mkdir("ztesting");

        // mkdir('/path/to/directory', 0755, true);*/
        $command = 'mkdir -p' . $structure ;
        /*// $command = 'mkdir -p ./zdepth01/depth2/depth3/';
        // $command = 'mkdir("./zdepth01/depth2/depth3/", 0777, true)';*/
        /*exec($command,$output=array(),$worked);
        if($worked != 0) {
            echo "<BR> \$worked for mkdir = $worked <BR>";
        }
        switch($worked){
            case 0:
                // echo "<span class=\"edit_success_solid\"><BR><BR>" . $command . "  worked.<BR><BR></span>";
                $check_num = "6";
                $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                break;
            case 1:
                echo "<span class=\"edit_fail\"><BR>" . $command . "  fail.<BR><BR></span>";
                break;
        }

        $command2 = 'rsync -hortig /var/www/html/repository/ /var/www/html/users/' . $db_name . '/';
        exec($command2,$output=array(),$worked);
        if($worked != 0) {
            echo "\$worked for rsync = $worked <BR>";
        }
        switch($worked){
            case 0:
                // echo "<span class=\"edit_success_solid\"><BR>" . $command2 . "  executed<BR><BR></span>";
                $check_num = "7";
                $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                break;
            case 1:
                echo "<span class=\"edit_fail\"><BR>" . $command2 . "  fail.<BR><BR></span>";
                break;
        }*/

        //sed -i.bak 's/\($dbUser\s=\s"\).*/\1edgar";/' dbSession.class

        $command3 = 'sed -i.bak \'s/\\($dbUser\\s=\\s"\\).*/\\1' . $db_username . '";/\' ' .  $pwd . '/config/dbSession.class';
        echo "\$command3 = " . $command3 . "<br>";
        exec($command3,$output=array(),$worked);
        if($worked != 0) {
            echo "\$worked sed specifying username = $worked <BR>";
        }
        switch($worked){
            case 0:
                // echo "<span class=\"edit_success_solid\"><BR>" . $command3 . "  executed<BR><BR></span>";
                $check_num = "8";
                $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                break;
            case 1:
                echo "<span class=\"edit_fail\"><BR>" . $command3 . "  fail.<BR><BR></span>";
                break;
        }

        $command4 = 'sed -i.bak \'s/\\($dbPass\\s=\\s"\\).*/\\1' . $db_pwd . '";/\' ' . $pwd . '/config/dbSession.class';
        echo "\$command4 = " . $command3 . "<br>";
        exec($command4,$output=array(),$worked);
        if($worked != 0) {
            echo "\$worked (the error code of the linux command itself) sed specifying password = $worked <BR>";
        }
        switch($worked){
            case 0:
                // echo "<span class=\"edit_success_solid\"><BR>" . $command4 . "  executed<BR><BR></span>";
                $check_num = "9";
                $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                break;
            case 1:
                echo "<span class=\"edit_fail\"><BR>" . $command4 . "  fail.<BR><BR></span>";
                break;
        }

        $command5 = 'sed -i.bak \'s/\\($dbName\\s=\\s"\\).*/\\1' . $db_name . '";/\' ' . $pwd . '/config/dbSession.class';
        echo "\$command5 = " . $command3 . "<br>";
        exec($command5,$output=array(),$worked);
        if($worked != 0) {
            echo "\$worked (the error code of the linux command itself) specifying the database name = $worked";
        }
        switch($worked){
            case 0:
                // echo "<span class=\"edit_success_solid\"><BR>" . $command5 . "  executed<BR><BR></span>";
                $check_num = "10";
                $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                break;
            case 1:
                echo "<span class=\"edit_fail\"><BR>" . $command5 . "  fail.<BR><BR></span>";
                break;
        }

        /*$command4 = 'mysql -u ' . $mysqlUserName . ' -p' . $mysqlPassword . ' --execute "GRANT ALL PRIVILEGES ON ' . $mysqlDatabaseName . '.* TO \'' . $new_admin_user_name . '\'@\'localhost\' IDENTIFIED BY \'' . $new_admin_user_pwd . '\'"';
        exec($command4,$output=array(),$worked);
        if($worked != 0) {
            echo "\$worked (the error code of the linux command itself) mysql -h command. = $worked <BR>";
        }
        switch($worked){
            case 0:
                // echo "<span class=\"edit_success_solid\"> \$command4 = " . $command4 . "<BR><BR> and it worked successfully.</span><BR><BR>";
                $check_num = "11";
                $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                break;
            case 1:
                echo "<span class=\"edit_fail\">There was an error during the User permissions editing. <BR> The command used was " . $command4 . "</span>";
                break;
        }*/

        /*insert_user_other_db($new_admin_user_name, $new_admin_user_pwd, 'localhost', $mysqlUserName, $mysqlPassword, $mysqlDatabaseName);
        $_POST['dbName'] = $new_admin_user_name;
        $_POST['db_folder'] = $db_folder;
        log_into_external_db();*/
    }

}
function create_db() {
// echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";
//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
    $debug = $_POST['debug'];
    $debugMsg .= "<b>Inside create_db()</b><BR>";
    $debugMsg .= "This " . $_POST['StartTime'] . " is the \$StartTime in index.php<BR><BR>";
    include("config/debug.php");
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************

    // echo"Table Data<BR>";
    echo "<div align=\"center\">";
    $db_name = $_POST['db_name'];
    $db_pwd = $_POST['db_pwd'];
    $Config_OS = $_POST['Config_OS'];
    $ClientInsertDate = $_POST['StartTime'];
    $StartTime = time();


//**********************************************************************************************
//***************************************************************** DEBUG VARIABLES HERE - START
    $debug = $_POST['debug'];
    $debugMsg .= "<b>Inside create_db()</b><BR>";
    $debugMsg .= "<b>\$db_pwd = $db_pwd</b><BR>";
    $debugMsg .= "<b>\$Config_OS = $Config_OS</b><BR>";
    $debugMsg .= "This " . $ClientInsertDate . " is the \$ClientInsertDate in index.php<BR><BR>";
    include("config/debug.php");
//******************************************************************* DEBUG VARIABLES HERE - END
//**********************************************************************************************


    if ($db_name != "") {
        $dbs = new dbSession();
        $sql = "CREATE USER '$db_name'@'localhost' IDENTIFIED BY '$db_pwd'";
        if ($dbs->getResult($sql)) {
            $msg = "User $db_name created.";
            echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
            $create_user_fail = 0;

        } else {
            $msg = $dbs->printError();
            echo "$msg <BR><BR>
				Please try a different name as <B>" . $db_name . "</B> is already taken.<BR>";
            $create_user_fail = 1;
        }

        if ($create_user_fail == 0) {
            $dbs2 = new dbSession();
            $sql2 = "GRANT USAGE ON *.* TO '$db_name'@'localhost' IDENTIFIED BY '$db_pwd' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0";
            if ($dbs2->getResult($sql2)) {
                // $msg = "Usage granted for $db_name for connections, updates, queries.";
                $check_num = "2";
                $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
            } else {
                $msg = $dbs2->printError();
                echo "$msg<BR>";
            }

            $dbs3 = new dbSession();
            $sql3 = "CREATE DATABASE IF NOT EXISTS `$db_name`";
            if ($dbs3->getResult($sql3)) {
                // $msg = "$db_name database completed. <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                $check_num = "3";
                $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";

            } else {
                $msg = $dbs3->printError();
                echo "$msg<BR>";
            }

            $dbs4 = new dbSession();
            $sql4 = "GRANT ALL PRIVILEGES ON $db_name.* TO $db_name@localhost IDENTIFIED by 'star'";
            // $sql4 = "GRANT ALL PRIVILEGES ON $db_name.* TO $db_name@localhost IDENTIFIED by 'star'";
            // $sql4 = "GRANT ALL PRIVILEGES ON `test78` . * TO 'test78'@'localhost' WITH GRANT OPTION";

            if ($dbs4->getResult($sql3)) {
                // $msg = "Priviliedges grandted for user $db_name on DB $db_name - next bit.";
                $check_num = "4";
                $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                // echo "\$sql4 = $sql4<BR><BR>";

            } else {
                $msg = $dbs4->printError();
                echo "$msg<BR>";
            }

            $dbs5 = new dbSession();
            $mysqlDatabaseName = $db_name;
            $new_admin_user_name = $db_name;
            $new_admin_user_pwd = $db_pwd;
            $mysqlUserName = $dbs5->dbUser;
            $mysqlPassword = $dbs5->dbPass;
            $mysqlHostName = 'localhost';
            $mysqlImportFilename ='base_database_20160520_generic.sql';
            $db_folder = "todolistq_2_4_7";
            //ENTER THE RELEVANT INFO BELOW


            exec("ls",$output=array(),$worked);
            // echo "\$output = " . $output[0] . "<br>";
            if($worked != 0) {
                echo "\$worked on sql file import of tables - mysql -h error code = $worked <BR>";
            }
            echo "\$output = " . $output . "<br>";
            print_r($output);
            $result_array=explode(' ', $output);
            echo "<br>Output: ".$result_array."<br>";
            echo "Exit status: ".$return_var."<br>";

            $pwd = shell_exec('pwd');
            $pwd = trim($pwd);
            //echo "<pre>$pwd</pre>";
            echo "$pwd" . "x<br>";

            /** ********************************************************************************************
            //********************************************************************** DEBUG VARIABLES HERE - START
            $debug = $_POST['debug'];
            $debugMsg .= "<b>\$mysqlDatabaseName = $mysqlDatabaseName</b><BR>";
            $debugMsg .= "<b>\$mysqlUserName = $mysqlUserName</b><BR>";
            $debugMsg .= "<b>\$mysqlPassword = $mysqlPassword</b><BR>";
            $debugMsg .= "<b>\$mysqlHostName = $mysqlHostName</b><BR>";
            $debugMsg .= "<b>\$mysqlImportFilename = $mysqlImportFilename</b><BR>";
            include("config/debug.php");
            //********************************************************************** DEBUG VARIABLES HERE - END
            //******************************************************************************************* */

            //DO NOT EDIT BELOW THIS LINE
            //Export the database and output the status to the page
            if ($Config_OS == "Off") {
                // This is for linux ubuntu
                // echo "<BR>This is for linux ubuntu - Spiros 2.3.2<BR><BR>";
                $command = 'mysql -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' . $pwd . '/' . $mysqlImportFilename;
                echo "\$command for Ubuntu = $command<BR><BR>";
            } else {
                // echo "<BR>This is for OSX MAMP<BR><BR>";
                //echo exec('/applications/MAMP/library/bin/mysql -u live -pRamjet44 test47 < /Applications/MAMP/htdocs/s/spiros2_2_2_create_db/base_database_20131216_generic.sql ');
                $command='/applications/MAMP/library/bin/mysql -h ' . $mysqlHostName .' -u ' . $mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
            }

            exec($command,$output=array(),$worked);
            if($worked != 0) {
                echo "\$worked on sql file import of tables - mysql -h error code = $worked <BR>";
            }
            switch($worked){
                case 0:
                    // echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";

                    // echo "<span class=\"edit_success_solid\">Import file <b>" .$mysqlImportFilename ."</b> successfully imported to database </span><b>" .$mysqlDatabaseName ."</b><BR>";
                    $check_num = "5";
                    $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                    echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                    break;
                case 1:
                    echo '<span class="edit_fail">There was an error during import. Please make sure the import file is saved in the same folder as this script and check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>MySQL Import Filename:</td><td><b>' .$mysqlImportFilename .'</span></b></td></tr></table>';
                    break;
                case 2:
                    echo "<span class=\"edit_fail\">Import file <b>" .$mysqlImportFilename .'</b> did not find the path. </span><b>' .$mysqlDatabaseName .'</b>';
                    break;
            }
            echo "<span class=\"generalspanOnWhite\">";
            $structure = ' /var/www/html/users/' . $db_name . '/';
            // $structure = ' /var/www/html/repository/';
            // mkdir("ztesting");

            // mkdir('/path/to/directory', 0755, true);

            $command = 'mkdir -p' . $structure ;
            // $command = 'mkdir -p ./zdepth01/depth2/depth3/';
            // $command = 'mkdir("./zdepth01/depth2/depth3/", 0777, true)';
            exec($command,$output=array(),$worked);
            if($worked != 0) {
                echo "<BR> \$worked for mkdir = $worked <BR>";
            }
            switch($worked){
                case 0:
                    // echo "<span class=\"edit_success_solid\"><BR><BR>" . $command . "  worked.<BR><BR></span>";
                    $check_num = "6";
                    $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                    echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                    break;
                case 1:
                    echo "<span class=\"edit_fail\"><BR>" . $command . "  fail.<BR><BR></span>";
                    break;
            }

            $command2 = 'rsync -hortig /var/www/html/repository/ /var/www/html/users/' . $db_name . '/';
            exec($command2,$output=array(),$worked);
            if($worked != 0) {
                echo "\$worked for rsync = $worked <BR>";
            }
            switch($worked){
                case 0:
                    // echo "<span class=\"edit_success_solid\"><BR>" . $command2 . "  executed<BR><BR></span>";
                    $check_num = "7";
                    $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                    echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                    break;
                case 1:
                    echo "<span class=\"edit_fail\"><BR>" . $command2 . "  fail.<BR><BR></span>";
                    break;
            }

            //sed -i.bak 's/\($dbUser\s=\s"\).*/\1edgar";/' dbSession.class

            $command3 = 'sed -i.bak \'s/\\($dbUser\\s=\\s"\\).*/\\1' . $db_name . '";/\' /var/www/html/users/' . $db_name . '/' . $db_folder . '/config/dbSession.class';
            exec($command3,$output=array(),$worked);
            if($worked != 0) {
                echo "\$worked sed specifying username = $worked <BR>";
            }
            switch($worked){
                case 0:
                    // echo "<span class=\"edit_success_solid\"><BR>" . $command3 . "  executed<BR><BR></span>";
                    $check_num = "8";
                    $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                    echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                    break;
                case 1:
                    echo "<span class=\"edit_fail\"><BR>" . $command3 . "  fail.<BR><BR></span>";
                    break;
            }

            $command4 = 'sed -i.bak \'s/\\($dbPass\\s=\\s"\\).*/\\1' . $db_pwd . '";/\' /var/www/html/users/' . $db_name . '/' . $db_folder . '/config/dbSession.class';
            exec($command4,$output=array(),$worked);
            if($worked != 0) {
                echo "\$worked (the error code of the linux command itself) sed specifying password = $worked <BR>";
            }
            switch($worked){
                case 0:
                    // echo "<span class=\"edit_success_solid\"><BR>" . $command4 . "  executed<BR><BR></span>";
                    $check_num = "9";
                    $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                    echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                    break;
                case 1:
                    echo "<span class=\"edit_fail\"><BR>" . $command4 . "  fail.<BR><BR></span>";
                    break;
            }

            $command5 = 'sed -i.bak \'s/\\($dbName\\s=\\s"\\).*/\\1' . $db_name . '";/\' /var/www/html/users/' . $db_name . '/' . $db_folder . '/config/dbSession.class';
            exec($command5,$output=array(),$worked);
            if($worked != 0) {
                echo "\$worked (the error code of the linux command itself) specifying the database name = $worked";
            }
            switch($worked){
                case 0:
                    // echo "<span class=\"edit_success_solid\"><BR>" . $command5 . "  executed<BR><BR></span>";
                    $check_num = "10";
                    $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                    echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                    break;
                case 1:
                    echo "<span class=\"edit_fail\"><BR>" . $command5 . "  fail.<BR><BR></span>";
                    break;
            }
            $command4 = 'mysql -u ' . $mysqlUserName . ' -p' . $mysqlPassword . ' --execute "GRANT ALL PRIVILEGES ON ' . $mysqlDatabaseName . '.* TO \'' . $new_admin_user_name . '\'@\'localhost\' IDENTIFIED BY \'' . $new_admin_user_pwd . '\'"';

            exec($command4,$output=array(),$worked);
            if($worked != 0) {
                echo "\$worked (the error code of the linux command itself) mysql -h command. = $worked <BR>";
            }
            switch($worked){
                case 0:
                    // echo "<span class=\"edit_success_solid\"> \$command4 = " . $command4 . "<BR><BR> and it worked successfully.</span><BR><BR>";
                    $check_num = "11";
                    $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
                    echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
                    break;
                case 1:
                    echo "<span class=\"edit_fail\">There was an error during the User permissions editing. <BR> The command used was " . $command4 . "</span>";
                    break;
            }

            insert_user_other_db($new_admin_user_name, $new_admin_user_pwd, 'localhost', $mysqlUserName, $mysqlPassword, $mysqlDatabaseName);
            $_POST['dbName'] = $new_admin_user_name;
            $_POST['db_folder'] = $db_folder;
            log_into_external_db();
        }
    } else {
        echo "<span class=\"edit_fail\"><BR><BR>Not a valid name. Please type it again.</span>";
    }
}
function insert_user_other_db($user_login, $user_pwd, $db_host_other_db, $db_user_other_db, $db_pass_other_db, $db_name_other_db) {
    // Get data from the database where the name variable = ????
/** ***********************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
    $turn_this_debug_on = 0;
    if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "<BR>********************************************************************<BR>";
        $debugMsg .= "Debug in InsertClient() in index.php<BR>";
        $debugMsg .= "\$_POST['name'] =" . $_POST['name'] . "<BR>";
        $debugMsg .= "\$_POST['pass'] = " . $_POST['pass'] . "<BR>";
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
        $debugMsg .= "********************************************************************<BR>";
        include("config/debug.php");
    }
//********************************************************************** DEBUG VARIABLES HERE - END
//************************************************************************************************/

/** ***********************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
    $turn_this_debug_on = 0;
    if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "<b>Inside InsertClient()</b><BR>";
        $debugMsg .= "This " . $_POST['StartTime'] . " is the \$StartTime in index.php<BR><BR>";
        include("config/debug.php");
    }
//********************************************************************** DEBUG VARIABLES HERE - END
//************************************************************************************************/

    // echo"Table Data<BR>";
    echo "<div align=\"center\">";
    /*    // $user_login = $_POST['InsertIntoDatabase'];
    // echo "<br></br>\$user_login = $user_login";

    // $user_pwd = $_POST['$user_pwd'];
    // echo "<br></br>\$user_pwd = $user_pwd";*/
    $ClientPhone1 = $_POST['ClientPhone1'];
    $ClientInsertDate = $_POST['StartTime'];
    $StartTime = time();

    /** ***********************************************************************************************
    //******************************************************************** DEBUG VARIABLES HERE - START
    $turn_this_debug_on = 0;
    if ($turn_this_debug_on == 1) {
        $debug = $_POST['debug'];
        $debugMsg .= "<b>Inside InsertClient()</b><BR>";
        $debugMsg .= "This " . $ClientInsertDate . " is the \$ClientInsertDate in index.php<BR><BR>";
        include("config/debug.php");
    }
    //********************************************************************** DEBUG VARIABLES HERE - END
    //************************************************************************************************/

    $dbs_other_db = new dbSession;
    $dbs_other_db->dbSession_other_db($db_host_other_db, $db_user_other_db, $db_pass_other_db, $db_name_other_db);

    if ($user_login != "") {
        // $sql = "INSERT INTO user (UserActive, UserDate, UserLogin, UserPassword, UserFirstname) VALUES ('1', '$StartTime', '$user_login', '$user_pwd', '$user_login')";
        // $sql = "UPDATE user SET (UserActive, UserDate, UserLogin, UserPassword, UserFirstname) VALUES ('1', '$StartTime', '$user_login', '$user_pwd', '$user_login') WHERE UserID = '1'";
        $sql = "UPDATE user SET 
			UserActive = '1', 
			UserDate = '$StartTime', 
			UserLogin = '$user_login',
			UserPassword = '$user_pwd', 
			UserFirstName = '$user_login'
			WHERE UserID = '1'";

        if ($dbs_other_db->getResult($sql)) {
            // $msg = "<span class=\"edit_success_solid\">User updated.</span>";
            $check_num = "12";
            $msg = "Check $check_num <img src=\"images/tick.gif\" width=\"20\" height=\"20\">";
            echo "<span class=\"edit_success_solid\">$msg<BR><BR></span>";
            /**
            $dbs = new dbSession();
            $sql = "SELECT UserID, UserLogin from user WHERE UserLogin = \"$user_login\"";
            $Results = $dbs->getResult($sql);
            $row = $dbs->getArray($Results);
            $UniqueIdentifier = $row['UserID'];
            $UserLogin = $row['UserLogin'];
            $GotoClientCard = "1";

            echo "Goto card for ";
            echo "<form method=\"post\" action=\"./user_card_with_time_limits_ajax.php\">";
            echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $UniqueIdentifier . "\">";
            echo "<input type=\"hidden\" name=\"StartTime\" value=\"" . $StartTime . "\">";
            include("log_in_authentication_form_vars.php");
            echo "<input class=\"inputA\" type=\"submit\" name=\"action\" value=\"" . $UserLogin . "\">";
            echo "</form>";
            echo "<BR>"; */
            //user_button($UniqueIdentifier);
        } else {
            $msg = $dbs->printError();
            echo "<BR>$msg<BR>";
        }
    } else {
        echo "<span class=\"edit_fail\"><BR><BR>Not a valid name. Please type it again.</span>";
    }

}
function choose_db() {
    $db_name = $_POST['db_name'];
    $db_folder = $_POST['db_folder'];
    ?>

    <TABLE align="center">
        <TR>
            <TD>

                <?PHP
                $StartTime = time();
                $debug = $_POST['debug'];
                $debugMsg .= "inside addClient()<br></br>";
                $debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
                $debugMsg .= "\$fieldName= $fieldName<BR>";
                include("config/debug.php");
                echo "<form method=\"post\" action=\"$PHP_SELF\">";
                // echo "<form method=\"post\" action=\"../../users/" . $db_name . "/" . $db_folder . "/index.php\" target=\"_blank\">";

                echo "<BR>";
                echo "DB name.............. ";
                echo "<input type=\"text\" name=\"db_name\" value=\"\">";
                echo "<BR>";

                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"log_into_external_db\">";
                echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
                echo "<input type=\"submit\" name=\"Submit\" value=\"Open existing DB\">";
                echo "</form>";


                ?>
            </TD>
        </TR>
    </TABLE>
    <?PHP
}
function log_into_external_db() {
    $db_name = $_POST['db_name'];
    $db_folder = $_POST['db_folder'];
    ?>

    <TABLE align="center">
        <TR>
            <TD>

                <?PHP
                $StartTime = time();
                $debug = $_POST['debug'];
                $debugMsg .= "inside addClient()<br></br>";
                $debugMsg .= "\$SearchClientName= $SearchClientName<BR>";
                $debugMsg .= "\$fieldName= $fieldName<BR>";
                include("config/debug.php");

                // echo "<form method=\"post\" action=\"../../users/test57/spiros2_2_2_create_db/log_in_other_thanks.php\" target=\"_blank\">";
                echo "<form method=\"post\" action=\"../../users/" . $db_name . "/" . $db_folder . "/index.php\" target=\"_blank\">";
                //echo "<form method=\"post\" action=" . htmlspecialchars($_SERVER["PHP_SELF"]); . ">";
                /**
                ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <?PHP

                // echo "System type.<BR> ";
                // echo "<input type=\"radio\" name=\"Config_OS\" value=\"On\" > OSX MAMP<BR>";
                // echo "<input type=\"radio\" name=\"Config_OS\" value=\"Off\" checked=\"checked\" > LINUX<BR>";
                echo "<BR>";
                echo "DB name.............. ";
                echo "<input type=\"text\" name=\"db_name\" value=\"\">";
                echo "<BR>";

                echo "Username .............. ";
                echo "<input type=\"text\" name=\"user_name\" value=\"\">";
                echo "<BR>";
                echo "User password...................... ";
                echo "<input type=\"password\" name=\"user_pwd\" value=\"\">";
                echo "<BR>";

                ?>
                Name <input class="inputA" type="text" name="name" size="5">
                Pass <input class="inputA" type="password" name="pass" size="5">
                <input type="hidden" name="<?php // echo session_name(); ?>" value="<?php echo session_id(); ?>">
                <?PHP
                 */
                echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"jump_to_db\">";
                echo "<input type=\"hidden\" name=\"StartTime\" value=\"$StartTime\">";
                echo "<input type=\"submit\" name=\"Submit\" value=\"Open task list\"> for " . $db_name;
                echo "</form>";
                ?>
            </TD>
        </TR>
    </TABLE>
    <?PHP
}
?>

