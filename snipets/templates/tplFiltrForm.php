<div id="emptyProduct">
  <div class="product_item">
    <div class="product-border">
      <img class="preloader" src="loader.GIF">
    </div>
  </div>
</div>

<div class="filter_nav_wrap">
  <div class="filter_nav">
    <div class="active_nav" onclick="$('.product_list').html('');GetProductList(0,12,$('#parent').text())">Продажа (<?php echo $this->GetSaleCount(); ?>)</div>

    <div class="hidden-xs" onclick="GetSrochList(0,30,$('#parent').text())">Срочная продажа (<?php echo $this->GetFastSaleCount(); ?>)</div>

    <div onclick="getBuyList()">Покупка (<?php echo $this->GetBuyCount(); ?>)</div>

    <!--        <div class="hidden-xs">Аренда (250)</div>-->

    <div class="hidden-xs" onclick="GetProdanoList(0,12,$('#parent').text())">Продано! (<?php echo $this->GetSaleDoneCount(); ?>)</div>
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
      <input type="text" name="search" id="nameid" value="" placeholder="Введите ID или название объекта">

      <button type="submit" class="search_button" value="" onclick="return nameIdSearch();"><i class="filter-icons filter-icons-search"></i></button>
    </div>
  </div>
</div>
<div class="visible-xs napBisnes">
  <select name="bisnes" id="bisnes" title="Выберите направление бизнеса">
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
      <span>0</span><span class="slider_line_1"></span><span>1 000 0000</span>
      <input class="input_slider_line_1" value="0" hidden>
      <input class="input_slider_line_5" value="10000000" hidden/>
    </div>
  </div>

  <div>
    <p>Выберите количество вложений (руб)</p>

    <div class="slider_line_wrap">
      <span>0</span> <span class="slider_line_2"></span> <span>10 000 0000</span>
      <input class="input_slider_line_2" value="0" hidden>
      <input class="input_slider_line_4" value="100000000" hidden>
    </div>
  </div>

  <div>
    <p>Выберите срок окупаемости (мес)</p>

    <div class="slider_line_wrap">
      <span>0</span> <span class="slider_line_3"></span> <span>120</span>
      <input class="input_slider_line_3" value="" hidden>
      <input class="input_slider_line_6" value="" hidden/>
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
    $spheres = $this->SphereListElements();
    $kk = 0;
    foreach ($spheres as $sphere) {
      if ($kk < 6) {
        echo "<li class='sphere'>" . $sphere . "</li>";
      }
      else {
        echo "<li class='sphere' style='display:none'>" . $sphere . "</li>";
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
                    <li class="district">Волжский</li>
                    <li class="district">Железнодорожный</li>
                    <li class="district">Кировский</li>
                    <li class="district">Красноглинский</li>
                    <li class="district">Куйбышевский</li>
                    <li class="district">Ленинский</li>
                    <li class="district">Октябрьский</li>
                    <li class="district">Промышленный</li>
                    <li class="district">Самарский</li>
                    <li class="district">Советский</li>

                </ul>
            </div>

        </div>
        <div>
            <div class="filter_trend hidden-xs">
                <!--Тольяти-->
                <ul style="margin-left: 0; margin-top: 20px;" class="trend_list" id="r-toglaty">
                    <li class="district">Автозаводской</li>
                    <li class="district">Комсомольский</li>
                    <li class="district">Ставропольский</li>
                    <li class="district">Центральный</li>
                </ul>
            </div>
        </div>
        <div>
            <div class="filter_trend hidden-xs">
                <!--Прочее-->
                <ul style="margin-left: 0; margin-top: 20px;" class="trend_list" id="r-diff">
                    <li class="district">п.Воскресенка</li>
                    <li class="district">с.Старый Аманак</li>
                    <li class="district">Самарская область, Алексеевский район</li>
                    <li class="district">Самарская область, Безенчукский район</li>
                    <li class="district">Самарская область, Богатовский район</li>
                    <li class="district">Самарская область, Большеглушицкий район</li>
                    <li class="district">Самарская область, Большечерниговский район</li>
                    <li class="district">Самарская область, Борский район</li>
                    <li class="district">Самарская область, г. Жигулевск</li>
                    <li class="district">Самарская область, г. Кинель</li>
                    <li class="district">Самарская область, г. Новокуйбышевск</li>
                    <li class="district">Самарская область, г. Отрадный</li>
                    <li class="district">Самарская область, г. Сызрань</li>
                    <li class="district">Самарская область, г. Чапаевск</li>
                    <li class="district">Самарская область, Елховский район</li>
                    <li class="district">Самарская область, Камышлинский район</li>
                    <li class="district">Самарская область, Кинель-Черкасский район</li>
                    <li class="district">Самарская область, Кинельский район</li>
                    <li class="district">Самарская область, Клявлинский район</li>
                    <li class="district">Самарская область, Кошкинский район</li>
                    <li class="district">Самарская область, Красноармейский район</li>
                    <li class="district">Самарская область, Красноярский район</li>
                    <li class="district">Самарская область, Нефтегорский район</li>
                    <li class="district">Самарская область, п.Яицкое</li>
                    <li class="district">Самарская область, Пестравский район</li>
                    <li class="district">Самарская область, Похвистневский район</li>
                    <li class="district">Самарская область, Приволжский район</li>
                    <li class="district">Самарская область, Сергиевский район</li>
                    <li class="district">Самарская область, Ставропольский район</li>
                    <li class="district">Самарская область, Сызранский район</li>
                    <li class="district">Самарская область, Хворостянский район</li>
                    <li class="district">Самарская область, Шенталинский район</li>
                    <li class="district">Самарская область, Шигонский район</li>
                    <li class="district">г. Волгоград</li>
                    <li class="district">г. Димитровград</li>
                    <li class="district">г. Липецк</li>
                    <li class="district">г. Москва</li>
                    <li class="district">г. Набережные Челны</li>
                    <li class="district">г. Орск</li>
                    <li class="district">г. Сочи</li>
                    <li class="district">г. Ульяновск</li>
                    <li class="district">Ижевская область</li>
                    <li class="district">Краснодарский край, г. Геленджик</li>
                    <li class="district">Краснодарский край, Туапсинский район</li>
                    <li class="district">Оренбургская область</li>
                    <li class="district">Пензенская область</li>
                    <li class="district">Республика Башкортостан</li>
                    <li class="district">Саратовская область</li>
                    <li class="district">Татарстан, г. Нурлат</li>
                    <li class="district">Удмуртская область</li>
                    <li class="district">Ульяновская область</li>
                    <li class="district">Чувашская республика</li>

                </ul>
            </div>
        </div>
    </div>

  <button class="button-search" onclick="Search();" type="button">Поиск</button>

</div>

</form>
</div>
</div>

<div></div>

<div></div>

<div></div>

<div></div>
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
    $slider_1 = $(".slider_line_1");
    $slider_1.slider({
      min: 0,
      max: 10000000,
      values: [0, 10000000],
      step: 1000,
      range: true,
      create: function (event, ui) {
        val_1 = $slider_1.slider('value');
        $slider_1.find(".ui-slider-handle:first").attr('data-hint', '');
        $slider_1.find(".ui-slider-handle:last").attr('data-hint', '');
        $('.input_slider_line_1').attr('value', '');
        $('.input_slider_line_5').attr('value', '');
      },
      slide: function (event, ui) {
        $('.input_slider_line').attr('value', ui.value);

        $slider_1.find(".ui-slider-handle:first").attr('data-hint', $slider_1.slider("values", 0));
        $slider_1.find(".ui-slider-handle:last").attr('data-hint', $slider_1.slider("values", 1));
        $('.input_slider_line_1').attr('value', $slider_1.slider("values", 0));
        $('.input_slider_line_5').attr('value', $slider_1.slider("values", 1));
      },
      stop: function( event, ui ) {

        preSearch($(".slider_line_1"));

      }
    });


      //Вложения
      $('.slider_line_2').slider({
      min: 0,
      max: 100000000,
      values: [0, 100000000],
      step: 500000,
      range: true,
      create: function (event, ui_2) {
        val_2 = $('.slider_line_2').slider('value');
        //$('.slider_line_2 .ui-slider-handle').attr('data-hint', val_2);
        $('.slider_line_2').find(".ui-slider-handle:first").attr('data-hint', '');
        $('.slider_line_2').find(".ui-slider-handle:last").attr('data-hint', '');
        $('.input_slider_line_2').attr('value', '');
        $('.input_slider_line_4').attr('value', '');
      },
      slide: function (event, ui_2) {
        //$('.slider_line_2 .ui-slider-handle').attr('data-hint', ui_2.values);
        //$('.input_slider_line_2').attr('value', ui_2.values);
        //$('.input_slider_line_4').attr('value', ui_2.values);siblings()
        $('.slider_line_2').find(".ui-slider-handle:first").attr('data-hint', $(".slider_line_2").slider("values", 0));
        $('.slider_line_2').find(".ui-slider-handle:last").attr('data-hint', $(".slider_line_2").slider("values", 1));
        $('.input_slider_line_2').attr('value', $(".slider_line_2").slider("values", 0));
        $('.input_slider_line_4').attr('value', $(".slider_line_2").slider("values", 1));
      },
        stop: function (event, ui_2) {

          preSearch($('.slider_line_2'));

        }
    });
    $slider_3 = $('.slider_line_3');
    $slider_3.slider({
      min: 0,
      max: 120,
      values: [0, 120],
      step: 1,
      range: true,
      create: function (event, ui_3) {
        val_3 = $slider_3.slider('value');
        $slider_3.find(".ui-slider-handle:first").attr('data-hint', '');
        $slider_3.find(".ui-slider-handle:last").attr('data-hint', '');
        $('.input_slider_line_3').attr('value', '');
        $('.input_slider_line_6').attr('value', '');
      },
      slide: function (event, ui_3) {
        $slider_3.find(".ui-slider-handle:first").attr('data-hint', $slider_3.slider("values", 0));
        $slider_3.find(".ui-slider-handle:last").attr('data-hint', $slider_3.slider("values", 1));
        $('.input_slider_line_3').attr('value', $slider_3.slider("values", 0));
        $('.input_slider_line_6').attr('value', $slider_3.slider("values", 1));
      },
      stop: function (event,ui_3) {

        preSearch($('.slider_line_3'));

      }
    });
    $('.ui-slider-handle').addClass('hint-bottom-s-small');

    /* Выбор направлений */
    $('.trend_list li').click(function () {
      $(this).toggleClass('active');
      preSearch($(this));
    });
  });
</script>