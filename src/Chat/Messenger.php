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

use EasyDingTalk\Kernel\Messages\Text;

/**
 * Class Messenger.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Messenger
{
    protected $client;
    protected $message;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function message($message)
    {
        if (is_string($message) || is_integer($message)) {
            $message = new Text($message);
        }
        $this->message = $message;

        return $this;
    }

    protected $chatId;

    public function to(string $chatId)
    {
        $this->chatId = $chatId;

        return $this;
    }

    public function send()
    {
        $data = ['chatid' => $this->chatId] + $this->message->transform();

        return $this->client->send($data);
    }
}
