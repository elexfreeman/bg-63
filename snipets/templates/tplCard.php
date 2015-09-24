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
            <p class="title">Портфель объектов</p>

            <p class="cart_info"><span onclick="window.print();" class="cart_print"><i class="cart-list-icons cart-list-icons-print"></i> Распечатать список объектов</span> <span><i class="cart-list-icons cart-list-icons-send"></i> Отправить на почту</span></p>
			<a class="border_button" href="/korzina-tovarov#form_zayav">Оформить заявку</a>

           <!--  <p class="sub_title">Срочная продажа</p> -->

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
                                $product=$this->GetProductInfo($product_id);

                               /* echo "<pre>";
                                print_r($product);
                                echo "</pre>";*/
                                ?>
                <div class="cart_product_row">
                                <div>
                                    <img src="<?php echo $product->tv['photo1']; ?>" alt="">
                                </div>

                                <div>
                                    <?php echo $product->title; ?>
                                    <br>ID <?php echo $product->id; ?>
                                </div>

                                <div>
                                    <?php echo $product->tv['mestopolojenie']; ?>
                                </div>

                                <div>
                                    <?php echo $product->tv['nedvijimost']; ?>
                                    <!-- S=33 кв. м. В аренде, 37 000 руб/мес. -->
                                </div>

                                <div>
                                    <span class="price"><?php echo $product->tv['stoimost']; ?> <?php echo $product->tv['razm_stoimosti']; ?></span>
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

<div id="form_zayav"></div>
<p class="cart_info"><span onclick="window.print();" class="cart_print"><i class="cart-list-icons cart-list-icons-print"></i> Распечатать список объектов</span> <span><i class="cart-list-icons cart-list-icons-send"></i> Отправить на почту</span></p>

<p style="    font-size: 48px; margin-bottom: 20px; font-family: 'Panton-Light', Arial, Helvetica, sans-serif; text-transform: uppercase; color: #00c0f2;">Оформить заявку</p>

<div class="cart_obr_sviaz">
	<input type="text" name="obr_sviaz_name" placeholder="Имя" required><br>
	<input type="text" name="obr_sviaz_phone" placeholder="Телефон" required><br>
	<input type="submit" value="Отправить">
</div>
