<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) baijunyao <baijunyao@baijunyao.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Microapp;

use EasyDingTalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author baijunyao <baijunyao@baijunyao.com>
 */
class Client extends BaseClient
{
    /**
     * Create a new microapp.
     *
     * @param array $params
     *
     * @return array
     */
    public function create(array $params)
    {
        return $this->httpPostJson('microapp/create', $params);
    }

    /**
     * Update an exist microapp.
     *
     * @param array $params
     *
     * @return array
     */
    public function update(array $params)
    {
        return $this->httpPostJson('microapp/update', $params);
    }

    /**
     * @param int $agentId
     *
     * @return array
     */
    public function delete(int $agentId)
    {
        $params = [
            'agentId' => $agentId
        ];
        return $this->httpPostJson('microapp/delete', $params);
    }

    /**
     * @return mixed
     */
    public function list()
    {
        return $this->httpPostJson('microapp/list');
    }

    /**
     * @param $userId
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function listByUserid($userId)
    {
        return $this->httpGet('microapp/list_by_userid', [
                'userid' => $userId,
            ]);
    }

    /**
     * @return mixed
     */
    public function visibleScopes($agentId)
    {
        $params = [
            'agentId' => $agentId
        ];
        return $this->httpPostJson('microapp/visible_scopes', $params);
    }

    /**
     * @return mixed
     */
    public function setVisibleScopes($params)
    {
        return $this->httpPostJson('microapp/set_visible_scopes', $params);
    }

}
