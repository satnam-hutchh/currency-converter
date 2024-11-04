<?php

namespace App\Helpers\CurrencyConvertor\Handler;
use Illuminate\Support\Facades\Log;
use App\Helpers\CurrencyConvertor\Payload;
/**
 * Class BaseHandler.
 */
class CurrencyHandler extends AbstractHandler
{
    
    public function convertFromIntent($convertPayload){
        Log::info('Handler');
        try{
            return $this->client->convertFromIntent($convertPayload);
        }catch(\Throwable $e){
            throw $e;
        }
    }

}