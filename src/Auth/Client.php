<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Auth;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * @return array
     */
    public function scopes()
    {
        return $this->httpGet('auth/scopes');
    }
}
