<?php
// $content_id = $scriptProperties['content_id'];
// $sql="select cv.contentid contentid, vars.name name,cv.value value from modx_site_tmplvar_contentvalues cv

//  join modx_site_tmplvars vars on vars.id=cv.tmplvarid

// where cv.contentid=".$content_id;
// $string='';
// foreach($modx->query($sql) as $row)
// {
//     if($row['name']=='Цена') {
//         $string.=$row['name'].":".str_replace(",", ".", $row['value'])." руб.;";
//         continue;
//     }
//     $string.=$row['name'].":".$row['value'].";";
// }

// $string = str_replace("\n", '', $string);


// $string=str_replace("\r","",$string);
// return $string;
$content_id = $scriptProperties['content_id'];
$sql="select cv.contentid contentid, vars.name name,cv.value value from modx_site_tmplvar_contentvalues cv

 join modx_site_tmplvars vars on vars.id=cv.tmplvarid

where cv.contentid=".$content_id;
$string='';
//echo $sql."\n";
foreach($modx->query($sql) as $row)
{
    switch($row['name']){
        case("Артикул"):
            if($string!=''){
                $string2 = $string;
                $string = $row['value']."#".$string2;
            } else {
                $string.= $row['value']."#";
            }
            break;
        case("Цена"):
        {
            //	$row['value']=preg_replace("/[\s]*/", '',$row['value']);
            //	$row['value']=preg_replace("/\t/"," ",$row['value']);
            $row['value']=str_replace("руб.", "", $row['value']);
            $row['value']=str_replace(",", ".", $row['value']);
            //$row['value']=str_replace("", ' ', $row['value']);
            //$row['value']=floatval($row['value']);

            //	$row['value']=preg_replace("/[^x\d|*\.]/","", $row['value']);
            $string.="\"".$row['value']."\"#";
            break;
        }
    }

}

$string = str_replace("\n", '', $string);
$string = str_replace("\r", '', $string);
