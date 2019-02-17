<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Role;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取角色列表
     *
     * @param int $offset
     * @param int $size
     *
     * @return mixed
     */
    public function list($offset = null, $size = null)
    {
        return $this->client->postJson('topapi/role/list', compact('offset', 'size'));
    }

    /**
     * 获取角色下的员工列表
     *
     * @param int $roleId
     * @param int $offset
     * @param int $size
     *
     * @return mixed
     */
    public function getUsers($roleId, $offset = null, $size = null)
    {
        return $this->client->postJson('topapi/role/simplelist', compact('offset', 'size') + ['role_id' => $roleId]);
    }

    /**
     * 获取角色组
     *
     * @param int $groupId
     *
     * @return mixed
     */
    public function getGroups($groupId)
    {
        return $this->client->postJson('topapi/role/getrolegroup', ['group_id' => $groupId]);
    }

    /**
     * 获取角色详情
     *
     * @param int $roleId
     *
     * @return mixed
     */
    public function get($roleId)
    {
        return $this->client->postJson('topapi/role/getrole', compact('roleId'));
    }

    /**
     * 创建角色
     *
     * @param int    $groupId
     * @param string $roleName
     *
     * @return mixed
     */
    public function create($groupId, $roleName)
    {
        return $this->client->postJson('role/add_role', compact('groupId', 'roleName'));
    }

    /**
     * 更新角色
     *
     * @param int    $roleId
     * @param string $roleName
     *
     * @return mixed
     */
    public function update($roleId, $roleName)
    {
        return $this->client->postJson('role/update_role', compact('roleId', 'roleName'));
    }

    /**
     * 删除角色
     *
     * @param int $roleId
     *
     * @return mixed
     */
    public function delete($roleId)
    {
        return $this->client->postJson('topapi/role/deleterole', ['role_id' => $roleId]);
    }

    /**
     * 创建角色组
     *
     * @param string $name
     *
     * @return mixed
     */
    public function createGroup($name)
    {
        return $this->client->postJson('role/add_role_group', compact('name'));
    }
}
