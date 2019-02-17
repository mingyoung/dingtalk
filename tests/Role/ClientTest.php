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
    /** @test */
    public function list()
    {
        $this->make(Client::class)->list()
            ->assertUri('topapi/role/list')->assertPostJson(['offset' => null, 'size' => null]);
    }

    /** @test */
    public function getUsers()
    {
        $this->make(Client::class)->getUsers(123)
            ->assertUri('topapi/role/simplelist')->assertPostJson(['offset' => null, 'size' => null, 'role_id' => 123]);
    }

    /** @test */
    public function getRoleGroups()
    {
        $this->make(Client::class)->getGroups(123)
            ->assertUri('topapi/role/getrolegroup')->assertPostJson(['group_id' => 123]);
    }

    /** @test */
    public function get()
    {
        $this->make(Client::class)->get(123)
            ->assertUri('topapi/role/getrole')->assertPostJson(['roleId' => 123]);
    }

    /** @test */
    public function create()
    {
        $this->make(Client::class)->create(123, 'Admin')
            ->assertUri('role/add_role')->assertPostJson(['groupId' => 123, 'roleName' => 'Admin']);
    }

    /** @test */
    public function update()
    {
        $this->make(Client::class)->update(123, 'Admin')
            ->assertUri('role/update_role')->assertPostJson(['roleId' => 123, 'roleName' => 'Admin']);
    }

    /** @test */
    public function delete()
    {
        $this->make(Client::class)->delete(123)
            ->assertUri('topapi/role/deleterole')->assertPostJson(['role_id' => 123]);
    }

    /** @test */
    public function createGroup()
    {
        $this->make(Client::class)->createGroup('Group')
            ->assertUri('role/add_role_group')->assertPostJson(['name' => 'Group']);
    }
}
