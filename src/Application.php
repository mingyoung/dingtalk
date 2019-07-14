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
 * @property Auth\SsoClient $sso
 * @property Auth\OAuthClient $oauth
 * @property Chat\Client $chat
 * @property Role\Client $role
 * @property User\Client $user
 * @property Media\Client $media
 * @property Health\Client $health
 * @property Report\Client $report
 * @property Checkin\Client $checkin
 * @property Contact\Client $contact
 * @property Process\Client $process
 * @property Calendar\Client $calendar
 * @property Callback\Client $callback
 * @property Microapp\Client $microapp
 * @property Schedule\Client $schedule
 * @property Blackboard\Client $blackboard
 * @property Attendance\Client $attendance
 * @property Department\Client $department
 * @property Conversation\Client $conversation
 * @property Kernel\Server $server
 */
class Application extends Container
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Chat\ServiceProvider::class,
        Role\ServiceProvider::class,
        User\ServiceProvider::class,
        Media\ServiceProvider::class,
        Health\ServiceProvider::class,
        Report\ServiceProvider::class,
        Checkin\ServiceProvider::class,
        Contact\ServiceProvider::class,
        Process\ServiceProvider::class,
        Calendar\ServiceProvider::class,
        Callback\ServiceProvider::class,
        Microapp\ServiceProvider::class,
        Schedule\ServiceProvider::class,
        Blackboard\ServiceProvider::class,
        Attendance\ServiceProvider::class,
        Department\ServiceProvider::class,
        Conversation\ServiceProvider::class,
        Kernel\Providers\ClientServiceProvider::class,
        Kernel\Providers\LoggerServiceProvider::class,
        Kernel\Providers\ServerServiceProvider::class,
        Kernel\Providers\RequestServiceProvider::class,
        Kernel\Providers\EncryptionServiceProvider::class,
        Kernel\Providers\AccessTokenServiceProvider::class,
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
