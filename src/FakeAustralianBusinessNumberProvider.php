<?php

namespace Faker\Provider;

class FakeAustralianBusinessNumberProvider implements FakeAbnProviderInterface
{
    /**
     * Generate a random Australian Business Number (ABN)
     *
     * @see http://pastebin.com/zrmLHzWs by https://stackoverflow.com/users/2274016/adrian-brown
     * @return string
     */
    public function getAustralianBusinessNumber(): string
    {
        // Generate a random 9-digit number, ensuring it is left-padded with zeros
        $random_number = str_pad(($random_number ?? rand(1, 999999999)), 9, '0', STR_PAD_LEFT);

        // Add the prefix "10" to the random number
        $abn = "10$random_number";

        // Calculate the ABN checksum
        $weights = [10, 1, 3, 5, 7, 9, 11, 13, 15, 17, 19];
        $sum = 0;
        foreach ($weights as $position => $weight) {
            $digit = $abn[$position] - ($position ? 0 : 1);
            $sum += $weight * $digit;
        }

        // Calculate the expected checksum digit and return the ABN
        return ((89 - ($sum % 89)) + 10).$random_number;
    }
}