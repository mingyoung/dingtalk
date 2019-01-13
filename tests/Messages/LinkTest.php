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

use EasyDingTalk\Messages\Link;
use EasyDingTalk\Tests\TestCase;

class LinkTest extends TestCase
{
    /** @test */
    public function staticMake()
    {
        $message = Link::make('https://example.com')->setPictureUrl('@lALOACZwe2Rk')->setTitle('测试')->setText('测试');
        $expected = [
            'msgtype' => 'link',
            'link' => [
                'messageUrl' => 'https://example.com',
                'picUrl' => '@lALOACZwe2Rk',
                'title' => '测试',
                'text' => '测试',
            ],
        ];

        $this->assertSame($expected, $message->toArray());
        $this->assertSame(json_encode($expected), $message->toJson());
    }

    /** @test */
    public function new()
    {
        $message = (new Link('https://example.com'))->setPictureUrl('@lALOACZwe2Rk')->setTitle('测试')->setText('测试');
        $expected = [
            'msgtype' => 'link',
            'link' => [
                'messageUrl' => 'https://example.com',
                'picUrl' => '@lALOACZwe2Rk',
                'title' => '测试',
                'text' => '测试',
            ],
        ];

        $this->assertSame($expected, $message->toArray());
        $this->assertSame(json_encode($expected), $message->toJson());
    }
}
