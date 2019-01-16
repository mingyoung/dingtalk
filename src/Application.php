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
        Chat\ServiceProvider::class,
        Role\ServiceProvider::class,
        User\ServiceProvider::class,
        Media\ServiceProvider::class,
        Scope\ServiceProvider::class,
        Health\ServiceProvider::class,
        Kernel\ServiceProvider::class,
        Report\ServiceProvider::class,
        Contact\ServiceProvider::class,
        Calendar\ServiceProvider::class,
        Microapp\ServiceProvider::class,
        Schedule\ServiceProvider::class,
        Blackboard\ServiceProvider::class,
        Department\ServiceProvider::class,
        Kernel\Http\ServiceProvider::class,
        Conversation\ServiceProvider::class,
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
