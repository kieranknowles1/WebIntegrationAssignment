<?php

/**
 * Class for processing the request and extracting information from it
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */

class Request
{
    public static function fromGlobals(): Request
    {
        return new Request($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"], $_POST);
    }

    /** The cleaned requested URL */
    private string $url;
    /** The request method */
    private string $method;
    /**
     * The query parameters
     * @var array<string, string>
     */
    private array $queryParams;
    /**
     * The body parameters
     * @var array<string, string>
     */
    private array $bodyParams;

    /**
     * Clean the URL to be in lowercase and without any trailing /
     */
    private function cleanUrl($raw): string
    {
        $url = strtolower($raw);
        $url = rtrim($url, '/');
        return $url;
    }

    private function __construct($rawUrl, $method, $bodyParams)
    {
        $parsed = parse_url($rawUrl);
        $this->url = $this->cleanUrl($parsed["path"]);
        $this->method = $method;
        $this->queryParams = [];
        parse_str($parsed["query"] ?? "", $this->queryParams);
        $this->bodyParams = $bodyParams;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    /** @return array<string, string> */
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /** @return array<string, string> */
    public function getBodyParams(): array
    {
        return $this->bodyParams;
    }
}
