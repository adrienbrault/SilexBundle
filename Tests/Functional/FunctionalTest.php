<?php

namespace AdrienBrault\SilexBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FunctionalTest extends WebTestCase
{
    public function testIndex()
    {
        $client = $this->createClient();
        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('Hello!', $client->getResponse()->getContent());
    }

    public function testWow()
    {
        $client = $this->createClient();
        $client->request('GET', '/wow/silex');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('wow such silex' . "\n", $client->getResponse()->getContent());
    }
}
