<?php

namespace PosteioTests;

use PHPUnit\Framework\TestCase;
use TorMorten\Posteio\Client;

class ClientTest extends TestCase
{
    /** @test * */
    public function it_can_send_a_get_request()
    {
        $client = new Client('http://localhost', 'test_username', 'test_password');
        $client->setClient(new \Http\Mock\Client());

        $client->boxes()->all();

        $requests = $client->getClient()->getRequests();
        $this->assertEquals('GET', $requests[0]->getMethod());
    }

    /** @test * */
    public function it_can_send_a_post_request()
    {
        $client = new Client('http://localhost', 'test_username', 'test_password');
        $client->setClient(new \Http\Mock\Client());

        $client->boxes()->create(['name' => 'John Doe', 'email' => 'john@myhost.com']);

        $requests = $client->getClient()->getRequests();
        $this->assertEquals('POST', $requests[0]->getMethod());
    }
}
