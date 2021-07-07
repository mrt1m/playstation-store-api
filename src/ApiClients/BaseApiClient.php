<?php
declare(strict_types=1);

namespace PlaystationStoreApi\ApiClients;

use GuzzleHttp\Psr7\Uri;
use PlaystationStoreApi\Enum\Region;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

abstract class BaseApiClient
{
    protected ClientInterface $client;
    protected string $region;
    protected string $language;
    protected UriInterface $uri;
    protected array $headers = [];
    protected Uri $basePath;

    public function __construct(Region $region, ClientInterface $client)
    {
        $this->parseRegion($region);

        $this->client = $client;
        $this->uri = new Uri();
        $this->basePath = new Uri();
    }

    protected function parseRegion(Region $region) : void
    {
        if ($result = explode('-', $region->getValue())) {
            $this->region = array_pop($result);
            $this->language = implode('-', $result);
        } else {
            throw new \UnexpectedValueException('The value [' . $region->getValue() . '] is not valid');
        }
    }

    protected function mergeBasePath(UriInterface $uri) : UriInterface
    {
        return $uri
            ->withScheme($this->basePath->getScheme())
            ->withHost($this->basePath->getHost())
            ->withPath($this->basePath->getPath() . $uri->getPath());
    }

    abstract public function get(RequestInterface $request) : string;
}