<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Kernel\Concerns;

use EasyDingTalk\Kernel\Concerns\InteractsWithCache;
use EasyDingTalk\Tests\TestCase;
use Mockery;
use Psr\SimpleCache\CacheInterface;

class InteractsWithCacheTest extends TestCase
{
    /** @test */
    public function getCache()
    {
        $cache = Mockery::mock(InteractsWithCache::class);

        $this->assertInstanceof(CacheInterface::class, $cache->getCache());
    }
}
