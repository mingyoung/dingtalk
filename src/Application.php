<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk;

use Overtrue\Http\Support\Collection;
use Pimple\Container;

/**
 * @property \EasyDingTalk\Kernel\AccessToken $access_token
 */
class Application extends Container
{
    /**
     * @var array
     */
    protected $providers = [
        Kernel\ServiceProvider::class,
        Kernel\Http\ServiceProvider::class,
        User\ServiceProvider::class,
        Chat\ServiceProvider::class,
        Department\ServiceProvider::class,
        Report\ServiceProvider::class,
        Role\ServiceProvider::class,
        Microapp\Client::class,
        Blackboard\Client::class,
        Calendar\Client::class,
    ];

    /**
     * Application constructor.
     *
     * @param array $config
     * @param array $values
     */
    public function __construct($config = [], array $values = [])
    {
        parent::__construct($values);

        $this['config'] = function () use ($config) {
            return new Collection($config);
        };

        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this[$name];
    }
}
