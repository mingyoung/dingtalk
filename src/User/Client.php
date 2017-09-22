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

use EasyDingTalk\Kernel\Client as BaseClient;

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

    public function create(array $data)
    {
        return $this->http->json('user/create', $data);
    }

    public function update(array $data)
    {
        return $this->http->json('user/update', $data);
    }

    public function delete($userId)
    {
        if (is_array($userId)) {
            return $this->http->json('user/batchdelete', ['useridlist' => $userId]);
        }

        return $this->httpGet('user/delete', $userId);
    }

    public function simpleList(int $departmentId)
    {
        return $this->httpGet('user/simplelist', [
            'department_id' => $departmentId,
        ]);
    }

    public function list(int $departmentId, int $offset, int $size)
    {
        return $this->httpGet('user/list', [
            'department_id' => $departmentId,
            'offset' => $offset,
            'size' => $size,
        ]);
    }

    public function admin()
    {
        return $this->httpGet('user/get_admin');
    }

    public function userId($unionId)
    {
        return $this->httpGet('user/getUseridByUnionid', [
            'unionid' => $unionId,
        ]);
    }

    public function count(bool $isActive = true)
    {
        return $this->httpGet('user/get_org_user_count', ['onlyActive' => (int) $isActive]);
    }
}
