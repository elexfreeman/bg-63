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

    $start = $_GET['start'] + 0;
    $count = $_GET['count'] + 0;
    $sql = 'select

(select count(*) n from bg63_site_content cc1
join  bg63_site_tmplvar_contentvalues cv
                        on cv.contentid=cc1.id

                        JOIN bg63_site_tmplvars tv ON tv.id=cv.tmplvarid



                        where (cc1.template=2)and(tv.name="prodano") ) nn,

                         content.*
                        from bg63_site_content content
                        join  bg63_site_tmplvar_contentvalues cv
                        on cv.contentid=content.id

                        JOIN bg63_site_tmplvars tv ON tv.id=cv.tmplvarid



                        where (content.template=2)and(tv.name="prodano")

                        limit ' . $start . ', ' . $count . '
        ';

    // echo $sql."<br>";
    //"/bmanager/UpLoad/$id/$FotoNum.jpg";
    foreach ($modx->query($sql) as $product) {

      $sql_tv = "select
                    tv.name,tv.caption,
                    cv.value

                     from bg63_site_tmplvar_contentvalues cv

                    join bg63_site_tmplvars tv
                    on tv.id=cv.tmplvarid

                    where cv.contentid = " . $product['id'];
      //переворачиваем таблицу бляять
      foreach ($modx->query($sql_tv) as $product_tv) {

        $tv[$product_tv['name']] = $product_tv['value'];
      }
      ?>

      <div class="product_item">
        <div class="product_title">
          <?php echo $product['pagetitle']; ?>
          <span>id <?php echo $tv['id']; ?></span>
        </div>
        <div class="product_img">
          <div class="product_img_list">
            <div class="product_img_list_layer"></div>
            <div class="prevSlider">
              <div class="item"></div>
              <div class="item"><img src="<?php echo "/UpLoad/" . $tv['id'] . "/0.jpg"; ?>" alt=""></div>
              <div class="item"></div>
            </div>
          </div>

          <div class="product_buy_info" style="display:none">
            <i class="product-icons product-icons-flag"></i> Срочная продажа
          </div>

          <div class="product_buy_buttons">
            <ul class="product_buy_buttons_list" id="product_id_<?php echo $product['id']; ?>">
              <li onclick="ProductDescription(<?php echo $product['uri']; ?>);">
                <i class="product-icons product-icons-list"></i><span>Подробнее</span>
              </li>
              <li onclick="AddToCard(<?php echo $product['id']; ?>);"><i class="product-icons product-icons-bag"></i><span>В портфель</span></li>
              <li><i class="product-icons product-icons-money"></i><span>Поторговаться</span></li>
              <li><i class="product-icons product-icons-printer"></i><span>Распечатать</span></li>
            </ul>
          </div>
        </div>

        <div class="product_info">
          <ul class="product_info_list">

            <li><span>Расположение</span><span><?php echo $tv['mestopolojenie']; ?></span></li>
            <li><span>Стоимость</span><span><?php echo $tv['stoimost'] . " " . $tv['razm_stoimosti']; ?></span></li>
            <li><span>Окупаемость</span><span><?php echo $tv['okypaemost']; ?></span></li>
            <li><span>Доход в месяц</span><span></span></li>
          </ul>
        </div>
      </div>

    <?php
    }

    $start = $start + $count;

    if (($start) < ($product['nn'])) {
      ?>
      <div class="product_list_all" onclick="GetProductList(<?php echo($start); ?>,<?php echo $count; ?>)">
        <i class="product-icons product-icons-all"></i> Показать еще
      </div>
    <?php
    }


  }


    function AddToCard($product_id,$count=1)
    {
        global $modx;
        if(isset($_SESSION['product_'.$_GET['product_id']]))
        {
            unset($_SESSION['product_'.$_GET['product_id']]);
            echo   json_encode(array("status"=>"0","count"=>$this->GetCardCountProduct(),"panel_text"=> $this->Panel_GetCardCount())); //удалили из корзины

        }
        else
        {
            $_SESSION['product_'.$_GET['product_id']]=mysql_escape_string($_GET['product_count']);
            echo   json_encode(array("status"=>"1","count"=>$this->GetCardCountProduct(),"panel_text"=> $this->Panel_GetCardCount())); //добавили
        }
    }

    //возвращает кол-во продуктов в корзине
    function GetCardCountProduct()
    {
        $cc=0;
        foreach($_SESSION as $key=>$value)
        {
            if(substr($key,0,3)=='pro') $cc=$cc+$value;
            //echo $key." ".$value." ".substr($key,0,3);


        }
        return $cc;
    }

    //Колл-во продуктов в корзине
    function Panel_GetCardCount()
    {
        $count=$this->GetCardCountProduct();
        if($count==0)
        {
            $count='Пусто';
        }
        elseif($count==1)
        {
            $count='У Вас 2 объект';
        }
        elseif(($count==2)or($count==3)or($count==4))
        {
            $count='У Вас '.$count.' объекта';
        }
        else $count='У Вас '.$count.' объектов';

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
        if($scriptProperties['action']=='Panel_GetCardCount')
        {
           echo $this->Panel_GetCardCount();
        }
        elseif($scriptProperties['action']=='ShowCard')
        {
            $this->ShowCard();
        }

    }
}

