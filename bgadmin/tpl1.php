<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>admin-bg</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/admin-bg.css">
    <script type="text/javascript" src="js/modernizr-2.7.1.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/tpl/img/favicon.ico"/>
    <link rel="apple-touch-icon" href="/assets/tpl/img/favicon.ico">
</head>
<body>
<div class="w-container head-menu">
    <div class="w-row">
        <div class="w-col w-col-2 w-hidden-small w-hidden-tiny"></div>
        <div class="w-col w-col-5 w-hidden-small w-hidden-tiny"></div>
        <div class="w-col w-col-4 head-menu-row-username">
            <div class="head-menu-username">
                <div class="head-menu-username-text">Пользователь: <span
                        class="head-menu-username-name">Антон Помидоров</span></div>
            </div>
        </div>
        <div class="w-col w-col-1 head-menu-row-logout"><a class="logout a-link" href="#">ВЫХОД</a></div>
    </div>
</div>
<div class="w-container">
    <div class="w-row head-container">
        <div class="w-col w-col-1 w-clearfix"><img class="logo-img"
                                                   src="https://daks2k3a4ib2z.cloudfront.net/55e6ac31dd5145120d31de49/55e6acfdaeeb20146f5e799e_logo.png">
        </div>
        <div class="w-col w-col-3 w-clearfix"><p class="logo-text"><span class="logo-text-b">БИЗНЕС ГАРАНТ</span><br>МАГАЗИН
                ГОТОВОГО БИЗНЕСА</p></div>
        <div class="w-col w-col-4 head-center">
            <div class="div-button-active">
                <div class="div-button-text">продажа</div>
            </div>
        </div>
        <div class="w-col w-col-4 head-center">
            <div class="div-button">
                <div class="div-button-text">покупка</div>
            </div>
        </div>
    </div>
</div>
<div class="w-container body-container"><h1 class="main-container-h1">Список объектов на продажу</h1>

    <div class="w-row row-filter">
        <div class="w-col w-col-4 w-col-stack row-maanger"><p class="main-head-text">Менеджер: <br><span
                    class="manager-selected">Антон Помидоров +7-987-547-65-89</span></p>

            <div class="w-dropdown" data-delay="300">
                <div class="w-dropdown-toggle manager-list">
                    <div>Список менеджеров</div>
                    <div class="w-icon-dropdown-toggle"></div>
                </div>
                <nav class="w-dropdown-list"><a class="w-dropdown-link manager-list-item" href="#">Link 1</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 2</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 3</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 4</a></nav>
            </div>
        </div>
        <div class="w-col w-col-5 w-col-stack row-maanger"><p class="main-head-text">Сфера бизнеса: <br><span
                    class="manager-selected">Магазины непродовольственных товаров</span></p>

            <div class="w-dropdown" data-delay="300">
                <div class="w-dropdown-toggle manager-list">
                    <div>Список сфер</div>
                    <div class="w-icon-dropdown-toggle"></div>
                </div>
                <nav class="w-dropdown-list"><a class="w-dropdown-link manager-list-item" href="#">Link 1</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 2</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 3</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 4</a></nav>
            </div>
        </div>
        <div class="w-col w-col-3 w-col-stack">
            <div class="div-button button-add">
                <div class="div-button-text">добавить</div>
            </div>
        </div>
    </div>
</div>
<div class="w-container search">
    <div class="w-row">
        <div class="w-col w-col-6">
            <div class="w-form">
                <form id="email-form" name="email-form" data-name="Email Form"><label
                        for="search-text">Поиск</label><input class="w-input" id="search-text" type="text"
                                                              placeholder="Введите ключевую фразу" name="search-text"
                                                              data-name="search-text"><input
                        class="w-button button-search" type="submit" value="Найти" data-wait="Please wait..."></form>
                <div class="w-form-done"><p>Thank you! Your submission has been received!</p></div>
                <div class="w-form-fail"><p>Oops! Something went wrong while submitting the form</p></div>
            </div>
        </div>
        <div class="w-col w-col-6">
            <div class="w-form">
                <form id="email-form-2" name="email-form-2" data-name="Email Form 2"><label for="search-id">Поиск по
                        ID:</label><input class="w-input" id="search-id" type="text" placeholder="Введите ID записи"
                                          name="search-id" data-name="search-id"><input class="w-button button-search"
                                                                                        type="submit" value="Найти"
                                                                                        data-wait="Please wait...">
                </form>
                <div class="w-form-done"><p>Thank you! Your submission has been received!</p></div>
                <div class="w-form-fail"><p>Oops! Something went wrong while submitting the form</p></div>
            </div>
        </div>
    </div>
</div>
<div class="w-container action-list">
    <div class="w-row row-action">
        <div class="w-col w-col-6">
            <div class="w-dropdown" data-delay="300">
                <div class="w-dropdown-toggle manager-list">
                    <div>Действия с отмеченными записями</div>
                    <div class="w-icon-dropdown-toggle"></div>
                </div>
                <nav class="w-dropdown-list"><a class="w-dropdown-link manager-list-item" href="#">Link 1</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 2</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 3</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 4</a></nav>
            </div>
        </div>
        <div class="w-col w-col-6"></div>
    </div>
</div>
<div class="w-container data-container">
    <div class="w-embed">
        <table class="companyes">
            <tbody>
            <tr>
                <th><input type="checkbox" id="check_all" value=""></th>
                <th title="№">№</th>
                <th title="Название/Тип">Название/Тип</th>
                <th title="Категория">Категория</th>
                <th title="Срок">Срок</th>
                <th title="Цена, руб.">Цена</th>
                <th title="Менеджер">Менеджер</th>
                <th title="Действия">Действия</th>
                <th title="Приоритет">Приоритет</th>
            </tr>
            <tr>
                <td><input type="checkbox" class="obj_check" value="4871"></td>
                <td>2632</td>
                <td><a name="#a_id4871"></a><a href="#a_id4871" onclick="doRequest('edit', 4871 )">Продуктовый
                        магазин</a></td>
                <td>Магазины продовольственных товаров<br></td>
                <td>3</td>
                <td>970&nbsp;000&nbsp;&nbsp;руб.</td>
                <td>Купцевич Татьяна</td>
                <td style="text-align: right">
                    <a href="#a_id4871" onclick="doRequest('edit', 4871 )">
                        <img11 src="images/edit.gif" title="редактировать" 11>
                    </a> &nbsp;&nbsp;&nbsp;<a href="#a_id4871" onclick="doRequest( 'del', 4871 )">
                        <img11 src="images/del.gif" title="удалить" 11>
                    </a>
                </td>
                <td style="text-align: center"><input cat="buy" rel="4871" class="priority" type="text" size="4"
                                                      value="485499"></td>
            </tr>
            <tr>
                <td><input type="checkbox" class="obj_check" value="4870"></td>
                <td>2631</td>
                <td><a name="#a_id4870"></a><a href="#a_id4870" onclick="doRequest('edit', 4870 )">Пивной магазин</a>
                </td>
                <td>Магазины продовольственных товаров<br></td>
                <td></td>
                <td>350&nbsp;000&nbsp;&nbsp;руб.</td>
                <td>Колгашкина Полина</td>
                <td style="text-align: right">
                    <a href="#a_id4870" onclick="doRequest('edit', 4870 )">
                        <img11 src="images/edit.gif" title="редактировать" 11>
                    </a> &nbsp;&nbsp;&nbsp;<a href="#a_id4870" onclick="doRequest( 'del', 4870 )">
                        <img11 src="images/del.gif" title="удалить" 11>
                    </a>
                </td>
                <td style="text-align: center"><input cat="buy" rel="4870" class="priority" type="text" size="4"
                                                      value="485489"></td>
            </tr>
            <tr>
                <td><input type="checkbox" class="obj_check" value="4869"></td>
                <td>2546-2</td>
                <td><a name="#a_id4869"></a><a href="#a_id4869" onclick="doRequest('edit', 4869 )">Универсальное
                        помещение</a></td>
                <td>Коммерческая недвижимость<br></td>
                <td>3</td>
                <td>5&nbsp;250&nbsp;000&nbsp;&nbsp;руб.</td>
                <td>Купцевич Татьяна</td>
                <td style="text-align: right">
                    <a href="#a_id4869" onclick="doRequest('edit', 4869 )">
                        <img11 src="images/edit.gif" title="редактировать" 11>
                    </a> &nbsp;&nbsp;&nbsp;<a href="#a_id4869" onclick="doRequest( 'del', 4869 )">
                        <img11 src="images/del.gif" title="удалить" 11>
                    </a>
                </td>
                <td style="text-align: center"><input cat="buy" rel="4869" class="priority" type="text" size="4"
                                                      value="485479"></td>
            </tr>
            <tr>
                <td><input type="checkbox" class="obj_check" value="4868"></td>
                <td>2624</td>
                <td><a name="#a_id4868"></a><a href="#a_id4868" onclick="doRequest('edit', 4868 )">АЗС </a></td>
                <td>Автозаправочные станции<br></td>
                <td>15</td>
                <td>9&nbsp;500&nbsp;000&nbsp;&nbsp;руб.</td>
                <td>Купцевич Татьяна</td>
                <td style="text-align: right">
                    <a href="#a_id4868" onclick="doRequest('edit', 4868 )">
                        <img11 src="images/edit.gif" title="редактировать" 11>
                    </a> &nbsp;&nbsp;&nbsp;<a href="#a_id4868" onclick="doRequest( 'del', 4868 )">
                        <img11 src="images/del.gif" title="удалить" 11>
                    </a>
                </td>
                <td style="text-align: center"><input cat="buy" rel="4868" class="priority" type="text" size="4"
                                                      value="485469"></td>
            </tr>
            <tr>
                <td><input type="checkbox" class="obj_check" value="3403"></td>
                <td>2050</td>
                <td><a name="#a_id3403"></a><a href="#a_id3403" onclick="doRequest('edit', 3403 )">Рынок
                        сельско-хозяйственный </a></td>
                <td>Магазины продовольственных товаров<br></td>
                <td></td>
                <td>50&nbsp;000&nbsp;000&nbsp;&nbsp;руб.</td>
                <td>Пономарёва Елена</td>
                <td style="text-align: right">
                    <a href="#a_id3403" onclick="doRequest('edit', 3403 )">
                        <img11 src="images/edit.gif" title="редактировать" 11>
                    </a> &nbsp;&nbsp;&nbsp;<a href="#a_id3403" onclick="doRequest( 'del', 3403 )">
                        <img11 src="images/del.gif" title="удалить" 11>
                    </a>
                </td>
                <td style="text-align: center"><input cat="buy" rel="3403" class="priority" type="text" size="4"
                                                      value="485469"></td>
            </tr>
            <tr>
                <td><input type="checkbox" class="obj_check" value="4517"></td>
                <td>2427</td>
                <td><a name="#a_id4517"></a><a href="#a_id4517" onclick="doRequest('edit', 4517 )">Супермаркет элитных
                        продуктов </a></td>
                <td>Магазины продовольственных товаров<br></td>
                <td></td>
                <td>3&nbsp;900&nbsp;000&nbsp;&nbsp;руб.</td>
                <td>Аникина Дарья</td>
                <td style="text-align: right">
                    <a href="#a_id4517" onclick="doRequest('edit', 4517 )">
                        <img11 src="images/edit.gif" title="редактировать" 11>
                    </a> &nbsp;&nbsp;&nbsp;<a href="#a_id4517" onclick="doRequest( 'del', 4517 )">
                        <img11 src="images/del.gif" title="удалить" 11>
                    </a>
                </td>
                <td style="text-align: center"><input cat="buy" rel="4517" class="priority" type="text" size="4"
                                                      value="485469"></td>
            </tr>
            <tr>
                <td><input type="checkbox" class="obj_check" value="4822"></td>
                <td>2609</td>
                <td><a name="#a_id4822"></a><a href="#a_id4822" onclick="doRequest('edit', 4822 )">Центр медицинской
                        косметологии</a></td>
                <td>Сфера красоты и здоровья<br></td>
                <td>5</td>
                <td>5&nbsp;600&nbsp;000&nbsp;&nbsp;руб.</td>
                <td>Купцевич Татьяна</td>
                <td style="text-align: right">
                    <a href="#a_id4822" onclick="doRequest('edit', 4822 )">
                        <img11 src="images/edit.gif" title="редактировать" 11>
                    </a> &nbsp;&nbsp;&nbsp;<a href="#a_id4822" onclick="doRequest( 'del', 4822 )">
                        <img11 src="images/del.gif" title="удалить" 11>
                    </a>
                </td>
                <td style="text-align: center"><input cat="buy" rel="4822" class="priority" type="text" size="4"
                                                      value="485459"></td>
            </tr>
            <tr>
                <td><input type="checkbox" class="obj_check" value="4688"></td>
                <td>2524</td>
                <td><a name="#a_id4688"></a><a href="#a_id4688" onclick="doRequest('edit', 4688 )">Салон красоты –
                        студия загара (Солярий, косметология, маникюр, педикюр)</a></td>
                <td>Сфера красоты и здоровья<br></td>
                <td></td>
                <td>980&nbsp;000&nbsp;&nbsp;руб.</td>
                <td>Колгашкина Полина</td>
                <td style="text-align: right">
                    <a href="#a_id4688" onclick="doRequest('edit', 4688 )">
                        <img11 src="images/edit.gif" title="редактировать" 11>
                    </a> &nbsp;&nbsp;&nbsp;<a href="#a_id4688" onclick="doRequest( 'del', 4688 )">
                        <img11 src="images/del.gif" title="удалить" 11>
                    </a>
                </td>
                <td style="text-align: center"><input cat="buy" rel="4688" class="priority" type="text" size="4"
                                                      value="485459"></td>
            </tr>
            <tr>
                <td><input type="checkbox" class="obj_check" value="4867"></td>
                <td>13783</td>
                <td><a name="#a_id4867"></a><a href="#a_id4867" onclick="doRequest('edit', 4867 )">Помещение под
                        Магазин</a></td>
                <td>Коммерческая недвижимость<br></td>
                <td>2 мес.</td>
                <td>5&nbsp;800&nbsp;000&nbsp;&nbsp;руб.</td>
                <td>Лаптев Александр</td>
                <td style="text-align: right">
                    <a href="#a_id4867" onclick="doRequest('edit', 4867 )">
                        <img11 src="images/edit.gif" title="редактировать" 11>
                    </a> &nbsp;&nbsp;&nbsp;<a href="#a_id4867" onclick="doRequest( 'del', 4867 )">
                        <img11 src="images/del.gif" title="удалить" 11>
                    </a>
                </td>
                <td style="text-align: center"><input cat="buy" rel="4867" class="priority" type="text" size="4"
                                                      value="485459"></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="w-container action-list">
    <div class="w-row row-action">
        <div class="w-col w-col-6">
            <div class="w-dropdown" data-delay="300">
                <div class="w-dropdown-toggle manager-list">
                    <div>Действия с отмеченными записями</div>
                    <div class="w-icon-dropdown-toggle"></div>
                </div>
                <nav class="w-dropdown-list"><a class="w-dropdown-link manager-list-item" href="#">Link 1</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 2</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 3</a><a
                        class="w-dropdown-link manager-list-item" href="#">Link 4</a></nav>
            </div>
        </div>
        <div class="w-col w-col-6"></div>
    </div>
</div>
<div class="w-container edit-container"><h1 class="main-container-h1">Редактирование объекта</h1>

    <div class="w-form form-edit-add">
        <form id="email-form-3" name="email-form-3" data-name="Email Form 3"><h2 class="content-h2">Основные
                сведения:</h2><label for="name">Внутренний номер документа:</label><input class="w-input" id="name"
                                                                                          type="text"
                                                                                          placeholder="inner_id"
                                                                                          name="name" data-name="Name">

            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="nazvanie">Название:</label><input class="w-input" id="nazvanie"
                                                                                         type="text"
                                                                                         placeholder="Продуктовый магазин"
                                                                                         name="nazvanie"
                                                                                         data-name="nazvanie"></div>
                <div class="w-col w-col-6"><label for="name-3">Тип помещения:</label>

                    <div class="w-checkbox w-clearfix"><input class="w-checkbox-input checkbox" id="areatype[]"
                                                              type="checkbox" data-name="areatype[]"
                                                              name="areatype[]"><label class="w-form-label"
                                                                                       for="areatype[]">офисное</label>
                    </div>
                    <div class="w-checkbox w-clearfix"><input class="w-checkbox-input checkbox" id="areatype[]-2"
                                                              type="checkbox" data-name="areatype[]"
                                                              name="areatype[]"><label class="w-form-label"
                                                                                       for="areatype[]-2">торговое</label>
                    </div>
                    <div class="w-checkbox w-clearfix"><input class="w-checkbox-input checkbox" id="areatype[]-3"
                                                              type="checkbox" data-name="areatype[]"
                                                              name="areatype[]"><label class="w-form-label"
                                                                                       for="areatype[]-3">универсальное</label>
                    </div>
                    <div class="w-checkbox w-clearfix"><input class="w-checkbox-input checkbox" id="areatype[]-4"
                                                              type="checkbox" data-name="areatype[]"
                                                              name="areatype[]"><label class="w-form-label"
                                                                                       for="areatype[]-4">отдельно
                            стоящее здание</label></div>
                </div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="stoimost">Стоимость:<br>(указывается только число, например,
                        1000000)</label><input class="w-input" id="stoimost" type="text" placeholder="970000"
                                               name="stoimost" data-name="stoimost"></div>
                <div class="w-col w-col-6"><label for="razm_stoimosti">Размерность стоимости:<br>(указывается, в чем
                        измеряется стоимость, например, руб.)</label><input class="w-input" id="razm_stoimosti"
                                                                            type="text" placeholder="руб."
                                                                            name="razm_stoimosti"
                                                                            data-name="razm_stoimosti"></div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="name-5">Оценка эксперта:</label>

                    <div class="w-checkbox w-clearfix"><input class="w-checkbox-input checkbox" id="valuation"
                                                              type="checkbox" data-name="valuation"
                                                              name="valuation"><label class="w-form-label"
                                                                                      for="valuation">Да/Нет</label>
                    </div>
                </div>
                <div class="w-col w-col-6"><label for="opf">Организационно-правовая форма:</label><input class="w-input"
                                                                                                         id="opf"
                                                                                                         type="text"
                                                                                                         placeholder="ООО"
                                                                                                         name="opf"
                                                                                                         data-name="opf">
                </div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="dolya">Доля, %:<br>(указывается только число, например,
                        100)</label><input class="w-input" id="dolya" type="text" placeholder="100" name="dolya"
                                           data-name="dolya"></div>
                <div class="w-col w-col-6"><label for="tip">Тип предприятия:</label><input class="w-input input1"
                                                                                           id="tip" type="text"
                                                                                           placeholder="Сфера красоты и здоровья"
                                                                                           name="tip" data-name="tip">
                </div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="tehhar">Технические характеристики объекта:</label><textarea
                        class="w-input" id="tehhar" placeholder="Example Text" name="tehhar"
                        data-name="tehhar"></textarea></div>
                <div class="w-col w-col-6"><label for="proizv">Производимая продукция, виды услуг:</label><input
                        class="w-input" id="proizv" type="text"
                        placeholder="Продажа лекарственных препаратов и приборов мед.назначения" name="proizv"
                        data-name="proizv"></div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="srok">Срок существования предприятия:</label><input
                        class="w-input" id="srok" type="text" placeholder="1 год" name="srok" data-name="srok"></div>
                <div class="w-col w-col-6"><label for="kolsot">Количество сотрудников:</label><input class="w-input"
                                                                                                     id="kolsot"
                                                                                                     type="text"
                                                                                                     placeholder="9"
                                                                                                     name="kolsot"
                                                                                                     data-name="kolsot">
                </div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="uppersonal">Управляющий персонал:</label><input class="w-input"
                                                                                                       id="uppersonal"
                                                                                                       type="text"
                                                                                                       placeholder="1"
                                                                                                       name="uppersonal"
                                                                                                       data-name="uppersonal">
                </div>
                <div class="w-col w-col-6"><label for="fondzp">Фонд заработной платы:</label><input class="w-input"
                                                                                                    id="fondzp"
                                                                                                    type="text"
                                                                                                    placeholder="100000"
                                                                                                    name="fondzp"
                                                                                                    data-name="fondzp">
                </div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="mestopolojenie">Месторасположение:</label><input class="w-input"
                                                                                                        id="mestopolojenie"
                                                                                                        type="text"
                                                                                                        placeholder="г.Самара, Ленинский район"
                                                                                                        name="mestopolojenie"
                                                                                                        data-name="mestopolojenie">
                </div>
                <div class="w-col w-col-6"><label for="district">Район:</label><select class="w-select" id="district"
                                                                                       name="district"
                                                                                       data-name="district">
                        <option value="">Select one...</option>
                        <option value="First">First Choice</option>
                        <option value="Second">Second Choice</option>
                        <option value="Third">Third Choice</option>
                    </select></div>
            </div>
            <h2 class="content-h2">Финансовая картина:</h2>

            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="nalogrejim">Налоговый режим:</label><input class="w-input"
                                                                                                  id="nalogrejim"
                                                                                                  type="text"
                                                                                                  placeholder="УСН"
                                                                                                  name="nalogrejim"
                                                                                                  data-name="nalogrejim">
                </div>
                <div class="w-col w-col-6"><label for="dolg">Долговые обязательства:</label><input class="w-input"
                                                                                                   id="dolg" type="text"
                                                                                                   name="dolg"
                                                                                                   data-name="dolg">
                </div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="invest">Необходимость инвестиций:</label><input class="w-input"
                                                                                                       id="invest"
                                                                                                       type="text"
                                                                                                       name="invest"
                                                                                                       data-name="invest">
                </div>
                <div class="w-col w-col-6"><label for="prichina">Причина продажи:</label><input class="w-input"
                                                                                                id="prichina"
                                                                                                type="text"
                                                                                                placeholder="Личные обстоятельства"
                                                                                                name="prichina"
                                                                                                data-name="prichina">
                </div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="okypaemost">Срок окупаемости:</label><input class="w-input"
                                                                                                   id="okypaemost"
                                                                                                   type="text"
                                                                                                   name="okypaemost"
                                                                                                   data-name="okypaemost">
                </div>
                <div class="w-col w-col-6"><label for="nemact">Нематериальные активы:</label><textarea class="w-input"
                                                                                                       id="nemact"
                                                                                                       placeholder="Example Text"
                                                                                                       name="nemact"
                                                                                                       data-name="nemact"></textarea>
                </div>
            </div>
            <h2 class="content-h2">основные фонды:</h2>

            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="nedvijimost">Недвижимость:</label><input class="w-input"
                                                                                                id="nedvijimost"
                                                                                                type="text"
                                                                                                name="nedvijimost"
                                                                                                data-name="nedvijimost">
                </div>
                <div class="w-col w-col-6"><label for="area">Площадь помещения, м²:</label><input class="w-input"
                                                                                                  id="area" type="text"
                                                                                                  placeholder="100000"
                                                                                                  name="area"
                                                                                                  data-name="area">
                </div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="tep">Средства производства:</label><input class="w-input"
                                                                                                 id="tep" type="text"
                                                                                                 name="tep"
                                                                                                 data-name="tep"></div>
                <div class="w-col w-col-6"><label for="sert">Сертификаты и лицензии:</label><input class="w-input"
                                                                                                   id="sert" type="text"
                                                                                                   name="sert"
                                                                                                   data-name="sert">
                </div>
            </div>
            <h2 class="content-h2">Дополнительная информация:</h2>

            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="status">Статус:</label><textarea class="w-input" id="status"
                                                                                        placeholder="Example Text"
                                                                                        name="status"
                                                                                        data-name="status"></textarea>
                </div>
                <div class="w-col w-col-6"><label for="kommentarii">Комментарии:</label><textarea class="w-input"
                                                                                                  id="kommentarii"
                                                                                                  placeholder="Example Text"
                                                                                                  name="kommentarii"
                                                                                                  data-name="kommentarii"></textarea>
                </div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="user_id">Консультант:</label><select class="w-select"
                                                                                            id="user_id" name="user_id"
                                                                                            data-name="user_id">
                        <option value="">Select one...</option>
                        <option value="First">First Choice</option>
                        <option value="Second">Second Choice</option>
                        <option value="Third">Third Choice</option>
                    </select></div>
                <div class="w-col w-col-6"><label for="field-6">Срочная продажа:</label>

                    <div class="w-checkbox w-clearfix"><input class="w-checkbox-input checkbox" id="fastsale"
                                                              type="checkbox" data-name="fastsale"
                                                              name="fastsale"><label class="w-form-label"
                                                                                     for="fastsale">Да/Нет</label></div>
                </div>
            </div>
            <div class="w-row edit-add-row bottom">
                <div class="w-col w-col-6"><label for="field-8">Продано:</label>

                    <div class="w-checkbox w-clearfix"><input class="w-checkbox-input checkbox" id="prodano"
                                                              type="checkbox" data-name="prodano" name="prodano"><label
                            class="w-form-label" for="prodano">Да/Нет</label></div>
                </div>
                <div class="w-col w-col-6"><label for="field-6">Продажа в лизинг:</label>

                    <div class="w-checkbox w-clearfix"><input class="w-checkbox-input checkbox" id="leasing"
                                                              type="checkbox" data-name="leasing" name="leasing"><label
                            class="w-form-label" for="leasing">Да/Нет</label></div>
                </div>
            </div>
            <label for="vid">Относится к группе:</label><select class="w-select" id="vid" name="vid" data-name="vid">
                <option value="">Select one...</option>
                <option value="First">First Choice</option>
                <option value="Second">Second Choice</option>
                <option value="Third">Third Choice</option>
            </select>

            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="field-9">Фото 1:</label><input class="w-input" id="field-9"
                                                                                      type="text"
                                                                                      placeholder="Example Text"
                                                                                      name="field-9"
                                                                                      required="required"></div>
                <div class="w-col w-col-6"><label for="field-10">Фото 2:</label><input class="w-input" id="field-10"
                                                                                       type="text"
                                                                                       placeholder="Example Text"
                                                                                       name="field-10"
                                                                                       required="required"
                                                                                       data-name="Field 10"></div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"><label for="field-11">Фото 3:</label><input class="w-input" id="field-11"
                                                                                       type="text"
                                                                                       placeholder="Example Text"
                                                                                       name="field-11"
                                                                                       required="required"
                                                                                       data-name="Field 11"></div>
                <div class="w-col w-col-6"><label for="field-12">Фото 4:</label><input class="w-input" id="field-12"
                                                                                       type="text"
                                                                                       placeholder="Example Text"
                                                                                       name="field-12"
                                                                                       required="required"
                                                                                       data-name="Field 12"></div>
            </div>
            <div class="w-row edit-add-row">
                <div class="w-col w-col-6"></div>
                <div class="w-col w-col-6 button-update-save"><a class="w-button button-search" href="#">СОХРАНИТЬ</a>
                </div>
            </div>
        </form>
        <div class="w-form-done"><p>Thank you! Your submission has been received!</p></div>
        <div class="w-form-fail"><p>Oops! Something went wrong while submitting the form</p></div>
    </div>
</div>
<div class="w-section footer">
    <div class="w-container">
        <div class="w-row footer-row">
            <div class="w-col w-col-1 w-clearfix"><img class="logo-img"
                                                       src="https://daks2k3a4ib2z.cloudfront.net/55e6ac31dd5145120d31de49/55e6acfdaeeb20146f5e799e_logo.png">
            </div>
            <div class="w-col w-col-3 w-clearfix"><p class="logo-text"><span
                        class="logo-text-b">БИЗНЕС ГАРАНТ</span><br>МАГАЗИН ГОТОВОГО БИЗНЕСА</p></div>
            <div class="w-col w-col-4 head-center"></div>
            <div class="w-col w-col-4 head-center"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script type="text/javascript"
        src="js/webflow.js"></script>

<!--[if lte IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>
