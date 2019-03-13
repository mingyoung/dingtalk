<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Blackboard;

use EasyDingTalk\Blackboard\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function list()
    {
        $this->make(Client::class)->list('mingyoung')
            ->assertUri('topapi/blackboard/listtopten')->assertPostJson(['userid' => 'mingyoung']);
    }
}
