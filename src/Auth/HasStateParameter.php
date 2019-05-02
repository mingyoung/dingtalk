<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Auth;

use function EasyDingTalk\str_random;
use function EasyDingTalk\tap;

trait HasStateParameter
{
    /**
     * Generate state.
     *
     * @return string
     */
    protected function makeState()
    {
        return tap(str_random(64), function ($state) {
            $this->app['request']->getSession()->set('state', $state);
        });
    }

    /**
     * @param string|null $state
     *
     * @return bool
     */
    protected function hasValidState($state)
    {
        return !is_null($state) && ($state === $this->app['request']->getSession()->get('state'));
    }
}
