<?php

namespace Nails\Currency\Driver\CurrencyLayer\Settings;

use Nails\Common\Helper\Form;
use Nails\Common\Interfaces;
use Nails\Common\Service\FormValidation;
use Nails\Components\Setting;
use Nails\Factory;

/**
 * Class CurrencyLayer
 *
 * @package Nails\Currency\Driver\CurrencyLayer\Settings
 */
class CurrencyLayer implements Interfaces\Component\Settings
{
    const KEY_ACCESS_KEY = 'sAccessKey';

    // --------------------------------------------------------------------------

    /**
     * @inheritDoc
     */
    public function getLabel(): string
    {
        return 'Open Exchange Rates';
    }

    // --------------------------------------------------------------------------

    /**
     * @inheritDoc
     */
    public function getPermissions(): array
    {
        return [];
    }

    // --------------------------------------------------------------------------

    /**
     * @inheritDoc
     */
    public function get(): array
    {
        /** @var Setting $oAccessKey */
        $oAccessKey = Factory::factory('ComponentSetting');
        $oAccessKey
            ->setKey(static::KEY_ACCESS_KEY)
            ->setLabel('Access Key')
            ->setInfo('A paid account is required for currency conversions to work correctly')
            ->setValidation([
                FormValidation::RULE_REQUIRED,
            ]);

        return [
            $oAccessKey,
        ];
    }
}
