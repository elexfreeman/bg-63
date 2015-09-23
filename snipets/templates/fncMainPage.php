<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 23.09.15
 * Time: 8:49
 */

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
                    <div class="item">
                        <img src="<?php echo "/UpLoad/" . $tv['id'] . "/0.jpg"; ?>" alt="">
                    </div>
                    <div class="item"></div>
                </div>
            </div>

            <div class="product_buy_info" style="display:none">
                <i class="product-icons product-icons-flag"></i> Срочная продажа
            </div>

            <div class="product_buy_buttons">
                <ul class="product_buy_buttons_list" id="product_id_<?php echo $product['id']; ?>">
                    <li
                    <li onclick="ProductDescription(<?php echo $product['uri']; ?>);">
                        <a href="<?php echo $product['uri']; ?>">
                            <i class="product-icons product-icons-list"></i><span>Подробнее</span></a>
                    </li>

                    <li onclick="AddToCard(<?php echo $product['id']; ?>); $('#mess_portfel').arcticmodal(); setTimeout(function () {      $('#mess_portfel').arcticmodal('close');}, 1000);">
                        <i class="product-icons product-icons-bag"></i><span>В портфель</span></li>
                    <li onclick="jQuery('#mess_potorg').arcticmodal()">
                        <i class="product-icons product-icons-money"></i><span>Поторговаться</span></li>
                    <li>
                        <a href="<?php echo $product['uri']; ?>#print">
                            <i class="product-icons product-icons-printer"></i><span>Распечатать</span></a>
                    </li>
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
