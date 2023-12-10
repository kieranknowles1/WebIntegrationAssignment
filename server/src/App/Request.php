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
        return new Request($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"], $_POST, getallheaders(), $_SERVER["PHP_AUTH_USER"] ?? null, $_SERVER["PHP_AUTH_PW"] ?? null);
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
     * @param array<string, string> $bodyParams
     * @param array<string, string> $headers
     */
    private function __construct(string $rawUrl, string $method, array $bodyParams, array $headers, ?string $authUser, ?string $authPassword)
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
        $this->bodyParams = $bodyParams;
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

    /** @return array<string, string> */
    public function getBodyParams(): array
    {
        return $this->bodyParams;
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
