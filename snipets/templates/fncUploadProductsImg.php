<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 22.09.15
 * Time: 14:16
 */

;
$sql="select * from ".$table_prefix."site_content where parent=".$this->catalog_id;

foreach ($modx->query($sql) as $row)
{
  $product=$this->GetProductInfo($row['id']);

}