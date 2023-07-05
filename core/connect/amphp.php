<?php

namespace Bot\Core\Connect;

use Amp\Http\Client\HttpClient;
use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\Request;
use Amp\Promise;
use Bot\Core\Cli\Error\Logger;

class Amphp
{
    private HttpClient $httpClient;
    private string $apiBaseUrl;

    public function __construct(string $url)
    {
        if (!file_exists('vendor/amphp')){
            Logger::status('Failed', 'Please Install AMPHP!', 'failed', true);
        }

        $this->apiBaseUrl = $url;
        $this->httpClient = HttpClientBuilder::buildDefault();
    }

    public function get(array $queryParams = []): Promise
    {
        $url = $this->apiBaseUrl . '?' . http_build_query($queryParams);
        $request = new Request($url, 'GET');
        return $this->httpClient->request($request);
    }

    public function post(array $data = []): Promise
    {
        $url = $this->apiBaseUrl;
        $request = new Request($url, 'POST');
        $request->setHeader('Content-Type', 'application/json');
        $request->setBody(json_encode($data));
        return $this->httpClient->request($request);
    }
}