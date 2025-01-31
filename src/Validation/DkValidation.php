<?php
declare(strict_types=1);

/**
 * Danish Localized Validation class. Handles localized validation for Denmark.
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
 * DkValidation
 */
class DkValidation extends LocalizedValidation
{
    /**
     * Define locale to be used by that localized
     * validation set
     *
     * @var string
     */
    protected static $validationLocale = 'da_DK';

    /**
     * Checks a social security number for Denmark.
     *
     * @param string $check The value to check.
     * @return bool Success
     */
    public static function personId(string $check): bool
    {
        $pattern = '/\A\b\d{6}-\d{4}\b\z/i';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks a postal code for Denmark.
     *
     * @param string $check The value to check.
     * @throws \Cake\Http\Exception\NotImplementedException Exception
     * @return bool Success
     */
    public static function postal(string $check): bool
    {
        $pattern = '/\A\b\d{4}\b\z/i';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks a phone number.
     *
     * @param string $check The value to check.
     * @throws \Cake\Http\Exception\NotImplementedException Exception
     * @return bool Success.
     */
    public static function phone(string $check): bool
    {
        $pattern = '/\A\b\d{8}\b\z/i';

        return (bool)preg_match($pattern, $check);
    }
}
