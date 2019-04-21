<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Microapp;

use EasyDingTalk\Microapp\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function list()
    {
        $this->make(Client::class)->list()
            ->assertUri('microapp/list')->assertEmptyQuery();
    }

    /** @test */
    public function listByUserId()
    {
        $this->make(Client::class)->listByUserId('mingyoung')
            ->assertUri('microapp/list_by_userid')->assertQuery(['userid' => 'mingyoung']);
    }

    /** @test */
    public function getVisibility()
    {
        $this->make(Client::class)->getVisibility('123')
            ->assertUri('microapp/visible_scopes')->assertPostJson(['agentId' => '123']);
    }

    /** @test */
    public function setVisibility()
    {
        $this->make(Client::class)->setVisibility([
            'agentId' => 123456,
            'isHidden' => false,
            'deptVisibleScopes' => [1, 2],
            'userVisibleScopes' => ['user1', 'user2'],
        ])->assertUri('microapp/set_visible_scopes')->assertPostJson([
            'agentId' => 123456,
            'isHidden' => false,
            'deptVisibleScopes' => [1, 2],
            'userVisibleScopes' => ['user1', 'user2'],
        ]);
    }
}
