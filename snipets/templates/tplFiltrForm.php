<div id="emptyProduct">
    <div class="product_item">
        <div class="product-border">
            <img class="preloader" src="loader.GIF">
        </div>
    </div>
</div>

<div class="filter_nav_wrap">
    <div class="filter_nav">
        <div class="active_nav" onclick="$('.product_list').html('');GetProductList(0,12,$('#parent').text())">Продажа (<?php echo $this->GetSaleCount();?>)</div>

        <div class="hidden-xs" onclick="GetSrochList(0,30,$('#parent').text())">Срочная продажа (<?php echo $this->GetFastSaleCount(); ?>)</div>

        <div>Покупка </div>

<!--        <div class="hidden-xs">Аренда (250)</div>-->

        <div class="hidden-xs">Продано! (<?php echo $this->GetSaleDoneCount(); ?>) </div>
    </div>
</div>

<div class="filter_tab">
    <div class="active_tab">
	<div class="filter_nav_close hidden-xs">
        <span>Фильтр</span> <i class="filter-icons filter-icons-hide"></i>
    </div>
        <div class="filter_content">

            <form id="filter_form">
                <div class="search_wrap hidden-xs">
                    <div class="search">
                        <div id="search_form">
                            <input type="text" name="search" value="" placeholder="Введите ID или название объекта">

                            <button type="submit" class="search_button" value=""><i class="filter-icons filter-icons-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="visible-xs napBisnes">
                    <select name="bisnes" id="bisnes">
                        <option value="0">Выберите направления бизнеса</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="visible-xs priceBisnes">
                    <label for="ot">Цена: </label>
                    <input name="ot" id="ot" type="number" placeholder="От:" min="0"/>
                    <input name="do" id="do" type="number" placeholder="До:" min="0"/>
                </div>

                <div class="filter_money hidden-xs">

                    <div>
                        <p>Выберите доходность (мес)</p>

                        <div class="slider_line_wrap">
                            <span>20 000</span>
                            <div class="slider_line"></div>
                            <span>1 000 000</span>
                            <input class="input_slider_line" value="" hidden>
                        </div>
                    </div>

                    <div>
                        <p>Выберите количество вложений (руб)</p>

                        <div class="slider_line_wrap">
                            <span>1000 000</span> <span class="slider_line_2"></span> <span>10 000 000</span>
                            <input class="input_slider_line_2" value="1000000" hidden>
                            <input class="input_slider_line_4" value="10000000" hidden>
                        </div>
                    </div>

                    <div>
                        <p>Выберите срок окупаемости (мес)</p>

                        <div class="slider_line_wrap">
                            <span>3</span> <span class="slider_line_3"></span> <span>60</span>
                            <input class="input_slider_line_3" value="" hidden>
                        </div>
                    </div>
                </div>

                <div class="filter_object hidden-xs">

                    <div>
                        <input type="checkbox" class="object_checkbox" id="object_checkbox_3"/>
                        <label for="object_checkbox_3">объект участвует в аукционе</label>
                    </div>
                </div>


                <div class="filter_trend hidden-xs">
                    <p class="title">Какие направления Вас интересуют?</p>

                    <ul class="trend_list" id="trends">

                        <?php
                        $spheres=$this->SphereList();
                        $kk=0;
                        foreach($spheres as $sphere)
                        {
                            if($kk<6)
                            {
                                echo "<li class='sphere'>".$sphere."</li>";
                            }
                            else
                            {
                                echo "<li class='sphere' style='display:none'>".$sphere."</li>";
                            }

                            $kk++;
                        }
                        ?>


                        <li class="sphereAll" onclick="$('.sphere').fadeIn('slow');$('.sphereAll').fadeOut('slow');">Остальные направления</li>
                    </ul>
                </div>

                <div class="filter_trend hidden-xs">
                    <p class="title">Какие районы Вас интересуют?</p>

                    <div class="filter_rayon_nav">

                        <div class="active_nav">Самара</div>

                        <div class="hidden-xs">Тольятти</div>

                        <div>Прочие</div>

                    </div>

                    <div class="filter_rayon_tab">
                        <div class="active_tab">

                            <div class="filter_trend hidden-xs">
                                <!--Самара-->
                                <ul style="margin-left: 0; margin-top: 20px;" class="trend_list" id="r-samara">
                                   <li>Волжский</li>
                                   <li>Железнодорожный</li>
                                   <li>Кировский</li>
                                   <li>Красноглинский</li>
                                   <li>Куйбышевский</li>
                                   <li>Ленинский</li>
                                   <li>Октябрьский</li>
                                   <li>Промышленный</li>
                                   <li>Самарский</li>
                                   <li>Советский</li>

                                </ul>
                            </div>

                        </div>
                        <div>
                            <div class="filter_trend hidden-xs">
                                <!--Тольяти-->
                                <ul style="margin-left: 0; margin-top: 20px;" class="trend_list" id="r-toglaty">
                                    <li>Автозаводской</li>
                                    <li>Комсомольский</li>
                                    <li>Ставропольский</li>
                                    <li>Центральный</li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="filter_trend hidden-xs">
                                <!--Прочее-->
                                <ul style="margin-left: 0; margin-top: 20px;" class="trend_list" id="r-diff">
                                    <li>п.Воскресенка</li>
                                    <li>с.Старый Аманак</li>
                                    <li>Самарская область, Алексеевский район</li>
                                    <li>Самарская область, Безенчукский район</li>
                                    <li>Самарская область, Богатовский район</li>
                                    <li>Самарская область, Большеглушицкий район</li>
                                    <li>Самарская область, Большечерниговский район</li>
                                    <li>Самарская область, Борский район</li>
                                    <li>Самарская область, г. Жигулевск</li>
                                    <li>Самарская область, г. Кинель</li>
                                    <li>Самарская область, г. Новокуйбышевск</li>
                                    <li>Самарская область, г. Отрадный</li>
                                    <li>Самарская область, г. Сызрань</li>
                                    <li>Самарская область, г. Чапаевск</li>
                                    <li>Самарская область, Елховский район</li>
                                    <li>Самарская область, Камышлинский район</li>
                                    <li>Самарская область, Кинель-Черкасский район</li>
                                    <li>Самарская область, Кинельский район</li>
                                    <li>Самарская область, Клявлинский район</li>
                                    <li>Самарская область, Кошкинский район</li>
                                    <li>Самарская область, Красноармейский район</li>
                                    <li>Самарская область, Красноярский район</li>
                                    <li>Самарская область, Нефтегорский район</li>
                                    <li>Самарская область, п.Яицкое</li>
                                    <li>Самарская область, Пестравский район</li>
                                    <li>Самарская область, Похвистневский район</li>
                                    <li>Самарская область, Приволжский район</li>
                                    <li>Самарская область, Сергиевский район</li>
                                    <li>Самарская область, Ставропольский район</li>
                                    <li>Самарская область, Сызранский район</li>
                                    <li>Самарская область, Хворостянский район</li>
                                    <li>Самарская область, Шенталинский район</li>
                                    <li>Самарская область, Шигонский район</li>
                                    <li>г. Волгоград</li>
                                    <li>г. Димитровград</li>
                                    <li>г. Липецк</li>
                                    <li>г. Москва</li>
                                    <li>г. Набережные Челны</li>
                                    <li>г. Орск</li>
                                    <li>г. Сочи</li>
                                    <li>г. Ульяновск</li>
                                    <li>Ижевская область</li>
                                    <li>Краснодарский край, г. Геленджик</li>
                                    <li>Краснодарский край, Туапсинский район</li>
                                    <li>Оренбургская область</li>
                                    <li>Пензенская область</li>
                                    <li>Республика Башкортостан</li>
                                    <li>Саратовская область</li>
                                    <li>Татарстан, г. Нурлат</li>
                                    <li>Удмуртская область</li>
                                    <li>Ульяновская область</li>
                                    <li>Чувашская республика</li>

                                </ul>
                            </div>
                        </div>
                    </div>


                    <button class="button-search" onclick="Search();" type="button">Поиск</button>

                </div>

            </form>
        </div>
    </div>

    <div>
    </div>

    <div>
    </div>

    <div>
    </div>

    <div>
    </div>
</div>

<script>
    $(document).ready(function () {
        /* Табы */
        $('.filter_nav > div').each(function (j) {
            var index = j;
            $(this).click(function () {
                $(this).addClass('active_nav')
                    .siblings().removeClass('active_nav');

                $('.filter_tab > div:eq(' + index + ')').addClass('active_tab')
                    .siblings().removeClass('active_tab');
            });
        });

        $('.filter_rayon_nav > div').each(function (j) {
            var index = j;
            $(this).click(function () {
                $(this).addClass('active_nav')
                    .siblings().removeClass('active_nav');

                $('.filter_rayon_tab > div:eq(' + index + ')').addClass('active_tab')
                    .siblings().removeClass('active_tab');
            });
        });

        /* Скрываем фильтр */
        $('.filter_nav_close').click(function () {
            $('#filter_form').slideToggle();
        });

        /* Ползунки в фильтре */
        $('.slider_line').slider({
            min: 20000,
            max: 1000000,
            value: 20000,
            step: 10000,
            range: 'min',
            create: function (event, ui) {
                val = $('.slider_line').slider('value');
                $('.slider_line .ui-slider-handle').attr('data-hint', val);
                $('.input_slider_line').attr('value', val);
            },
            slide: function (event, ui) {
                $('.slider_line .ui-slider-handle').attr('data-hint', ui.value);
                $('.input_slider_line').attr('value', ui.value);
            },
        });
        $('.slider_line_2').slider({
            min: 100000,
            max: 10000000,
            values: [1000000, 8000000],
            step: 500000,
            range: true,
            create: function (event, ui_2) {
                val_2 = $('.slider_line_2').slider('value');
                //$('.slider_line_2 .ui-slider-handle').attr('data-hint', val_2);
                $('.slider_line_2').find(".ui-slider-handle:first").attr('data-hint',   100000 );
                $('.slider_line_2').find(".ui-slider-handle:last").attr('data-hint',  10000000 );
                $('.input_slider_line_2').attr('value', 100000);
                $('.input_slider_line_4').attr('value', 10000000);
            },
            slide: function (event, ui_2) {
                //$('.slider_line_2 .ui-slider-handle').attr('data-hint', ui_2.values);
                //$('.input_slider_line_2').attr('value', ui_2.values);
                //$('.input_slider_line_4').attr('value', ui_2.values);siblings()
                $('.slider_line_2').find(".ui-slider-handle:first").attr('data-hint',  $( ".slider_line_2" ).slider( "values", 0 ));
                $('.slider_line_2').find(".ui-slider-handle:last").attr('data-hint',  $( ".slider_line_2" ).slider( "values", 1 ));
                $('.input_slider_line_2').attr('value', $( ".slider_line_2" ).slider( "values", 0 ));
                $('.input_slider_line_4').attr('value',  $( ".slider_line_2" ).slider( "values", 1 ));
            },
        });
        $('.slider_line_3').slider({
            min: 3,
            max: 60,
            value: 3,
            step: 1,
            range: 'min',
            create: function (event, ui_3) {
                val_3 = $('.slider_line_3').slider('value');


                $('.slider_line_3 .ui-slider-handle').attr('data-hint', val_3);
                $('.input_slider_line_3').attr('value', val_3);
            },
            slide: function (event, ui_3) {
                $('.slider_line_3 .ui-slider-handle').attr('data-hint', ui_3.value);
                $('.input_slider_line_3').attr('value', ui_3.value);
            },
        });
        $('.ui-slider-handle').addClass('hint-bottom-s-small');

        /* Выбор направлений */
        $('.trend_list li').click(function () {
            $(this).toggleClass('active');
        });
    });
</script>