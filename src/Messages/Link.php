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

class Link extends Message
{
    protected $type = 'link';

    public function setPictureUrl($value)
    {
        return $this->setAttribute('picUrl', $value);
    }

    public function setTitle($value)
    {
        return $this->setAttribute('title', $value);
    }

    public function setText($value)
    {
        return $this->setAttribute('text', $value);
    }

    protected function transform($value)
    {
        list($url) = $value;

        return ['messageUrl' => $url];
    }
}
