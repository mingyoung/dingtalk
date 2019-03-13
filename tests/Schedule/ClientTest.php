<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Schedule;

use EasyDingTalk\Schedule\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function add()
    {
        $this->make(Client::class)->add($params = [
            'userid' => 'mingyoung',
            'create_time' => 1496678400000,
            'title' => '标题',
            'url' => 'https://easydingtalk.org',
            'formItemList' => [
                [
                    'title' => '标题',
                    'content' => '内容',
                ],
            ],
        ])
            ->assertUri('topapi/workrecord/add')
            ->assertPostJson($params);
    }

    /** @test */
    public function update()
    {
        $this->make(Client::class)->update('mingyoung', 'record123')
            ->assertUri('topapi/workrecord/update')
            ->assertPostJson(['userid' => 'mingyoung', 'record_id' => 'record123']);
    }

    /** @test */
    public function completedList()
    {
        $this->make(Client::class)->list('mingyoung', true, 0, 50)
            ->assertUri('topapi/workrecord/getbyuserid')
            ->assertPostJson([
                'userid' => 'mingyoung',
                'status' => 1,
                'offset' => 0,
                'limit' => 50,
            ]);
    }

    /** @test */
    public function incompletedList()
    {
        $this->make(Client::class)->list('mingyoung', false, 0, 50)
            ->assertUri('topapi/workrecord/getbyuserid')
            ->assertPostJson([
                'userid' => 'mingyoung',
                'status' => 0,
                'offset' => 0,
                'limit' => 50,
            ]);
    }
}
