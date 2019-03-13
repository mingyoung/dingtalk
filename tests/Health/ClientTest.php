<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Health;

use EasyDingTalk\Health\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function status()
    {
        $this->make(Client::class)->status('mingyoung')
            ->assertPostUri('topapi/health/stepinfo/getuserstatus')
            ->assertPostJson(['userid' => 'mingyoung']);
    }

    /** @test */
    public function user()
    {
        $this->make(Client::class)->user('mingyoung', '20180101,20180102')
            ->assertPostUri('topapi/health/stepinfo/list')
            ->assertPostJson(['type' => 0, 'object_id' => 'mingyoung', 'stat_dates' => '20180101,20180102']);
    }

    /** @test */
    public function department()
    {
        $this->make(Client::class)->department('mingyoung', '20180101,20180102')
            ->assertPostUri('topapi/health/stepinfo/list')
            ->assertPostJson(['type' => 1, 'object_id' => 'mingyoung', 'stat_dates' => '20180101,20180102']);
    }

    /** @test */
    public function users()
    {
        $this->make(Client::class)->users(['mingyoung', 'cc'], '20180101')
            ->assertPostUri('topapi/health/stepinfo/listbyuserid')
            ->assertPostJson(['userids' => 'mingyoung,cc', 'stat_date' => '20180101']);
    }
}
