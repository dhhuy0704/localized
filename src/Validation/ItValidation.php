<?php
declare(strict_types=1);

/**
 * Italian Localized Validation class. Handles localized validation for Italy.
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

use Cake\Http\Exception\NotImplementedException;

/**
 * ItValidation
 */
class ItValidation extends LocalizedValidation
{
    /**
     * Define locale to be used by that localized
     * validation set
     *
     * @var string
     */
    protected static $validationLocale = 'it_IT';

    /**
     * Checks a phone number for Italy.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function phone(string $check): bool
    {
        $pattern = '/^(\d*\-?\ ?\/?\d*)$/';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks a postal code for Italy.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function postal(string $check): bool
    {
        $pattern = '/^\d{5}$/i';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks Codice Fiscale for Italy.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function cf(string $check): bool
    {
        if ((strlen($check) === 11) && preg_match('/\d{11}/', $check)) {
            return true;
        }

        $check = strtoupper($check);
        if (strlen($check) !== 16 || !preg_match('/[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]/', $check)) {
            return false;
        }

        $checkOdd = [
            '0' => 1, '1' => 0, '2' => 5, '3' => 7, '4' => 9, '5' => 13,
            '6' => 15, '7' => 17, '8' => 19, '9' => 21,
            'A' => 1, 'B' => 0, 'C' => 5, 'D' => 7, 'E' => 9, 'F' => 13,
            'G' => 15, 'H' => 17, 'I' => 19, 'J' => 21, 'K' => 2, 'L' => 4,
            'M' => 18, 'N' => 20, 'O' => 11, 'P' => 3, 'Q' => 6, 'R' => 8,
            'S' => 12, 'T' => 14, 'U' => 16, 'V' => 10, 'W' => 22, 'X' => 25,
            'Y' => 24, 'Z' => 23,
        ];
        $sum = 0;

        for ($i = 1; $i <= 13; $i += 2) {
            $sum += is_numeric($check[$i]) ? (int)$check[$i] : ord($check[$i]) - ord('A');
        }

        for ($i = 0; $i <= 14; $i += 2) {
            $sum += $checkOdd[$check[$i]];
        }

        return chr($sum % 26 + ord('A')) === $check[15];
    }

    /**
     * Checks a country specific identification number.
     *
     * @param string $check The value to check.
     * @throws \Cake\Http\Exception\NotImplementedException Exception
     * @return bool Success.
     */
    public static function personId(string $check): bool
    {
        throw new NotImplementedException(__d('localized', '%s Not implemented yet.'));
    }
}
