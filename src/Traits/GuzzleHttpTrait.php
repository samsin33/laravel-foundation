<?php

namespace Samsin33\Foundation\Traits;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;

trait GuzzleHttpTrait
{
    public function httpCurl($url, $method, $properties = [])
    {
        try
        {
            $guzzle = new HttpClient();
            $response = $guzzle->request($method, $url, $properties);
            return $response;
        }
        catch (RequestException $exception)
        {
            return $exception->getResponse();
        }
    }
}
