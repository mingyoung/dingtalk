<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Messages;

use EasyDingTalk\Messages\Voice;
use EasyDingTalk\Tests\TestCase;

class VoiceTest extends TestCase
{
    /** @test */
    public function staticMake()
    {
        $message = Voice::make('media-id', 10);
        $expected = [
            'msgtype' => 'voice',
            'voice' => [
                'media_id' => 'media-id',
                'duration' => 10,
            ],
        ];

        $this->assertSame($expected, $message->toArray());
        $this->assertSame(json_encode($expected), $message->toJson());
    }

    /** @test */
    public function new()
    {
        $message = new Voice('media-id', 10);

        $expected = [
            'msgtype' => 'voice',
            'voice' => [
                'media_id' => 'media-id',
                'duration' => 10,
            ],
        ];

        $this->assertSame($expected, $message->toArray());
        $this->assertSame(json_encode($expected), $message->toJson());
    }
}
