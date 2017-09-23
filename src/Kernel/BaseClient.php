<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Kernel;

use EasyDingTalk\Application;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;

class BaseClient
{
    use MakesHttpRequests;

    /**
     * @var \EasyDingTalk\Application
     */
    protected $app;

    /**
     * @param \EasyDingTalk\Application
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->setRequestOptions(['handler' => $this->handlerStack()]);
    }

    protected function handlerStack(): HandlerStack
    {
        $handlerStack = HandlerStack::create();

        $middleware = [
            'access_token' => function (callable $handler) {
                return function (RequestInterface $request, array $options) use ($handler) {
                    if (isset($this->app['credential'])) {
                        $request = $this->app['credential']->applyToRequest($request, $options);
                    }

                    return $handler($request, $options);
                };
            },
        ];

        foreach ($middleware as $name => $handler) {
            $handlerStack->push($handler, $name);
        }

        return $handlerStack;
    }
}
