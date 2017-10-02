<?php 

namespace TorMorten\Posteio\Traits;

use GuzzleHttp\Exception\ClientException;

trait Creates
{
    public function create($data)
    {
        return $this->client->request('POST', $this->getEndpoint(), $data);
    }
}
