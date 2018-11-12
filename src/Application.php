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
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \EasyDingTalk\Auth\Client         $auth
 * @property \EasyDingTalk\Chat\Client         $chat
 * @property \EasyDingTalk\Role\Client         $role
 * @property \EasyDingTalk\User\Client         $user
 * @property \EasyDingTalk\Media\Client        $media
 * @property \EasyDingTalk\Jssdk\Client        $jssdk
 * @property \EasyDingTalk\Report\Client       $report
 * @property \EasyDingTalk\Checkin\Client      $checkin
 * @property \EasyDingTalk\Message\Client      $message
 * @property \EasyDingTalk\Process\Client      $process
 * @property \EasyDingTalk\Microapp\Client     $microapp
 * @property \EasyDingTalk\Attendance\Client   $attendance
 * @property \EasyDingTalk\Kernel\Credential   $credential
 * @property \EasyDingTalk\Department\Client   $department
 * @property \EasyDingTalk\Message\AsyncClient $async_message
 */
class Application extends Container
{
    public static $useOApi = false;

    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Chat\ServiceProvider::class,
        Role\ServiceProvider::class,
        User\ServiceProvider::class,
        Jssdk\ServiceProvider::class,
        Media\ServiceProvider::class,
        Kernel\ServiceProvider::class,
        Report\ServiceProvider::class,
        Checkin\ServiceProvider::class,
        Message\ServiceProvider::class,
        Process\ServiceProvider::class,
        Microapp\ServiceProvider::class,
        Attendance\ServiceProvider::class,
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
