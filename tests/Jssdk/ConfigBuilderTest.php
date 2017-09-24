<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Jssdk;

use EasyDingTalk\Jssdk\Client;
use EasyDingTalk\Jssdk\ConfigBuilder;
use EasyDingTalk\Tests\TestCase;

class ConfigBuilderTest extends TestCase
{
    public function testSetUrl()
    {
        $builder = $this->getConfigBuilder();
        $builder->setUrl('http://example.com/foo/bar');

        $this->assertSame('http%3A%2F%2Fexample.com%2Ffoo%2Fbar', $builder->getUrl());
    }

    protected function getConfigBuilder()
    {
        return new ConfigBuilder(
            \Mockery::mock(Client::class)
        );
    }
}
