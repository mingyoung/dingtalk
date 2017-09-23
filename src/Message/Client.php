<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Message;

use EasyDingTalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    public function status(string $messageId)
    {
        return $this->httpPostJson('message/list_message_status', compact('messageId'));
    }

    public function message($message): Messenger
    {
        return (new Messenger($this))->message($message);
    }

    public function send(array $data)
    {
        return $this->httpPostJson('message/send', $data);
    }
}
