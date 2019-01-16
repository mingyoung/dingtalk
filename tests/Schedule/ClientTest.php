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
    public function testCreate()
    {
        $this->make(Client::class);
    }

    public function testUpdate()
    {
        $this->make(Client::class);
    }

    public function testListByUserId()
    {
        $this->make(Client::class);
    }
}
