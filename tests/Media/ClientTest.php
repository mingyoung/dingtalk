<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Media;

use EasyDingTalk\Media\Client;
use EasyDingTalk\Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function uploadImage()
    {
        $this->make(Client::class)->uploadImage(__DIR__.'/__fixtures__/foo.stub')
            ->assertPostUri('media/upload');
    }

    /** @test */
    public function uploadVoice()
    {
        $this->make(Client::class)->uploadVoice(__DIR__.'/__fixtures__/foo.stub')
            ->assertPostUri('media/upload');
    }

    /** @test */
    public function uploadFile()
    {
        $this->make(Client::class)->uploadFile(__DIR__.'/__fixtures__/foo.stub')
            ->assertPostUri('media/upload');
    }
}
