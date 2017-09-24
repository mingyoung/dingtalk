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
     * @param string      $departmentId
     * @param int         $start
     * @param int|null    $end
     * @param int|null    $offset
     * @param int|null    $size
     * @param string|null $order
     *
     * @return array
     */
    public function record($departmentId, int $start, int $end = null, int $offset = null, int $size = null, string $order = null)
    {
        return $this->httpGet('checkin/record', [
            'department_id' => $departmentId,
            'start_time' => $start,
            'end_time' => $end,
            'offset' => $offset,
            'size' => $size,
            'order' => $order,
        ]);
    }
}
