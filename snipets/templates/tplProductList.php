<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 24.09.15
 * Time: 11:05
 */


    ?>
    <div class="w-container body-container">
        <h1 class="main-container-h1">Список объектов на продажу</h1>

        <div class="w-row row-filter">


            <?php
            /*
            $sql_manager="select * from
(
select
tv.name,
cv.value users_last_name
,cv.contentid
from bg63_site_tmplvar_contentvalues cv

join bg63_site_tmplvars tv
on tv.id=cv.tmplvarid

where (tv.name='users_last_name')
) users_last_name
join
(
select
tv.name,
cv.value user_first_name
,cv.contentid
from bg63_site_tmplvar_contentvalues cv

left join bg63_site_tmplvars tv
on tv.id=cv.tmplvarid

where (tv.name='user_first_name')
) user_first_name
on users_last_name.contentid=user_first_name.contentid


left join
(
select
tv.name,
cv.value users_mobile_phone
,cv.contentid
from bg63_site_tmplvar_contentvalues cv

join bg63_site_tmplvars tv
on tv.id=cv.tmplvarid

where (tv.name='users_mobile_phone')
) users_mobile_phone
on users_mobile_phone.contentid=user_first_name.contentid";

*/
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

on a.id=d.id
order by c.last_name
";

            ?>

            <div class="w-col w-col-4 w-col-stack row-maanger"><p class="main-head-text">Менеджер: <br><span
                        class="manager-selected"><?php
                        if((isset($_GET['manager']))and($_GET['manager']!=''))
                        {
                            echo $this->GetManagerByID($_GET['manager']);
                        }
                        else
                        {
                            echo "Все";
                        }
                        ?></span></p>
                <div class="w-dropdown" data-delay="300">
                    <div class="w-dropdown-toggle manager-list">
                        <div>Список менеджеров</div>
                        <div class="w-icon-dropdown-toggle"></div>
                    </div>
                    <nav class="w-dropdown-list">

                        <?php

                        ?>
                        <a class="w-dropdown-link manager-list-item" href="/bg-admin?<?php
                        //строим URL
                        $tmp='';
                        if((isset($_GET['search-text']))and($_GET['search-text']!=''))
                        {
                            $tmp= "search-text=".$_GET['search-text']."&";
                        }
                        if((isset($_GET['sphere']))and($_GET['sphere']!=''))
                        {
                            $tmp= "sphere=".$_GET['sphere']."&";
                        }



                        echo $tmp;


                        ?>">Все</a>



                        <?php
                        foreach ($modx->query($sql_manager) as $row_manager)
                        {
                            ?>
                            <a class="w-dropdown-link manager-list-item" href="/bg-admin?<?php
                            //строим URL
                            $tmp='';
                            if((isset($_GET['search-text']))and($_GET['search-text']!=''))
                            {
                                $tmp= "search-text=".$_GET['search-text']."&";
                            }
                            if((isset($_GET['sphere']))and($_GET['sphere']!=''))
                            {
                                $tmp= "sphere=".$_GET['sphere']."&";
                            }


                            $tmp.="manager=".$row_manager['user_id'];
                            echo $tmp;


                            ?>"><?php
                                echo $row_manager['last_name']." ".$row_manager['first_name']." ".$row_manager['work_phone'];
                                ?></a>
                        <?php
                        }
                        ?>


                    </nav>
                </div>
                <div style="margin:5px 0 0 0;text-align: left"><a href="/manager_list">Редактировать</a></div>
            </div>
            <div class="w-col w-col-5 w-col-stack row-maanger">
                <p class="main-head-text">Сфера бизнеса: <br>
                        <span class="manager-selected"><?php
                            if((isset($_GET['sphere']))and($_GET['sphere']!=''))
                            {
                                echo $_GET['sphere'];
                            }
                            else
                            {
                                echo "Все";
                            }
                            ?></span>
                </p>


                <?php
                $sql_sphere="select  distinct
tv.name,
cv.value

from bg63_site_tmplvar_contentvalues cv

join bg63_site_tmplvars tv
on tv.id=cv.tmplvarid

where tv.name='vid_name'
;";


                ?>


                <div class="w-dropdown" data-delay="300">
                    <div class="w-dropdown-toggle manager-list">
                        <div>Список сфер</div>
                        <div class="w-icon-dropdown-toggle"></div>
                    </div>
                    <nav class="w-dropdown-list">
                        <?php

                        ?>
                        <a class="w-dropdown-link manager-list-item" href="/bg-admin?<?php
                        $tmp='';
                        if((isset($_GET['search-text']))and($_GET['search-text']!=''))
                        {
                            $tmp= "search-text=".$_GET['search-text']."&";
                        }
                        if((isset($_GET['manager']))and($_GET['manager']!=''))
                        {
                            $tmp= "manager=".$_GET['manager']."&";
                        }

                        echo $tmp;

                        ?>">Все</a>

                        <?php
                        foreach ($modx->query($sql_sphere) as $row_sphere)
                        {
                            ?>
                            <a class="w-dropdown-link manager-list-item" href="/bg-admin?<?php
                            $tmp='';
                            if((isset($_GET['search-text']))and($_GET['search-text']!=''))
                            {
                                $tmp= "search-text=".$_GET['search-text']."&";
                            }
                            if((isset($_GET['manager']))and($_GET['manager']!=''))
                            {
                                $tmp= "manager=".$_GET['manager']."&";
                            }
                            $tmp.="sphere=".$row_sphere['value'];
                            echo $tmp;

                            ?>"><?php if($row_sphere['value']!='') echo $row_sphere['value'];  ?></a>
                        <?php
                        }
                        ?>

                    </nav>
                </div>

            </div>
            <div class="w-col w-col-3 w-col-stack">
                <a href="/bgadmin/add">
                    <div class="div-button button-add">
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
            <div class="w-col w-col-6">
                <div class="w-form">
                    <form id="email-form-2" name="email-form-2" data-name="Email Form 2"><label for="search-id">Поиск
                            по
                            ID:</label><input class="w-input" id="search-id" type="text" value="<?php if((isset($_GET['search-id']))and($_GET['search-id']!=''))
                        {
                            echo $_GET['search-id'];
                        }
                        ?>"
                                              placeholder="Введите ID записи"
                                              name="search-id" data-name="search-id"><input
                            class="w-button button-search"
                            type="submit"
                            data-wait="Please wait...">
                    </form>
                    <div class="w-form-done"><p>Thank you! Your submission has been received!</p></div>
                    <div class="w-form-fail"><p>Oops! Something went wrong while submitting the form</p></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if((isset($_GET['search-text']))and($_GET['search-text']!=''))
    {
        $searchText='AND(pagetitle like "%'.mysql_escape_string($_GET['search-text']).'%")';
    }

    if((isset($_GET['search-id']))and($_GET['search-id']!=''))
    {
        $searchID=' AND(id ='.mysql_escape_string($_GET['search-id']).') ';
    }

    $sql="select count(*) cc from bg63_site_content

where (template=2)".$searchText.$searchID." limit 50";

    foreach ($modx->query($sql) as $row)
    {
        $count=$row['cc']+0;
    }

    if($count>0)
    {
        ?>

        <div class="w-container action-list">
            <div class="w-row row-action">
                <div class="w-col w-col-6">
                    <div class="w-dropdown" data-delay="300">
                        <div class="w-dropdown-toggle manager-list">
                            <div>Действия с отмеченными записями</div>
                            <div class="w-icon-dropdown-toggle"></div>
                        </div>
                        <nav class="w-dropdown-list"><a class="w-dropdown-link manager-list-item" href="#">Удалить</a><a
                                class="w-dropdown-link manager-list-item" href="#">Сменить менеджера</a><a
                                class="w-dropdown-link manager-list-item" href="#">Оплатит</a><a
                                class="w-dropdown-link manager-list-item" href="#">Link 4</a></nav>
                    </div>
                </div>
                <div class="w-col w-col-6"></div>
            </div>
        </div>
        <div class="w-container data-container">
            <div class="w-embed table-responsive">
                <table class="table" >
                    <tr class="div-button-active">
                        <th></th>
                        <th>№</th>
                        <th></th>
                        <th>Название/Тип</th>
                        <th>Категория</th>
                        <th>Срок</th>
                        <th>Цена</th>
                        <th>Менеджер</th>

                        <th>Приоритет</th>
                    </tr>
                    <?php




                    $sql="select * from bg63_site_content

where (template=2)".$searchText.$searchID." limit 50";

                    foreach ($modx->query($sql) as $row)
                    {

                        $sql_tv="select
tv.name,
cv.value



from bg63_site_tmplvar_contentvalues cv

join bg63_site_tmplvars tv
on tv.id=cv.tmplvarid

where cv.contentid=".$row['id'];

                        foreach ($modx->query($sql_tv) as $row_tv)
                        {
                            $tv[$row_tv['name']]=$row_tv['value'];
                        }

                        //Проверяем сферу не в запроси ппц
                        if  (((isset($_GET['sphere']))and($_GET['sphere']!=''))or((isset($_GET['manager']))and($_GET['manager']!='')))
                        {
                            if
                            (
                                (($_GET['sphere']==$tv['vid_name'])and($_GET['manager']==''))
                                or
                                (($_GET['sphere']==$tv['vid_name'])and($_GET['manager']==$tv['user_id']))
                                or
                                (($_GET['sphere']=='')and($_GET['manager']==$tv['user_id']))
                            )
                            {
                                ?>
                                <tr class="row-table">
                                    <td><input class="checkbox" type="checkbox" name="chk_<?php echo $row['id'];?>"></td>
                                    <td><?php echo $row['id'];?></td>
                                    <td>
                                        <div>
                                            <a class="e-button button-search a-button"  href="/bg-admin/edit.html?id=<?php echo $row['id'];?>"  >
                                                <img src="/bgadmin/css/edit.png">
                                            </a>
                                            <input class="w-button button-search" type="submit" value="X" data-wait="Please wait..."></div></td>
                                    <td><?php echo $row['pagetitle'];?></td>
                                    <td><?php echo $tv['vid_name'];?></td>
                                    <td><?php echo $tv['srok'];?></td>
                                    <td><?php echo $tv['stoimost'];?></td>
                                    <td><?php echo $this->GetManagerByID($tv['user_id'],true)?></td>

                                    <td><?php echo $tv['row_sort'];?></td>
                                </tr>
                            <?php
                            }
                        }
                        else// если не выбран не один фильтр
                        {
                            ?>
                            <tr class="row-table">
                                <td><input class="checkbox" type="checkbox" name="chk_<?php echo $row['id'];?>"></td>
                                <td><?php echo $row['id'];?></td>
                                <td>
                                    <div>
                                        <a class="e-button button-search a-button"  href="/bg-admin/edit.html?id=<?php echo $row['id'];?>"  >
                                            <img src="/bgadmin/css/edit.png">
                                        </a>
                                        <input class="w-button button-search" type="submit" value="X" data-wait="Please wait..."></div></td>
                                <td><?php echo $row['pagetitle'];?></td>
                                <td><?php echo $tv['vid_name'];?></td>
                                <td><?php echo $tv['srok'];?></td>
                                <td><?php echo $tv['stoimost'];?></td>
                                <td><?php echo $tv['last_name']." ".$tv['first_name'];?></td>

                                <td><?php echo $tv['row_sort'];?></td>
                            </tr>
                        <?php
                        }



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
    }
    else
    {
        ?>
        <div class="w-container search">
            <h2 class="content-h2">Поиск не дал результатов</h2>
        </div>

    <?php
    }


