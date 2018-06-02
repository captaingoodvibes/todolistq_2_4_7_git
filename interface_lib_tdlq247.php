<?php
/**
 * Created by PhpStorm.
 * User: dionpatelis
 * Date: 2/06/2018
 * Time: 7:19 PM
 */

namespace tdlq\backup01;

// An interface is set up by the lead coder to flesh out the functions needed in a class.
interface move_db
{
    function backup_db();
    function restore_db();
}

