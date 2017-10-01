<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Chat;

use EasyDingTalk\Kernel\BaseClient;
use EasyDingTalk\Kernel\Messages\Message;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data)
    {
        return $this->httpPostJson('chat/create', $data);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function update(array $data)
    {
        return $this->httpPostJson('chat/update', $data);
    }

    /**
     * @param string $chatId
     *
     * @return array
     */
    public function get(string $chatId)
    {
        return $this->httpGet('chat/get', [
            'chatid' => $chatId,
        ]);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function send(array $data = null)
    {
        return $this->httpPostJson('chat/send', $data ?? $this->data);
    }

    /**
     * @param string $chatId
     *
     * @return $this
     */
    public function toChat(string $chatId)
    {
        $this->data['chatid'] = $chatId;

        return $this;
    }

    /**
     * @param $message
     *
     * @return $this
     */
    public function withReply($message)
    {
        $this->data += Message::parse($message)->transform();

        return $this;
    }
}
