<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Contact;

use EasyDingTalk\Contact\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function labels()
    {
        $this->make(Client::class)->labels(0, 20)
            ->assertUri('topapi/extcontact/listlabelgroups')->assertPostJson(['offset' => 0, 'size' => 20]);
    }

    /** @test */
    public function list()
    {
        $this->make(Client::class)->list(0, 20)
            ->assertUri('topapi/extcontact/list')->assertPostJson(['offset' => 0, 'size' => 20]);
    }

    /** @test */
    public function get()
    {
        $this->make(Client::class)->get('mingyoung')
            ->assertUri('topapi/extcontact/get')->assertPostJson(['user_id' => 'mingyoung']);
    }

    /** @test */
    public function create()
    {
        $this->make(Client::class)->create(['name' => 'MINGYOUNG'])
            ->assertUri('topapi/extcontact/create')->assertPostJson(['contact' => [
                'name' => 'MINGYOUNG',
            ]]);
    }

    /** @test */
    public function update()
    {
        $this->make(Client::class)->update(123, ['name' => 'MINGYOUNG'])
            ->assertUri('topapi/extcontact/update')->assertPostJson(['contact' => [
                'user_id' => 123, 'name' => 'MINGYOUNG',
            ]]);
    }

    /** @test */
    public function delete()
    {
        $this->make(Client::class)->delete('mingyoung')
            ->assertUri('topapi/extcontact/delete')->assertPostJson(['user_id' => 'mingyoung']);
    }

    /** @test */
    public function scopes()
    {
        $this->make(Client::class)->scopes()
            ->assertUri('auth/scopes');
    }
}
