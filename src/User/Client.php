<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\User;

use EasyDingTalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @param string $userId
     *
     * @return array
     */
    public function get(string $userId)
    {
        return $this->httpGet('user/get', ['userid' => $userId]);
    }

    /**
     * Create a new user.
     *
     * @param array $params
     *
     * @return array
     */
    public function create(array $params)
    {
        return $this->http->json('user/create', $params);
    }

    /**
     * Update an exist user.
     *
     * @param array $params
     *
     * @return array
     */
    public function update(array $params)
    {
        return $this->http->json('user/update', $params);
    }

    /**
     * @param array|string $userId
     *
     * @return array
     */
    public function delete($userId)
    {
        if (is_array($userId)) {
            return $this->http->json('user/batchdelete', ['useridlist' => $userId]);
        }

        return $this->httpGet('user/delete', $userId);
    }

    /**
     * @param int   $departmentId
     * @param array $params
     *
     * @return array
     */
    public function simpleList(int $departmentId, array $params = [])
    {
        return $this->httpGet('user/simplelist', [
            'department_id' => $departmentId,
        ] + $params);
    }

    /**
     * @param int   $departmentId
     * @param int   $size
     * @param int   $offset
     * @param array $params
     *
     * @return array
     */
    public function list(int $departmentId, int $size, int $offset, array $params = [])
    {
        return $this->httpGet('user/list', [
            'department_id' => $departmentId,
            'offset' => $offset,
            'size' => $size,
        ] + $params);
    }

    /**
     * @return array
     */
    public function admin()
    {
        return $this->httpGet('user/get_admin');
    }

    /**
     * UnionId to userId.
     *
     * @param string $unionId
     *
     * @return array
     */
    public function toUserId(string $unionId)
    {
        return $this->httpGet('user/getUseridByUnionid', [
            'unionid' => $unionId,
        ]);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function count(array $params)
    {
        return $this->httpGet('user/get_org_user_count', $params);
    }
}
