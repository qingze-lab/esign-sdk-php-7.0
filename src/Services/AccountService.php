<?php

namespace QingzeLab\ESignBao\Services;

use QingzeLab\ESignBao\Exceptions\ESignBaoException;
use QingzeLab\ESignBao\Http\HttpClient;

/**
 * 账号服务
 * 基于易签宝官方文档 V3 API
 */
class AccountService
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * 解绑e签宝SaaS账号登录凭证
     * 接口文档: https://open.esign.cn/doc/opendoc/account_3/smelh6m20a5fizu2
     * 接口路径: POST /v3/account-unbind-url
     *
     * @param string      $account      用户登录凭证：手机号或邮箱
     * @param bool        $hideTopBar   是否隐藏顶部通栏，默认：false
     * @param string|null $redirectUrl  账号解绑后页面重定向跳转地址
     * @param string|null $customBizNum 自定义业务编码
     * @return array 包含accountUnbindUrl和accountUnbindShortUrl
     * @throws ESignBaoException
     */
    public function getUnbindUrl(
        string $account,
        bool   $hideTopBar = false,
        string $redirectUrl = null,
        string $customBizNum = null
    ): array
    {
        $data = [
            'account'    => $account,
            'hideTopBar' => $hideTopBar,
        ];

        if ($redirectUrl !== null) {
            $data['redirectUrl'] = $redirectUrl;
        }

        if ($customBizNum !== null) {
            $data['customBizNum'] = $customBizNum;
        }

        return $this->httpClient->post('/v3/account-unbind-url', $data);
    }
}
