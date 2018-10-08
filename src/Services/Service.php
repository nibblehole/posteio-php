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
        return strtolower($this->classBasename(static::class));
    }

    public function all($filters = null)
    {
        return $this->client->request('GET', $this->getEndpoint(), $filters);
    }

    /**
     * Get the class "basename" of the given object / class.
     *
     * @param  string|object $class
     * @return string
     */
    protected function classBasename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}
