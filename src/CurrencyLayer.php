<?php

namespace Nails\Currency\Driver;

use Nails\Common\Driver\Base;
use Nails\Factory;

class CurrencyLayer extends Base
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
}
