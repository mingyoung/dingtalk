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

use EasyDingTalk\Application;

class ApplicationTest extends TestCase
{
    /** @test */
    public function services()
    {
        $app = new Application();

        $services = [
            'logger' => \Monolog\Logger::class,
            'chat' => \EasyDingTalk\Chat\Client::class,
            'user' => \EasyDingTalk\User\Client::class,
            'role' => \EasyDingTalk\Role\Client::class,
            'media' => \EasyDingTalk\Media\Client::class,
            'server' => \EasyDingTalk\Kernel\Server::class,
            'report' => \EasyDingTalk\Report\Client::class,
            'health' => \EasyDingTalk\Health\Client::class,
            'contact' => \EasyDingTalk\Contact\Client::class,
            'callback' => \EasyDingTalk\Callback\Client::class,
            'calendar' => \EasyDingTalk\Calendar\Client::class,
            'schedule' => \EasyDingTalk\Schedule\Client::class,
            'microapp' => \EasyDingTalk\Microapp\Client::class,
            'client' => \EasyDingTalk\Kernel\Http\Client::class,
            'config' => \Overtrue\Http\Support\Collection::class,
            'blackboard' => \EasyDingTalk\Blackboard\Client::class,
            'department' => \EasyDingTalk\Department\Client::class,
            'access_token' => \EasyDingTalk\Kernel\AccessToken::class,
            'conversation' => \EasyDingTalk\Conversation\Client::class,
            'request' => \Symfony\Component\HttpFoundation\Request::class,
            'encryptor' => \EasyDingTalk\Kernel\Encryption\Encryptor::class,
        ];

        $this->assertCount(count($services), $app->keys());
        foreach ($services as $name => $service) {
            $this->assertInstanceof($service, $app->{$name});
            $this->assertInstanceof($service, $app[$name]);
        }
    }
}
