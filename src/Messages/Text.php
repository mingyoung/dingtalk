<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Messages;

class Text extends Message
{
    protected $type = 'text';

    protected function transform($value)
    {
        list($content) = $value;

        return ['content' => $content];
    }
}
