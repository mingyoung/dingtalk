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

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    public function create(array $data)
    {
        return $this->httpPostJson('chat/create', $data);
    }

    public function update(array $data)
    {
        return $this->httpPostJson('chat/update', $data);
    }

    public function get(string $chatId)
    {
        return $this->httpGet('chat/get', [
            'chatid' => $chatId,
        ]);
    }

    public function send(array $data)
    {
        return $this->httpPostJson('chat/send', $data);
    }

    public function message($message): Messenger
    {
        return (new Messenger($this))->message($message);
    }
}
