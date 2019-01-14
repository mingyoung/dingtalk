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
    public function testStatus()
    {
        $this->make(Client::class);
    }

    public function testUser()
    {
        $this->make(Client::class);
    }

    public function testDepartment()
    {
        $this->make(Client::class);
    }

    public function testList()
    {
        $this->make(Client::class);
    }
}
