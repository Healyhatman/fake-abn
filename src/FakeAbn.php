<?php

namespace Faker\Provider;

use Faker\Generator;

class FakeAbn extends Base
{
    protected FakeAbnProviderInterface $dataProvider;

    public function __construct(Generator $generator)
    {
        parent::__construct($generator);

        $this->setDataProvider(new FakeAustralianBusinessNumberProvider());
    }

    public function setDataProvider(FakeAbnProviderInterface $dataProvider): void
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * Validate the ABN using the Australian Tax Office's verification method
     *
     * @see https://abr.business.gov.au/Help/AbnFormat
     *
     * @param  string  $abn
     *
     * @return bool
     */
    public static function validateAbn(string $abn): bool
    {
        $weights = [10, 1, 3, 5, 7, 9, 11, 13, 15, 17, 19];

        // strip anything other than digits
        $abn = preg_replace('/\D/', '', $abn);

        // check length is 11 digits
        if (strlen($abn) == 11) {
            // apply ato check method
            $sum = 0;
            foreach ($weights as $position => $weight) {
                $digit = $abn[$position] - ($position ? 0 : 1);
                $sum += $weight * $digit;
            }
            return ($sum % 89) == 0;
        }
        return false;
    }

    /**
     * Get a newly generated ABN
     *
     * @return string
     */
    public function abn(): string
    {
        return $this->dataProvider->getAustralianBusinessNumber();
    }
}