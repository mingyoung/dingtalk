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
    /** @test */
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

    /** @test */
    public function getUsers()
    {
        $this->make(Client::class)->getUsers('123', 10, 20)
            ->assertUri('user/simplelist')->assertQuery(['department_id' => '123', 'offset' => 10, 'size' => 20, 'order' => null, 'lang' => null]);
    }

    /** @test */
    public function getDetailedUsers()
    {
        $this->make(Client::class)->getDetailedUsers('123', 10, 20)
            ->assertUri('user/listbypage')->assertQuery(['department_id' => '123', 'offset' => 10, 'size' => 20, 'order' => null, 'lang' => null]);
    }

    /** @test */
    public function administrators()
    {
        $this->make(Client::class)->administrators()
            ->assertUri('user/get_admin');
    }

    /** @test */
    public function administratorScope()
    {
        $this->make(Client::class)->administratorScope('mingyoung')
            ->assertUri('topapi/user/get_admin_scope')->assertQuery(['userid' => 'mingyoung']);
    }

    /** @test */
    public function getUseridByUnionid()
    {
        $this->make(Client::class)->getUseridByUnionid('mingyoung')
            ->assertUri('user/getUseridByUnionid')->assertQuery(['unionid' => 'mingyoung']);
    }

    /** @test */
    public function create()
    {
        $this->make(Client::class)->create(['userid' => 'mingyoung', 'name' => 'MINGYOUNG'])
            ->assertUri('user/create')->assertPostJson([
                'userid' => 'mingyoung', 'name' => 'MINGYOUNG',
            ]);
    }

    /** @test */
    public function update()
    {
        $this->make(Client::class)->update('mingyoung', ['name' => 'MINGYOUNG'])
            ->assertUri('user/update')->assertPostJson([
                'userid' => 'mingyoung',
                'name' => 'MINGYOUNG',
            ]);
    }

    /** @test */
    public function delete()
    {
        $this->make(Client::class)->delete('mingyoung')
            ->assertUri('user/delete')->assertQuery(['userid' => 'mingyoung']);
    }

    /** @test */
    public function getUserByCode()
    {
        $this->make(Client::class)->getUserByCode('code')
            ->assertUri('user/getuserinfo')->assertQuery(['code' => 'code']);
    }

    /** @test */
    public function addRoles()
    {
        $this->make(Client::class)->addRoles('user1,user2', 'role1,role2')
            ->assertUri('topapi/role/addrolesforemps')->assertPostJson(['userIds' => 'user1,user2', 'roleIds' => 'role1,role2']);

        $this->make(Client::class)->addRoles(['user1', 'user2'], ['role1', 'role2'])
            ->assertUri('topapi/role/addrolesforemps')->assertPostJson(['userIds' => 'user1,user2', 'roleIds' => 'role1,role2']);
    }

    /** @test */
    public function removeRoles()
    {
        $this->make(Client::class)->removeRoles('user1,user2', 'role1,role2')
            ->assertUri('topapi/role/removerolesforemps')->assertPostJson(['userIds' => 'user1,user2', 'roleIds' => 'role1,role2']);

        $this->make(Client::class)->removeRoles(['user1', 'user2'], ['role1', 'role2'])
            ->assertUri('topapi/role/removerolesforemps')->assertPostJson(['userIds' => 'user1,user2', 'roleIds' => 'role1,role2']);
    }

    /** @test */
    public function getUserCount()
    {
        $this->make(Client::class)->getCount()
            ->assertUri('user/get_org_user_count')->assertQuery(['onlyActive' => 0]);
    }

    /** @test */
    public function getActivatedCount()
    {
        $this->make(Client::class)->getActivatedCount()
            ->assertUri('user/get_org_user_count')->assertQuery(['onlyActive' => 1]);
    }
}
