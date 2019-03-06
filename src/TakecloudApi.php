<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/2/9
 * Time: 14:46
 */
// 目录入口
define('TAKECLOUDAPI_ROOT_PATH', dirname(__FILE__));
require_once TAKECLOUDAPI_ROOT_PATH . '/Common/TakecloudApiBase.php';

class TakecloudApi extends TakecloudApiBase
{
    /**
     * 生成请求的URL，不发起请求
     * @param $path  string 请求路径
     * @param $params  array 请求参数
     * @return string
     */
    public function generateUrl($path, $params = [])
    {
        require_once TAKECLOUDAPI_ROOT_PATH . '/Common/TakecloudApiRequest.php';
        return TakecloudApiRequest::generateUrl($path, $params, $this->_appId, $this->_appSecret);
    }

    /**
     * 生成请求的URL，发起请求
     * @param $path  string 请求路径
     * @param $params  array 请求参数
     * @return mixed
     */
    public function send($path, $params = [], $method = 'get')
    {
        require_once TAKECLOUDAPI_ROOT_PATH . '/Common/TakecloudApiRequest.php';
        return TakecloudApiRequest::send($path, $params, $this->_appId, $this->_appSecret,$method);
    }
}