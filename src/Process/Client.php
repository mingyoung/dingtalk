<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Process;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 发起审批实例
     *
     * @param array $params
     *
     * @return mixed
     */
    public function create($params)
    {
        return $this->client->postJson('topapi/processinstance/create', $params);
    }

    /**
     * 批量获取审批实例 ID
     *
     * @param array $params
     *
     * @return mixed
     */
    public function getIds($params)
    {
        return $this->client->postJson('topapi/processinstance/listids', $params);
    }

    /**
     * 获取单个审批实例
     *
     * @param string $id
     *
     * @return mixed
     */
    public function get($id)
    {
        return $this->client->postJson('topapi/processinstance/get', ['process_instance_id' => $id]);
    }

    /**
     * 获取用户待审批数量
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function count($userId)
    {
        return $this->client->postJson('topapi/process/gettodonum', ['userid' => $userId]);
    }

    /**
     * 获取用户可见的审批模板
     *
     * @param string|null $userId
     * @param int         $offset
     * @param int         $size
     *
     * @return mixed
     */
    public function listByUserId($userId = null, $offset = 0, $size = 100)
    {
        return $this->client->postJson('topapi/process/listbyuserid', ['userid' => $userId, 'offset' => $offset, 'size' => $size]);
    }
}
