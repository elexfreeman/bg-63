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

$sql="select * from ".$table_prefix."site_content
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

) res
where (res.stoimost>".$vlj_min.")and(res.stoimost<".$vlj_max.")


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
