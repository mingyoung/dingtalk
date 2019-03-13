<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Conversation;

use EasyDingTalk\Conversation\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function sendGeneralMessage()
    {
        $this->make(Client::class)->sendGeneralMessage('sender-foo', 'cid-bar', ['foo' => 'bar'])
            ->assertPostUri('message/send_to_conversation')
            ->assertPostJson([
                'sender' => 'sender-foo', 'cid' => 'cid-bar',
                'msg' => ['foo' => 'bar'],
            ]);
    }

    /** @test */
    public function sendCorporationMessage()
    {
        $this->make(Client::class)->sendCorporationMessage($params = ['foo' => 'bar'])
            ->assertPostUri('topapi/message/corpconversation/asyncsend_v2')
            ->assertPostJson($params);
    }

    /** @test */
    public function progress()
    {
        $this->make(Client::class)->corporationMessage('task-id')->progress()
            ->assertPostUri('topapi/message/corpconversation/getsendprogress')
            ->assertPostJson(['agent_id' => 'mock-agent', 'task_id' => 'task-id']);
    }

    /** @test */
    public function result()
    {
        $this->make(Client::class)->corporationMessage('task-id')->result()
            ->assertPostUri('topapi/message/corpconversation/getsendresult')
            ->assertPostJson(['agent_id' => 'mock-agent', 'task_id' => 'task-id']);
    }
}
