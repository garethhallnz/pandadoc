<?php

namespace PandaDoc\Tests;

use PandaDoc\Documents;
use PHPUnit\Framework\TestCase;

/**
 * Class PandaDocTest
 *
 * @package PandaDoc\Tests
 */
class PandaDocTest extends TestCase
{

    /**
     * Test handleRequest method.
     *
     * @throws \PandaDoc\PandaDocAPIException
     */
    public function testHandleRequest()
    {

        $dummy_response_text = 'dummy body';
        
        $panda_doc = new Documents('access_token', new TestHttpClient($dummy_response_text));

        $response_body = $panda_doc->handleRequest('get', 'test.uri');
        
        $this->assertEquals($dummy_response_text, $response_body->value);
    }

    /**
     * Test request method.
     *
     * @throws \PandaDoc\PandaDocAPIException
     */
    public function testRequest()
    {
        $dummy_response_text = 'dummy body';

        $client = new TestHttpClient($dummy_response_text);

        $panda_doc = new Documents('access_token', $client);

        $response_body = $panda_doc->request('GET', 'some.endpoint');

        $this->assertEquals($dummy_response_text, $response_body->value);
        $this->assertTrue(!empty($client->options['headers']['Authorization']));
    }
}
