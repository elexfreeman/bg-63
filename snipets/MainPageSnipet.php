<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 01.09.15
 * Time: 11:05
 */

include_once "bg.class.php";
$BG = new BG();

switch($_GET['action']){
  case "GetProductList":
    $BG->MainPage();
    break;
  case "AddToCard":
    $BG->AddToCard(mysql_escape_string($_GET['product_id']));
    break;
  case "Search":
    $BG->Search();
    break;
  case "GetProductSingle":
    $BG->GetProductSingle(mysql_escape_string($_GET['product_id']));
    break;
  case "GetSphereList":
    $BG->LeftMenu();
    break;
  case "specList":
    $BG->GetFastList($_GET['parent']);
    break;
  case "GetProductListGotov":
    $BG->GetProductListGotov();
    break;
    case "CardRemove":
    $BG->CardRemove(mysql_escape_string($_GET['product_id']));
    break;

}