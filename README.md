### takecloudapi-sdk-php

takecloudapi-sdk-php是为了让PHP开发者能够在自己的代码里更快捷方便的使用乘云的API而开发的SDK工具包。

#### 资源

* [公共参数](http://wiki.qcloud.com/wiki/%E5%85%AC%E5%85%B1%E5%8F%82%E6%95%B0)
* [API列表](http://wiki.qcloud.com/wiki/API)
* [错误码](http://wiki.qcloud.com/wiki/%E9%94%99%E8%AF%AF%E7%A0%81)

#### 入门

1. 申请安全凭证。
在第一次使用云API之前，用户首先需要在乘云网站上申请安全凭证，安全凭证包括 AppId 和 AppSecret, AppId 是用于标识 API 调用者的身份，AppSecret是用于加密签名字符串和服务器端验证签名字符串的密钥。AppSecret 必须严格保管，避免泄露。

2. 下载SDK，放入到您的程序目录。
使用方法请参考下面的例子。

#### 例子

    <?php
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
