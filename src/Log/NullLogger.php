<?php

namespace QingzeLab\ESignBao\Log;

/**
 * Class NullLogger
 *
 * 空日志器，不记录任何日志。
 */
final class NullLogger implements LoggerInterface
{
    /**
     * 记录信息级日志。
     *
     * @param string               $message 日志消息
     * @param array<string, mixed> $context 上下文数据
     *
     * @return void
     */
    public function info(string $message, array $context = [])
    {
        // Do nothing.
    }

    /**
     * 记录错误级日志。
     *
     * @param string               $message 日志消息
     * @param array<string, mixed> $context 上下文数据
     *
     * @return void
     */
    public function error(string $message, array $context = [])
    {
        // Do nothing.
    }
}
