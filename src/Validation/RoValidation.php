<?php
declare(strict_types=1);

/**
 * RO Localized Validation class. Handles localized validation for Romania
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
 * RoValidation
 */
class RoValidation
{
    /**
     * Define locale to be used by that localized
     * validation set
     *
     * @var string
     */
    protected static $validationLocale = 'ro_RO';

    /**
     * Checks postal codes for Romania
     *
     * @param string $check The value to check.
     * @return bool
     */
    public static function postal(string $check): bool
    {
        $pattern = '/^\d{6}$/';

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Checks a phone number.
     *
     * @param string $check The value to check.
     * @throws \Cake\Http\Exception\NotImplementedException Exception
     * @return bool Success.
     */
    public static function phone(string $check)
    {
        throw new NotImplementedException(__d('localized', '%s Not implemented yet.'));
    }

    /**
     * Checks a country specific identification number.
     *
     * @param string $check The value to check.
     * @throws \Cake\Http\Exception\NotImplementedException Exception
     * @return bool Success.
     */
    public static function personId(string $check)
    {
        throw new NotImplementedException(__d('localized', '%s Not implemented yet.'));
    }
}
