<?php 

namespace TorMorten\Posteio\Traits;

trait Updates
{
    public function update($email, $data)
    {
        return $this->client->request('PATCH', $this->getEndpoint() . '/'. $email, $data);
    }
}
