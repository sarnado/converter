<?php


namespace Unit;


use PHPUnit\Framework\TestCase;
use Sarnado\Converter\Collections\CryptoCurrenciesCollection;
use Sarnado\Converter\Collections\CryptoExchangesCollection;
use Sarnado\Converter\Collections\CryptoRatesCollection;
use Sarnado\Converter\Collections\FiatCurrenciesCollection;
use Sarnado\Converter\Collections\FiatRatesCollection;
use Sarnado\Converter\Objects\APIUsageObject;
use Sarnado\Converter\Objects\CryptoCurrencyObject;
use Sarnado\Converter\Objects\CryptoExchangeObject;
use Sarnado\Converter\Objects\CryptoRateObject;
use Sarnado\Converter\Objects\FiatCurrencyObject;
use Sarnado\Converter\Objects\FiatRateObject;
use Sarnado\Converter\SarnadoConverter;
use Tightenco\Collect\Support\Collection;

class SarnadoConverterTest extends TestCase
{
    /**
     * @var SarnadoConverter
     */
    private $validConverter;
    /**
     * @var SarnadoConverter
     */
    private $invalidConverter;

    public function setUp()
    {
        $this->validConverter = new SarnadoConverter($_ENV['API_KEY']);
        $this->invalidConverter = new SarnadoConverter(1234);
    }

    public function testGetApiUsage()
    {
        $result = $this->validConverter->getApiUsage();
        self::assertInstanceOf(APIUsageObject::class, $result);
        self::assertInternalType('int', $result->getCurrent());
        self::assertInternalType('int', $result->getAvailable());
        self::assertInternalType('int', $result->getRefreshAfter());
    }

    public function testGetApiUsageInvalidConverter()
    {
        $this->expectException(\Throwable::class);
        $result = $this->invalidConverter->getApiUsage();
    }

    public function testGetCryptoExchanges()
    {
        $result = $this->validConverter->getCryptoExchanges();
        self::assertInstanceOf(CryptoExchangesCollection::class, $result);
        foreach ($result as $item)
        {
            self::assertInstanceOf(CryptoExchangeObject::class, $item);
        }
    }

    public function testGetCryptoExchangesInvalidConverter()
    {
        $this->expectException(\Throwable::class);
        $result = $this->invalidConverter->getCryptoExchanges();
    }

    public function testGetCryptoRates()
    {
        $result = $this->validConverter->getCryptoRates();
        self::assertInstanceOf(CryptoRatesCollection::class, $result);
        foreach ($result as $item)
        {
            self::assertInstanceOf(CryptoRateObject::class, $item);
        }
    }

    public function testGetCryptoRatesWithParams()
    {
        $result = $this->validConverter->getCryptoRates('BTC', 'USD');
        self::assertInstanceOf(CryptoRateObject::class, $result);
    }

    public function testGetCryptoRatesWithAllParams()
    {
        $result = $this->validConverter->getCryptoRates('BTC', 'USD', 'binance');
        self::assertInstanceOf(CryptoRateObject::class, $result);
    }

    public function testGetCryptoRatesInvalidConverter()
    {
        $this->expectException(\Throwable::class);
        $result = $this->invalidConverter->getCryptoRates();
    }

    public function testGetFiatRates()
    {
        $result = $this->validConverter->getFiatRates();
        self::assertInstanceOf(FiatRatesCollection::class, $result);
        foreach ($result as $item)
        {
            self::assertInstanceOf(FiatRateObject::class, $item);
        }
    }

    public function testGetFiatRatesWithAllParams()
    {
        $result = $this->validConverter->getFiatRates('USD', 'RUB');
        self::assertInstanceOf(FiatRateObject::class, $result);
    }

    public function testGetFiatRatesInvalidConverter()
    {
        $this->expectException(\Throwable::class);
        $result = $this->invalidConverter->getFiatRates();
    }

    public function testGetCryptoCurrencies()
    {
        $result = $this->validConverter->getCryptoCurrencies();
        self::assertInstanceOf(CryptoCurrenciesCollection::class, $result);
        foreach ($result as $item)
        {
            self::assertInstanceOf(CryptoCurrencyObject::class, $item);
        }
    }

    public function testGetCryptoCurrenciesInvalidConverter()
    {
        $this->expectException(\Throwable::class);
        $result = $this->invalidConverter->getCryptoCurrencies();
    }

    public function testGetFiatCurrencies()
    {
        $result = $this->validConverter->getFiatCurrencies();
        self::assertInstanceOf(FiatCurrenciesCollection::class, $result);
        foreach ($result as $item)
        {
            self::assertInstanceOf(FiatCurrencyObject::class, $item);
        }
    }

    public function testGetFiatCurrenciesInvalidConverter()
    {
        $this->expectException(\Throwable::class);
        $result = $this->invalidConverter->getFiatCurrencies();
    }
}
