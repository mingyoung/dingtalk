<?php

namespace EasyDingTalk;

use Psr\SimpleCache\CacheInterface;

class AccessToken
{
    /**
     * @var \EasyDingTalk\Client
     */
    protected $client;

    public function __construct(protected string $appKey, protected string $appSecret, protected ?CacheInterface $cache = null)
    {
        //
    }

    public function setCache(CacheInterface $cache)
    {
        $this->cache = $cache;

        return $this;
    }

    public function getCache(): CacheInterface
    {
        return $this->cache;
    }

    public function getClient(): Client
    {
        return $this->client ?: $this->client = new Client;
    }

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getToken()
    {
        $cacheKey = sprintf('easydingtalk.access_token.%s', md5($this->appKey.$this->appSecret));

        if ($value = $this->getCache()->get($cacheKey)) {
            return $value;
        }

        $value = $this->getClient()->get('https://oapi.dingtalk.com/gettoken', [
            'appkey' => $this->appKey,
            'appsecret' => $this->appSecret,
        ])->json();

        $this->getCache()->set($cacheKey, $value, 6666);

        return $value;
    }
}