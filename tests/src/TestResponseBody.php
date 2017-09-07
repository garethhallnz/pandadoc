<?php

namespace PandaDoc\Tests;

/**
 * Class TestResponseBody
 *
 * @package PandaDoc\Tests
 */
class TestResponseBody
{
    
    public $value;
    
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getContents()
    {
        $body = new \stdClass();
        
        $body->value = $this->value;

        return json_encode($body);
    }
}
