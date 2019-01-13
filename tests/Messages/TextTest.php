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

use EasyDingTalk\Messages\Text;
use EasyDingTalk\Tests\TestCase;

class TextTest extends TestCase
{
    /** @test */
    public function staticMake()
    {
        $message = Text::make('mock');
        $expected = [
            'msgtype' => 'text',
            'text' => [
                'content' => 'mock',
            ],
        ];

        $this->assertSame($expected, $message->toArray());
        $this->assertSame(json_encode($expected), $message->toJson());
    }

    /** @test */
    public function new()
    {
        $message = new Text('mock');
        $expected = [
            'msgtype' => 'text',
            'text' => [
                'content' => 'mock',
            ],
        ];

        $this->assertSame($expected, $message->toArray());
        $this->assertSame(json_encode($expected), $message->toJson());
    }
}
