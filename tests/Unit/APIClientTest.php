<?php


namespace Unit;


use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Sarnado\Converter\API\APIClient;

class APIClientTest extends TestCase
{
    public function test__construct()
    {
        $client = new APIClient($_ENV['API_KEY']);
        self::assertInstanceOf(APIClient::class, $client);
        self::assertInstanceOf(Client::class, $client->getHttpClient());
    }
}
