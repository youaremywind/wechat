<?php

function getDailyEnglishInfo($keyword)
{
    $url = "http://open.iciba.com/dsapi/";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $output = str_replace("%", "%%", $output); 
    $result = json_decode($output, true);
    
$english = array(); 
$english[] = array("Title" =>"每日一言（双语）".$result["dateline"], "Description"=>$result["content"]."\n".$result["note"]."\n\n".str_replace("词霸小编：", "解释：", $result["translation"]), "PicUrl" =>$result["picture"], "Url" =>"");
    return $english;
}

?>