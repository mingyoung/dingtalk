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

/**
 * Trait MakesHttpRequests.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
trait MakesHttpRequests
{
    /**
     * @var bool
     */
    protected $transform = true;

    /**
     * @param string $method
     * @param string $uri
     * @param array  $options
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function request(string $method, string $uri, array $options = [])
    {
        $response = $this->app['http_client']->request($method, $uri, $options);

        return $this->transform ? $this->transformResponse($response) : $response;
    }

    /**
     * @return $this
     */
    public function dontTransform()
    {
        $this->transform = false;

        return $this;
    }

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     *
     * @return array
     *
     * @throws \EasyDingTalk\Kernel\Exceptions\ClientError
     */
    protected function transformResponse($response): array
    {
        $result = json_decode($response->getBody()->getContents(), true);

        if (isset($result['errcode']) && $result['errcode'] !== 0) {
            throw new Exceptions\ClientError($result['errmsg'], $result['errcode']);
        }

        if (isset($result['error_response'])) {
            throw new Exceptions\ClientError($result['error_response']['msg'], $result['error_response']['code']);
        }

        return $result;
    }
}
