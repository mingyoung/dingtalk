<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\User;

use EasyDingTalk\Tests\TestCase;
use EasyDingTalk\User\Client;

class ClientTest extends TestCase
{
    /** @test 获取用户 */
    public function get()
    {
        $this->make(Client::class)->get('mingyoung')
            ->assertUri('user/get')->assertQuery(['userid' => 'mingyoung', 'lang' => null]);

        $this->make(Client::class)->get('mingyoung', 'zh-CN')
            ->assertUri('user/get')->assertQuery(['userid' => 'mingyoung', 'lang' => 'zh-CN']);
    }

    /** @test */
    public function getUserIds()
    {
        $this->make(Client::class)->getUserIds('123')
            ->assertUri('user/getDeptMember')->assertQuery(['deptId' => '123']);
    }
}
