<?php

namespace QingzeLab\ESignBao\Constants;

/**
 * 认证相关常量
 */
class AuthConstants
{
    // 个人核身认证方式
    public const INDIV_AUTH_TYPE_PSN_BANK4_AUTHCODE     = 'PSN_BANK4_AUTHCODE';     // 银行卡四要素认证
    public const INDIV_AUTH_TYPE_PSN_TELECOM_AUTHCODE   = 'PSN_TELECOM_AUTHCODE';   // 运营商三要素认证
    public const INDIV_AUTH_TYPE_PSN_FACEAUTH_BYURL     = 'PSN_FACEAUTH_BYURL';     // 刷脸认证
    public const INDIV_AUTH_TYPE_PSN_AUDIO_VIDEO_ESIGN  = 'PSN_AUDIO_VIDEO_ESIGN';  // 智能视频认证

    // 个人核身来源
    public const INDIV_AUTH_ORIGIN_BROWSER = 'BROWSER'; // 浏览器
    public const INDIV_AUTH_ORIGIN_APP     = 'APP';     // 移动端 APP

    // 刷脸认证方式
    public const FACE_AUTH_MODE_ZHIMACREDIT           = 'ZHIMACREDIT';           // 支付宝刷脸
    public const FACE_AUTH_MODE_TENCENT               = 'TENCENT';               // 腾讯云刷脸
    public const FACE_AUTH_MODE_ESIGN                 = 'ESIGN';                 // 快捷刷脸
    public const FACE_AUTH_MODE_WE_CHAT_FACE          = 'WE_CHAT_FACE';          // 微信小程序刷脸
    public const FACE_AUTH_MODE_PSN_AUDIO_VIDEO_ESIGN = 'PSN_AUDIO_VIDEO_ESIGN'; // 智能视频认证

    // 证件类型
    public const CERT_TYPE_INDIVIDUAL_CH_IDCARD                    = 'INDIVIDUAL_CH_IDCARD';                  // 中国大陆身份证
    public const CERT_TYPE_INDIVIDUAL_CH_TWCARD                    = 'INDIVIDUAL_CH_TWCARD';                  // 台湾来往大陆通行证
    public const CERT_TYPE_INDIVIDUAL_CH_HONGKONG_MACAO            = 'INDIVIDUAL_CH_HONGKONG_MACAO';          // 港澳来往大陆通行证
    public const CERT_TYPE_INDIVIDUAL_CH_RESIDENCE_PERMIT_HK_MO_TW = 'INDIVIDUAL_CH_RESIDENCE_PERMIT_HK_MO_TW'; // 港澳台居民居住证
    public const CERT_TYPE_INDIVIDUAL_CH_GREEN_CARD                = 'INDIVIDUAL_CH_GREEN_CARD';              // 外国人永久居留身份证

    // 个人账号证件类型 (用于查询个人认证信息等接口)
    public const CRED_PSN_CH_IDCARD   = 'CRED_PSN_CH_IDCARD';   // 中国大陆居民身份证
    public const CRED_PSN_CH_HONGKONG = 'CRED_PSN_CH_HONGKONG'; // 香港来往大陆通行证
    public const CRED_PSN_CH_MACAO    = 'CRED_PSN_CH_MACAO';    // 澳门来往大陆通行证
    public const CRED_PSN_CH_TWCARD   = 'CRED_PSN_CH_TWCARD';   // 台湾来往大陆通行证
    public const CRED_PSN_PASSPORT    = 'CRED_PSN_PASSPORT';    // 护照
}
