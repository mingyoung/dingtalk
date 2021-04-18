<?php

namespace EasyDingTalk\Middleware;

use EasyDingTalk\AccessToken;

class AccessTokenMiddleware
{
    public function __construct(protected AccessToken $token)
    {
        //
    }

    public function __invoke()
    {

    }
}