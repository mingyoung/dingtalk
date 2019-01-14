<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests;

use EasyDingTalk\Robot;
use GuzzleHttp\Psr7\Response;
use Mockery;

class RobotTest extends TestCase
{
    /** @test */
    public function create()
    {
        if (1 === version_compare(\PHPUnit\Runner\Version::series(), 6)) {
            $this->markTestSkipped();
        }

        $robot = Mockery::mock(Robot::class.'[getHttpClient]', ['mock-token']);
        $robot->shouldReceive('getHttpClient->request')->withArgs(function ($method, $url, $content) {
            $this->assertSame('POST', $method);
            $this->assertSame('https://oapi.dingtalk.com/robot/send?access_token=mock-token', $url);
            $this->assertArrayHasKey('json', $content);

            return true;
        })->andReturn(new Response());

        $response = $robot->send([
            'msgtype' => 'text',
            'text' => [
                'content' => 'robot-content',
            ],
        ]);
        $this->assertTrue(is_array($response));
    }
}
