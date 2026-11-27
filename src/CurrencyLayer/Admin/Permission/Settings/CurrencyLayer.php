<?php

namespace Nails\Currency\Driver\CurrencyLayer\Admin\Permission\Settings;

use Nails\Admin\Interfaces\Permission;

class CurrencyLayer implements Permission
{
    public function label(): string
    {
        return 'Can manage Open Exchange Rates settings';
    }

    public function group(): string
    {
        return 'Settings';
    }
}
