<?php

$cc=0;
foreach($_SESSION as $key=>$value)
{
    if(substr($key,0,3)=='pro') $cc=$cc+($value+0);
    //echo $key." ".$value." ".substr($key,0,3);
}
//если корзина не пустая
if($cc>0)
{
?>

    <div class="cart_wrap">
        <div class="cart">
            <p class="title">Корзина объектов</p>

            <p class="cart_info"><span><i class="cart-list-icons cart-list-icons-print"></i> Распечатать список объектов</span> <span><i class="cart-list-icons cart-list-icons-send"></i> Отправить на почту</span></p>

            <p class="sub_title">Срочная продажа</p>

            <div class="cart_product_list">
                <div class="cart_product_row">
                    <div style="text-align: center;">Фото</div>

                    <div>Наименование</div>

                    <div>Местоположение</div>

                    <div>Недвижимость</div>

                    <div>Стоимость</div>
                </div>



                    <?php
                    $summa=0;


                    /*получаем список товаров в корзине*/
                    foreach($_SESSION as $key1=>$value1)
                    {
                        if(substr($key1,0,3)=='pro')
                        {

                            $value1=$value1+0;
                            if($value1>0)
                            {
                                $kk=explode("_",$key1);
                                $product_id=$kk[1];
/*
                                $product=$products->GetProductInfo($product_id);
                                $price=$products->GetProductMainPrice($product_id);
                                //print_r($price);
                                //echo $key1." ".$sql."<br>";
                                ?>
                                <tr>
                                    <td><img src="<?php echo '/files/goods/'.$price->img1; ?>"></td>
                                    <td>Название букета “<?php echo $product->title; ?>”</td>
                                    <td><?php



                                        echo $price->price;
                                        $summa+=( $price->price*$value1);


                                        ?> руб.</td>
                                    <td><input type="text" value="<?php echo $value1;?>" id="product_count_<?php echo $product->id;; ?>"                                   onchange="CardProductChangeCount(<?php echo $row['id']; ?>);"
                                            ></td>
                                    <td><?php echo  $price->price*$value1;

                                        ?> руб.</td>
                                    <td><span class="card_product_delete_<?php echo $product->id;; ?>" onclick="CardProductDelete(<?php echo $product->id;; ?>);">
                                <img src="/site/tpl/img/cross.png"></span></td>
                                </tr>
                            <?php
                                */

                                ?>
                <div class="cart_product_row">
                                <div>
                                    <img src="/assets/tpl/img/cart_img_example.png" alt="">
                                </div>

                                <div>
                                    Свадебный салон
                                    <br>ID 2551
                                </div>

                                <div>
                                    Октябрьский район
                                </div>

                                <div>
                                    S=33 кв. м. В аренде, 37 000 руб/мес.
                                </div>

                                <div>
                                    <span class="price">1 750 000 руб.</span>
                                </div>
                </div>
                    <?php
                            }

                        }

                    }



                    ?>


            </div>
        </div>
    </div>
<?php

}
?>
