<?php
declare(strict_types=1);

/**
 * French Localized Validation class. Handles localized validation for France.
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
 * FrValidation
 */
class FrValidation extends LocalizedValidation
{
    /**
     * Define locale to be used by that localized
     * validation set
     *
     * @var string
     */
    protected static $validationLocale = 'fr_FR';

    /**
     * Checks a phone number for France.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function phone(string $check): bool
    {
        $pattern = '/(^0|\+33)(0?[1-9]{1}|\s0?[1-9]{1}|-0?[1-9]{1}|\.0?[1-9]{1})((\d{8})|((\s\d{2}){4})|((-\d{2}){4})|((\.\d{2}){4}))$|(^0(508|596|590|594|262))((\d{6})|((\s\d{2}){3})|((-\d{2}){3})|((\.\d{2}){3}))$|(^\+(?\'intl\'508|596|590|594|262))((\k\'intl\'\d{6})|(\s\k\'intl\'(\s\d{2}){3})|(-\k\'intl\'(-\d{2}){3})|(\.\k\'intl\'(\.\d{2}){3}))$/';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks a postal code for France.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function postal(string $check): bool
    {
        $pattern = '/^\d{5}$/';
        if ((bool)preg_match($pattern, $check)) {
            $value = (int)$check;

            return $value >= 1000 && $value <= 99138;
        }

        return false;
    }

    /**
     * Checks a social security number for France.
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function personId(string $check): bool
    {
        $pattern = '/^[12]\d{2}(0\d|1[012])(\d{2}|2[AB])\d{8}$/';
        if (!preg_match($pattern, $check)) {
            return false;
        }

        $numberWithoutKey = substr($check, 0, -2);
        $key = substr($check, -2);

        // Corse special cases
        // source : https://xml.insee.fr/schema/nir.html
        // check : https://www.parodie.com/monetique/nir.htm
        if ($numberWithoutKey[6] === 'A') {
            $numberWithoutKey = str_replace('A', '0', $numberWithoutKey);
            $numberWithoutKey -= 1000000;
        } elseif ($numberWithoutKey[6] === 'B') {
            $numberWithoutKey = str_replace('B', '0', $numberWithoutKey);
            $numberWithoutKey -= 2000000;
        }

        return $key == 97 - ($numberWithoutKey - (floor($numberWithoutKey / 97) * 97));
    }
}
