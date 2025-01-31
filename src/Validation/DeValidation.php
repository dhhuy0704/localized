<?php
declare(strict_types=1);

/**
 * German Localized Validation class. Handles localized validation for Germany.
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
 * DeValidation
 */
class DeValidation extends LocalizedValidation
{
    /**
     * Define locale to be used by that localized
     * validation set
     *
     * @var string
     */
    protected static $validationLocale = 'de_DE';

    /**
     * Checks a postal code for Germany.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function postal(string $check): bool
    {
        $pattern = '/^(0[1-46-9]\d{3}|[1-357-9]\d{4}|[4][0-24-9]\d{3}|[6][013-9]\d{3})$/';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks an address (street and number) for Germany.
     * That is what is called "Straße und Hausnummer",
     * the first line of a german formal address block.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function address1(string $check): bool
    {
        $pattern = '/[a-zA-ZäöüÄÖÜß \.]+ \d+[a-zA-Z]?/';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks a phone number for Germany.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function phone(string $check): bool
    {
        $pattern = '/^[0-9\/. \-]*$/';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks date of birth formal format for Germany (dd.mm.yyyy),
     * afterwards checks it is a valid gregorian calendar date.
     *
     * @param string $check the date of birth.
     * @return bool Success.
     */
    public static function dob(string $check): bool
    {
        $pattern = '/^\d{2}\.\d{2}\.(\d{2}|\d{4})$/';
        $return = preg_match($pattern, $check);
        if (!$return) {
            return false;
        }
        $check = str_replace('.', ',', $check);
        $check = explode(',', $check, 3);

        return checkdate((int)$check[1], (int)$check[0], (int)$check[2]);
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
