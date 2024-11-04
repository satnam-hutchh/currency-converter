<?php

namespace App\Helpers\CurrencyConvertor\Helper;

use GuzzleHttp\ClientInterface;

/**
 * Class BaseSender.
 */
abstract class HTTPClient
{
    /**
     * The client used to send messages.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * The URL entry point.
     *
     * @var string
     */
    protected $config;

    /**
     * Initializes a new sender object.
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @param string                     $url
     */
    public function __construct(ClientInterface $client, $config)
    {
        $this->client = $client;
        $this->config = $config;
    }
}