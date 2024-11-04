<?php
namespace App\Helpers\CurrencyConvertor\Helper;
use App\Helpers\CurrencyConvertor\Payload;
interface ClientInterface{
    function convertFromIntent(Payload\ConvertFromPayloadBuilder $convertFromPayload);
}