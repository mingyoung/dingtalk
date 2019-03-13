<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Blackboard;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取用户公告数据
     *
     * @param string $userid
     *
     * @return mixed
     */
    public function list($userid)
    {
        return $this->client->postJson('topapi/blackboard/listtopten', compact('userid'));
    }
}
