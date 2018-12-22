<?php

header("Content-Type:text/html;charset=UTF-8");

require_once 'sign.php';

$appKey = '25353289';

$appSecret = '8561aa6380b588f2c31b57664dae63f4';

$sessionkey= 'test';

@$num_iids=$_GET['num_iid'] OR die('err');
//参数数组

$paramArr = array(

     'app_key' => $appKey,

     'session_key' => $sessionkey,

     'method' => 'taobao.tbk.item.convert',

     'format' => 'json',

     'v' => '2.0',

     'sign_method'=>'md5',

     'timestamp' => date('Y-m-d H:i:s'),

     'fields' => 'num_iid,click_url',
	 'num_iids' => $num_iids,
     'adzone_id'=> 666,
     
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

$datas = json_encode($results);
echo $datas
?>