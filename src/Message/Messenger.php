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

    protected $user;

    public function toUser($user)
    {
        $this->user = implode(',', (array) $user);

        return $this;
    }

    protected $party;

    public function toParty($party)
    {
        $this->party = implode(',', (array) $party);

        return $this;
    }

    protected $agentId;

    public function ofAgent(int $agentId)
    {
        $this->agentId = $agentId;

        return $this;
    }

    public function send()
    {
        $data = array_merge([
            'touser' => $this->user,
            'toparty' => $this->party,
            'agentid' => $this->agentId,
        ], $this->message->transform());

        return $this->client->send($data);
    }
}
