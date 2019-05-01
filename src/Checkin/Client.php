<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Checkin;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取部门用户签到记录
     *
     * @param array $params
     *
     * @return mixed
     */
    public function records($params)
    {
        return $this->client->get('checkin/record', $params);
    }

    /**
     * 获取用户签到记录
     *
     * @param array $params
     *
     * @return mixed
     */
    public function get($params)
    {
        return $this->client->postJson('topapi/checkin/record/get', $params);
    }
}
