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
                        <img src="<?php echo "/images/" . $product->tv['photo1']; ?>" alt="">
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