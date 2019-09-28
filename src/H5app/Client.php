<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\H5app;

use EasyDingTalk\Kernel\BaseClient;
use EasyDingTalk\Kernel\Concerns\InteractsWithCache;
use EasyDingTalk\Kernel\Exceptions\InvalidCredentialsException;

class Client extends BaseClient
{
    use InteractsWithCache;

    /**
     * 获取 jsapi_ticket
     *
     * @return mixed
     */
    public function get()
    {
        if ($value = $this->getCache()->get($this->cacheFor())) {
            return $value;
        }
        $value = $this->client->get('get_jsapi_ticket');
        if (0 !== $value['errcode']) {
            throw new InvalidCredentialsException(json_encode($value));
        }
        $this->getCache()->set($this->cacheFor(), $value, $value['expires_in']);
        return $value;
    }

    /**
     * 获取 ticket
     *
     * @return string
     */
    public function getTicket()
    {
        return $this->get()['ticket'];
    }

    /**
     * 获取签名相关信息
     *
     * @param string $url
     * 
     * @return mixed
     */
    public function getSignature($url)
    {
        $nonceStr = $this->getNonceStr();
        $timeStamp = time();
        $plain = 'jsapi_ticket=' . $this->getTicket() . '&noncestr=' . $nonceStr . '&timestamp=' . $timeStamp . '&url=' . $url;
        $signature = sha1($plain);
        return [
            'agentId' => $this->app['config']->get('agent_id'),
            'corpId' => $this->app['config']->get('corp_id'),
            'timeStamp' => $timeStamp,
            'nonceStr' => $nonceStr,
            'signature' => $signature,
            'url' => $url
        ];
    }

    /**
     * 缓存 Key
     *
     * @return string
     */
    protected function cacheFor()
    {
        return sprintf('jsapi_ticket.%s', $this->app['config']->get('app_key'));
    }

    /**
     * 生产 随机字符串
     *
     * @return string
     */
    protected function getNonceStr($length=16)
    {
        $strs = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
        return substr(str_shuffle($strs), mt_rand(0, strlen($strs)-11), $length);
    }
}
