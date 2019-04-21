<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Health;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取用户钉钉运动开启状态
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function status($userId)
    {
        return $this->client->postJson('topapi/health/stepinfo/getuserstatus', ['userid' => $userId]);
    }

    /**
     * 获取个人钉钉运动数据
     *
     * @param string $id
     * @param string $dates
     *
     * @return mixed
     */
    public function byUser($id, $dates)
    {
        return $this->client->postJson('topapi/health/stepinfo/list', ['type' => 0, 'object_id' => $id, 'stat_dates' => $dates]);
    }

    /**
     * 获取部门钉钉运动数据
     *
     * @param string $id
     * @param string $dates
     *
     * @return mixed
     */
    public function byDepartment($id, $dates)
    {
        return $this->client->postJson('topapi/health/stepinfo/list', ['type' => 1, 'object_id' => $id, 'stat_dates' => $dates]);
    }

    /**
     * 批量获取钉钉运动数据
     *
     * @param array  $userIds
     * @param string $date
     *
     * @return mixed
     */
    public function byUsers(array $userIds, $date)
    {
        $userIds = implode(',', $userIds);

        return $this->client->postJson('topapi/health/stepinfo/listbyuserid', ['userids' => $userIds, 'stat_date' => $date]);
    }
}
