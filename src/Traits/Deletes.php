<?php 

namespace TorMorten\Posteio\Traits;

use GuzzleHttp\Exception\ClientException;

trait Deletes
{
    public function delete($email)
    {
        return $this->client->request('DELETE', $this->getEndpoint() . '/'. $email, $data);
    }
}
