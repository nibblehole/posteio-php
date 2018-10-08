<?php

namespace TorMorten\Posteio;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Http\Client\Common\Exception\ClientErrorException;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;

class Client
{
    /**
     * The host to the Poste.io instance
     *
     * @var string
     */
    protected $host;

    /**
     * The admin username
     *
     * @var string
     */
    protected $username;

    /**
     * The admin password
     *
     * @var string
     */
    protected $password;

    /**
     * The HTTP client
     *
     * @var HttpClient
     */
    protected $client;

    /**
     * Build the client
     *
     * @param string $host
     * @param string $username
     * @param string $password
     * @param HttpClient $client
     */
    public function __construct($host, $username, $password, ?HttpClient $client = null)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;

        $this->client = $client;
    }

    /**
     * Sends the request
     *
     * @param  string $method
     * @param  string $endpoint
     * @param  array $data
     * @return string
     */
    protected function sendRequest($method, $endpoint, $data = null)
    {
        if (!$this->client) {
            throw new \Exception('Please add a client by using "setClient" or adding it through the fourth argument to the constructor.');
        }
        $options = [
            'auth' => [$this->username, $this->password]
        ];

        if ($data && is_array($data)) {
            $options['body'] = $data;
        }

        $request = $this->client->sendRequest(
            $this->createRequest($method, $endpoint, $data)
        );

        return (string)$request->getBody();
    }

    protected function createRequest($method, $endpoint, $options)
    {
        $messageFactory = MessageFactoryDiscovery::find();

        return $messageFactory->createRequest($method, "{$this->host}/admin/api/v1/{$endpoint}", [], $options);
    }

    /**
     * Creates a request and parses it as JSON
     *
     * @param  string $method
     * @param  string $endpoint
     * @param  array $data
     * @return array
     */
    public function request($method, $endpoint, $data = null)
    {
        try {
            $response = json_decode($this->sendRequest($method, $endpoint, $data));
            return is_null($response) ? true : $response;
        } catch (ClientException $e) {
            return (string)$e->getResponse()->getBody();
        }
    }

    /**
     * Boxes API
     *
     * @return Services\Boxes
     */
    public function boxes()
    {
        return new Services\Boxes($this);
    }

    /**
     * Domains API
     *
     * @return Services\Domains
     */
    public function domains()
    {
        return new Services\Domains($this);
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient(HttpClient $client)
    {
        $this->client = $client;
        return $this;
    }
}
