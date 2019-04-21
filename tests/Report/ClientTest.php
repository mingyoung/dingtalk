<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Report;

use EasyDingTalk\Report\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function list()
    {
        $expected = [
            'start_time' => 1507564800000,
            'end_time' => 1507564800000,
            'userid' => 'mingyoung',
        ];

        $this->make(Client::class)->list($expected)
            ->assertUri('topapi/report/list')->assertPostJson($expected);
    }

    /** @test */
    public function templates()
    {
        $expected = [
            'userid' => 'mingyoung',
            'offset' => 100,
            'size' => 50,
        ];

        $this->make(Client::class)->templates('mingyoung', 100, 50)
            ->assertUri('topapi/report/template/listbyuserid')->assertPostJson($expected);
    }

    /** @test */
    public function unreadCount()
    {
        $this->make(Client::class)->unreadCount('mingyoung')
            ->assertUri('topapi/report/getunreadcount')->assertPostJson(['userid' => 'mingyoung']);
    }
}
