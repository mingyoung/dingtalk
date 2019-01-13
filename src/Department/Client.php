<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Department;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    private $client;

    /**
     * Client constructor.
     *
     * @param \EasyDingTalk\Application $app
     */
    public function __construct($app)
    {
        parent::__construct($app);
        $this->client = $this->app['client'];
    }

    /**
     * 获取子部门ID列表
     *
     * @param string $id 部门ID
     *
     * @return mixed
     */
    public function getSubDepartIds($id)
    {
        return $this->client->get('department/list_ids', compact('id'));
    }

    /**
     * 获取部门列表
     *
     * @param bool   $isFetchChild
     * @param string $id
     * @param string $lang
     *
     * @return mixed
     */
    public function getDepartments($isFetchChild = false, $id = null, $lang = null)
    {
        return $this->client->get('department/list',
            compact('id', 'lang') + ['fetch_child' => $isFetchChild]);
    }

    /**
     * 获取部门详情
     *
     * @param string $id
     * @param string $lang
     *
     * @return mixed
     */
    public function get($id, $lang = null)
    {
        return $this->client->get('department/get', compact('id', 'lang'));
    }

    /**
     * 查询部门的所有上级父部门路径
     *
     * @param string $id
     *
     * @return mixed
     */
    public function getParentsByDepartment($id)
    {
        return $this->client->get('department/list_parent_depts_by_dept', compact('id'));
    }

    /**
     * 查询指定用户的所有上级父部门路径
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function getParentsByUser($userId)
    {
        return $this->client->get('department/list_parent_depts', compact('userId'));
    }

    /**
     * 获取企业员工人数
     *
     * @param int $onlyActive
     *
     * @return mixed
     */
    public function getUserCount($onlyActive = 0)
    {
        return $this->client->get('department/get_org_user_count', compact('onlyActive'));
    }

    /**
     * 创建部门
     *
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->client->postJson('department/create', $params);
    }

    /**
     * 更新部门
     *
     * @param string $id
     * @param array  $params
     *
     * @return mixed
     */
    public function update($id, array $params)
    {
        return $this->client->postJson('department/update', compact('id') + $params);
    }

    /**
     * 删除部门
     *
     * @param string $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->client->postJson('department/delete', compact('id'));
    }
}
