<?php

namespace TorMorten\Posteio;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;

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
     * Build the client
     *
     * @param string $host
     * @param string $username
     * @param string $password
     */
    public function __construct($host, $username, $password)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;

        $this->client = new GuzzleClient([
            'base_uri' => "{$this->host}/admin/api/v1/"
        ]);
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
        $options = [
            'auth' => [$this->username, $this->password]
        ];
        
        if ($data && is_array($data)) {
            $options['form_params'] = $data;
        }

        $request = $this->client->request($method, $endpoint, $options);

        return (string) $request->getBody();
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
            return (string) $e->getResponse()->getBody();
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
}
