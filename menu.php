<?php
//https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login 获取
$appid = "";
$appsecret = "";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$output = https_request($url);
$jsoninfo = json_decode($output, true);

$access_token = $jsoninfo["access_token"];

$jsonmenu = '{
      "button":[
         {
               "name":"查天气",
               "sub_button":[
                {
                   "type":"click",
                   "name":"当地天气",
                   "key":"weather"
                },
                {
                   "type":"click",
                   "name":"空气质量",
                   "key":"airquality"
                }
                ]
          },
          {
               "name":"实用查询",
               "sub_button":[
                {
                   "type":"click",
                   "name":"中-英翻译",
                   "key":"translate"
                },
                {
                   "type":"click",
                   "name":"交通查询",
                   "key":"traffic"
                },
              {
                   "type":"click",
                   "name":"每日一言",
                   "key":"day"
                }]
           },
           {
               "type":"click",
               "name":"最新推送",
               "key":"latest"
           }]
       }';


$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

?>