<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 03.09.15
 * Time: 11:41
 */


require_once __DIR__."/bg-admin.class.php";

$BGAdminModel = new BGAdmin();

global $modx;

$sphereList = $BGAdminModel->SphereListElements();

if (isset($_POST) && $_POST['action'] == "save") {

    $sphereList[] = $_POST['name'];
    $tv = $modx->getObject('modTemplateVar',array("name"=>"vid"));
    $tv->set('elements', implode("||", $sphereList));
    $tv->save();

    echo "Сохранено";
}
    else {



    ?>
        <div class="w-container edit-container">
            <h1 class="main-container-h1">Добвление сферы деятельности <a class="go-back" href="/bg-admin/buisnes-sphere-admin/">Вернуться</a></h1>

            <div class="w-form form-edit-add">
                <form method="post">
                    <input type="hidden" name="action" value="save"/>

                    <div class="w-row edit-add-row">
                        <div class="w-col w-col-6"><label for="name">Наименование:</label>
                            <input class="w-input"
                                   id="name"
                                   type="text"
                                   placeholder="Автозаправки"
                                   name="name"
                                   data-name="name"
                                   value=""
                                >
                        </div>
                    </div>
                    <div class="w-row edit-add-row">
                        <div class="w-col w-col-6"></div>
                        <div class="w-col w-col-6 button-update-save">
                            <input type="submit" value="СОХРАНИТЬ" class="w-button button-search"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
    }