<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Chat;

use EasyDingTalk\Chat\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function send()
    {
        $this->make(Client::class)->send('foobar', ['foo' => 'bar'])
            ->assertPostUri('chat/send')->assertPostJson([
                'chatid' => 'foobar',
                'msg' => ['foo' => 'bar'],
            ]);
    }

    /** @test */
    public function result()
    {
        $this->make(Client::class)->result('message-id', 0, 100)
            ->assertGetUri('chat/getReadList')->assertQuery([
                'messageId' => 'message-id',
                'cursor' => 0,
                'size' => 100,
            ]);
    }

    /** @test */
    public function create()
    {
        $this->make(Client::class)->create($params = ['name' => 'EasyDingTalk', 'owner' => 'mingyoung', 'useridlist' => ['mingyoung', 'member']])
            ->assertPostUri('chat/create')->assertPostJson($params);
    }

    /** @test */
    public function update()
    {
        $this->make(Client::class)->update('chat-id', $params = ['name' => 'EasyDingTalk', 'owner' => 'mingyoung', 'add_useridlist' => ['member']])
            ->assertPostUri('chat/update')->assertPostJson(array_merge(['chatid' => 'chat-id'], $params));
    }

    /** @test */
    public function get()
    {
        $this->make(Client::class)->get('chat-id')
            ->assertGetUri('chat/get')->assertQuery(['chatid' => 'chat-id']);
    }
}
