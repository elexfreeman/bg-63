<div class="filter_nav_wrap">
    <div class="filter_nav">
        <div class="active_nav">Продажа (1231)</div>

        <div class="hidden-xs">Срочная продажа (765)</div>

        <div>Покупка (765)</div>

        <div class="hidden-xs">Аренда (250)</div>

        <div class="hidden-xs">Продано! (789)</div>
    </div>

    <div class="filter_nav_close hidden-xs">
        <i class="filter-icons filter-icons-hide"></i>
    </div>
</div>

<div class="filter_tab">
    <div class="active_tab">
        <div class="filter_content">

            <form id="filter_form">
                [[$search]]
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
                        <p>Выберите количество вложений</p>

                        <div class="slider_line_wrap">
                            <span>1000 000</span> <span class="slider_line_2"></span> <span>10 000 000</span>
                            <input class="input_slider_line_2" value="" hidden>
                            <input class="input_slider_line_4" value="" hidden>
                        </div>
                    </div>

                    <div>
                        <p>Выберите срок окупаемости</p>

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

                    <ul class="trend_list">
                        <li>Магазины непродовольственных товаров</li>
                        <li>Строительство</li>
                        <li>Магазины продовольственных товаров</li>
                        <li>Павильоны, киоски</li>
                        <li>Сельское хозяйство</li>
                        <li>Гостиницы, турбазы, отели</li>
                        <li>Еще 20 направлений</li>
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
                                <ul style="margin-left: 0; margin-top: 20px;" class="trend_list">
                                    <li>Магазины непродовольственных товаров</li>
                                    <li>Строительство</li>
                                    <li>Магазины продовольственных товаров</li>
                                    <li>Павильоны, киоски</li>
                                    <li>Сельское хозяйство</li>
                                    <li>Гостиницы, турбазы, отели</li>
                                    <li>Еще 20 направлений</li>
                                </ul>
                            </div>

                        </div>
                        <div>
                            <div class="filter_trend hidden-xs">
                                <ul style="margin-left: 0; margin-top: 20px;" class="trend_list">
                                    <li>Магазины непродовольственных товаров</li>
                                    <li>Строительство</li>
                                    <li>Магазины продовольственных товаров</li>
                                    <li>Павильоны, киоски</li>
                                    <li>Сельское хозяйство</li>
                                    <li>Гостиницы, турбазы, отели</li>
                                    <li>Еще 20 направлений</li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="filter_trend hidden-xs">
                                <ul style="margin-left: 0; margin-top: 20px;" class="trend_list">
                                    <li>Магазины непродовольственных товаров</li>
                                    <li>Строительство</li>
                                    <li>Магазины продовольственных товаров</li>
                                    <li>Павильоны, киоски</li>
                                    <li>Сельское хозяйство</li>
                                    <li>Гостиницы, турбазы, отели</li>
                                    <li>Еще 20 направлений</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>

    <div>
        <div class="filter_content">
            В разработке
        </div>
    </div>

    <div>
        <div class="filter_content">
            В разработке
        </div>
    </div>

    <div>
        <div class="filter_content">
            В разработке
        </div>
    </div>

    <div>
        <div class="filter_content">
            В разработке
        </div>
    </div>

    <div>
        <div class="filter_content">
            В разработке
        </div>
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
            min: 1000000,
            max: 10000000,
            values: [1000000, 8000000],
            step: 500000,
            range: true,
            create: function (event, ui_2) {
                val_2 = $('.slider_line_2').slider('value');
                $('.slider_line_2 .ui-slider-handle').attr('data-hint', val_2);
                $('.input_slider_line_2').attr('value', val_2);
                $('.input_slider_line_4').attr('value', val_2);
            },
            slide: function (event, ui_2) {
                $('.slider_line_2 .ui-slider-handle').attr('data-hint', ui_2.values);
                $('.input_slider_line_2').attr('value', ui_2.values);
                $('.input_slider_line_4').attr('value', ui_2.values);
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