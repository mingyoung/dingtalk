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

use GuzzleHttp\Client as GuzzleHttp;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ServiceProvider.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['request'] = function () {
            return Request::createFromGlobals();
        };

        $app['http_client'] = function () {
            return new GuzzleHttp([
                'base_uri' => 'https://oapi.dingtalk.com/',
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'timeout' => 5.0,
            ]);
        };

        $app['credential'] = function ($app) {
            return new Credential($app);
        };

        $app['cache'] = function () {
            return new FilesystemCache();
        };
    }
}
