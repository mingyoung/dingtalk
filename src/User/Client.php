<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\User;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取用户详情
     *
     * @param string      $userid
     * @param string|null $lang
     *
     * @return mixed
     */
    public function get($userid, $lang = null)
    {
        return $this->app['client']->get('user/get', compact('userid', 'lang'));
    }

    /**
     * 获取部门用户 Userid 列表
     *
     * @param int $departmentId
     *
     * @return mixed
     */
    public function getUserIds($departmentId)
    {
        return $this->app['client']->get('user/getDeptMember', ['deptId' => $departmentId]);
    }

    /**
     * 获取部门用户
     *
     * @param int    $departmentId
     * @param int    $offset
     * @param int    $size
     * @param string $order
     * @param string $lang
     *
     * @return mixed
     */
    public function getUsers($departmentId, $offset, $size, $order = null, $lang = null)
    {
        return $this->app['client']->get('user/simplelist', [
            'department_id' => $departmentId, 'offset' => $offset, 'size' => $size, 'order' => $order, 'lang' => $lang,
        ]);
    }

    /**
     * 获取部门用户详情
     *
     * @param int    $departmentId
     * @param int    $offset
     * @param int    $size
     * @param string $order
     * @param string $lang
     *
     * @return mixed
     */
    public function getDetailedUsers($departmentId, $offset, $size, $order = null, $lang = null)
    {
        return $this->app['client']->get('user/listbypage', [
            'department_id' => $departmentId, 'offset' => $offset, 'size' => $size, 'order' => $order, 'lang' => $lang,
        ]);
    }

    /**
     * 获取管理员列表
     *
     * @return mixed
     */
    public function administrators()
    {
        return $this->app['client']->get('user/get_admin');
    }

    /**
     * 获取管理员通讯录权限范围
     *
     * @param string $userid
     *
     * @return mixed
     */
    public function administratorScope($userid)
    {
        return $this->app['client']->get('topapi/user/get_admin_scope', compact('userid'));
    }

    /**
     * 根据unionid获取userid
     *
     * @param string $unionid
     *
     * @return mixed
     */
    public function getUseridByUnionid($unionid)
    {
        return $this->app['client']->get('user/getUseridByUnionid', compact('unionid'));
    }

    /**
     * 创建用户
     *
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->app['client']->postJson('user/create', $params);
    }

    /**
     * 更新用户
     *
     * @param string $userid
     * @param array  $params
     *
     * @return mixed
     */
    public function update($userid, array $params)
    {
        return $this->app['client']->postJson('user/update', compact('userid') + $params);
    }

    /**
     * 删除用户
     *
     * @param $userid
     *
     * @return mixed
     */
    public function delete($userid)
    {
        return $this->app['client']->get('user/delete', compact('userid'));
    }

    /**
     * 企业内部应用免登获取用户userid
     *
     * @param string $unionid
     *
     * @return mixed
     */
    public function getuserinfobyCode($code)
    {
        return $this->app['client']->get('user/getuserinfo', compact('code'));
    }
}
