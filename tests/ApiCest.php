<?php
class ApiCest
{
    public function tryApiWithoutValues(ApiTester $I)
    {
        $I->sendGET('/');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiWithoutFrom(ApiTester $I)
    {
        $I->sendGET('/BRL');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiWithoutTo(ApiTester $I)
    {
        $I->sendGET('/EUR');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiWithoutAmount(ApiTester $I)
    {
        $I->sendGET('/BRL/USD/', ['price' => 5.58]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiWithoutPrice(ApiTester $I)
    {
        $I->sendGET('/BRL/USD/', ['amount' => 10]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiNegativeAmount(ApiTester $I)
    {
        $I->sendGET('/BRL/USD/', ['amount' => -10, 'price' => 5.58]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiInvalidAmount(ApiTester $I)
    {
        $I->sendGET('/BRL/USD/', ['amount' => 'a', 'price' => 5.58]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiInvalidPrice(ApiTester $I)
    {
        $I->sendGET('/BRL/EUR/', ['amount' => 10, 'price' => 'a']);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiInvalidFrom(ApiTester $I)
    {
        $I->sendGET('/eur/USD/', ['amount' => 10, 'price' => 5.58]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiInvalidTo(ApiTester $I)
    {
        $I->sendGET('/EUR/usd/', ['amount' => 10, 'price' => 6.70]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiBrlToUsd(ApiTester $I)
    {
        $I->sendGET('/BRL/USD/', ['amount' => 12, 'price' => 5.58]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'convertedValue' => 2.15,
            'symbol' => '$',
        ]);
    }

    public function tryApiUsdToBrl(ApiTester $I)
    {
        $I->sendGET('/USD/BRL/', ['amount' => 7, 'price' => 5.58]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'convertedValue' => 39.06,
            'symbol' => 'R$',
        ]);
    }

    public function tryApiBrlToEur(ApiTester $I)
    {
        $I->sendGET('/BRL/EUR/', ['amount' => 7, 'price' => 6.70]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'convertedValue' => 1.04,
            'symbol' => '€',
        ]);
    }

    public function tryApiEurToBrl(ApiTester $I)
    {
        $I->sendGET('/EUR/BRL/', ['amount' => 7, 'price' => 6.70]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'convertedValue' => 46.9,
            'symbol' => 'R$',
        ]);
    }
}
