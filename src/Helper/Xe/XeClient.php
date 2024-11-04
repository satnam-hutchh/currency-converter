<?php
namespace App\Helpers\CurrencyConvertor\Helper\Xe;
use App\Helpers\CurrencyConvertor\Helper;
use App\Helpers\CurrencyConvertor\Payload;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
/**
 * Class BaseSender.
 */

class XeClient extends Helper\HTTPClient implements Helper\ClientInterface {

    public function convertFromIntent(Payload\ConvertFromPayloadBuilder $convertFromPayload){
        $response = null;
        try {            
            $getRequestBody     = $convertFromPayload->toArray();
            $responseData       = $this->client->send(new Request('GET', 'convert_from'), [
                RequestOptions::QUERY => $getRequestBody,
            ]);
            $response    = json_decode($responseData->getBody()->getContents(), true); 
            Log::info($response);
            $responseHeader     = $responseData->getHeaders(); 
            Log::info($responseHeader);
            
        } catch (ClientException $e) {
            Log::info($e->getResponse());
            throw $e;
        }

        return $response;
    }
}