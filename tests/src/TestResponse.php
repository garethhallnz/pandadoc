<?php

namespace PandaDoc\Tests;

use GuzzleHttp\Psr7\Response;

/**
 * Class TestResponse
 *
 * @package PandaDoc\Tests
 */
class TestResponse extends Response
{
    
    public $bodyValue;

    public function __construct($body_value = 'test body value')
    {
        
        $this->bodyValue = $body_value;
        
        parent::__construct();
    }

    public function getBody()
    {
        return new TestResponseBody($this->bodyValue);
    }
}
