<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 23.09.15
 * Time: 8:49
 */


$vid_name = mysql_escape_string($_GET['parent']);
$start = $_GET['start'] + 0;
$count = $_GET['count'] + 0;

$sort=explode("-",mysql_escape_string($_GET['sort']));
//print_r($sort);

$sort_d=$sort[1];
$sort=$sort[0];

$sql_sort="order by ".$sort." ".$sort_d;

if(!empty($vid_name))
{
    $sql_having=" having vid_name like '%".$vid_name."%'";
}


/*-- ----------------------------------

select * from
-- 			okypaemost -------------
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
) a
-- ----------------------------------
join
(
select
    tv.name okypaemost_title,
    cv.value okypaemost,
    cv.contentid okypaemost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='okypaemost'
) b

on b.okypaemost_content=a.stoimost_content
-- ----------------------------------

-- ----------------------------------
join
(
select
    tv.name vid_name_title,
    cv.value vid_name,
    cv.contentid vid_name_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='vid_name'
) c

on c.vid_name_content=a.stoimost_content
-- ----------------------------------


-- ----------------------------------
join
(
select
    tv.name fastsale_title,
    cv.value fastsale,
    cv.contentid fastsale_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='fastsale'
) d

on d.fastsale_content=a.stoimost_content
-- ----------------------------------
order by stoimost+0,vid_name*/

/*

$sql = 'select
    (select count(*) n from bg63_site_content cc1
    join  bg63_site_tmplvar_contentvalues cv
    on cv.contentid=cc1.id
    JOIN bg63_site_tmplvars tv
    ON tv.id=cv.tmplvarid
    where (cc1.template=2)and(cv.value LIKE "%' . $parent . '%")) nn, content.* from bg63_site_content content
    join  bg63_site_tmplvar_contentvalues cv
    on cv.contentid=content.id
    JOIN bg63_site_tmplvars tv
    ON tv.id=cv.tmplvarid
  --  join bg63_site_tmplvar_contentvalues cv1 on cv1.contentid=content.id
    where (content.template=2)and(cv.value like "%' . $parent . '%")
                        limit ' . $start . ', ' . $count;

*/

$sql="select * from
-- 			okypaemost -------------
(

-- 			stoimost -------------
select
    tv.name stoimost_title,
    cv.value stoimost,
    cv.contentid stoimost_content,
    cv.contentid id

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='stoimost'
) a
-- ----------------------------------
join
(
select
    tv.name okypaemost_title,
    cv.value okypaemost,
    cv.contentid okypaemost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='okypaemost'
) b

on b.okypaemost_content=a.stoimost_content
-- ----------------------------------

-- ----------------------------------
join
(
select
    tv.name vid_name_title,
    cv.value vid_name,
    cv.contentid vid_name_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='vid_name'
) c

on c.vid_name_content=a.stoimost_content
-- ----------------------------------


-- ----------------------------------
join
(
select
    tv.name fastsale_title,
    cv.value fastsale,
    cv.contentid fastsale_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='fastsale'
) d

on d.fastsale_content=a.stoimost_content
-- ----------------------------------
".$sql_having."
order by stoimost+0,vid_name
 limit " . $start . " ,  ". $count;


$sql_from=" from
-- 			okypaemost -------------
(

-- 			stoimost -------------
select
    tv.name stoimost_title,
    cv.value stoimost,
    cv.contentid stoimost_content,
    cv.contentid id

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='stoimost'
) a
-- ----------------------------------
join
(
select
    tv.name okypaemost_title,
    cv.value okypaemost,
    cv.contentid okypaemost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='okypaemost'
) b

on b.okypaemost_content=a.stoimost_content
-- ----------------------------------

-- ----------------------------------
join
(
select
    tv.name vid_name_title,
    cv.value vid_name,
    cv.contentid vid_name_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='vid_name'
) c

on c.vid_name_content=a.stoimost_content
-- ----------------------------------


-- ----------------------------------
join
(
select
    tv.name fastsale_title,
    cv.value fastsale,
    cv.contentid fastsale_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='fastsale'
) d

on d.fastsale_content=a.stoimost_content
-- ----------------------------------
".$sql_having."
".$sql_sort;

$sql="select * ".$sql_from." limit " . $start . " ,  ". $count;

$sql_count="select count(*) from (select * ".$sql_from.") cc";

$row_count=0;
foreach ($modx->query($sql_count) as $row) {
    $row_count=$row['nn'];
}


//echo $sql_count;




//"/bmanager/UpLoad/$id/$FotoNum.jpg";
$query=$modx->query($sql);
$num_rows = $modx->getCount('modResource', $query);

echo "<pre style='display:none'>";
echo $sql;
echo "</pre>";

foreach ($query as $product) {


    $product=$this->GetProductInfo($product['id']);
  ?>

  <div class="product_item">
    <a href="<?php echo $product->url; ?>#content">
      <div class="product_title" onmouseenter="ShowTitle(this)" onmouseleave="HideTitle(this)">
        <p><?php echo $product->title; ?></p>
        <span>id <?php echo $product->tv['inner_id']; ?></span>
      </div>
    </a>
    <div class="product_img" title="<?php echo $product->url; ?>" onmouseover="Show(this)">
      <div class="product_img_list">
<!--        <div class="product_img_list_layer"></div>-->
        <div class="prevSlider">
          <?php

          for ($i = 1; $i < 6; $i = $i + 1) {
            if (isset($image->tv['photo' . $i]) and (!empty($product->tv['photo' . $i]))) {
              ?>
              <div class="item">
                <img src="/images/<?php echo $product->tv['photo' . $i]; ?>" alt="">
              </div>
            <?php
            }
            elseif (!isset($product->tv['photo1'])) {
              ?>
              <div class="item">
                <img src="/images/default3.png" alt="" style="width: 100% !important;">
              </div>
              <?php
              break;
            }
            else {
              break;
            }
          }
          ?>
        </div>
      </div>

      <div class="product_buy_info" <?php if (!$product->tv['fastsale'] == 1) echo 'style="display:none"' ?>>
        <i class="product-icons product-icons-flag"></i> Срочная продажа
      </div>

      <div class="product_buy_buttons" onmouseout="ShowMenu(this)" onmouseover="HideMenu(this)">
        <ul class="product_buy_buttons_list" id="product_id_<?php echo $product->id; ?>">
          <!--<li onclick1="ProductDescription('<?php /*echo $product['uri']; */ ?>');">
            <a href="<?php /*echo $product['uri']; */ ?>">
              <i class="product-icons product-icons-list"></i><span>Подробнее</span></a>
          </li>-->
          <li class="add_to_portfel" onclick="AddToCard(<?php echo $product->id; ?>); jQuery('#mess_portfel').arcticmodal(); setTimeout(function () {      $('#mess_portfel').arcticmodal('close');      }, 1000);">
            <i class="product-icons product-icons-bag"></i><span>В портфель</span></li>
          <li onclick="jQuery('#mess_potorg').arcticmodal();">
            <i class="product-icons product-icons-money"></i><span>Поторговаться</span></li>
          <li>
            <a href="<?php echo $product->uri; ?>#print">
              <i class="product-icons product-icons-printer"></i><span>Распечатать</span></a>
          </li>
        </ul>
      </div>
    </div>

    <div class="product_info">
      <ul class="product_info_list">

        <li onmouseenter="ShowInfo(this)" onmouseleave="HideInfo(this)">
          <span>Расположение</span><span><?php echo $product->tv['mestopolojenie']; ?></span></li>
        <li>
          <span>Стоимость</span><span><?php echo number_format($product->tv['stoimost'], 0, ',', ' ') . " " . $product->tv['razm_stoimosti']; ?></span>
        </li>
        <li><span>Окупаемость</span><span><?php if(isset($product->tv['okypaemost']) and (!empty($product->tv['okypaemost']))){echo $product->tv['okypaemost'];} else{echo "По запросу";} ?></span></li>
        <!--todo: когда будет выгрузка добавить поле для дохода в месяц-->
        <li><span>Доход в месяц</span><span>По запросу</span></li>
      </ul>
    </div>
  </div>

<?php
}

$start = $start + $count;

if (($start) < ($row_count)) {
  ?>
  <div class="product_list_all" onclick="GetProductList(<?php echo($start); ?>,<?php echo $count; ?>,'<?php echo $vid_name; ?>','<?php echo $_GET['sort']; ?>')">
    <i class="product-icons product-icons-all"></i> Показать еще
  </div>
<?php
}