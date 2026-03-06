<?php

namespace QingzeLab\ESignBao\Services;

use QingzeLab\ESignBao\Constants\AuthConstants;
use QingzeLab\ESignBao\Exceptions\ESignBaoException;
use QingzeLab\ESignBao\Http\HttpClient;

/**
 * 实名认证领域服务
 * 基于易签宝官方文档 V3 API
 */
class AuthService
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
     * 获取个人认证&授权页面链接
     * 接口文档: https://open.esign.cn/doc/opendoc/auth3/rx8igf
     *
     * @param array       $psnAuthConfig   个人实名认证配置项
     * @param array|null  $authorizeConfig 个人授权配置项（可选）
     * @param array|null  $redirectConfig  重定向配置项（可选）
     * @param string|null $notifyUrl       异步通知地址（可选）
     * @param string|null $clientType      客户端类型（可选，默认ALL）
     * @return array 包含authUrl和authFlowId
     * @throws ESignBaoException
     */
    public function getPersonAuthUrl(
        array  $psnAuthConfig,
        array  $authorizeConfig = null,
        array  $redirectConfig = null,
        string $notifyUrl = null,
        string $clientType = null
    ): array
    {
        $data = ['psnAuthConfig' => $psnAuthConfig];

        if ($authorizeConfig !== null) {
            $data['authorizeConfig'] = $authorizeConfig;
        }
        if ($redirectConfig !== null) {
            $data['redirectConfig'] = $redirectConfig;
        }
        if ($notifyUrl !== null) {
            $data['notifyUrl'] = $notifyUrl;
        }
        if ($clientType !== null) {
            $data['clientType'] = $clientType;
        }

        return $this->httpClient->post('/v3/psn-auth-url', $data);
    }

    /**
     * 获取机构认证&授权页面链接
     * 接口文档: https://open.esign.cn/doc/opendoc/auth3/kcbdu7
     *
     * @param array       $orgAuthConfig   组织机构认证配置项
     * @param array|null  $authorizeConfig 机构授权配置项（可选）
     * @param string|null $notifyUrl       异步通知地址（可选）
     * @param array|null  $redirectConfig  重定向配置项（可选）
     * @param string|null $clientType      客户端类型（可选，默认ALL）
     * @param string|null $appScheme       App Scheme（可选，用于端外唤起APP）
     * @return array 包含authUrl和authFlowId
     * @throws ESignBaoException
     */
    public function getOrganizationAuthUrl(
        array  $orgAuthConfig,
        array  $authorizeConfig = null,
        array  $redirectConfig = null,
        string $notifyUrl = null,
        string $clientType = null,
        string $appScheme = null
    ): array
    {
        $data = ['orgAuthConfig' => $orgAuthConfig];
        if ($authorizeConfig !== null) {
            $data['authorizeConfig'] = $authorizeConfig;
        }
        if ($notifyUrl !== null) {
            $data['notifyUrl'] = $notifyUrl;
        }
        if ($redirectConfig !== null) {
            $data['redirectConfig'] = $redirectConfig;
        }
        if ($clientType !== null) {
            $data['clientType'] = $clientType;
        }
        if ($appScheme !== null) {
            $data['appScheme'] = $appScheme;
        }

        return $this->httpClient->post('/v3/org-auth-url', $data);
    }

    /**
     * 查询认证授权流程详情
     * 接口文档: https://open.esign.cn/doc/opendoc/auth3/hlrs7s
     *
     * @param string $authFlowId 认证授权流程ID
     * @return array 流程详情
     * @throws ESignBaoException
     */
    public function getAuthFlowDetail(string $authFlowId): array
    {
        return $this->httpClient->get('/v3/auth-flow/' . $authFlowId);
    }

    /**
     * 查询个人认证信息
     * 接口文档: https://open.esign.cn/doc/opendoc/auth3/vssvtu
     *
     * @param string|null $psnId         个人账号ID
     * @param string|null $psnAccount    个人账号标识（手机号或邮箱）
     * @param string|null $psnIDCardNum  个人证件号
     * @param string|null $psnIDCardType 证件类型，默认 AuthConstants::CRED_PSN_CH_IDCARD
     *                                   可选值:
     *                                   - AuthConstants::CRED_PSN_CH_IDCARD (中国大陆居民身份证)
     *                                   - AuthConstants::CRED_PSN_CH_HONGKONG (香港来往大陆通行证)
     *                                   - AuthConstants::CRED_PSN_CH_MACAO (澳门来往大陆通行证)
     *                                   - AuthConstants::CRED_PSN_CH_TWCARD (台湾来往大陆通行证)
     *                                   - AuthConstants::CRED_PSN_PASSPORT (护照)
     * @return array 认证信息
     * @throws ESignBaoException
     */
    public function getPersonIdentityInfo(
        string $psnId = null,
        string $psnAccount = null,
        string $psnIDCardNum = null,
        string $psnIDCardType = null
    ): array
    {
        if ($psnIDCardType === null) {
            $psnIDCardType = AuthConstants::CRED_PSN_CH_IDCARD;
        }

        $params = [];

        if ($psnId !== null) {
            $params['psnId'] = $psnId;
        }
        if ($psnAccount !== null) {
            $params['psnAccount'] = $psnAccount;
        }
        if ($psnIDCardNum !== null) {
            $params['psnIDCardNum']  = $psnIDCardNum;
            $params['psnIDCardType'] = $psnIDCardType;
        }

        if (empty($params)) {
            throw new ESignBaoException('必须提供 psnId、psnAccount 或 psnIDCardNum 中的至少一个参数');
        }

        return $this->httpClient->get('/v3/persons/identity-info', $params);
    }

    /**
     * 查询组织机构认证信息
     *
     * @param string|null $orgId        机构账号ID
     * @param string|null $orgIDCardNum 统一社会信用代码
     * @return array 认证信息
     * @throws ESignBaoException
     */
    public function getOrganizationIdentityInfo(
        string $orgId = null,
        string $orgIDCardNum = null
    ): array
    {
        $params = [];

        if ($orgId !== null) {
            $params['orgId'] = $orgId;
        }
        if ($orgIDCardNum !== null) {
            $params['orgIDCardNum'] = $orgIDCardNum;
        }

        if (empty($params)) {
            throw new ESignBaoException('必须提供 orgId 或 orgIDCardNum 中的至少一个参数');
        }

        return $this->httpClient->get('/v3/organizations/identity-info', $params);
    }

    /**
     * 个人核身（刷脸认证）
     * 接口文档: https://open.esign.cn/doc/opendoc/identity_service/wbsb6y
     *
     * @param string $name         姓名
     * @param string $idNo         证件号
     * @param string $faceauthMode 刷脸认证方式 (ZHIMACREDIT, TENCENT, ESIGN, WE_CHAT_FACE, PSN_AUDIO_VIDEO_ESIGN)
     * @param string $callbackUrl  认证完成后重定向地址
     * @param array  $options      可选参数
     *                             - certType: 证件类型，默认 INDIVIDUAL_CH_IDCARD
     *                             - faceInterfaceType: 刷脸对接方式，默认 H5
     *                             - resultPage: 是否展示结果页，默认 0 (不展示)
     *                             - contextId: 自定义业务标识
     *                             - notifyUrl: 异步通知地址
     *                             - config: 认证配置项 (array)
     *                             - mobileNo: 手机号
     *                             - certificationPurpose: 实名用途，默认 INDIVIDUAL
     *                             - orgName: 企业名称
     *                             - orgCertNo: 企业证件号
     * @return array
     * @throws ESignBaoException
     */
    public function individualFaceAuth(string $name, string $idNo, string $faceauthMode, string $callbackUrl, array $options = []): array
    {
        $data = [
            'name'         => $name,
            'idNo'         => $idNo,
            'faceauthMode' => $faceauthMode,
            'callbackUrl'  => $callbackUrl,
        ];

        // 可选参数映射
        $optionalFields = [
            'certType',
            'faceInterfaceType',
            'resultPage',
            'contextId',
            'notifyUrl',
            'config',
            'mobileNo',
            'certificationPurpose',
            'orgName',
            'orgCertNo',
        ];

        foreach ($optionalFields as $field) {
            if (isset($options[$field])) {
                $data[$field] = $options[$field];
            }
        }

        return $this->httpClient->post('/v2/identity/auth/api/individual/face', $data);
    }

    /**
     * 查询个人刷脸状态
     * 接口文档: https://open.esign.cn/doc/opendoc/paas_api/za7u0cs4vwt5ilyx
     *
     * @param string $flowId 刷脸认证流程ID
     * @return array
     * @throws ESignBaoException
     */
    public function getPersonFaceAuthStatus(string $flowId): array
    {
        return $this->httpClient->get("/v2/identity/auth/pub/individual/{$flowId}/face");
    }

    /**
     * 个人运营商3要素信息比对
     * 接口文档: https://open.esign.cn/doc/opendoc/identity_service/cgs6ee
     *
     * @param string $idNo     身份证号（大陆二代身份证）
     * @param string $name     姓名
     * @param string $mobileNo 手机号（中国大陆3大运营商）
     * @return array
     * @throws ESignBaoException
     */
    public function verifyTelecom3Factors(string $idNo, string $name, string $mobileNo): array
    {
        $data = [
            'idNo'     => $idNo,
            'name'     => $name,
            'mobileNo' => $mobileNo,
        ];

        return $this->httpClient->post('/v2/identity/verify/individual/telecom3Factors', $data);
    }
}
