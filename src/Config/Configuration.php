<?php

namespace QingzeLab\ESignBao\Config;

use QingzeLab\ESignBao\Log\LoggerInterface;
use QingzeLab\ESignBao\Log\NullLogger;

/**
 * 易签宝配置类
 */
class Configuration
{
    /**
     * @var string 应用ID
     */
    private $appId;

    /**
     * @var string 应用密钥
     */
    private $appSecret;

    /**
     * @var string 接口地址
     */
    private $apiBaseUrl;

    /**
     * @var int 请求超时时间
     */
    private $timeout = 30;

    /**
     * @var float 连接超时时间（秒）
     */
    private $connectTimeout = 2.0;

    /**
     * @var bool 是否沙箱环境
     */
    private $sandbox = false;

    /**
     * @var int 重试次数
     */
    private $maxRetries = 3;

    /**
     * @var array 重试状态码
     */
    private $retryStatusCodes = [408, 429, 500, 502, 503, 504];

    /**
     * @var int 重试基础延迟（毫秒）
     */
    private $retryDelayMs = 200;

    /**
     * @var LoggerInterface 日志器
     */
    private $logger;

    /**
     * 构造函数
     *
     * @param string $appId      应用ID
     * @param string $appSecret  应用密钥
     * @param string $apiBaseUrl 接口地址（默认正式环境）
     */
    public function __construct($appId, $appSecret, $apiBaseUrl = 'https://openapi.esign.cn')
    {
        $this->appId      = $appId;
        $this->appSecret  = $appSecret;
        $this->apiBaseUrl = rtrim($apiBaseUrl, '/');
        $this->logger     = new NullLogger();

        // 简单判断是否为沙箱环境，用于辅助逻辑
        if (strpos($this->apiBaseUrl, 'smlopenapi') !== false) {
            $this->sandbox = true;
        }
    }

    /**
     * 设置请求超时时间
     * @param int $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * 设置连接超时时间
     * @param float $connectTimeout
     * @return $this
     */
    public function setConnectTimeout($connectTimeout)
    {
        $this->connectTimeout = $connectTimeout;
        return $this;
    }

    /**
     * 设置最大重试次数
     * @param int $maxRetries
     * @return $this
     */
    public function setMaxRetries($maxRetries)
    {
        $this->maxRetries = $maxRetries;
        return $this;
    }

    /**
     * 设置重试延迟
     * @param int $retryDelayMs
     * @return $this
     */
    public function setRetryDelayMs($retryDelayMs)
    {
        $this->retryDelayMs = $retryDelayMs;
        return $this;
    }

    /**
     * 设置日志器
     * @param LoggerInterface $logger
     * @return $this
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }

    // Getters

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * @return string
     */
    public function getApiBaseUrl()
    {
        return $this->apiBaseUrl;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @return float
     */
    public function getConnectTimeout()
    {
        return $this->connectTimeout;
    }

    /**
     * @return bool
     */
    public function isSandbox()
    {
        return $this->sandbox;
    }

    /**
     * @return int
     */
    public function getMaxRetries()
    {
        return $this->maxRetries;
    }

    /**
     * @return array
     */
    public function getRetryStatusCodes()
    {
        return $this->retryStatusCodes;
    }

    /**
     * @return int
     */
    public function getRetryDelayMs()
    {
        return $this->retryDelayMs;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
