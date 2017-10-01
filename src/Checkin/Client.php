<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Checkin;

use EasyDingTalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @param string $departmentId
     * @param int    $start
     * @param array  $params
     *
     * @return array
     */
    public function record($departmentId, int $start, array $params = [])
    {
        return $this->httpGet('checkin/record', [
            'department_id' => $departmentId,
            'start_time' => $start,
        ] + $params);
    }
}
