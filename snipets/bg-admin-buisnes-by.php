<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 24.09.15
 * Time: 9:48
 * снипет для админки покупки бизнеса
 */

require_once "snipets/bg-admin.class.php";
$BGAdmin = new BGAdmin();
$BGAdmin-> ProductByMenu();
$BGAdmin->ProductByList($scriptProperties);