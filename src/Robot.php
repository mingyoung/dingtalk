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

use Overtrue\Http\Traits\HasHttpRequests;

class Robot
{
    use HasHttpRequests;

    /**
     * 机器人 AccessToken
     *
     * @var string
     */
    protected $accessToken;

    /**
     * @param string $accessToken
     */
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param string $accessToken
     *
     * @return self
     */
    public static function create($accessToken)
    {
        return new static($accessToken);
    }

    /**
     * 发送消息
     *
     * @param array $message
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($message)
    {
        $response = $this->getHttpClient()->request(
            'POST', 'https://oapi.dingtalk.com/robot/send?access_token='.$this->accessToken, ['json' => $message]
        );

        return $this->castResponseToType($response);
    }
}
