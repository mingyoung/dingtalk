<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Kernel\Support;

/**
 * @param int $length
 *
 * @return string
 */
function str_random($length = 16): string
{
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
}

/**
 * @return string
 */
function current_url(): string
{
    $protocol = 'http://';

    if (! empty($_SERVER['HTTPS']) || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'http') === 'https') {
        $protocol = 'https://';
    }

    return $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}
