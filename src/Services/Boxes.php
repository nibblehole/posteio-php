<?php 

namespace TorMorten\Posteio\Services;

use TorMorten\Posteio\Traits\Creates;
use TorMorten\Posteio\Traits\Deletes;
use TorMorten\Posteio\Traits\Gets;
use TorMorten\Posteio\Traits\Updates;

class Boxes extends Service
{
    use Creates, Updates, Deletes, Gets;

    public function getQuota($email)
    {
        return $this->client->request('GET', "{$this->getEndpoint()}/{$email}/quota");
    }

    public function setQuota($email, $size = null, $count = null)
    {
        $data = [];

        if ($size) {
            $data['quotaSize'] = $size;
        }
        if ($count) {
            $data['quotaCount'] = $count;
        }

        return $this->client->request('PATCH', "{$this->getEndpoint()}/{$email}/quota", $data);
    }

    public function setSleve($email, $script)
    {
        return $this->client->request('PATCH', "{$this->getEndpoint()}/{$email}/sleve", [
            'script' => $script
        ]);
    }
}
