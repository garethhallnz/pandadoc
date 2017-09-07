<?php

namespace PandaDoc\Tests;

use PandaDoc\Templates;
use PHPUnit\Framework\TestCase;

/**
 * Class TemplatesTest
 *
 * @package PandaDoc\Tests
 */
class TemplatesTest extends TestCase
{

    /**
     * Test list function.
     */
    public function testList()
    {
        $dummy_response_text = 'dummy body';
        
        $templates = new Templates('access_token', new TestHttpClient($dummy_response_text));

        $response_body = $templates->list();
        
        $this->assertEquals($dummy_response_text, $response_body->value);
    }

    /**
     * Test details function.
     */
    public function testDetails()
    {
        $dummy_response_text = 'dummy body';

        $templates = new Templates('access_token', new TestHttpClient($dummy_response_text));

        $response_body = $templates->details(1);

        $this->assertEquals($dummy_response_text, $response_body->value);
    }
}
