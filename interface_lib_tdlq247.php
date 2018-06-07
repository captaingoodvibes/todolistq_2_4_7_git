<?php
/**
 * Created by PhpStorm.
 * User: dionpatelis
 * Date: 2/06/2018
 * Time: 7:19 PM
 */

//namespace global;

// An interface is set up by the lead coder to flesh out the functions needed in a class..
interface move_db {
    // This setter function executes a backup and relays the status of the database movement.
    function backup_db();
    // This setter function restores from backup and relays the status of the database movement.
    function restore_db($new_restore_file);
    // This getter function informs about status of the database movement.
    function whats_the_status();
}

