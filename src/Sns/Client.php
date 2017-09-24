<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Sns;

use EasyDingTalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    public function token()
    {
        return $this->httpGet('sns/gettoken', [
            'appid' => '',
            'appsecret' => '',
        ]);
    }

    public function persistentCode(string $authCode)
    {
        return $this->httpPostJson('sns/get_persistent_code', [
            'tmp_auth_code' => $authCode,
        ]);
    }

    public function snsToken(string $openId, string $persistentCode)
    {
        return $this->httpPostJson('sns/get_sns_token', [
            'openid' => $openId,
            'persistent_code' => $persistentCode,
        ]);
    }

    public function userInfo(string $snsToken)
    {
        return $this->httpGet('sns/getuserinfo', [
            'sns_token' => $snsToken,
        ]);
    }
}
