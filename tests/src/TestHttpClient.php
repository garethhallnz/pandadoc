<?php

namespace PandaDoc\Tests;

use GuzzleHttp\Client;

/**
 * Class TestHttpClient
 *
 * @package PandaDoc\Tests
 */
class TestHttpClient extends Client
{

    public $method;

    public $uri;

    public $options;

    public $testResponse;

    public function __construct($test_response = 'test response')
    {
        $this->testResponse = $test_response;

        parent::__construct([]);
    }

    /**
     * @inheritdoc
     */
    public function request($method, $uri = null, array $options = [])
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->options = $options;

        return new TestResponse($this->testResponse);
    }
}
