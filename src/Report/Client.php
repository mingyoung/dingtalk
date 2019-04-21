<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Report;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取用户日志数据
     *
     * @param array $params
     *
     * @return mixed
     */
    public function list($params)
    {
        return $this->client->postJson('topapi/report/list', $params);
    }

    /**
     * 获取用户可见的日志模板
     *
     * @param string|null $userId
     * @param int         $offset
     * @param int         $size
     *
     * @return mixed
     */
    public function templates($userId = null, $offset = 0, $size = 100)
    {
        return $this->client->postJson('topapi/report/template/listbyuserid', [
            'userid' => $userId, 'offset' => $offset, 'size' => $size,
        ]);
    }

    /**
     * 获取用户日志未读数
     *
     * @param string $userid
     *
     * @return mixed
     */
    public function unreadCount($userid)
    {
        return $this->client->postJson('topapi/report/getunreadcount', compact('userid'));
    }
}
