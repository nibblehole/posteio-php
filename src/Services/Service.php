<?php 

namespace TorMorten\Posteio\Services;

use TorMorten\Posteio\Client;

abstract class Service
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getEndpoint()
    {
        return strtolower(class_basename(static::class));
    }

    public function all($filters = null)
    {
        return $this->client->request('GET', $this->getEndpoint(), $filters);
    }
}
