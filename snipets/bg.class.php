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


  function LeftMenu(){
    global $modx;
    $sql = "SELECT * from bg63_site_content WHERE parent=1175";
    echo "<ul>";
    foreach ($modx->query($sql) as $dd) {
      ?>
      <li>
        <a href="<?php echo $dd['uri']; ?>"><?php echo $dd['pagetitle']; ?></a>
      </li>
      <?php
    }

  }

  function FilterForm()
  {
    global $modx;
    global $table_prefix;
    include "templates/tplFiltrForm.php";
  }

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
    echo json_encode($res);

  }

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


  // объявление метода
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

  //возвращает кол-во продуктов в корзине
  function GetCardCountProduct()
  {
    $cc = 0;
    foreach ($_SESSION as $key => $value) {
      if (substr($key, 0, 3) == 'pro') $cc = $cc + $value;
      //echo $key." ".$value." ".substr($key,0,3);


    }
    return $cc;
  }

  //Колл-во продуктов в корзине
  function Panel_GetCardCount()
  {
    $count = $this->GetCardCountProduct();
    if ($count == 0) {
      $count = 'Пусто';
    }
    elseif ($count == 1) {
      $count = 'У Вас 2 объект';
    }
    elseif (($count == 2) or ($count == 3) or ($count == 4)) {
      $count = 'У Вас ' . $count . ' объекта';
    }
    else $count = 'У Вас ' . $count . ' объектов';

    return $count;
  }

  function ShowCard()
  {
    global $modx;
    global $table_prefix;
    include "templates/tplCard.php";
  }


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


  //Инфо по продукту
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


  /*Для акса вывода при поиске одного товара*/
  function GetProductSingle($product_id)
  {

    $product = $this->GetProductInfo($product_id);
    ?>
    <div class="product_item">
      <div class="product_title">
        <?php echo $product->title; ?>
        <span>id <?php echo $product->id; ?></span>
      </div>
      <div class="product_img">
        <div class="product_img_list">
          <div class="product_img_list_layer"></div>
          <div class="prevSlider">
            <div class="item"></div>
            <div class="item">
              <img src="<?php echo "/UpLoad/" . $product->id . "/0.jpg"; ?>" alt="">
            </div>
            <div class="item"></div>
          </div>
        </div>

        <div class="product_buy_info" style="display:none">
          <i class="product-icons product-icons-flag"></i> Срочная продажа
        </div>

        <div class="product_buy_buttons">
          <ul class="product_buy_buttons_list" id="product_id_<?php echo $product->id; ?>">
            <li onclick="ProductDescription(<?php echo $product->url; ?>);">
              <i class="product-icons product-icons-list"></i><span>Подробнее</span>
            </li>
            <li onclick="AddToCard(<?php echo $product->id; ?>);">
              <i class="product-icons product-icons-bag"></i><span>В портфель</span></li>
            <li><i class="product-icons product-icons-money"></i><span>Поторговаться</span></li>
            <li><i class="product-icons product-icons-printer"></i><span>Распечатать</span></li>
          </ul>
        </div>
      </div>

      <div class="product_info">
        <ul class="product_info_list">

          <li><span>Расположение</span><span><?php echo $product->tv['mestopolojenie']; ?></span></li>
          <li>
            <span>Стоимость</span><span><?php echo $product->tv['stoimost'] . " " . $product->tv['razm_stoimosti']; ?></span>
          </li>
          <li><span>Окупаемость</span><span><?php echo $product->tv['okypaemost']; ?></span></li>
          <li><span>Доход в месяц</span><span></span></li>
        </ul>
      </div>
    </div>
  <?php
  }

  function UploadProductsImg()
  {
    global $modx;
    global $table_prefix;
    include "templates/fncUploadProductsImg.php";
  }

}

