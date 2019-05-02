<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Auth;

use EasyDingTalk\Kernel\Http\Client;

class SsoClient extends Client
{
    /**
     * 获取应用后台免登 AccessToken
     *
     * @return mixed
     */
    public function getToken()
    {
        return $this->get('sso/gettoken', [
            'corpid' => $this->app['config']->get('corp_id'),
            'corpsecret' => $this->app['config']->get('sso_secret'),
        ]);
    }

    /**
     * 获取用户身份信息
     *
     * @return mixed
     */
    public function user()
    {
        return $this->get('sso/getuserinfo', [
            'access_token' => $this->getToken()['access_token'],
            'code' => $this->app['request']->get('code'),
        ]);
    }
}
