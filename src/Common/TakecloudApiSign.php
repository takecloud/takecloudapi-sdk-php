<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/2/9
 * Time: 15:38
 */

class TakecloudApiSign
{
    /**
     * 生成签名
     * @param $srcStr
     * @param $appSecret
     * @return string
     */
    public static function sign($srcStr, $appSecret)
    {
        $retStr = base64_encode(hash_hmac('sha1', $srcStr, $appSecret, true));
        return $retStr;
    }

    /**
     * 生成拼接签名源文字符串
     * @param $requestPath
     * @param $requestParams
     * @return string
     */
    public static function makeSignPlainText($requestPath, $requestParams)
    {
        $paramStr = self::_buildParamStr($requestParams);
        $plainText = $requestPath . $paramStr;
        return $plainText;
    }

    /**
     * 拼接参数
     * @param $requestParams
     * @return string
     */
    protected static function _buildParamStr($requestParams)
    {
        $paramStr = '';
        ksort($requestParams,SORT_STRING);
        $i = 0;
        foreach ($requestParams as $key => $value) {
            // 把 参数中的 _ 替换成 .
            if (strpos($key, '_'))
            {
                $key = str_replace('_', '.', $key);
            }
            if ($i == 0)
            {
                $paramStr .= '?';
            } else {
                $paramStr .= '&amp;';
            }
            $paramStr .= $key . '=' . $value;
            ++$i;
        }
        return $paramStr;
    }
}