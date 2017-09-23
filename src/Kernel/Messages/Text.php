<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Kernel\Messages;

/**
 * Class Text.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Text extends Message
{
    protected $type = 'text';

    public function __construct(string $content)
    {
        parent::__construct(compact('content'));
    }
}
