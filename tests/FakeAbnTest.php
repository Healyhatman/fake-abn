<?php

namespace Faker\tests;

use Faker\Generator;
use Faker\Provider\FakeAbn;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class FakeAbnTest extends TestCase
{
    private Generator $faker;

    /**
     * A simple provider to run a test 100 times
     *
     * @return array
     */
    public static function dataProviderOneHundredTimes(): array
    {
        return array_fill(0, 100, []);
    }

    public static function dataProviderCanValidateAbn(): array
    {
        return [
            'Sky Spider ABN' => ['82 892 660 618', true],
            'Australian Taxation Office' => ['51 824 753 556', true],
            'Empty' => ['', false],
            'Too short' => ['1234567890', false],
            'Too long' => ['123456789012', false],
            'Invalid' => ['12345678901', false],
            'Fails checksum' => ['45632456452', false],
            'Invalid characters' => ['1234567890a', false],
        ];
    }

    #[DataProvider('dataProviderOneHundredTimes')]
    public function testCanGenerateValidAbns(): void
    {
        $abn = $this->faker->abn();

        $this->assertTrue(FakeAbn::validateAbn($abn));
    }

    #[DataProvider('dataProviderCanValidateAbn')]
    public function testCanValidateAbn(string $abn, bool $expected): void
    {
        $this->assertEquals($expected, FakeAbn::validateAbn($abn));
    }

    protected function setUp(): void
    {
        $this->faker = new Generator();
        $this->faker->addProvider(new FakeAbn($this->faker));
    }
}