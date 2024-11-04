<?php

namespace Hutchh\CurrencyConverter\Managers;
use Illuminate\Support\Manager;
use Hutchh\CurrencyConverter\Helper;
use Illuminate\Support\Facades\Log;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\HandlerStack;

class CurrencyConverterManager extends Manager
{
    public function getDefaultDriver(){
        return $this->config->get('currency.driver');
    }

    protected function createXeDriver(){
        $config = $this->config->get('currency.xe', []);
        $handler = HandlerStack::create();
        $handler->unshift(Helper\Xe\Middleware::mapRequest());
        $client = new Client([
            RequestOptions::TIMEOUT => 15,
            RequestOptions::CONNECT_TIMEOUT => 15,
            'base_uri'  => $config['base_url'],
            'handler'   => $handler,
            RequestOptions::AUTH => [
                $config['accountId'],
                $config['accountKey'],
            ],
        ]);
        return new Helper\Xe\XeClient($client, $config);
    }
}