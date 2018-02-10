<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/2/9
 * Time: 16:49
 */
// 设置http头返回json格式
header('Content-type: application/json');

require_once './src/TakecloudApi.php';

$config = [
    'AppId' => 'tc_5a7be935ca123',  // 您的appId
    'AppSecret' => '5b0dbec2b6346ba7053dee52c9485b8f'  // 您的appSecret
];

$app = new TakecloudApi($config);
$ret = $app->send('admin/app/getAppList');
echo $ret;