<?php

include("interface_lib_tdlq247.php");

class class_lib_movedb implements move_db{
    var $status;

    // This setter function executes a backup and relays the status of the database movement
    function backup_db() {
        $dbsbu = new dbSession();
        $command = 'mysqldump -u ' . $dbsbu->get_dbUser() . ' -p\'' . $dbsbu->get_dbPass() . '\' --single-transaction --quick --lock-tables=false ' . $dbsbu->get_dbName() . ' > backup.sql';
        exec($command,$output=array(),$worked);
        if($worked != 0) {
            $this->status = "<BR> \$worked for mysqldump = $worked <BR>";
        }
        switch($worked){
            case 0:
                $this->status = "case 0 " . $command;
                echo "<a href=\"http://todolistq.com/247installer/backup.sql\" class=\"blue\">Download my backup</a><br><br>";
                break;
            case 1:
                // echo "<span class=\"edit_fail\"><BR>" . $command . "  fail.<BR><BR></span>";
                $this->status = "case 1 " . $command;
                break;
        }
        /**echo $dbsbu->get_dbUser() . " in class_lib_backup1<br>";
        echo $dbsbu->get_dbPass() . " in class_lib_backup2<br>";
        echo $dbsbu->get_dbName() . " in class_lib_backup3<br>";*/

    }
    // This setter function restores from backup and relays the status of the database movement.
    function restore_db() {
        $dbsbu = new dbSession();
        /**
         * Use
         * shell> mysql < dump.sql
         * to restore the db.
         */
        echo "Restore DB<br><br>";
        $command = 'mysql -u ' . $dbsbu->get_dbUser() . ' -p\'' . $dbsbu->get_dbPass() . '\' ' . $dbsbu->get_dbName() . ' < dump6.sql';
        exec($command,$output=array(),$worked);
        if($worked != 0) {
            $this->status = "<BR> \$worked for mysqldump = $worked <BR>";
        }
        switch($worked){
            case 0:
                $this->status = "case 0 " . $command;
                break;
            case 1:
                // echo "<span class=\"edit_fail\"><BR>" . $command . "  fail.<BR><BR></span>";
                $this->status = "case 1 " . $command;
                break;
        }
    }

    // The getter function informs about status of the database movement.
    function whats_the_status() {
        return $this-> status;
    }
}

