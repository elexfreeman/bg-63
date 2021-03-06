<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 03.09.15
 * Time: 11:34
 */

/*sd*/
/*05KtXxixXb*/
/*sdsdsdsds*/
/*asasasas*/
/**
 * @param $string
 * @return string
 * 
 */

function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 'c',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'C',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '_',  'Ы' => 'Y',   'Ъ' => '_',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}

function encodestring($str) {
    // переводим в транслит
    $str = rus2translit($str);
    // в нижний регистр
    $str = strtolower($str);
    // заменям все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
    // удаляем начальные и конечные '-'
    $str = trim($str, "-");


    return $str;
}


class BGAdmin
{

    function GetManagerByID($user_id,$istable=false)
    {
        global $modx;

        $sql_manager="select * from
(
		select
		manager.id,
		manager.pagetitle,
		tv.name,
		cv.value user_id
		 from bg63_site_content manager

		join bg63_site_tmplvar_contentvalues cv
		on cv.contentid=manager.id

		join bg63_site_tmplvars tv
		on tv.id=cv.tmplvarid
		where (manager.template=12)and(tv.name='user_id')
		having user_id=".mysql_escape_string($user_id)."
) a
join
(
	select
	manager.id,
	cv.value first_name
	 from bg63_site_content manager

	join bg63_site_tmplvar_contentvalues cv
	on cv.contentid=manager.id

	join bg63_site_tmplvars tv
	on tv.id=cv.tmplvarid

	where (manager.template=12)and(tv.name='first_name')

) b
on a.id=b.id


join
(
	select
	manager.id,
	cv.value last_name
	from bg63_site_content manager

	join bg63_site_tmplvar_contentvalues cv
	on cv.contentid=manager.id

	join bg63_site_tmplvars tv
	on tv.id=cv.tmplvarid
	where (manager.template=12)and(tv.name='last_name')

) c
on a.id=c.id


join
(
	select
	manager.id,
	cv.value work_phone
	from bg63_site_content manager

	join bg63_site_tmplvar_contentvalues cv
	on cv.contentid=manager.id

	join bg63_site_tmplvars tv
	on tv.id=cv.tmplvarid
	where (manager.template=12)and(tv.name='work_phone')

) d

on a.id=d.id";

        foreach ($modx->query($sql_manager) as $row_manager)
        {
            if($istable)
            {
                $user=$row_manager['last_name']." ".$row_manager['first_name'];

            }
            else
            $user=$row_manager['last_name']." ".$row_manager['first_name']." ".$row_manager['work_phone'];;

        }

        return $user;
    }

    //Редактирование менеджеров
    public function ManagerEdit() {

        include_once $_SERVER['DOCUMENT_ROOT'].'/snipets/manageredit.php';

    }

    public function GetManagerOfficeList() {

        global $modx;

        $document = $modx->getCollection('modResource', array(
            'published' => 1,
            'isfolder' => 1,
            'parent'    => 1120
        ));

        return $document;

    }

    //Возвращает массив типов помещений
    function GetAreaTypes()
    {
        global $modx;
        $sql="select * from bg63_site_tmplvars where name='areatype'";


        foreach ($modx->query($sql) as $row)
        {
            $areatypes=$row['elements'];
        }

        $areatypes=explode('||',$areatypes);
        $qs = array();
        foreach($areatypes as $areatype)
        {
            $qs[]=$areatype;
        }
        return $qs;
    }

    function GetCurrentAreaTypes($tvId, $contentId)
    {
        global $modx;
        $sql="select * from bg63_site_tmplvars where name='areatype'";

        foreach ($modx->query($sql) as $row)
        {
            $areatypes=$row['elements'];
        }

        $areatypes = explode('||',$areatypes);
        $qs = array();
        $sqlPageTv = $modx->query("select value from bg63_site_tmplvar_contentvalues where tmplvarid = {$tvId} AND contentid={$contentId} LIMIT 1");
        $tvArray = explode("||", $sqlPageTv->fetchColumn());
        foreach($areatypes as $areatype)
        {

            if (in_array($areatype, $tvArray)) {

                $qs[] = array(
                                'value'   => $areatype,
                                'checked' => 1
                );

            }
            else {

                $qs[] = array(
                    'value'   => $areatype,
                    'checked' => 0
                );

            }

        }

        return $qs;
    }

    //Возвращает массив пользователей-менеджеров
    function GetManagerList()
    {

        global $modx;

        $sql_manager="select * from
(
		select
		manager.id uid,
		manager.pagetitle,
		tv.name,
		cv.value user_id
		 from bg63_site_content manager

		join bg63_site_tmplvar_contentvalues cv
		on cv.contentid=manager.id

		join bg63_site_tmplvars tv
		on tv.id=cv.tmplvarid
		where (manager.template=12)and(tv.name='user_id')

) a
join
(
	select
	manager.id,
	cv.value first_name
	 from bg63_site_content manager

	join bg63_site_tmplvar_contentvalues cv
	on cv.contentid=manager.id

	join bg63_site_tmplvars tv
	on tv.id=cv.tmplvarid

	where (manager.template=12)and(tv.name='first_name')

) b
on a.uid=b.id


join
(
	select
	manager.id,
	cv.value last_name
	from bg63_site_content manager

	join bg63_site_tmplvar_contentvalues cv
	on cv.contentid=manager.id

	join bg63_site_tmplvars tv
	on tv.id=cv.tmplvarid
	where (manager.template=12)and(tv.name='last_name')

) c
on a.uid=c.id


join
(
	select
	manager.id,
	cv.value work_phone
	from bg63_site_content manager

	join bg63_site_tmplvar_contentvalues cv
	on cv.contentid=manager.id

	join bg63_site_tmplvars tv
	on tv.id=cv.tmplvarid
	where (manager.template=12)and(tv.name='work_phone')

) d

on a.uid=d.id

join
(
	select
	manager.id,
	cv.value mobile_phone
	from bg63_site_content manager

	join bg63_site_tmplvar_contentvalues cv
	on cv.contentid=manager.id

	join bg63_site_tmplvars tv
	on tv.id=cv.tmplvarid
	where (manager.template=12)and(tv.name='mobile_phone')

) e
on a.uid=e.id

left join
(
	select
	manager.id,
	cv.value manager_photo
	from bg63_site_content manager

	join bg63_site_tmplvar_contentvalues cv
	on cv.contentid=manager.id

	join bg63_site_tmplvars tv
	on tv.id=cv.tmplvarid
	where (manager.template=12)and(tv.name='manager_photo')

) f
on a.uid=f.id

";


        $qs = array();

        foreach ($modx->query($sql_manager) as $row_manager)
        {
            $obj = new stdClass();
            $obj->first_name = $row_manager['first_name'];
            $obj->last_name = $row_manager['last_name'];
            $obj->work_phone =  $row_manager['work_phone'];
            $obj->mobile_phone = $row_manager['mobile_phone'];
            $obj->user_id = $row_manager['user_id'];
            $obj->page_id = $row_manager['uid'];
            $obj->manager_photo = $row_manager['manager_photo'];
            $product = $modx->getObject('modResource',$obj->page_id);
            $parent = $product->getOne('Parent');
            $obj->parentTitle = $parent->get('pagetitle');

            //print_r($obj);
            $qs[]=$obj;

        }
        return $qs;
    }

    public  function ProductList()
    {
        global $modx;
        global $table_prefix;
        include $_SERVER['DOCUMENT_ROOT']."/snipets/templates/tplProductList.php";
    }

    public function ManagerList()
    {

        include_once $_SERVER['DOCUMENT_ROOT'] . "/snipets/managerlist.php";

    }

    public function ManagerUpdate()
    {
        global $modx;
        $pageId = $_POST['page_id'];
        unset($_POST['action']);
        unset($_POST['page_id']);

        $manager = $modx->getObject('modResource', $pageId);
        foreach ($_POST as $tvName => $tvValue) {

            $manager->setTVValue($tvName,$tvValue);
        }

    }

    /**
     *
     */
    function ProductUpdate()
    {
        global $modx;

        $productId = $_POST['product_id'];

        foreach ($_POST as $key => $value) {

            if ($key == "action" || $key == "product_id" || $key == "name") {
                continue;
            }

            if (is_array($value)) {

                $insertVal = implode("||", $value);

            } else {

                $insertVal = $value;

            }

            if ($key == "areatype_input" && !empty($value)) {

                $aretypeValueQuery = $modx->query("SELECT `elements` FROM bg63_site_tmplvars WHERE `name` = 'areatype'");
                $aretypeValue = $aretypeValueQuery->fetchColumn() . "||" . trim($value);
                $modx->query("UPDATE bg63_site_tmplvars SET `elements` = '".mysql_escape_string($aretypeValue)."' WHERE `name` = 'areatype'");

                $areatypeQ = $modx->query("SELECT value from bg63_site_tmplvar_contentvalues WHERE contentid={$productId} AND tmplvarid=2");

                $areatypeValue = $areatypeQ->fetchColumn();
                $insertVal = $areatypeValue  . "||{$value}";
                $key = "areatype";

            }

            $checkQuery = $modx->query("SELECT id FROM bg63_site_tmplvar_contentvalues WHERE tmplvarid=(SELECT id FROM bg63_site_tmplvars where name='{$key}') AND contentid = {$productId} LIMIT 1");
            if ($checkQuery->rowCount() > 0) {

                $fieldId = $checkQuery->fetchColumn();
                $updateQuery = "UPDATE bg63_site_tmplvar_contentvalues SET value = '".mysql_escape_string($insertVal)."' WHERE id = {$fieldId}";

                $modx->query($updateQuery);

            } else {

                $tvIdQuery = $modx->query("(SELECT id FROM bg63_site_tmplvars where name='{$key}')");
                $tvId = $tvIdQuery->fetchColumn();
                if ($tvId != "") {
                    $insertQuery = "INSERT INTO bg63_site_tmplvar_contentvalues (tmplvarid, contentid, value)
                                    VALUES ({$tvId}, {$productId}, '".mysql_escape_string($insertVal)."')";
                    $modx->query($insertQuery);

                } else {

                    //echo "tv not found:{$key}<br/>";

                }
            }

        }

        echo "Сохранено";

    }


    /**
     *
     */
    function ProductEdit()
    {
        global $modx;
        $sql="select * from bg63_site_content

where id=".mysql_escape_string($_GET['id']);

        foreach ($modx->query($sql) as $row) {

            $sql_tv = "select
tv.name,
cv.value



from bg63_site_tmplvar_contentvalues cv

join bg63_site_tmplvars tv
on tv.id=cv.tmplvarid

where cv.contentid=" . $row['id'];

            //echo $sql_tv;
            foreach ($modx->query($sql_tv) as $row_tv) {
                $tv[$row_tv['name']] = $row_tv['value'];
            }
            ?>
            <div class="w-container edit-container">
                <h1 class="main-container-h1">Редактирование объекта <a class="go-back" href="/bg-admin">Вернуться</a></h1>

                <div class="w-form form-edit-add">
                    <form method="post">
                        <input name="action" type="hidden" value="update">
                        <input name="product_id" type="hidden" value="<?php echo mysql_escape_string($_GET['id']); ?>">
                        <h2 class="content-h2">Основные
                            сведения:</h2>
                        <label for="name">Внутренний номер документа:</label>
                        <input class="w-input"
                               id="name"
                               type="text"
                               placeholder="inner_id"
                               name="inner_id" value="<?=htmlspecialchars($tv['inner_id'])?>"
                               data-name="Name">

                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="nazvanie">Название:</label>
                                <input class="w-input"
                                       id="nazvanie"
                                       type="text"
                                       placeholder="Продуктовый магазин"
                                       name="nazvanie"
                                       data-name="nazvanie"
                                       value="<?=htmlspecialchars($tv['nazvanie'])?>"
                                    >
                            </div>

                            <div class="w-col w-col-6">
                                <label for="name-3">Тип помещения:</label>
                                <div class="w-checkbox w-clearfix">
                                    <input type="hidden" name="areatype[]" value="">


                                </div>
                                <?php

                                $areatypes = $this->GetCurrentAreaTypes(2, $row['id']);
                                $i = 1;
                                foreach ($areatypes as $areatype)
                                {
                                    ?>
                                    <div class="w-checkbox w-clearfix">
                                        <input class="w-checkbox-input checkbox" id="areatype[]-<?php echo $i; ?>"
                                               type="checkbox" <?php if ($areatype['checked']) echo 'checked = "checked"'?> data-name="areatype[]" value="<?=htmlspecialchars($areatype['value']) ?>"
                                               name="areatype[]">

                                        <label class="w-form-label" for="areatype[]-<?php echo $i; ?>"><?=htmlspecialchars($areatype['value'])?></label>
                                    </div>
                                <?php
                                    $i++;
                                }

                                ?>



                                <input class="w-input" id="areatype_input" type="text" placeholder="Или введите новый тип" name="areatype_input" >
                            </div>

                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="stoimost">Стоимость:<br>(указывается только число,
                                    например,
                                    1000000)</label><input class="w-input" id="stoimost" type="text"
                                                           placeholder="970000"
                                                           name="stoimost"
                                                           value="<?=htmlspecialchars($tv['stoimost'])?>"

                                                           data-name="stoimost"></div>
                            <div class="w-col w-col-6"><label for="razm_stoimosti">Размерность стоимости:<br>
                                    (указывается, в чем измеряется стоимость, например, руб.)</label>
                                <input class="w-input"
                                    id="razm_stoimosti"
                                    type="text" placeholder="руб."
                                    name="razm_stoimosti"  value="<?=htmlspecialchars($tv['razm_stoimosti'])?>"
                                    data-name="razm_stoimosti">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="name-5">Оценка эксперта:</label>

                                <div class="w-checkbox w-clearfix">
                                    <input type="hidden" name="valuation" value=""/>
                                    <input class="w-checkbox-input checkbox"
                                                                          id="valuation"
                                                                          type="checkbox" data-name="valuation"
                                                                          name="valuation"
                                                                          <?php if($tv['valuation'] == "on") echo 'checked = "checked"'?>
                                                                            ><label class="w-form-label
                                                                                                  for="valuation">Да/Нет</label>
                                </div>
                            </div>
                            <div class="w-col w-col-6"><label for="opf">Организационно-правовая форма:</label><input
                                    class="w-input"
                                    id="opf"
                                    type="text"
                                    placeholder="ООО"
                                    name="opf" value="<?=htmlspecialchars($tv['opf'])?>"
                                    data-name="opf">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="dolya">Доля, %:<br>(указывается только число,
                                    например,
                                    100)</label><input class="w-input" id="dolya" type="text" placeholder="100"
                                                       name="dolya"
                                                       value="<?=htmlspecialchars($tv['dolya'])?>"
                                                       data-name="dolya"></div>
                            <div class="w-col w-col-6"><label for="tip">Тип предприятия:</label><input
                                    class="w-input input1"
                                    id="tip" type="text" value="<?=htmlspecialchars($tv['tip'])?>"
                                    placeholder="Сфера красоты и здоровья"
                                    name="tip" data-name="tip">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="tehhar">Технические характеристики
                                    объекта:</label><textarea
                                    class="w-input" id="tehhar" placeholder="Example Text" name="tehhar"
                                    data-name="tehhar"><?=htmlspecialchars($tv['tehhar'])?></textarea></div>
                            <div class="w-col w-col-6"><label for="proizv">Производимая продукция, виды
                                    услуг:</label><input
                                    class="w-input" id="proizv" type="text"
                                    placeholder="Продажа лекарственных препаратов и приборов мед.назначения"
                                    name="proizv"   value="<?=htmlspecialchars($tv['proizv'])?>"
                                    data-name="proizv"></div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="srok">Срок существования предприятия:</label><input
                                    class="w-input" id="srok" type="text" placeholder="1 год" name="srok"
                                    value="<?=htmlspecialchars($tv['srok'])?>"
                                    data-name="srok">
                            </div>
                            <div class="w-col w-col-6"><label for="kolsot">Количество сотрудников:</label><input
                                    class="w-input"
                                    id="kolsot" value="<?=htmlspecialchars($tv['kolsot'])?>"
                                    type="text"
                                    placeholder="9"
                                    name="kolsot"
                                    data-name="kolsot">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="uppersonal">Управляющий персонал:</label><input
                                    class="w-input"
                                    id="uppersonal"
                                    type="text" value="<?=htmlspecialchars($tv['uppersonal'])?>"
                                    placeholder="1"
                                    name="uppersonal"
                                    data-name="uppersonal">
                            </div>
                            <div class="w-col w-col-6"><label for="fondzp">Фонд заработной платы:</label><input
                                    class="w-input"
                                    id="fondzp"
                                    type="text" value="<?=htmlspecialchars($tv['fondzp'])?>"
                                    placeholder="100000"
                                    name="fondzp"
                                    data-name="fondzp">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="mestopolojenie">Месторасположение:</label><input
                                    class="w-input"
                                    id="mestopolojenie" value="<?=htmlspecialchars($tv['mestopolojenie'])?>"
                                    type="text"
                                    placeholder="г.Самара, Ленинский район"
                                    name="mestopolojenie"
                                    data-name="mestopolojenie">
                            </div>

                            <div class="w-col w-col-6"><?php

                                echo $this->tvSelectOutput($row['id'], 'district');

                                ?></div>
                        </div>
                        <h2 class="content-h2">Финансовая картина:</h2>

                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="nalogrejim">Налоговый режим:</label><input
                                    class="w-input"
                                    id="nalogrejim"
                                    type="text" value="<?=htmlspecialchars($tv['nalogrejim'])?>"
                                    placeholder="УСН"
                                    name="nalogrejim"
                                    data-name="nalogrejim">
                            </div>
                            <div class="w-col w-col-6"><label for="dolg">Долговые обязательства:</label><input
                                    class="w-input"
                                    id="dolg" type="text"
                                    name="dolg" value="<?=htmlspecialchars($tv['dolg'])?>"
                                    data-name="dolg">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="invest">Необходимость инвестиций:</label><input
                                    class="w-input"
                                    id="invest"
                                    type="text" value="<?=htmlspecialchars($tv['invest'])?>"
                                    name="invest"
                                    data-name="invest">
                            </div>
                            <div class="w-col w-col-6"><label for="prichina">Причина продажи:</label><input
                                    class="w-input"
                                    id="prichina"
                                    type="text" value="<?=htmlspecialchars($tv['prichina'])?>"
                                    placeholder="Личные обстоятельства"
                                    name="prichina"
                                    data-name="prichina">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="okypaemost">Срок окупаемости:</label><input
                                    class="w-input"
                                    id="okypaemost"
                                    type="text" value="<?=htmlspecialchars($tv['okypaemost'])?>"
                                    name="okypaemost"
                                    data-name="okypaemost">
                            </div>
                            <div class="w-col w-col-6"><label for="nemact">Нематериальные активы:</label><textarea
                                    class="w-input"
                                    id="nemact"
                                    placeholder="Example Text"
                                    name="nemact"
                                    data-name="nemact"><?=htmlspecialchars($tv['nemact'])?></textarea>
                            </div>
                        </div>
                        <h2 class="content-h2">основные фонды:</h2>

                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="nedvijimost">Недвижимость:</label><input
                                    class="w-input"
                                    id="nedvijimost"
                                    type="text"  value="<?=htmlspecialchars($tv['nedvijimost'])?>"
                                    name="nedvijimost"
                                    data-name="nedvijimost">
                            </div>
                            <div class="w-col w-col-6"><label for="area">Площадь помещения, м²:</label><input
                                    class="w-input"
                                    id="area" type="text"
                                    placeholder="100000"
                                    name="area" value="<?=htmlspecialchars($tv['area'])?>"
                                    data-name="area">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="tep">Средства производства:</label><input
                                    class="w-input"
                                    id="tep"
                                    type="text" value="<?=htmlspecialchars($tv['tep'])?>"
                                    name="tep"
                                    data-name="tep">
                            </div>
                            <div class="w-col w-col-6"><label for="sert">Сертификаты и лицензии:</label><input
                                    class="w-input"
                                    id="sert" type="text"
                                    name="sert" value="<?=htmlspecialchars($tv['sert'])?>"
                                    data-name="sert">
                            </div>
                        </div>
                        <h2 class="content-h2">Дополнительная информация:</h2>

                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6">
                                <label for="status">Статус:</label>
                                <textarea class="w-input"
                                            id="status"
                                            placeholder="Example Text"
                                            name="status"
                                            data-name="status"><?=htmlspecialchars($tv['status'])?></textarea>
                            </div>
                            <div class="w-col w-col-6"><label for="kommentarii">Комментарии:</label><textarea
                                    class="w-input"
                                    id="kommentarii"
                                    placeholder="Example Text"
                                    name="kommentarii"
                                    data-name="kommentarii"><?=htmlspecialchars($tv['kommentarii'])?></textarea>
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6">
                                <label for="user_id">Консультант:</label>
                                <select class="w-select"
                                    id="user_id"
                                    name="user_id"
                                    data-name="user_id">
                                    <option  value="">Выберите менеджера</option>
                                    <?php
                                    $managers=$this->GetManagerList();
                                    //print_r($managers);
                                    foreach($managers as $manager)
                                    {
                                        $selected='';
                                        if($manager->user_id== $tv['user_id']) $selected=" selected ";
                                        echo ' <option '.$selected.' value="'.$manager->user_id.'">'.$manager->last_name." ".$manager->first_name." ".$manager->work_phone." ".'</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="w-col w-col-6"><label for="field-6">Срочная продажа:</label>

                                <div class="w-checkbox w-clearfix">
                                    <input type="hidden" name="fastsale" value=""/>
                                    <input class="w-checkbox-input checkbox"
                                          id="fastsale"
                                          type="checkbox" data-name="fastsale"
                                        <?php if($tv['fastsale'] == "on") echo 'checked = "checked"'?>
                                          name="fastsale"><label class="w-form-label"
                                                                 for="fastsale">Да/Нет</label>
                                </div>
                            </div>
                        </div>
                        <div class="w-row edit-add-row bottom">
                            <div class="w-col w-col-6">
                                <label for="field-8">Продано:</label>

                                <div class="w-checkbox w-clearfix">
                                    <input type="hidden" name="prodano" value=""/>
                                    <input class="w-checkbox-input checkbox" id="prodano"
                                                                          type="checkbox" data-name="prodano"
                                        <?php if($tv['prodano'] == "on") echo 'checked = "checked"'?>
                                                                          name="prodano">
                                    <label class="w-form-label" for="prodano">Да/Нет</label></div>
                                </div>
                                <div class="w-col w-col-6">
                                    <label for="field-6">Продажа в лизинг:</label>
                                <div class="w-checkbox w-clearfix">
                                    <input type="hidden" name="leasing" value=""/>
                                    <input class="w-checkbox-input checkbox" id="leasing"
                                                                          type="checkbox" data-name="leasing"
                                        <?php if($tv['leasing'] == "on") echo 'checked = "checked"'?>
                                                                          name="leasing">
                                    <label class="w-form-label" for="leasing">Да/Нет</label>
                                </div>
                            </div>
                        </div>
                        <?php

                        echo $this->tvSelectOutput($row['id'], 'vid');

                        ?>

                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6">
                                <label for="field-9">Фото 1:</label>
                                <input class="w-input"
                                          id="field-9"
                                          type="text"
                                          placeholder="Example Text"
                                          value="<?=htmlspecialchars($tv['photo1'])?>"
                                          name="photo1">
                            </div>
                            <div class="w-col w-col-6">
                                <label for="field-10">Фото 2:</label>
                                <input class="w-input"
                                                       id="field-10"
                                                       type="text"
                                                       placeholder="Example Text"
                                                       value="<?=htmlspecialchars($tv['photo2'])?>"
                                                       name="photo2"

                                                       data-name="Field 10">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6">
                                <label for="field-11">Фото 3:</label>
                                <input class="w-input"
                                                       id="field-11"
                                                       type="text"
                                                       placeholder="Example Text"
                                                       value="<?=htmlspecialchars($tv['photo3'])?>"
                                                       name="photo3"

                                                       data-name="Field 11">
                            </div>
                            <div class="w-col w-col-6">
                                <label for="field-12">Фото 4:</label>
                                <input class="w-input"
                                                       id="field-12"
                                                       type="text"
                                                       placeholder="Example Text"
                                                       value="<?=htmlspecialchars($tv['photo4'])?>"
                                                       name="photo4"

                                                       data-name="Field 12">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"></div>
                            <div class="w-col w-col-6 button-update-save">
                                <button class="w-button button-search">СОХРАНИТЬ</button>
                            </div>
                        </div>

                    </form>
                    <div class="w-form-done"><p>Thank you! Your submission has been received!</p></div>
                    <div class="w-form-fail"><p>Oops! Something went wrong while submitting the form</p></div>
                </div>
            </div>
            <?php
        }
    }

    function ProductAdd()
    {
        global $modx;

            ?>
            <div class="w-container edit-container">
                <h1 class="main-container-h1">Добавление объекта <a class="go-back" href="/bg-admin">Вернуться</a></h1>

                <div class="w-form form-edit-add">
                    <form id="email-form-3" name="email-form-3" data-name="Email Form 3">
                        <h2 class="content-h2">Основные
                            сведения:</h2>
                        <label for="name">Внутренний номер документа:</label>
                        <input class="w-input"
                               id="name"
                               type="text"
                               placeholder="inner_id"
                               name="name"
                               data-name="Name">

                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="nazvanie">Название:</label>
                                <input class="w-input"
                                       id="nazvanie"
                                       type="text"
                                       placeholder="Продуктовый магазин"
                                       name="nazvanie"
                                       data-name="nazvanie"

                                    >
                            </div>

                            <div class="w-col w-col-6"><label for="name-3">Тип помещения:</label>

                                <div class="w-checkbox w-clearfix">
                                    <input class="w-checkbox-input checkbox" id="areatype[]"
                                           type="checkbox" data-name="areatype[]"
                                           name="areatype[]">

                                    <label class="w-form-label" for="areatype[]">офисное</label>
                                </div>


                                <div class="w-checkbox w-clearfix">
                                    <input class="w-checkbox-input checkbox"
                                           id="areatype[]-2"
                                           type="checkbox" data-name="areatype[]"
                                           name="areatype[]">
                                    <label class="w-form-label" for="areatype[]-2">торговое</label>
                                </div>

                                <div class="w-checkbox w-clearfix">
                                    <input class="w-checkbox-input checkbox"
                                           id="areatype[]-3"
                                           type="checkbox" data-name="areatype[]"
                                           name="areatype[]"><label class="w-form-label"
                                                                    for="areatype[]-3">универсальное</label>
                                </div>
                                <div class="w-checkbox w-clearfix"><input class="w-checkbox-input checkbox"
                                                                          id="areatype[]-4"
                                                                          type="checkbox" data-name="areatype[]"
                                                                          name="areatype[]"><label class="w-form-label"
                                                                                                   for="areatype[]-4">отдельно
                                        стоящее здание</label></div>
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="stoimost">Стоимость:<br>(указывается только число,
                                    например,
                                    1000000)</label><input class="w-input" id="stoimost" type="text"
                                                           placeholder="970000"
                                                           name="stoimost"


                                                           data-name="stoimost"></div>
                            <div class="w-col w-col-6"><label for="razm_stoimosti">Размерность стоимости:<br>
                                    (указывается, в чем измеряется стоимость, например, руб.)</label>
                                <input class="w-input"
                                       id="razm_stoimosti"
                                       type="text" placeholder="руб."
                                       name="razm_stoimosti"
                                       data-name="razm_stoimosti">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="name-5">Оценка эксперта:</label>

                                <div class="w-checkbox w-clearfix"><input class="w-checkbox-input checkbox"
                                                                          id="valuation"
                                                                          type="checkbox" data-name="valuation"
                                                                          name="valuation"><label class="w-form-label"
                                                                                                  for="valuation">Да/Нет</label>
                                </div>
                            </div>
                            <div class="w-col w-col-6"><label for="opf">Организационно-правовая форма:</label><input
                                    class="w-input"
                                    id="opf"
                                    type="text"
                                    placeholder="ООО"
                                    name="opf"
                                    data-name="opf">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="dolya">Доля, %:<br>(указывается только число,
                                    например,
                                    100)</label><input class="w-input" id="dolya" type="text" placeholder="100"
                                                       name="dolya"
                                                       data-name="dolya"></div>
                            <div class="w-col w-col-6"><label for="tip">Тип предприятия:</label><input
                                    class="w-input input1"
                                    id="tip" type="text"
                                    placeholder="Сфера красоты и здоровья"
                                    name="tip" data-name="tip">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="tehhar">Технические характеристики
                                    объекта:</label><textarea
                                    class="w-input" id="tehhar" placeholder="Example Text" name="tehhar"
                                    data-name="tehhar"></textarea></div>
                            <div class="w-col w-col-6"><label for="proizv">Производимая продукция, виды
                                    услуг:</label><input
                                    class="w-input" id="proizv" type="text"
                                    placeholder="Продажа лекарственных препаратов и приборов мед.назначения"
                                    name="proizv"
                                    data-name="proizv"></div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="srok">Срок существования предприятия:</label><input
                                    class="w-input" id="srok" type="text" placeholder="1 год" name="srok"
                                    data-name="srok">
                            </div>
                            <div class="w-col w-col-6"><label for="kolsot">Количество сотрудников:</label><input
                                    class="w-input"
                                    id="kolsot"
                                    type="text"
                                    placeholder="9"
                                    name="kolsot"
                                    data-name="kolsot">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="uppersonal">Управляющий персонал:</label><input
                                    class="w-input"
                                    id="uppersonal"
                                    type="text"
                                    placeholder="1"
                                    name="uppersonal"
                                    data-name="uppersonal">
                            </div>
                            <div class="w-col w-col-6"><label for="fondzp">Фонд заработной платы:</label><input
                                    class="w-input"
                                    id="fondzp"
                                    type="text"
                                    placeholder="100000"
                                    name="fondzp"
                                    data-name="fondzp">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="mestopolojenie">Месторасположение:</label><input
                                    class="w-input"
                                    id="mestopolojenie"
                                    type="text"
                                    placeholder="г.Самара, Ленинский район"
                                    name="mestopolojenie"
                                    data-name="mestopolojenie">
                            </div>
                            <div class="w-col w-col-6"><label for="district">Район:</label><select class="w-select"
                                                                                                   id="district"
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
                            <div class="w-col w-col-6"><label for="nalogrejim">Налоговый режим:</label><input
                                    class="w-input"
                                    id="nalogrejim"
                                    type="text"
                                    placeholder="УСН"
                                    name="nalogrejim"
                                    data-name="nalogrejim">
                            </div>
                            <div class="w-col w-col-6"><label for="dolg">Долговые обязательства:</label><input
                                    class="w-input"
                                    id="dolg" type="text"
                                    name="dolg"
                                    data-name="dolg">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="invest">Необходимость инвестиций:</label><input
                                    class="w-input"
                                    id="invest"
                                    type="text"
                                    name="invest"
                                    data-name="invest">
                            </div>
                            <div class="w-col w-col-6"><label for="prichina">Причина продажи:</label><input
                                    class="w-input"
                                    id="prichina"
                                    type="text"
                                    placeholder="Личные обстоятельства"
                                    name="prichina"
                                    data-name="prichina">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="okypaemost">Срок окупаемости:</label><input
                                    class="w-input"
                                    id="okypaemost"
                                    type="text"
                                    name="okypaemost"
                                    data-name="okypaemost">
                            </div>
                            <div class="w-col w-col-6"><label for="nemact">Нематериальные активы:</label><textarea
                                    class="w-input"
                                    id="nemact"
                                    placeholder="Example Text"
                                    name="nemact"
                                    data-name="nemact"></textarea>
                            </div>
                        </div>
                        <h2 class="content-h2">основные фонды:</h2>

                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="nedvijimost">Недвижимость:</label><input
                                    class="w-input"
                                    id="nedvijimost"
                                    type="text"
                                    name="nedvijimost"
                                    data-name="nedvijimost">
                            </div>
                            <div class="w-col w-col-6"><label for="area">Площадь помещения, м²:</label><input
                                    class="w-input"
                                    id="area" type="text"
                                    placeholder="100000"
                                    name="area"
                                    data-name="area">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="tep">Средства производства:</label><input
                                    class="w-input"
                                    id="tep"
                                    type="text"
                                    name="tep"
                                    data-name="tep">
                            </div>
                            <div class="w-col w-col-6"><label for="sert">Сертификаты и лицензии:</label><input
                                    class="w-input"
                                    id="sert" type="text"
                                    name="sert"
                                    data-name="sert">
                            </div>
                        </div>
                        <h2 class="content-h2">Дополнительная информация:</h2>

                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6">
                                <label for="status">Статус:</label>
                                <textarea class="w-input"
                                          id="status"
                                          placeholder="Example Text"
                                          name="status"
                                          data-name="status"></textarea>
                            </div>
                            <div class="w-col w-col-6"><label for="kommentarii">Комментарии:</label><textarea
                                    class="w-input"
                                    id="kommentarii"
                                    placeholder="Example Text"
                                    name="kommentarii"
                                    data-name="kommentarii"></textarea>
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6">
                                <label for="user_id">Консультант:</label>
                                <select class="w-select"
                                        id="user_id"
                                        name="user_id"
                                        data-name="user_id">
                                    <option value="">Select one...</option>
                                    <option value="First">First Choice</option>
                                    <option value="Second">Second Choice</option>
                                    <option value="Third">Third Choice</option>
                                </select></div>
                            <div class="w-col w-col-6"><label for="field-6">Срочная продажа:</label>

                                <div class="w-checkbox w-clearfix">
                                    <input class="w-checkbox-input checkbox"
                                           id="fastsale"
                                           type="checkbox" data-name="fastsale"
                                           name="fastsale"><label class="w-form-label"
                                                                  for="fastsale">Да/Нет</label>
                                </div>
                            </div>
                        </div>
                        <div class="w-row edit-add-row bottom">
                            <div class="w-col w-col-6">
                                <label for="field-8">Продано:</label>

                                <div class="w-checkbox w-clearfix">
                                    <input class="w-checkbox-input checkbox" id="prodano"
                                           type="checkbox" data-name="prodano"
                                           name="prodano">
                                    <label class="w-form-label" for="prodano">Да/Нет</label></div>
                            </div>
                            <div class="w-col w-col-6">
                                <label for="field-6">Продажа в лизинг:</label>
                                <div class="w-checkbox w-clearfix">
                                    <input class="w-checkbox-input checkbox" id="leasing"
                                           type="checkbox" data-name="leasing"
                                           name="leasing">
                                    <label class="w-form-label" for="leasing">Да/Нет</label>
                                </div>
                            </div>
                        </div>
                        <label for="vid">Относится к группе:</label><select class="w-select" id="vid" name="vid"
                                                                            data-name="vid">
                            <option value="">Select one...</option>
                            <option value="First">First Choice</option>
                            <option value="Second">Second Choice</option>
                            <option value="Third">Third Choice</option>
                        </select>

                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="field-9">Фото 1:</label><input class="w-input"
                                                                                                  id="field-9"
                                                                                                  type="text"
                                                                                                  placeholder="Example Text"
                                                                                                  name="field-9"
                                                                                                  required="required">
                            </div>
                            <div class="w-col w-col-6"><label for="field-10">Фото 2:</label><input class="w-input"
                                                                                                   id="field-10"
                                                                                                   type="text"
                                                                                                   placeholder="Example Text"
                                                                                                   name="field-10"
                                                                                                   required="required"
                                                                                                   data-name="Field 10">
                            </div>
                        </div>
                        <div class="w-row edit-add-row">
                            <div class="w-col w-col-6"><label for="field-11">Фото 3:</label><input class="w-input"
                                                                                                   id="field-11"
                                                                                                   type="text"
                                                                                                   placeholder="Example Text"
                                                                                                   name="field-11"
                                                                                                   required="required"
                                                                                                   data-name="Field 11">
                            </div>
                            <div class="w-col w-col-6"><label for="field-12">Фото 4:</label><input class="w-input"
                                                                                                   id="field-12"
                                                                                                   type="text"
                                                                                                   placeholder="Example Text"
                                                                                                   name="field-12"
                                                                                                   required="required"
                                                                                                   data-name="Field 12">
                            </div>
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
            <?php
        }


    function ImportUsers()
    {
        global $modx;
        global $table_prefix;

        $uploadfile="/var/www/virtual-hosts/delo-bg63.aktiwork.ru/snipets/expor_users.csv";

//херим данные в таблице s_products
        $tmpFile='/var/www/virtual-hosts/delo-bg63.aktiwork.ru/snipets/tmp.sql';
//unlink($tmpFile);

//$fp = fopen($uploadfile, "r"); // Открываем файл в режиме чтения

        $import_file=file_get_contents($uploadfile);
        $import_file=explode("|",$import_file);

        $count=0;
        {
            $start = true;
            //modx_site_tmplvar_templates - содежит связь между полями и шаблонами
            //modx_site_tmplvar_contentvalues - содежит значения полей в странице
            //modx_site_tmplvars - поля
            //modx_site_content - страницы
            //
            $modx_category_tv = 9;


            // while (!feof($fp))
            foreach ($import_file as $key1=>$mytext)
            {
                //$kkk++;
               // $kk++;
                //$mytext = fgets($fp);
                $tt = explode("#", $mytext);
                echo "<pre>";
                print_r($tt);
                echo "</pre>";

                //Заголовок
                if ($start) {
                    $start = false;
                    //Формируем TV

                    foreach ($tt as $key => $value) {
                        $value = mysql_escape_string($value);
                        $property[$key] = 0;

                        $sql_tpl_var = "select id from " . $table_prefix . "site_tmplvars where name='" . $value . "'";
                        foreach ($modx->query($sql_tpl_var) as $row_tpl_var) {
                            $property[$key] = $row_tpl_var['id'] + 0;
                        }

                        if ($property[$key] == 0) {
                            $sql_tplvar = "INSERT INTO " . $table_prefix . "site_tmplvars
(type, name, caption, description,category) VALUES ('text', '$value', '$value', ''," . $modx_category_tv . ");";
                            $modx->query($sql_tplvar);
                            $property[$key] = $modx->lastInsertId();
                            echo $sql_tplvar . "<br>";
                        }
                    }

                } else {

                    //импортируем страницы
                    $parent = 1120;
                    $template = 12;
                    //Ищем такую страницу
                    $pagetitle = mysql_escape_string($tt[0])." ".mysql_escape_string($tt[1])." ".mysql_escape_string($tt[2]);
                    $alias = encodestring(mysql_escape_string($tt[0])."_".mysql_escape_string($tt[1])."_".mysql_escape_string($tt[2]));
                    $url = "users/" . $alias . ".html";


                    $product_id = 0;
                    $sql_page = "select * from " . $table_prefix . "site_content where pagetitle='" . mysql_escape_string($pagetitle) . "'";
                    echo $sql_page;
                    foreach ($modx->query($sql_page) as $row_page) {
                        $product_id = $row_page['id'];
                    }
                    if ($product_id == 0) {
                        $sql_product = "INSERT INTO " . $table_prefix . "site_content
(id, type, contentType, pagetitle, longtitle,
description, alias, link_attributes,
published, pub_date, unpub_date, parent,
isfolder, introtext, content, richtext,
template, menuindex, searchable,
cacheable, createdby, createdon,
editedby, editedon, deleted, deletedon,
deletedby, publishedon, publishedby,
menutitle, donthit, privateweb, privatemgr,
content_dispo, hidemenu, class_key, context_key,
content_type, uri, uri_override, hide_children_in_tree,
show_in_tree, properties)
VALUES (NULL, 'document', 'text/html', '" . $pagetitle . "', '', '', '" . encodestring(mysql_escape_string($articul . "-" . $pagetitle)) . "',
'', true, 0, 0, " . $parent . ", false, '', '', true, " . $template . ", 1, true, true, 1, 1421901846, 0, 0, false, 0, 0, 1421901846, 1, '',
false, false, false, false, false, 'modDocument', 'web', 1,
 '" . $url . "', false, false, true, null
 );

;";
                        echo "------------------------------------------------------";
                        echo "--------------------- ПРОДУКТ ------------------------";
                        echo $sql_product . "<br>";
                        $modx->query($sql_product);
                        $product_id = $modx->lastInsertId();
                    }
                    //Теперь свойства

                    //СОВЙСТВА
                    $page_property = null;
                    foreach ($tt as $key => $value) {
                        //if ($key > 3)
                        {

                            //Ищем есть ли уже такое свойство
                            $tv_id = 0;
                            $sql_tv = "select * from " . $table_prefix . "site_tmplvar_contentvalues where
 (tmplvarid='" . $property[$key] . "')and(contentid='$product_id')

";
                            foreach ($modx->query($sql_tv) as $row_tv) {
                                $tv_id = $row_tv['id'];
                            }
                            if ($tv_id == 0) {
                                $sql_modx_vars = "INSERT INTO " . $table_prefix . "site_tmplvar_contentvalues
(tmplvarid,contentid,value) VALUES ('" . $property[$key] . "','$product_id','$value');";
                                echo $sql_modx_vars . "<br>";
                                $modx->query($sql_modx_vars);
                            } else {
                                $sql_modx_vars = "update " . $table_prefix . "site_tmplvar_contentvalues
            set value='$value' where  (tmplvarid='" . $property[$key] . "')and(contentid='$product_id')";
                                echo $sql_modx_vars . "<br>";
                                $modx->query($sql_modx_vars);
                            }
                            //modx_site_tmplvar_templates - содежит связь между полями и шаблонами
                            //modx_site_tmplvar_contentvalues - содежит значения полей в странице
                            //modx_site_tmplvars - поля
                            //modx_site_content - страницы
                        }
                    }


                }


                // echo $mytext . "<br />";


                $count++;
                // echo $sql."<br>";
                // $query = $modx->query($sql);
                // echo "---------------------------------------------<br>";
                //  fwrite($fh, $sql);

            }
//
        }
//else echo "Ошибка при открытии файла";
//fclose($fp);
//fclose($fh);
        echo "Итого: ".$count."<br>";
//$cmd='mysql -u '.$database_user.' -p'.$database_password.' '.$database_user.' < '.$tmpFile;
//echo $cmd;
//exec($cmd);
    }

    //Потом захерить это на 1 раз надеюсь
    function ChangeUserID()
    {
        global $modx;
        global $table_prefix;


        $sql="select * from ".$table_prefix."site_content where template=2";
        foreach ($modx->query($sql) as $row)
        {
            $tv='';
            $sql_tv="select
tv.name,cv.value
 from bg63_site_tmplvar_contentvalues cv
join bg63_site_tmplvars tv
on tv.id= cv.tmplvarid
where cv.contentid=".$row['id'];

            foreach ($modx->query($sql_tv) as $row_tv)
            {
                $tv[$row_tv['name']]=$row_tv['value'];
            }

            $first_name=$tv['first_name'];
            $last_name=$tv['last_name'];
            $user_id=$tv['user_id'];





        }

    }

    function SphereList()
    {
        global $modx;
        global $table_prefix;
        $sql_sphere="select  distinct
            tv.name,
            cv.value

            from bg63_site_tmplvar_contentvalues cv

            join bg63_site_tmplvars tv
            on tv.id=cv.tmplvarid

            where tv.name='vid_name'
            ;";

        $temp=array();
        foreach ($modx->query($sql_sphere) as $row_sphere)
        {
            $tmp[]=$row_sphere['value'];
        }
        return $tmp;
    }

    function tvSelectOutput ($contentId, $tvName) {

        global $modx;

        $result = '';

        $tv = $modx->getObject('modTemplateVar',array('name'=>$tvName));
        $tvs = explode("||", $tv->get('elements'));
        $tvCaption = $tv->get('caption');
        $page = $modx->getObject('modResource', $contentId);
        $contentTv = $page->getTVValue($tvName);
        $result = '<label for="district">'.$tvCaption.'</label><select class="w-select"
                                                               id="'.$tvName.'"
                                                               name="'.$tvName.'"
                                                               data-name="'.$tvName.'">

                                                        ';
        foreach ($tvs as $value) {
            if ($value == $contentTv) {
                $result.= '<option value="'.$value.'" selected="selected">'.$value.'</option>';
            }
            else {
                $result.= '<option value="'.$value.'">'.$value.'</option>';
            }
        }

        $result.= ' </select>';

        return $result;
    }


    //Перекключение активной кнопки меню костыль на jquery
    function ProductByMenu()
    {
        ?>
        <script>
            $(function() {
                $(".bg-admin-menu-sale").removeClass("div-button-active");
                $(".bg-admin-menu-sale").addClass("div-button");

                $(".bg-admin-menu-by").addClass("div-button-active");
                $(".bg-admin-menu-by").removeClass("div-button");


            });
        </script>
        <?php

    }


    //Перекключение активной кнопки меню костыль на jquery
    function ManagerTopMenu()
    {
        ?>
        <script>
            $(function() {
                $(".bg-admin-menu-sale").removeClass("div-button-active");
                $(".bg-admin-menu-sale").addClass("div-button");

                $(".bg-admin-menu-by").addClass("div-button-active");
                $(".bg-admin-menu-by").removeClass("div-button");


            });
        </script>
    <?php

    }

    function ProductByList($scriptProperties)
    {
        global $modx;
        global $table_prefix;

        include "bg-admin-buisnes-by-list.php";


    }

}