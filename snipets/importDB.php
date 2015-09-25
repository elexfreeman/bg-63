<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 26.08.15
 * Time: 13:24
 */




function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 'c',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'C',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '_',  'Ы' => 'Y',   'Ъ' => '_',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}

function encodestring($str) {
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


global $table_prefix;
?>
<div class="container">

<?php


$import_sql_sale="select
sale.*, vid.name vid_name, vid.img vid_img
,districts.name districts_name
,districts.place districts_place
 from business_sale sale

join business_vid vid
on sale.vid=vid.id

join districts
on districts.id=sale.district";


$import_sql_purchase="select purchase.*,
users.first_name user_first_name,
users.last_name users_last_name,
users.work_phone users_work_phone,
users.mobile_phone users_mobile_phone ,
actiontypes.name actiontypes_name  from business_purchase purchase
left join business_users users
on users.id=purchase.user_id
join actiontypes
on actiontypes.id=purchase.actiontype
";

$uploadfile="/var/www/virtual-hosts/delo-bg63.aktiwork.ru/snipets/export1.csv";

//херим данные в таблице s_products
$tmpFile='/var/www/virtual-hosts/delo-bg63.aktiwork.ru/snipets/tmp.sql';
//unlink($tmpFile);

//$fp = fopen($uploadfile, "r"); // Открываем файл в режиме чтения

$import_file=file_get_contents($uploadfile);
$import_file=explode("|",$import_file);

$count=0;
 {
    $start = true;
    //modx_site_tmplvar_templates - содежит связь между полями и шаблонами
    //modx_site_tmplvar_contentvalues - содежит значения полей в странице
    //modx_site_tmplvars - поля
    //modx_site_content - страницы
    //
    $modx_category_tv = 9;


    // while (!feof($fp))
     foreach ($import_file as $key1=>$mytext)
    {
        $kkk++;
        $kk++;
        //$mytext = fgets($fp);
        $tt = explode("#", $mytext);
        echo "<pre>";
        print_r($tt);
        echo "</pre>";

        //Заголовок
        if ($start) {
            $start = false;
            //Формируем TV

            foreach ($tt as $key => $value) {
                $value = mysql_escape_string($value);
                $property[$key] = 0;

                $sql_tpl_var = "select id from " . $table_prefix . "site_tmplvars where name='" . $value . "'";
                foreach ($modx->query($sql_tpl_var) as $row_tpl_var) {
                    $property[$key] = $row_tpl_var['id'] + 0;
                }

                if ($property[$key] == 0) {
                    $sql_tplvar = "INSERT INTO " . $table_prefix . "site_tmplvars
(type, name, caption, description,category) VALUES ('text', '$value', '$value', ''," . $modx_category_tv . ");";
                    $modx->query($sql_tplvar);
                    $property[$key] = $modx->lastInsertId();
                    echo $sql_tplvar . "<br>";
                }


            }

        } else {

            //импортируем страницы
            $parent = 2;
            $template = 2;
            //Ищем такую страницу
            $pagetitle = mysql_escape_string($tt[2]);
            $alias = encodestring($tt[0] . "_" . $tt[2]);
            $url = "prodazha/" . $alias . ".html";


            $product_id = 0;
            $sql_page = "select * from " . $table_prefix . "site_content where pagetitle='" . mysql_escape_string($pagetitle) . "'";
            echo $sql_page;
            foreach ($modx->query($sql_page) as $row_page) {
                $product_id = $row_page['id'];
            }
            if ($product_id == 0) {
                $sql_product = "INSERT INTO " . $table_prefix . "site_content
(id, type, contentType, pagetitle, longtitle,
description, alias, link_attributes,
published, pub_date, unpub_date, parent,
isfolder, introtext, content, richtext,
template, menuindex, searchable,
cacheable, createdby, createdon,
editedby, editedon, deleted, deletedon,
deletedby, publishedon, publishedby,
menutitle, donthit, privateweb, privatemgr,
content_dispo, hidemenu, class_key, context_key,
content_type, uri, uri_override, hide_children_in_tree,
show_in_tree, properties)
VALUES (NULL, 'document', 'text/html', '" . $pagetitle . "', '', '', '" . encodestring(mysql_escape_string($articul . "-" . $pagetitle)) . "',
'', true, 0, 0, " . $parent . ", false, '', '', true, " . $template . ", 1, true, true, 1, 1421901846, 0, 0, false, 0, 0, 1421901846, 1, '',
false, false, false, false, false, 'modDocument', 'web', 1,
 '" . $url . "', false, false, true, null
 );

;";
                echo "------------------------------------------------------";
                echo "--------------------- ПРОДУКТ ------------------------";
                echo $sql_product . "<br>";
                $modx->query($sql_product);
                $product_id = $modx->lastInsertId();
            }
            //Теперь свойства

            //СОВЙСТВА
            $page_property = null;
            foreach ($tt as $key => $value) {
                //if ($key > 3)
                 {

                    //Ищем есть ли уже такое свойство
                    $tv_id = 0;
                    $sql_tv = "select * from " . $table_prefix . "site_tmplvar_contentvalues where
 (tmplvarid='" . $property[$key] . "')and(contentid='$product_id')

";
                    foreach ($modx->query($sql_tv) as $row_tv) {
                        $tv_id = $row_tv['id'];
                    }
                    if ($tv_id == 0) {
                        $sql_modx_vars = "INSERT INTO " . $table_prefix . "site_tmplvar_contentvalues
(tmplvarid,contentid,value) VALUES ('" . $property[$key] . "','$product_id','$value');";
                        echo $sql_modx_vars . "<br>";
                        $modx->query($sql_modx_vars);
                    } else {
                        $sql_modx_vars = "update " . $table_prefix . "site_tmplvar_contentvalues
            set value='$value' where  (tmplvarid='" . $property[$key] . "')and(contentid='$product_id')";
                        echo $sql_modx_vars . "<br>";
                        $modx->query($sql_modx_vars);
                    }
                    //modx_site_tmplvar_templates - содежит связь между полями и шаблонами
                    //modx_site_tmplvar_contentvalues - содежит значения полей в странице
                    //modx_site_tmplvars - поля
                    //modx_site_content - страницы
                }
            }


        }


        // echo $mytext . "<br />";


        $count++;
        // echo $sql."<br>";
        // $query = $modx->query($sql);
        // echo "---------------------------------------------<br>";
        //  fwrite($fh, $sql);

    }
//
}
//else echo "Ошибка при открытии файла";
//fclose($fp);
//fclose($fh);
echo "Итого: ".$count."<br>";
//$cmd='mysql -u '.$database_user.' -p'.$database_password.' '.$database_user.' < '.$tmpFile;
//echo $cmd;
//exec($cmd);


?>

</div>