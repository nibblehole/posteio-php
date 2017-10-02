<?php 

namespace TorMorten\Posteio\Services;

use TorMorten\Posteio\Traits\Creates;
use TorMorten\Posteio\Traits\Deletes;
use TorMorten\Posteio\Traits\Gets;
use TorMorten\Posteio\Traits\Updates;

class Domains extends Service
{
    use Creates, Updates, Deletes, Gets;

    public function getDkim($domain)
    {
        return $this->client->request('GET', "{$this->getEndpoint()}/{$domain}/dkim");
    }

    public function deleteDkim($domain)
    {
        return $this->client->request('DELETE', "{$this->getEndpoint()}/{$domain}/dkim");
    }

    public function setDkim($domain, $name)
    {
        return $this->client->request('PATCH', "{$this->getEndpoint()}/{$email}/dkim", [
            'name' => $name
        ]);
    }
}
