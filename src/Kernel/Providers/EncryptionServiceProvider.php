<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Kernel\Providers;

use EasyDingTalk\Kernel\Encryption\Encryptor;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class EncryptionServiceProvider implements ServiceProviderInterface
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
        $pimple['encryptor'] = function ($app) {
            return new Encryptor(
                $app['config']->get('corp_id'),
                $app['config']->get('token'),
                $app['config']->get('aes_key')
            );
        };
    }
}
