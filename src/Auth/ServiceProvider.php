<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Auth;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param \Pimple\Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['sso'] = function ($app) {
            return new SsoClient($app);
        };

        $pimple['oauth'] = function ($app) {
            if (!$app['request']->hasSession()) {
                $app['request']->setSession(new Session());
            }

            return new OAuthClient($app);
        };
    }
}
