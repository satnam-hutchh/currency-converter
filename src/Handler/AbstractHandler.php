<?php

namespace App\Helpers\CurrencyConvertor\Handler;
use Illuminate\Support\Str;
use App\Exceptions\InvalidAttributeException;
use App\Helpers\CurrencyConvertor\Helper\ClientInterface;

/**
 * Class BaseHandler.
 */
abstract class AbstractHandler
{
    /**
     * The client used to send messages.
     *
     * @var \Helper\ClientInterface
     */
    protected $client;

    /**
     * The URL entry point.
     *
     * @var string
     */
    protected $url;

    /**
     * Initializes a new sender object.
     *
     * @param \Helper\ClientInterface $client
     * @param string                     $url
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function get($key){
        return $this->{$key};
    }

    public function __get($key){
        return $this->getAttribute($key);
    }

    public function getAttribute($key){
        if($this->hasGetMutator($key)){
            $method = 'get' . $this->getStudlyCase($key) . 'Attribute';
            return $this->{$method}();
        }
        throw new InvalidAttributeException(sprintf("Undefined property '%s' in class '%s'", $key, get_called_class()));

        return NULL;
    }

    public function hasGetMutator($key){
        return method_exists($this, 'get' . $this->getStudlyCase($key) . 'Attribute');
    }

    protected function getStudlyCase($str){
        return ucfirst(Str::studly($str));
    }
}