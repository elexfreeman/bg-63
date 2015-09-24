<?php

global $modx;
$managers = $this->GetManagerList();



?>
<div class="w-container body-container">
    <h1 class="main-container-h1">Список менеджеров</h1>

    <div class="w-row row-filter">
        <div class="w-col w-col-5 w-col-stack row-maanger">
            <div class="w-col w-col-3 w-col-stack">
                <a href="/bg-admin/manager-list/add.html">
                    <div class="div-button button-add manager-add-button">
                        <div class="div-button-text">добавить</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="w-container search">
        <div class="w-row">
            <div class="w-col w-col-6">
                <div class="w-form">
                    <form id="email-form" name="email-form" data-name="Email Form">
                        <label for="search-text">Поиск</label>
                        <input class="w-input" id="search-text" type="text"
                               placeholder="Введите ключевую фразу"
                               name="search-text"
                               value="<?php if((isset($_GET['search-text']))and($_GET['search-text']!=''))
                               {
                                   echo $_GET['search-text'];
                               }
                               ?>"
                               data-name="search-text">
                        <input class="w-button button-search" type="submit" value="Найти" data-wait="Please wait...">
                    </form>
                    <div class="w-form-done"><p>Thank you! Your submission has been received!</p></div>
                    <div class="w-form-fail"><p>Oops! Something went wrong while submitting the form</p></div>
                </div>
            </div>

        </div>
    </div>


    <div class="w-container data-container">
        <div class="w-embed table-responsive">
            <table class="table" >
                <tr class="div-button-active">
                    <th></th>
                    <th></th>
                    <th>ФИО</th>

                    <th>Офис</th>
                    <th>Телефоны</th>
                    <th>Почта</th>

                </tr>
                <?php

                foreach ($managers as $manager) {


                    ?>
                    <tr class="row-table">
                        <td>
                            <div>
                                <a class="e-button button-search a-button"  href="/bgadmin/manager-list/manager-edit/?id=<?=$manager->page_id?>"  >
                                    <img src="/bgadmin/css/edit.png">
                                </a>
                                <input class="w-button button-search" type="submit" value="X" data-wait="Please wait..."></div></td>
                        <td><?=$manager->manager_photo?></td>
                        <td><?=$manager->last_name . " " . $manager->first_name?></td>

                        <td><?=$manager->parentTitle?></td>
                        <td><?="раб.: " . $manager->work_phone . " моб.: ". $manager->mobile_phone?></td>
                        <td>Почта</td>

                    </tr>
                    <?php




                }


                ?>
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
    <?php