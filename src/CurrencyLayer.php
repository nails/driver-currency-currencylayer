<?php

namespace Nails\Currency\Driver;

use Nails\Common\Driver\Base;
use Nails\Currency\Interfaces\Driver;
use Nails\Currency\Resource\Currency;
use Nails\Factory;

class CurrencyLayer extends Base implements Driver
{
    /**
     * The base url of the Open Exchange Rates service
     * @var string
     */
    const BASE_URL = 'http://api.currencylayer.com/api/live';

    // --------------------------------------------------------------------------

    /**
     * TheAccess Key to use.
     * @var string
     */
    protected $sAccessKey;

    // --------------------------------------------------------------------------

    /**
     * Returns the rate between two given currencies
     *
     * @param Currency $oFrom The from currency
     * @param Currency $oTo   The to currency
     *
     * @return float
     */
    public function getRate(Currency $oFrom, Currency $oTo): float
    {
        return 0.11;
    }
}
