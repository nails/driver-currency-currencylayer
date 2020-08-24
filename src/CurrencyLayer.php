<?php

namespace Nails\Currency\Driver;

use Nails\Common\Driver\Base;
use Nails\Common\Service\HttpCodes;
use Nails\Currency\Exception\ExchangeException\DriverApiException;
use Nails\Currency\Exception\ExchangeException\DriverNotConfiguredException;
use Nails\Currency\Interfaces\Driver;
use Nails\Currency\Resource\Currency;
use Nails\Factory;

class CurrencyLayer extends Base implements Driver
{
    /**
     * The base url of the Open Exchange Rates service
     *
     * @var string
     */
    const BASE_URL = 'http://api.currencylayer.com/api/live';

    // --------------------------------------------------------------------------

    /**
     * TheAccess Key to use.
     *
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
        if (empty($this->sAccessKey)) {
            throw new DriverNotConfiguredException(
                'The CurrencyLayer Access Key has not been configured'
            );
        }

        //  @todo (Pablo 24/08/2020) - Cache the request so subsequent queries for the spource are faster

        /** @var HttpRequest\Get $oGet */
        $oGet      = Factory::factory('HttpRequestGet');
        $oResponse = $oGet
            ->baseUri(static::BASE_URL)
            ->query([
                'access_key' => $this->sAccessKey,
                'source'     => $oFrom->code,
            ])
            ->execute();

        if ($oResponse->getStatusCode() !== HttpCodes::STATUS_OK) {
            throw new DriverApiException(
                sprintf(
                    'Received a non-200 response from CL API: %s %s',
                    $oResponse->getStatusCode(),
                    $oResponse->getReasonPhrase()
                )
            );
        }

        $oBody = $oResponse->getBody();

        if (!$oBody->success) {
            throw new DriverApiException(
                sprintf(
                    'Recieved an error from the CL API: %s %s',
                    $oBody->error->code,
                    $oBody->error->info
                )
            );
        } elseif (!property_exists($oBody->quotes, $oFrom->code . $oTo->code)) {
            throw new DriverApiException(
                sprintf(
                    'Currency "%s" was not found in returned exchange rates for currency %s',
                    $oTo->code,
                    $oFrom->code
                )
            );
        }

        return (float) $oBody->quotes->{$oFrom->code . $oTo->code};
    }
}
