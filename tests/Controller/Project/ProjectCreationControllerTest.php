<?php

namespace App\Tests\Controller\Project;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ProjectCreationControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/project/creation');

        self::assertResponseIsSuccessful();
    }
}
