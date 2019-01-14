<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Role;

use EasyDingTalk\Role\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testList()
    {
        $this->make(Client::class);
    }

    public function testGetUsers()
    {
        $this->make(Client::class);
    }

    public function testGetGroups()
    {
        $this->make(Client::class);
    }

    public function testGet()
    {
        $this->make(Client::class);
    }

    public function testCreate()
    {
        $this->make(Client::class);
    }

    public function testUpdate()
    {
        $this->make(Client::class);
    }

    public function testDelete()
    {
        $this->make(Client::class);
    }

    public function testCreateGroup()
    {
        $this->make(Client::class);
    }

    public function testAddUserRoles()
    {
        $this->make(Client::class);
    }

    public function testDeleteUserRoles()
    {
        $this->make(Client::class);
    }
}
