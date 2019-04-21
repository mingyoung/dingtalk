<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Microapp;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取应用列表
     *
     * @return mixed
     */
    public function list()
    {
        return $this->client->postJson('microapp/list');
    }

    /**
     * 获取员工可见的应用列表
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function listByUserId($userId)
    {
        return $this->client->get('microapp/list_by_userid', [
            'userid' => $userId,
        ]);
    }

    /**
     * 获取应用的可见范围
     *
     * @param int $agentId
     *
     * @return mixed
     */
    public function getVisibility($agentId)
    {
        return $this->client->postJson('microapp/visible_scopes', compact('agentId'));
    }

    /**
     * 设置应用的可见范围
     *
     * @param array $params
     *
     * @return mixed
     */
    public function setVisibility($params)
    {
        return $this->client->postJson('microapp/set_visible_scopes', $params);
    }
}
