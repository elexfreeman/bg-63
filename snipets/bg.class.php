<?php

/**
 * Created by PhpStorm.
 * User: elex
 * Date: 01.09.15
 * Time: 11:41
 */
//Класс ждя работы с front-end
class BG
{

  /*function FilterForm()
  {
    global $modx;
    global $table_prefix;
    include "templates/tplFiltrForm.php";
  }*/

  /**
   * Функция возвращения списка id срочной продажи
   */
  function GetFastList($parent)
  {
    global $modx;
    include "templates/tplFastList.php";
  }

  /**
   * функция возвращает список id проданых товаров
   */
  function GetProdanoList($parent)
  {
    global $modx;
    include "templates/fncProdanList.php";
  }

  /**
   * функция для вывода проданых товаров по одному
   */
  function GetProdanoSingle($product_id)
  {
    include "templates/tplProductSinglePro.php";
  }

  function LeftMenu()
  {
    global $modx;
    include "templates/fncLeftMenu.php";
  }

  /**
   *
   */
  function Search()
  {
    global $modx;
    global $table_prefix;

    /*
    select * from bg63_site_content
    where id in(

    select stoimost_content from
    (

    -- ----------------------------------

    select * from
    -- 			okypaemost -------------
    (
    select
        tv.name okypaemost_title,
        cv.value okypaemost,
        cv.contentid okypaemost_content

        from bg63_site_tmplvar_contentvalues cv

        join bg63_site_tmplvars tv
        on tv.id=cv.tmplvarid

        where tv.name='okypaemost'
    ) a
    -- ----------------------------------
    join
    (
    -- 			stoimost -------------
    select
        tv.name stoimost_title,
        cv.value stoimost,
        cv.contentid stoimost_content

        from bg63_site_tmplvar_contentvalues cv

        join bg63_site_tmplvars tv
        on tv.id=cv.tmplvarid

        where tv.name='stoimost'
    ) b
    on a.okypaemost_content=b.stoimost_content
    -- ----------------------------------

    ) res
    where res.stoimost>330000
    )

             * */
/*
    $sql = "
-- ----------------------------------

select * from
-- 			okypaemost -------------
(
select
    tv.name okypaemost_title,
    cv.value okypaemost,
    cv.contentid okypaemost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='okypaemost'
) a
-- ----------------------------------
join
(
-- 			stoimost -------------
select
    tv.name stoimost_title,
    cv.value stoimost,
    cv.contentid stoimost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='stoimost'
) b
on a.okypaemost_content=b.stoimost_content
-- ----------------------------------
";


    $dohodnost = mysql_escape_string($_GET['dohodnost']);
    $vlj_min = mysql_escape_string($_GET['vlj_min']);
    $vlj_max = mysql_escape_string($_GET['vlj_max']);
    $srok = mysql_escape_string($_GET['srok']);


    $sql = "select * from " . $table_prefix . "site_content
where id in(

select stoimost_content from
(

-- ----------------------------------

select * from
-- 			okypaemost -------------
(
select
    tv.name okypaemost_title,
    cv.value okypaemost,
    cv.contentid okypaemost_content

    from " . $table_prefix . "site_tmplvar_contentvalues cv

    join " . $table_prefix . "site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='okypaemost'
) a
-- ----------------------------------
join
(
-- 			stoimost -------------
select
    tv.name stoimost_title,
    cv.value stoimost,
    cv.contentid stoimost_content

    from " . $table_prefix . "site_tmplvar_contentvalues cv

    join " . $table_prefix . "site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='stoimost'
) b
on a.okypaemost_content=b.stoimost_content
-- ----------------------------------

) res

where res.stoimost>330000


)";

    // echo $sql;


    $prd = '';
    $i = 0;
    foreach ($modx->query($sql) as $product) {
      $prd .= "," . $product['id'];
      $i++;
    }
    $res['count'] = $i;
    if ($prd != '') $prd = substr($prd, 1);
    $res['res'] = $prd;
    $res['sql'] = $sql;
    echo json_encode($res);*/
      include "templates/tplSearch.php";
  }

  /**
   * Функция для вывода количества товара
   */
  function GetCount($name)
  {
    global $modx;
    include "templates/fntGetCount.php";
  }


  /**
   * функция для вывода каталога готовых фирм
   */
  function GetProductListGotov()
  {
    global $modx;
    include "templates/fncGotovFirm.php";
  }

  public function MainPage()
  {

    global $modx;
    global $table_prefix;
    include "templates/fncMainPage.php";


  }

  function AddToCard($product_id, $count = 1)
  {
    global $modx;
    if (isset($_SESSION['product_' . $_GET['product_id']])) {
      unset($_SESSION['product_' . $_GET['product_id']]);
      echo json_encode(array("status" => "0", "count" => $this->GetCardCountProduct(), "panel_text" => $this->Panel_GetCardCount())); //удалили из корзины

    }
    else {
      $_SESSION['product_' . $_GET['product_id']] = mysql_escape_string($_GET['product_count']);
      echo json_encode(array("status" => "1", "count" => $this->GetCardCountProduct(), "panel_text" => $this->Panel_GetCardCount())); //добавили
    }
  }


  // объявление метода

  function GetCardCountProduct()
  {
    $cc = 0;
    foreach ($_SESSION as $key => $value) {
      if (substr($key, 0, 3) == 'pro') $cc = $cc + $value;
      //echo $key." ".$value." ".substr($key,0,3);


    }
    return $cc;
  }

  function Panel_GetCardCount()
  {
    $count = $this->GetCardCountProduct();
    if ($count == 0) {
      $count = 'Пусто';
    }
    elseif ($count == 1) {
      $count = 'У Вас 1 объект';
    }
    elseif (($count == 2) or ($count == 3) or ($count == 4)) {
      $count = 'У Вас ' . $count . ' объекта';
    }
    else $count = 'У Вас ' . $count . ' объектов';

    return $count;
  }

  //возвращает кол-во продуктов в корзине

  function GlobalSnipet($scriptProperties)
  {
    global $modx;

    //Колл-во продуктов в корзине
    if ($scriptProperties['action'] == 'Panel_GetCardCount') {
      echo $this->Panel_GetCardCount();
    }
    elseif ($scriptProperties['action'] == 'ShowCard') {
      $this->ShowCard();
    }
    elseif ($scriptProperties['action'] == 'FilterForm') {
      $this->FilterForm();
    }

  }

  //Колл-во продуктов в корзине

  function ShowCard()
  {
    global $modx;
    global $table_prefix;
    include "templates/tplCard.php";
  }

  function FilterForm()
  {
    global $modx;
    global $table_prefix;
    include "templates/tplFiltrForm.php";
  }

  function GetProductInfo($product_id)
  {
    global $modx;
    global $table_prefix;

    $sql = "select * from " . $table_prefix . "site_content where id=" . $product_id;
    foreach ($modx->query($sql) as $row) {
      $product = new stdClass();
      $product->id = $row['id'];
      $product->introtext = $row['introtext'];
      $product->description = $row['description'];
      $product->title = $row['pagetitle'];
      $product->url = $row['uri'];
      //теперь дополнительные поля
      // - 1 - если это подарки, то тут нету дополнительных цен
      $tv = $this->GetContentTV($product_id);
      $product->tv = $tv;

    }
    return $product;

  }


  //Инфо по продукту

  function GetContentTV($content_id)
  {
    global $modx;
    global $table_prefix;


    $sql_tv = "select
                            tv.name,
                            cv.value

                            from " . $table_prefix . "site_tmplvar_contentvalues cv

                            join " . $table_prefix . "site_tmplvars tv
                            on tv.id=cv.tmplvarid

                            where cv.contentid=" . $content_id;

    // echo $sql_tv;
    foreach ($modx->query($sql_tv) as $row_tv) {
      $tv[$row_tv['name']] = $row_tv['value'];
    }
    return $tv;
  }

  function SphereList()
  {
    global $modx;
    global $table_prefix;
    $sql_sphere = "select  distinct
            tv.name,
            cv.value

            from " . $table_prefix . "site_tmplvar_contentvalues cv

            join " . $table_prefix . "site_tmplvars tv
            on tv.id=cv.tmplvarid

            where tv.name='vid_name'
            ;";

    $temp = array();
    foreach ($modx->query($sql_sphere) as $row_sphere) {
      $tmp[] = $row_sphere['value'];
    }
    return $tmp;
  }

  /*
     * Выбираем массив сфер деятельности (по умолчанию)
     * */

  function SphereListElements() {

    global $modx;

    $result = array();

    $sphereTv = $modx->getObject('modTemplateVar',array('name'=>"vid_name"));
    $sphereTvElements = $sphereTv->get('elements');
    $result = explode("||", $sphereTvElements);

    return $result;

  }


  /*Для акса вывода при поиске одного товара*/
  function GetProductSingle($product_id)
  {

    include "templates/tplProductSingle.php";
  }

  function UploadProductsImg()
  {
    global $modx;
    global $table_prefix;
    include "templates/fncUploadProductsImg.php";
  }

  function CardRemove($product_id)
  {
    unset($_SESSION['product_' . $_GET['product_id']]);
  }

    function GetFastSaleCount()
    {
        global $modx;
        global $table_prefix;

        $sql="select count(*) cc from
(

-- ----------------------------------

select * from
-- 			okypaemost -------------
(
select
    tv.name prodano_title,
    cv.value prodano,
    cv.contentid prodano_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='prodano'
) a
-- ----------------------------------
left join
(
-- 			stoimost -------------
select
    tv.name stoimost_title,
    cv.value stoimost,
    cv.contentid stoimost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='stoimost'
) b
on a.prodano_content=b.stoimost_content
-- ----------------------------------
left join
(
-- 			stoimost -------------
select
    tv.name fastsale_title,
    cv.value fastsale,
    cv.contentid fastsale_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='fastsale'
) c
on a.prodano_content=c.fastsale_content
-- ----------------------------------
having fastsale=1

) v ";

        $count=0;
        foreach ($modx->query($sql) as $row) {
            $count=$row['cc'];
        }
        return $count;
    }

    function GetSaleCount()
    {
        global $modx;
        global $table_prefix;

        $sql="select count(*) cc from
(

-- ----------------------------------

select * from
-- 			okypaemost -------------
(
select
    tv.name prodano_title,
    cv.value prodano,
    cv.contentid prodano_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='prodano'
) a
-- ----------------------------------
join
(
-- 			stoimost -------------
select
    tv.name stoimost_title,
    cv.value stoimost,
    cv.contentid stoimost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='stoimost'
) b
on a.prodano_content=b.stoimost_content
-- ----------------------------------
having prodano=0

) v";

        $count=0;
        foreach ($modx->query($sql) as $row) {
            $count=$row['cc'];
        }
        return $count;
    }


    function GetSaleDoneCount()
    {
        global $modx;
        global $table_prefix;

        $sql="select count(*) cc from
(

-- ----------------------------------

select * from
-- 			okypaemost -------------
(
select
    tv.name prodano_title,
    cv.value prodano,
    cv.contentid prodano_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='prodano'
) a
-- ----------------------------------
join
(
-- 			stoimost -------------
select
    tv.name stoimost_title,
    cv.value stoimost,
    cv.contentid stoimost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='stoimost'
) b
on a.prodano_content=b.stoimost_content
-- ----------------------------------
having prodano=1

) v";

        $count=0;
        foreach ($modx->query($sql) as $row) {
            $count=$row['cc'];
        }
        return $count;
    }

  /**
   * Функция получения mail по фамилии менеджера
   * @param $last_name
   */
  function Mail($last_name){
    global $modx;
    include "templates/fncMail.php";
  }

  /**
   * Функция удаления готовго ООО
   * @param $gotov_id
   */
  function Remove($remove_id){
    global $modx;
    include "templates/gotov/fncRemoveGotov.php";
  }

  /**
   * функция возвращает json массив с id покупок
   */
  function GetBuyList(){
    global $modx;
    include "templates/fncGetBuyList.php";
  }

  /**
   * Функция выводит одиночную покупку
   * @param $product_id
   */
  function GetBuySingle($product_id){
    global $modx;
    include "templates/tplBuySungle.php";
  }

  /**
   * функция возвращает количество покупок
   * @return mixed
   */
  function GetBuyCount(){
    global $modx;
    $sql = "SELECT count(*) n
FROM bg63_site_content b
WHERE b.parent=4";
    foreach ($modx->query($sql) as $dd) {
      $count = $dd['n'];
    }
    return $count;

  }

  /**
   * Функция вывода в карточку больших фотографий
   * @param $old_id
   */
  function GetBigImage($old_id){
    global $modx;
    include "templates/tplBigFoto.php";
  }

  function GetSmallImage($old_id){
    global $modx;
    include "templates/tplSmallFoto.php";
  }

  function GetManager($user_id){
    global $modx;
    include "templates/tplManager.php";
  }

}

