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

/**
 * Class Credential.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Credential
{
    use MakesHttpRequests;

    /**
     * @var \EasyDingTalk\Application
     */
    protected $app;

    /**
     * Credential constructor.
     *
     * @param \EasyDingTalk\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get credential token.
     *
     * @return string
     */
    public function token(): string
    {
        if ($value = $this->app['cache']->get($this->cacheKey())) {
            return $value;
        }

        $result = $this->request('GET', 'gettoken', [
            'query' => $this->credentials(),
        ]);

        $this->setToken($token = $result['access_token'], 7000);

        return $token;
    }

    /**
     * @param string                 $token
     * @param int|\DateInterval|null $ttl
     *
     * @return $this
     */
    public function setToken(string $token, $ttl = null)
    {
        $this->app['cache']->set($this->cacheKey(), $token, $ttl);

        return $this;
    }

    /**
     * @return array
     */
    protected function credentials(): array
    {
        return [
            'corpid' => $this->app['config']->get('corp_id'),
            'corpsecret' => $this->app['config']->get('corp_secret'),
            'appkey' => $this->app['config']->get('appkey'),
            'appsecret' => $this->app['config']->get('appsecret'),
        ];
    }

    /**
     * @return string
     */
    protected function cacheKey(): string
    {
        return 'easydingtalk.access_token.'.md5(json_encode($this->credentials()));
    }
}
