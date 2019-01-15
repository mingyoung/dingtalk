<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) cyril chan <cxhforever@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Extcontact;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 *
 * @author cyril chan <cxhforever@gmail.com
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['extcontact'] = function ($app) {
            return new Client($app);
        };
    }
}
