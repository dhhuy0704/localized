<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link https://cakephp.org
 * @license https://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Localized\Validation;

use Cake\I18n\FrozenDate;
use Cake\I18n\I18n;
use Cake\I18n\Number;

/**
 * Localized Validation base class.
 */
abstract class LocalizedValidation implements ValidationInterface
{
    /**
     * Define locale to be used by that localized
     * validation set
     *
     * @var string
     */
    protected static $validationLocale = 'en_US';

    /**
     * Checks a date string, from language specific format.
     *
     * @param string $string The value to check.
     * @return bool Success.
     */
    public static function date(string $string): bool
    {
        $currentLocale = I18n::getLocale();
        $needChange = ($currentLocale !== static::$validationLocale);
        if ($needChange) {
            I18n::setLocale(static::$validationLocale);
        }

        $currentLenient = FrozenDate::lenientParsingEnabled();
        if ($currentLenient) {
            FrozenDate::disableLenientParsing();
        }

        $isValid = FrozenDate::parseDate($string) !== null;

        if ($needChange) {
            I18n::setLocale($currentLocale);
        }

        if ($currentLenient) {
            FrozenDate::enableLenientParsing();
        }

        return $isValid;
    }

    /**
     * Checks a date and time string, from language specific format.
     *
     * @param string $string The value to check.
     * @return bool Success.
     */
    public static function dateTime(string $string): bool
    {
        $currentLocale = I18n::getLocale();
        $needChange = ($currentLocale !== static::$validationLocale);
        if ($needChange) {
            I18n::setLocale(static::$validationLocale);
        }

        $currentLenient = FrozenDate::lenientParsingEnabled();
        if ($currentLenient) {
            FrozenDate::disableLenientParsing();
        }

        $isValid = FrozenDate::parseDateTime($string) !== null;

        if ($needChange) {
            I18n::setLocale($currentLocale);
        }

        if ($currentLenient) {
            FrozenDate::enableLenientParsing();
        }

        return $isValid;
    }

    /**
     * Checks a decimal number, from language specific format.
     *
     * @param string $string The value to check.
     * @return bool Success.
     */
    public static function decimal(string $string): bool
    {
        return Number::parseFloat($string) !== false;
    }
}
