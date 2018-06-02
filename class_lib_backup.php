<?php
/**
 * Created by PhpStorm.
 * User: dionpatelis
 * Date: 2/06/2018
 * Time: 7:54 PM
 */
namespace tdlq\backup01;
include ("interface_lib_tdlq247.php");

class class_lib_backup implements move_db {
    function backup_db(){
        echo "Backup DB<br><br>";
    }

    function restore_db(){
        echo "Restore DB<br><br>";
    }
}

