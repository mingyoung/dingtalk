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

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Assert;

class TestResponse extends Response
{
    protected $method;
    protected $uri;
    protected $options;

    /**
     * Request arguments.
     *
     * @return \Closure
     */
    public function setExpectedArguments()
    {
        return function () {
            list($this->method, $this->uri, $this->options) = func_get_args();

            return true;
        };
    }

    public function assertUri($uri)
    {
        Assert::assertSame(
            $this->uri, $uri, 'Not the same uri.'
        );

        return $this;
    }

    public function assertQuery($query)
    {
        Assert::assertSame(
            $this->options['query'], $query, 'not the same query.'
        );

        return $this;
    }
}
