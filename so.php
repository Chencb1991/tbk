<?php

header("Content-Type:text/html;charset=UTF-8");

require_once 'sign.php';

$appKey = '25353289';

$appSecret = '8561aa6380b588f2c31b57664dae63f4';

$sessionkey= 'test';

@$keyword=$_GET['key'] OR die('err');
//参数数组

$paramArr = array(

     'app_key' => $appKey,

     'session_key' => $sessionkey,

     'method' => 'taobao.tbk.item.get',

     'format' => 'json',

     'v' => '2.0',

     'sign_method'=>'md5',

     'timestamp' => date('Y-m-d H:i:s'),

     'fields' => 'num_iid,title,pict_url,small_images,reserve_price,zk_final_price,item_url,volume,total_results',
	 'q' => $keyword,

    // 'nick' => 'sandbox_c_1'

);

//生成签名

$sign = createSign($paramArr);

//echo $sign;

//组织参数

$strParam = createStrParam($paramArr);

$strParam .= 'sign='.$sign;

$url = 'http://gw.api.taobao.com/router/rest?'.$strParam;

$result = file_get_contents($url);

$results =json_decode($result, true);

echo json_encode($results);
?>