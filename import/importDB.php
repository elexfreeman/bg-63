<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 26.08.15
 * Time: 13:24
 */

include "../core/config/config.inc.php";

$dbh = new PDO('mysql:host='.$database_server.';dbname='.$dbase, $database_user, $database_password);
$dbh->query("SET NAMES 'utf8'");

