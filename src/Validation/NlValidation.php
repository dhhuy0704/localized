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
 * @since Localized Plugin v 0.1
 * @license https://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Localized\Validation;

/**
 * Dutch Localized Validation class. Handles localized validation for The Netherlands
 */
class NlValidation extends LocalizedValidation
{
    /**
     * Define locale to be used by that localized
     * validation set
     *
     * @var string
     */
    protected static $validationLocale = 'nl_NL';

    /**
     * Checks a phone number for The Netherlands
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function phone(string $check): bool
    {
        $pattern = '/^0(6[\s-]?[1-9]\d{7}|[1-9]\d[\s-]?[1-9]\d{6}|[1-9]\d{2}[\s-]?[1-9]\d{5})$/';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks a postal code for The Netherlands
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function postal(string $check): bool
    {
        $pattern = '/^[1-9]\d{3}\s?[A-Z]{2}$/i';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks a social security number (BSN) for The Netherlands
     *
     * @param string $check The value to check.
     * @return bool Success.
     */
    public static function personId(string $check): bool
    {
        $pattern = '/\A\b\d{9}\b\z/i';

        return (bool)preg_match($pattern, $check);
    }
}
