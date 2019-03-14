<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Jssdk;

use EasyDingTalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @return \EasyDingTalk\Jssdk\ConfigBuilder
     */
    public function configBuilder(): ConfigBuilder
    {
        return new ConfigBuilder($this);
    }

    /**
     * @return string
     */
    public function ticket(): string
    {
        if ($value = $this->app['cache']->get($this->cacheKey())) {
            return $value;
        }

        $result = $this->httpGet('get_jsapi_ticket');
        $this->app['cache']->set($this->cacheKey(), $ticket = $result['ticket'], $result['expires_in'] - 200);

        return $ticket;
    }

    /**
     * @param string $url
     * @param string $nonce
     * @param int    $timestamp
     *
     * @return string
     */
    public function signature(string $url, string $nonce, int $timestamp): string
    {
        return sha1("jsapi_ticket={$this->ticket()}&noncestr={$nonce}&timestamp={$timestamp}&url={$url}");
    }

    /**
     * @return string
     */
    public function corpId(): string
    {
        return $this->app['config']->get('corp_id');
    }

    /**
     * @return string
     */
    protected function cacheKey(): string
    {
        return 'easydingtalk.jsticket.'.($this->app['config']->get('app_key') ?: $this->corpId());
    }
}
