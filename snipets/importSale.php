<?php

ini_set('max_execution_time', 11111);

function encodestring ($str)
{
  // переводим в транслит
  $str = rus2translit($str);
  // в нижний регистр
  $str = strtolower($str);
  // заменям все ненужное нам на "-"
  $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
  // удаляем начальные и конечные '-'
  $str = trim($str, "-");


  return $str;
}


function rus2translit ($string)
{
  $converter = array(
    'а' => 'a', 'б' => 'b', 'в' => 'v',
    'г' => 'g', 'д' => 'd', 'е' => 'e',
    'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
    'и' => 'i', 'й' => 'y', 'к' => 'k',
    'л' => 'l', 'м' => 'm', 'н' => 'n',
    'о' => 'o', 'п' => 'p', 'р' => 'r',
    'с' => 'c', 'т' => 't', 'у' => 'u',
    'ф' => 'f', 'х' => 'h', 'ц' => 'c',
    'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
    'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
    'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

    'А' => 'A', 'Б' => 'B', 'В' => 'V',
    'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
    'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
    'И' => 'I', 'Й' => 'Y', 'К' => 'K',
    'Л' => 'L', 'М' => 'M', 'Н' => 'N',
    'О' => 'O', 'П' => 'P', 'Р' => 'R',
    'С' => 'C', 'Т' => 'T', 'У' => 'U',
    'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
    'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
    'Ь' => '_', 'Ы' => 'Y', 'Ъ' => '_',
    'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
  );

  return strtr($string, $converter);
}

$uploadfile = $_SERVER['DOCUMENT_ROOT'] . "/snipets/business_sale.csv";

$import_file = file_get_contents($uploadfile);
$import_file = explode("|", $import_file);

//массив тв
$tvs = array(
  "old_id",
  "row_sort",
  "nazvanie",
  "user_id",
  "stoimost",
  "razm_stoimosti",
  "opf",
  "dolya",
  "tip",
  "proizv",
  "srok",
  "kolsot",
  "uppersonal",
  "mestopolojenie",
  "nalogrejim",
  "dolg",
  "invest",
  "prichini",
  "nedvijimost",
  "tep",
  "moshnosti",
  "sert",
  "status",
  "kommentarii",
  "konsult",
  "contact",
  "date_in",
  "fastsale",
  "vid",
  "inner_id",
  "tehhar",
  "fondzp",
  "prichina",
  "okypaemost",
  "nemact",
  "place",
  "district",
  "areatype",
  "prodano",
  "special_offer",
  "special_offer_price",
  "leasing",
  "valuation",
  "vimeo_vid_id",
  "district",
  "areatype",
  "vid_name"
);

foreach ($import_file as $csvString) {

  $csvArray = explode("#", $csvString);

  //Создаем страницу и записываем параметры

  $product = $modx->newObject('modResource');
  $product->set('pagetitle', $csvArray['2']);
  $product->set('template', 2);
  $product->set('published', 1);
  $product->set('alias', encodestring($csvArray['0'] . "_" . $csvArray['2'] . rand(1, 90000)));
  $product->set('parent', 2);
  $product->setContent('[[*id]][[*opf]]');
  $product->save();

  //пихаем тв

  foreach ($csvArray as $tvNum => $tvValue) {

    if (!$product->setTVValue($tvs[$tvNum], preg_replace('/(^"|"$)/', '', $tvValue))) {

      echo "Не вставляицо тв: {$tvs[$tvNum]} - {$tvValue}";

    }

    else {


      //echo "Не вставляицо тв: {$tvs[$tvNum]} - {".preg_replace('/(^"|"$)/', '', $tvValue)."}";

    }
    $product->save();

  }

}

