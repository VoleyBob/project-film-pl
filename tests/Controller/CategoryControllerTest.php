<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class CategoryControllerTest extends WebTestCase
{

    public function testMainPageReponse()
    {
        $client = static::createClient();
        $client->request('GET','/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
