<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Conversation;

class SendViaCorporation
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function toAgent($agentId)
    {
        return $this;
    }

    public function toUsers($agentId)
    {
        return $this;
    }

    public function toDepartments($agentId)
    {
        return $this;
    }

    public function toAllUsers($agentId)
    {
        return $this;
    }

    /**
     * 发送工作通知消息
     *
     * @param array $message
     *
     * @return mixed
     */
    public function send($message)
    {
        return $this->client->sendViaCorporation($this->build());
    }
}
