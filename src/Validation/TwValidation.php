<?php
declare(strict_types=1);

/**
 * Taiwan Localized Validation class. Handles localized validation for Taiwan.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link https://cakephp.org
 * @since Localized Plugin v 0.1
 * @license https://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Localized\Validation;

/**
 * TwValidation
 */
class TwValidation extends LocalizedValidation
{
    /**
     * Define locale to be used by that localized
     * validation set
     *
     * @var string
     */
    protected static $validationLocale = 'zh_TW';

    /**
     * Checks a phone number for Taiwan.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function phone(string $check): bool
    {
        $pattern = '/^\(?(0|\+886)[-. ]?[2-9][\)-. ]?(\d[\)-. ]?){2}(\d[-. ]?){3}\d{2}\d?$/';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks a postal code for Taiwan.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function postal(string $check): bool
    {
        $pattern = '/^[1-9]\d{2}(\d{2})?$/';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks national identify card number for Taiwan.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function personId(string $check): bool
    {
        $check = strtoupper($check);
        if (!preg_match('/^[A-Z][1-2]\d{8}$/', $check)) {
            return false;
        }
        $keyTable = [
            'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17,
            'I' => 34, 'J' => 18, 'K' => 19, 'L' => 20, 'M' => 21, 'N' => 22, 'O' => 35, 'P' => 23,
            'Q' => 24, 'R' => 25, 'S' => 26, 'T' => 27, 'U' => 28, 'V' => 29, 'W' => 32, 'X' => 30,
            'Y' => 31, 'Z' => 33,
        ];
        $n1 = $keyTable[$check[0]];
        $checksum = (int)($n1 / 10) + ($n1 % 10) * 9;

        for ($i = 1; $i < 9; $i++) {
            $checksum += $check[$i] * (9 - $i);
        }

        return substr(strval(10 - ($checksum % 10)), 0, 1) === $check[9];
    }

    /**
     * Checks unified business number for Taiwan.
     *
     * @param string $check The value to check.
     * @return bool Success.
     * @link https://herolin.mine.nu/entry/is-valid-TW-company-ID
     */
    public static function ubn(string $check): bool
    {
        if (!preg_match('/^\d{8}$/', $check)) {
            return false;
        }
        $tbNum = [1, 2, 1, 2, 1, 2, 4, 1];
        $intSum = 0;
        for ($i = 0; $i < 8; $i++) {
            $intMultiply = $check[$i] * $tbNum[$i];
            $intAddition = floor($intMultiply / 10) + ($intMultiply % 10);
            $intSum += $intAddition;
        }

        return ($intSum % 10 === 0) || ($intSum % 10 === 9 && $check[6] === 7);
    }

    /**
     * Checks national identify card number for Taiwan.
     *
     * @param string $check The value to check.
     * @return bool Success.
     * @deprecated Use personId() instead.
     */
    public static function nicn(string $check): bool
    {
        return static::personId($check);
    }
}
