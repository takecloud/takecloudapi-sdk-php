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
    'AppId' => 'tc_5c7f30c34a034',  // 您的appId
    'AppSecret' => '25f389028cb0135aae68319cfbef0826'  // 您的appSecret
];

$app = new TakecloudApi($config);
//$ret = $app->send('admin/goods/goodsList',[
//    'pageIndex' => 1,
//    'pageSize' => 5,
//    'status' => '待上架#已上架#已下架',
//    'promote' => '秒杀#拼团#砍价#无促销'
//]);
$ret = $app->generateUrl('admin/goods/goodsList',[
    'pageIndex' => 1,
    'pageSize' => 5,
    'status' => '待上架#已上架#已下架',
    'promote' => '秒杀#拼团#砍价#无促销'
]);
echo $ret;