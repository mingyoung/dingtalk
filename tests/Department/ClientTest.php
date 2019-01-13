<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Department;

use EasyDingTalk\Department\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function getSubDepartmentIds()
    {
        $this->make(Client::class)->getSubDepartmentIds('test-id')
            ->assertUri('department/list_ids')->assertQuery(['id' => 'test-id']);
    }
}
