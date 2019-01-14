<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Calendar;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 创建日程
     *
     * @param array $params
     *
     * @return mixed
     */
    public function create($params)
    {
        return $this->client->postJson('topapi/calendar/create', $params);
    }
}
