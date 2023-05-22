<?php

namespace PavelPlot\App\Request;

class Request
{
    private string $url;
    private string $method;
    private array $params;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = $this->method === 'GET' ? $_GET : $_POST;
    }

    public static function generate(): self
    {
        return new self();
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}