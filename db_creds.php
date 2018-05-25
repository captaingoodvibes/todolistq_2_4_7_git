<?php
/**
 * Created by PhpStorm.
 * User: dionpatelis
 * Date: 19/05/2018
 * Time: 7:00 PM
 */


$dbs6 = new dbSession();
$red = $dbs5->dbUser;
$ted = $dbs5->dbPass;
$mysqlHostName = 'localhost';

echo "<b>\$mysqlUserName 2 = $red</b><BR>";
echo "<b>\$mysqlPassword 2 = $ted</b><BR>";
?>