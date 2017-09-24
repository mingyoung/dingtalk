<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Attendance;

use EasyDingTalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @param array  $userIds
     * @param string $from
     * @param string $to
     *
     * @return array
     */
    public function record(array $userIds, string $from, string $to)
    {
        return $this->httpPostJson('attendance/listRecord', [
            'userIds' => $userIds,
            'checkDateFrom' => $from,
            'checkDateTo' => $to,
        ]);
    }

    /**
     * @param string $userId
     * @param string $from
     * @param string $to
     *
     * @return array
     */
    public function list(string $userId, string $from, string $to)
    {
        return $this->httpPostJson('attendance/list', [
            'userId' => $userId,
            'workDateFrom' => $from,
            'workDateTo' => $to,
        ]);
    }
}
