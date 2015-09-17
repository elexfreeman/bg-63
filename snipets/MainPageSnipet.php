<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 01.09.15
 * Time: 11:05
 */

include_once "bg.class.php";
$BG = new BG();

if (isset($_GET['action'])) {
  if ($_GET['action'] == 'GetProductList') {
    $BG->MainPage();
  }
}