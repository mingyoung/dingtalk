<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Scope;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取通讯录权限范围
     *
     *
     * @return mixed
     */
    public function list()
    {
        return $this->client->get('auth/scopes');
    }
}
