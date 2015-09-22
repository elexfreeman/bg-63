<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 03.09.15
 * Time: 11:41
 */


require_once __DIR__."/bg-admin.class.php";

$list=new BGAdmin();

if((isset($_POST['action']))and($_POST['action']=='update'))
{
    $list->ProductUpdate();
}
else
$list->ProductEdit();