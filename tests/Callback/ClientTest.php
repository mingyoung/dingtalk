<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Callback;

use EasyDingTalk\Callback\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function register()
    {
        $this->make(Client::class)->register($params = ['call_back_tag' => ['foo', 'bar']])
            ->assertPostUri('call_back/register_call_back')->assertPostJson(array_merge($params, ['token' => 'test-token', 'aes_key' => 'test-aes-key']));
    }

    /** @test */
    public function list()
    {
        $this->make(Client::class)->list()
            ->assertGetUri('call_back/get_call_back');
    }

    /** @test */
    public function update()
    {
        $this->make(Client::class)->update($params = ['call_back_tag' => ['foo', 'bar']])
            ->assertPostUri('call_back/update_call_back')->assertPostJson(array_merge($params, ['token' => 'test-token', 'aes_key' => 'test-aes-key']));
    }

    /** @test */
    public function delete()
    {
        $this->make(Client::class)->delete()
            ->assertGetUri('call_back/delete_call_back');
    }

    /** @test */
    public function failed()
    {
        $this->make(Client::class)->failed()
            ->assertGetUri('call_back/get_call_back_failed_result');
    }
}
