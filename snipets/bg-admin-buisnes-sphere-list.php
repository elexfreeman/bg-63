<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 03.09.15
 * Time: 11:41
 */


require_once __DIR__."/bg-admin.class.php";

$BGAdminModel = new BGAdmin();

$sphereList = $BGAdminModel->SphereListElements();


?>
    <div class="w-container body-container">
    <h1 class="main-container-h1">Список сфер деятельности</h1>

    <div class="w-row row-filter">
        <div class="w-col w-col-5 w-col-stack row-maanger">
            <div class="w-col w-col-3 w-col-stack">
                <a href="/bg-admin/buisnes-sphere-admin/add.html">
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
                    <th>Наименование</th>
                </tr>
                <?php

                foreach ($sphereList as $k=>$sphere) {

                    ?>
                    <tr class="row-table">
                        <td>
                            <div>
                                <a class="e-button button-search a-button"  href="/bg-admin/buisnes-sphere-admin/edit.html?id=<?=$k?>"  >
                                    <img src="/bgadmin/css/edit.png">
                                </a>
                                <input class="w-button button-search" type="submit" value="X" data-wait="Please wait..."></div></td>

                        <td><?=htmlspecialchars($sphere)?></td>

                    </tr>
                    <?php


                }


                ?>
            </table>
        </div>
    </div>
<?php