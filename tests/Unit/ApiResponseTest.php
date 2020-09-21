<?php


namespace Unit;


use PHPUnit\Framework\TestCase;
use Sarnado\Converter\API\APIResponse;
use Sarnado\Converter\Exceptions\BadAPIResponseException;
use Sarnado\Converter\Exceptions\BadRequestException;
use Sarnado\Converter\Exceptions\ConverterServerErrorException;
use Sarnado\Converter\Exceptions\DefaultAPIException;
use Sarnado\Converter\Exceptions\ReachedRateLimitException;
use Sarnado\Converter\Exceptions\UnauthorizedException;

class ApiResponseTest extends TestCase
{
    const VALID_DATA_JSON = '{
      "success": true,
      "result": {
        "current": 0,
        "available": 60,
        "refresh_after": -1600203128
      }
    }';

    const INVALID_DATA_JSON_WITHOUT_DATA = '{
      "success": true
    }';

    const INVALID_DATA_JSON_WITH_DATA = '{
      "success": false,
      "result": {
        "current": 0,
        "available": 60,
        "refresh_after": -1600203128
      }
    }';


    public function test__construct()
    {
        $response = new APIResponse(200, self::VALID_DATA_JSON);
        self::assertInstanceOf(APIResponse::class, $response);
        $parsed = json_decode(self::VALID_DATA_JSON, true);
        self::assertEquals($parsed['success'], $response->getSuccess());
        self::assertEquals($parsed['result'], $response->getResult());
    }

    public function testBadRequestException()
    {
        $this->expectException(BadRequestException::class);
        $response = new APIResponse(404, self::VALID_DATA_JSON);
    }

    public function testReachedRateLimitException()
    {
        $this->expectException(ReachedRateLimitException::class);
        $response = new APIResponse(429, self::VALID_DATA_JSON);
    }

    public function testConverterServerErrorException()
    {
        $this->expectException(ConverterServerErrorException::class);
        $response = new APIResponse(500, self::VALID_DATA_JSON);
    }

    public function testUnauthorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $response = new APIResponse(401, self::VALID_DATA_JSON);
    }

    public function testDefaultAPIException()
    {
        $this->expectException(DefaultAPIException::class);
        $response = new APIResponse(302, self::VALID_DATA_JSON);
    }

    public function testBadAPIResponseExceptionWithData()
    {
        $this->expectException(BadAPIResponseException::class);
        $response = new APIResponse(200, self::INVALID_DATA_JSON_WITH_DATA);
    }

    public function testBadAPIResponseExceptionWithoutData()
    {
        $this->expectException(BadAPIResponseException::class);
        $response = new APIResponse(200, self::INVALID_DATA_JSON_WITHOUT_DATA);
    }
}
