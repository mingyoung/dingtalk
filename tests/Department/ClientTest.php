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

    /** @test */
    public function list()
    {
        $this->make(Client::class)->list()
            ->assertUri('department/list')->assertQuery(['id' => null, 'lang' => null, 'fetch_child' => false]);
    }

    /** @test */
    public function get()
    {
        $this->make(Client::class)->get(1)
            ->assertUri('department/get')->assertQuery(['id' => 1, 'lang' => null]);
    }

    /** @test */
    public function getParentsById()
    {
        $this->make(Client::class)->getParentsById(1)
            ->assertUri('department/list_parent_depts_by_dept')->assertQuery(['id' => 1]);
    }

    /** @test */
    public function getParentsByUserId()
    {
        $this->make(Client::class)->getParentsByUserId('mingyoung')
            ->assertUri('department/list_parent_depts')->assertQuery(['userId' => 'mingyoung']);
    }

    /** @test */
    public function create()
    {
        $this->make(Client::class)->create(['name' => 'EasyDingTalk'])
            ->assertUri('department/create')->assertPostJson(['name' => 'EasyDingTalk']);
    }

    /** @test */
    public function update()
    {
        $this->make(Client::class)->update(1, ['name' => 'EasyDingTalk'])
            ->assertUri('department/update')->assertPostJson(['id' => 1, 'name' => 'EasyDingTalk']);
    }

    /** @test */
    public function delete()
    {
        $this->make(Client::class)->delete(1)
            ->assertUri('department/delete')->assertQuery(['id' => 1]);
    }
}
