<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Kernel;

class BaseClient
{
    /**
     * @var \EasyDingTalk\Application
     */
    protected $app;

    /**
     * @var \EasyDingTalk\Kernel\Http\Client
     */
    protected $client;

    /**
     * Client constructor.
     *
     * @param \EasyDingTalk\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->client = $this->app['client']->withAccessTokenMiddleware()->withRetryMiddleware();
    }
}
