<?php

namespace QingzeLab\ESignBao\Exceptions;

use Exception;

/**
 * 易签宝异常类
 */
class ESignBaoException extends Exception
{
    /**
     * API响应数据
     * @var array|null
     */
    private $response;

    /**
     * 构造函数
     *
     * @param string         $message
     * @param int            $code
     * @param array|null     $response
     * @param Exception|null $previous
     */
    public function __construct($message = "", $code = 0, $response = null, $previous = null)
    {
        // 确保 code 是整数
        $intCode = is_numeric($code) ? (int)$code : 0;
        
        parent::__construct($message, $intCode, $previous);
        $this->response = $response;
    }

    /**
     * 获取API响应数据
     * @return array|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}
