<?php


namespace EasyDingTalk;


use JetBrains\PhpStorm\Pure;

class Client
{
    protected array $middleware = [];

    public function __construct()
    {
        //
    }

    public function withMiddleware(callable $middleware): static
    {
        $this->middleware[] = $middleware;

        return $this;
    }

    public function get($uri, array $query = [])
    {
        return $this->send('GET', $uri, [
            'query' => $query,
        ]);
    }

    public function post($uri, array $data = [])
    {
        return $this->send('POST', $uri, [
            'json' => $data,
        ]);
    }

    public function send(string $method, $uri, array $options = [])
    {
        return new Response();
    }
}