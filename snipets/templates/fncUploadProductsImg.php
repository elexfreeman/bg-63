<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 22.09.15
 * Time: 14:16
 */





//$sql="select * from ".$table_prefix."site_content where parent=".$this->catalog_id;

echo "111";
/*
foreach ($modx->query($sql) as $row)
{
  $product = $this->GetProductInfo($row['id']);*/
  //разбираем имя файла

  $path = $_SERVER['DOCUMENT_ROOT']."/images/";



  if ($handle = opendir($path)) { // открыт текущий каталог
  while (false !== ($file = readdir($handle)))   {
    if ($file != "." && $file != "..")
    {
      $tmpName = explode(".", $file);

      $tmpName = explode(" ", $tmpName[0]);
      $tmpName = (count($tmpName) > 1)?$tmpName[1]:$tmpName[0];
      $tmpName = explode("-", $tmpName);
      $inner_id = $tmpName[0];
      echo "SELECT contentid FROM bg63_site_tmplvar_contentvalues WHERE `value` = '{$inner_id}' AND `tmplvarid`=48";

      $fileNameQuery = $modx->query("SELECT contentid FROM bg63_site_tmplvar_contentvalues WHERE `value` = '{$inner_id}' AND `tmplvarid`=48");

      $contentId = $fileNameQuery->fetchColumn();

      echo "INSERT INTO bg63_site_tmplvar_contentvalues (tmplvarid, contentid, vlaue) VALUES (48, {$contentId}, '{$file}')";

      //$modx->query("INSERT INTO bg63_site_tmplvar_contentvalues (tmplvarid, contentid, vlaue) VALUES (48, {$contentId}, '{$fileName}')");

    }
  }
  closedir($handle);
}
exit;





  var_dump($product);exit;

//}