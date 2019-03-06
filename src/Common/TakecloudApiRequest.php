<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/2/9
 * Time: 16:03
 */
require_once TAKECLOUDAPI_ROOT_PATH . '/Common/TakecloudApiSign.php';

class TakecloudApiRequest
{
    /**
     * api请求的服务器
     */
    const API_HOST = 'weapp.takecloud.cn';

    /**
     * 校验公共参数
     * @param $paramArray
     * @param $appId
     * @return mixed
     */
    private static function checkPublicParams($paramArray, $appId)
    {
        if (!isset($paramArray['AppId'])) {
            $paramArray['AppId'] = $appId;
        }
        if (!isset($paramArray['Nonce'])) {
            $paramArray['Nonce'] = mt_rand(1,65535);
        }
        if (!isset($paramArray['Timestamp'])) {
            $paramArray['Timestamp'] = time();
        }
        return $paramArray;
    }

    /**
     * 发送请求并接收
     * @param $url
     * @return mixed
     */
    private static function sendRequest($url, $method = 'get', $postData = [])
    {
        if ($method == 'get') {
            // 1. 初始化一个cURL会话
            $ch = curl_init();
            // 2. 设置请求选项, 包括具体的url
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            // 3. 执行一个cURL会话并且获取相关回复
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        } elseif ($method == 'post') {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // post数据
            curl_setopt($ch, CURLOPT_POST, 1);
            // post的变量
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        }
    }

    /**
     * 生成请求url
     * @param $requestPath
     * @param $paramArray
     * @param $appId
     * @param $appSecret
     * @param string $method
     * @return array|string
     */
    public static function generateUrl($requestPath, $paramArray, $appId, $appSecret, $method = 'get')
    {
        $paramArray = self::checkPublicParams($paramArray, $appId);
        $plainText = TakecloudApiSign::makeSignPlainText($requestPath,$paramArray);
        $paramArray['Signature'] = TakecloudApiSign::sign($plainText,$appSecret);
        if ($method == 'get') {
            $url = 'https://' . self::API_HOST . '/' . $requestPath . '?' . http_build_query($paramArray);
            return $url;
        } elseif ($method == 'post') {
            return [
                'url' => 'https://' . self::API_HOST . '/' . $requestPath,
                'postData' => $paramArray
            ];
        }
    }

    /**
     * 发送请求
     * @param $requestPath
     * @param $paramArray
     * @param $appId
     * @param $appSecret
     * @return mixed
     */
    public static function send($requestPath, $paramArray, $appId, $appSecret, $method = 'get')
    {
        $url = self::generateUrl($requestPath,$paramArray,$appId,$appSecret,$method);
        if ($method == 'get') {
            return self::sendRequest($url);
        } else {
            return self::sendRequest($url['url'],'post',$url['postData']);
        }
    }
}