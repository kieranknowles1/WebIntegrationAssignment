<?php

namespace App;

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
        $body = file_get_contents("php://input");
        if ($body === false) {
            throw new \InvalidArgumentException("Failed to read request body");
        }

        return new Request(
            $_SERVER["REQUEST_URI"], // rawUrl
            $_SERVER["REQUEST_METHOD"], // method
            $body, // body
            getallheaders(), // headers
            $_SERVER["PHP_AUTH_USER"] ?? null, // authUser
            $_SERVER["PHP_AUTH_PW"] ?? null // authPassword
        );
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
    /** The body of the request. Expected format depends on the endpoint */
    private string $body;

    /**
     * The headers
     * @var array<string, string>
     */
    private array $headers;

    private ?string $authUser;
    private ?string $authPassword;

    /**
     * Clean the URL to be in lowercase and without any trailing /
     */
    private function cleanUrl(string $raw): string
    {
        $url = strtolower($raw);
        $url = rtrim($url, '/');
        return $url;
    }

    /**
     * @param array<string, string> $headers
     */
    private function __construct(string $rawUrl, string $method, string $body, array $headers, ?string $authUser, ?string $authPassword)
    {
        $parsed = parse_url($rawUrl);

        // Check for a malformed URL
        if ($parsed === false) {
            throw new \InvalidArgumentException("Failed to parse URL");
        }
        if (!isset($parsed["path"])) {
            throw new \InvalidArgumentException("URL has no path");
        }

        $this->url = $this->cleanUrl($parsed["path"]);
        $this->method = $method;
        $this->queryParams = [];
        parse_str($parsed["query"] ?? "", $this->queryParams);
        $this->body = $body;
        $this->headers = [];
        foreach ($headers as $key => $value) {
            $this->headers[strtolower($key)] = $value;
        }

        $this->authUser = $authUser;
        $this->authPassword = $authPassword;
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

    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Get the lowercased headers
     * @return array<string, string>
     * */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getAuthUser(): ?string
    {
        return $this->authUser;
    }

    public function getAuthPassword(): ?string
    {
        return $this->authPassword;
    }
}
