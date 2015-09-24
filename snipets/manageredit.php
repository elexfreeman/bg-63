<?php

global $modx;

$managerId = mysql_escape_string($_GET['id']);


$BGModel = new BG();
$tv = $BGModel->GetContentTV($managerId);
$managerPage = $modx->getObject('modResource', $managerId);
$parent = $managerPage->get('parent');

$officeList = $this->GetManagerOfficeList();

?>
    <div class="w-container edit-container">
        <h1 class="main-container-h1">Редактирование менеджера <a class="go-back" href="/bg-admin/manager-list">Вернуться</a></h1>

        <div class="w-form form-edit-add">
            <form method="post">
                <input type="hidden" name="action" value="update"/>
                <input type="hidden" name="page_id" value="<?=$managerId?>"/>
                <div class="w-row edit-add-row">
                    <div class="w-col w-col-6"><label for="last_name">Фамилия:</label>
                        <input class="w-input"
                               id="last_name"
                               type="text"
                               placeholder="Иванов"
                               name="last_name"
                               data-name="last_name"
                               value="<?= htmlspecialchars($tv['last_name']) ?>"
                            >
                    </div>

                    <div class="w-col w-col-6"><label for="first_name">Имя:</label>
                        <input class="w-input"
                               id="first_name"
                               type="text"
                               placeholder="Иван"
                               name="first_name"
                               data-name="first_name"
                               value="<?= htmlspecialchars($tv['first_name']) ?>"
                            >
                    </div>
                </div>
                <div class="w-row edit-add-row">
                    <div class="w-col w-col-6"><label for="work_phone">Рабочий телефон:</label>
                        <input class="w-input"
                               id="work_phone"
                               type="text"
                               placeholder=""
                               name="work_phone"
                               data-name="work_phone"
                               value="<?= htmlspecialchars($tv['work_phone']) ?>"
                            >
                    </div>

                    <div class="w-col w-col-6"><label for="mobile_phone">Мобильный телефон:</label>
                        <input class="w-input"
                               id="mobile_phone"
                               type="text"
                               placeholder=""
                               name="mobile_phone"
                               data-name="mobile_phone"
                               value="<?= htmlspecialchars($tv['mobile_phone']) ?>"
                            >
                    </div>
                </div>
                <div class="w-row edit-add-row">
                    <div class="w-col w-col-6"><label for="email">Почта:</label>
                        <input class="w-input"
                               id="email"
                               type="text"
                               placeholder=""
                               name="email"
                               data-name="email"
                               value="<?= htmlspecialchars($tv['email']) ?>"
                            >
                    </div>

                    <div class="w-col w-col-6"><label for="office">Офис:</label>
                        <select class ="w-select" name="office">
                            <?php foreach ($officeList as $officeOption) {
                                ?>
                            <option <?php if ($parent == $officeOption['id']) echo 'selected="selected"'?> value = "<?=$officeOption['id']?>">
                                <?=$officeOption['pagetitle']?>
                            </option>
                        <?php
                            }
                            ?>
                        </select>

                    </div>
                    <div class="w-col w-col-6"><label for="manager_photo">Фото:</label>
                        <input class="w-input"
                               id="manager_photo"
                               type="text"
                               placeholder=""
                               name="manager_photo"
                               data-name="manager_photo"
                               value="<?= htmlspecialchars($tv['manager_photo']) ?>"
                            >
                    </div>
                </div>
                <div class="w-row edit-add-row">
                    <div class="w-col w-col-6"></div>
                    <div class="w-col w-col-6 button-update-save">
                        <input type="submit" class="w-button button-search" value="СОХРАНИТЬ"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
