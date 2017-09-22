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

trait MakesHttpRequests
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var bool
     */
    protected $transform = true;

    /**
     * Make a get request.
     *
     * @param string $uri
     * @param array  $query
     *
     * @return array
     */
    public function httpGet(string $uri, array $query = [])
    {
        return $this->httpRequest('GET', $uri, compact('query'));
    }

    /**
     * Make a post request.
     *
     * @param string $uri
     * @param array  $json
     * @param array  $query
     *
     * @return array
     */
    public function httpPostJson(string $uri, array $json = [], array $query = [])
    {
        return $this->httpRequest('POST', $uri, compact('json', 'query'));
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    protected function setRequestOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $options
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function httpRequest(string $method, string $uri, array $options = [])
    {
        $response = $this->app['http_client']->request($method, $uri, $options + $this->options);

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

        return $result;
    }
}
