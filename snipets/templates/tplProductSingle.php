<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 23.09.15
 * Time: 9:15
 */

$product = $this->GetProductInfo($product_id);
echo "<pre style='display: none'>";
print_r($product);
echo "</pre>";

?>

  <div class="product_item">
    <a href="<?php $product->url; ?>">
      <div class="product_title">
        <?php echo $product->title; ?>
        <span>id <?php echo $product->tv['id']; ?></span>
      </div>
    </a>
    <div class="product_img" title="<?php echo $product->url ?>" onmouseover="Show(this)">
      <div class="product_img_list">
<!--        <div class="product_img_list_layer"></div>-->
        <div class="prevSlider">
          <?php
          $image = $this->GetProductInfo($product->id);
          for ($i = 1; $i < 6; $i = $i + 1) {
            if (isset($image->tv['photo' . $i]) and (!empty($image->tv['photo' . $i]))) {
              ?>
              <div class="item">
                <img src="/images/<?php echo $image->tv['photo' . $i]; ?>" alt="">
              </div>
            <?php
            } elseif (!isset($image->tv['photo1'])){
              ?>
              <div class="item">
                <img src="/images/default3.png" alt="">
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

      <div class="product_buy_info" <?php if(!$product->tv['fastsale']==1) echo 'style="display:none"' ?>>
        <i class="product-icons product-icons-flag"></i> Срочная продажа
      </div>

      <div class="product_buy_buttons" onmouseout="ShowMenu(this)" onmouseover="HideMenu(this)">
        <ul class="product_buy_buttons_list" id="product_id_<?php echo $product->id; ?>">
          <!--<li onclick1="ProductDescription('<?php /*echo $product['uri']; */?>');">
            <a href="<?php /*echo $product['uri']; */?>">
              <i class="product-icons product-icons-list"></i><span>Подробнее</span></a>
          </li>-->
          <li class="add_to_portfel" onclick="AddToCard(<?php echo $product->id; ?>); jQuery('#mess_portfel').arcticmodal(); setTimeout(function () {      $('#mess_portfel').arcticmodal('close');      }, 1000);">
            <i class="product-icons product-icons-bag"></i><span>В портфель</span></li>
          <li onclick="jQuery('#mess_potorg').arcticmodal();">
            <i class="product-icons product-icons-money"></i><span>Поторговаться</span></li>
          <li>
            <a href="<?php echo $product->url; ?>#print">
              <i class="product-icons product-icons-printer"></i><span>Распечатать</span></a>
          </li>
        </ul>
      </div>
    </div>

    <div class="product_info">
      <ul class="product_info_list">

        <li onmouseenter="ShowInfo(this)" onmouseleave="HideInfo(this)"><span>Расположение</span><span><?php echo $product->tv['mestopolojenie']; ?></span></li>
        <li>
          <span>Стоимость</span><span><?php echo number_format(($product->tv['stoimost']+0), 0, ',', ' ') . " " . $product->tv['razm_stoimosti']; ?></span>
        </li>
        <li><span>Окупаемость</span><span><?php if(isset($tv['okypaemost']) and (!empty($tv['okypaemost']))){echo $tv['okypaemost'];} else{echo "По запросу";} ?></span></li>
        <li><span>Доход в месяц</span><span>По запросу</span></li>
      </ul>
    </div>
  </div>
<?php