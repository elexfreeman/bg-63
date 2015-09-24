<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 03.09.15
 * Time: 11:41
 */


require_once __DIR__."/bg-admin.class.php";
require_once __DIR__."/bg.class.php";

$BGAdminModel=new BGAdmin();
$BGModel = new BG();

if((isset($_POST['action']))and($_POST['action']=='update'))
{
    $BGAdminModel->ManagerUpdate();
}
else
    $BGAdminModel->ManagerEdit();