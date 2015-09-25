<?php
/**
 * Created by PhpStorm.
 * User: elex
 * Date: 22.09.15
 * Time: 10:16
 */



/*
select * from bg63_site_content
where id in(

select stoimost_content from
(

-- ----------------------------------

select * from
-- 			okypaemost -------------
(
select
    tv.name okypaemost_title,
    cv.value okypaemost,
    cv.contentid okypaemost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='okypaemost'
) a
-- ----------------------------------
join
(
-- 			stoimost -------------
select
    tv.name stoimost_title,
    cv.value stoimost,
    cv.contentid stoimost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='stoimost'
) b
on a.okypaemost_content=b.stoimost_content
-- ----------------------------------

) res
where res.stoimost>330000
)

         * */

$sql="
-- ----------------------------------

select * from
-- 			okypaemost -------------
(
select
    tv.name okypaemost_title,
    cv.value okypaemost,
    cv.contentid okypaemost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='okypaemost'
) a
-- ----------------------------------
join
(
-- 			stoimost -------------
select
    tv.name stoimost_title,
    cv.value stoimost,
    cv.contentid stoimost_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='stoimost'
) b
on a.okypaemost_content=b.stoimost_content
-- ----------------------------------
";

$dohodnost=mysql_escape_string($_GET['dohodnost']);
$vlj_min=mysql_escape_string($_GET['vlj_min']);
$vlj_max=mysql_escape_string($_GET['vlj_max']);
$srok=mysql_escape_string($_GET['srok']);

//Условия для сферы деятельности

if(isset($_GET['sphere']) && !empty($_GET['sphere'])) {

    $vid_name = explode("||", mysql_escape_string($_GET['sphere']));
    $vid = array();

    foreach ($vid_name as $key=>$value) {

        if (!empty($value)) {

            $vid[] = "\"{$value}\"";

        }

    }

    $vid_name = implode(",", $vid);

    $vidWhere = " AND res.vid IN (".$vid_name.")";
}

//Условия для районов
if(isset($_GET['district']) && !empty($_GET['district'])) {

    $district_name = explode("||", mysql_escape_string($_GET['district']));
    $district = array();

    foreach ($district_name as $key=>$value) {

        if (!empty($value)) {

            $district[] = "\"{$value}\"";

        }

    }

    $district_name = implode(",", $district);

    $districtJoin = ""

    . "-- ----------------------------------

join
(
select
    tv.name district_title,
    cv.value district,
    cv.contentid district_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='district'
) f
on f.district_content=b.stoimost_content";

    $districtWhere = " AND res.district IN (".$district_name.")";


}

//ENDIF Условия для районов

$sql=
    ""."select * from ".$table_prefix."site_content
where id in(

select stoimost_content from
(

-- ----------------------------------

select * from
-- 			okypaemost -------------
(
select
    tv.name okypaemost_title,
    cv.value okypaemost,
    cv.contentid okypaemost_content

    from ".$table_prefix."site_tmplvar_contentvalues cv

    join ".$table_prefix."site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='okypaemost'
) a
-- ----------------------------------
join
(
-- 			stoimost -------------
select
    tv.name stoimost_title,
    cv.value stoimost,
    cv.contentid stoimost_content

    from ".$table_prefix."site_tmplvar_contentvalues cv

    join ".$table_prefix."site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='stoimost'
) b
on a.okypaemost_content=b.stoimost_content
-- ----------------------------------

join
(
select
    tv.name vid_title,
    cv.value vid,
    cv.contentid vid_content

    from bg63_site_tmplvar_contentvalues cv

    join bg63_site_tmplvars tv
    on tv.id=cv.tmplvarid

    where tv.name='vid_name'
) e
on e.vid_content=b.stoimost_content
".$districtJoin."

) res
where (res.stoimost>".$vlj_min.")and(res.stoimost<".$vlj_max.")
".$vidWhere."
".$districtWhere."



)";


// echo $sql;


$prd='';
$i=0;
foreach ($modx->query($sql) as $product)
{
    $prd.=",".$product['id'];
    $i++;
}
$res['count']=$i;
if($prd!='') $prd=substr($prd, 1);
$res['res']=$prd;
$res['sql']=$sql;
echo json_encode($res);
