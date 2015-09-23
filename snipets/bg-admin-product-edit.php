<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 03.09.15
 * Time: 11:41
 */


require_once __DIR__."/bg-admin.class.php";
require_once __DIR__."/bg.class.php";

$list=new BGAdmin();
$list2=new BG();

if ($_GET['action'] == "upload") {

    $list2->UploadProductsImg();
}

if((isset($_POST['action']))and($_POST['action']=='update'))
{
    $list->ProductUpdate();
}
else
$list->ProductEdit();