<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk;

use Pimple\Container;

/**
 * Class Application.
 *
 * @property \EasyDingTalk\Auth\Client $auth
 * @property \EasyDingTalk\User\Client $user
 * @property \EasyDingTalk\Kernel\Credential $credential
 * @property \EasyDingTalk\Department\Client $department
 */
class Application extends Container
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        User\ServiceProvider::class,
        Kernel\ServiceProvider::class,
        Department\ServiceProvider::class,
    ];

    /**
     * Application constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct();

        $this['config'] = function () use ($config) {
            return new Kernel\Config($config);
        };

        $this->registerProviders();
    }

    /**
     * Register providers.
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }
}
