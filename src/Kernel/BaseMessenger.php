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

use EasyDingTalk\Kernel\Messages\Text;

/**
 * Class BaseMessenger.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
abstract class BaseMessenger
{
    /**
     * @var \EasyDingTalk\Kernel\Messages\Message
     */
    protected $message;

    /**
     * Message to send.
     *
     * @param int|string|\EasyDingTalk\Kernel\Messages\Message $message
     *
     * @return $this
     */
    public function message($message)
    {
        if (is_string($message) || is_int($message)) {
            $message = new Text($message);
        }

        $this->message = $message;

        return $this;
    }

    abstract public function send();
}
