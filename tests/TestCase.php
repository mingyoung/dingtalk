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
use GuzzleHttp\ClientInterface;
use Mockery;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * @param \EasyDingTalk\Kernel\BaseClient $client
     *
     * @return \EasyDingTalk\Kernel\BaseClient
     */
    protected function make($client)
    {
        $app = $this->newApplication([
            'token' => 'test-token',
            'aes_key' => 'test-aes-key',
            'http' => ['response_type' => 'raw'],
        ]);

        $response = new TestResponse(200, [], '{"mock": "test"}');

        $app['client']->setHttpClient(Mockery::mock(ClientInterface::class, function ($mock) use ($response) {
            $mock->shouldReceive('request')->withArgs($response->setExpectedArguments())->andReturn($response);
        }));

        return new $client($app);
    }

    /**
     * @param array $config
     * @param array $overrides
     *
     * @return \EasyDingTalk\Application
     */
    protected function newApplication(array $config = [], array $overrides = [])
    {
        return new Application(array_merge(['appkey' => 'mock-appkey', 'appsecret' => 'mock-appsecret', 'agent_id' => 'mock-agent'], $config), $overrides);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
