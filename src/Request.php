<?php
declare(strict_types=1);

namespace PlaystationStoreApi;

use PlaystationStoreApi\Enum\Regions;
use Psr\Http\Client\ClientInterface;
use GuzzleHttp\Client;

class Request
{
    protected string $region;
    protected string $language;
    protected ClientInterface $httpClient;

    public function __construct(Regions $region)
    {
        $this->parseRegion($region);

        $this->httpClient = new Client([
            'base_uri' => 'https://store.playstation.com/store/api/chihiro/00_09_000/container/'.strtoupper($this->region).'/'.$this->language.'/999/',
            'timeout' => 10,
        ]);
    }

    protected function parseRegion(Regions $region) : void
    {
        if ($result = explode('-', $region->getValue())) {
            $this->region = array_pop($result);
            $this->language = implode('-', $result);
        } else {
            throw new \UnexpectedValueException('The value ['.$region->getValue().'] is not valid');
        }
    }

    /**
     * @param string $pageId
     * @param array  $params
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $pageId, array $params = []) : string
    {
        return $this->httpClient->get($pageId, $params)->getBody()->getContents();
    }
}