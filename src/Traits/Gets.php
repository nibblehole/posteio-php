<?php 

namespace TorMorten\Posteio\Traits;

use GuzzleHttp\Exception\ClientException;

trait Gets
{
    public function get($email)
    {
        return $this->client->request('GET', $this->getEndpoint() . '/'. $email);
    }
}
