<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Schedule;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 发起待办
     *
     * @param array $params
     *
     * @return mixed
     */
    public function add($params)
    {
        return $this->client->postJson('topapi/workrecord/add', $params);
    }

    /**
     * 更新待办
     *
     * @param string $userId
     * @param string $recordId
     *
     * @return mixed
     */
    public function update($userId, $recordId)
    {
        return $this->client->postJson('topapi/workrecord/update', ['userid' => $userId, 'record_id' => $recordId]);
    }

    /**
     * 获取用户待办事项
     *
     * @param string $userId
     * @param bool   $completed
     * @param int    $offset
     * @param int    $limit
     *
     * @return mixed
     */
    public function list($userId, $completed, $offset, $limit)
    {
        return $this->client->postJson('topapi/workrecord/getbyuserid', [
            'userid' => $userId,
            'status' => (int) $completed,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }
}
