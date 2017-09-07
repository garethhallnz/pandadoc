<?php

namespace PandaDoc\Tests;

use PandaDoc\Documents;
use PandaDoc\Entity\DocumentBuilder;
use PHPUnit\Framework\TestCase;

class DocumentsTest extends TestCase
{

    /**
     * Test list method.
     */
    public function testList()
    {
        $dummy_response_text = 'dummy body';

        $documents = new Documents('access_token', new TestHttpClient($dummy_response_text));

        $response_body = $documents->list();

        $this->assertEquals($dummy_response_text, $response_body->value);
    }

    /**
     * Test details method.
     */
    public function testDetails()
    {
        $dummy_response_text = 'dummy body';

        $client = new TestHttpClient($dummy_response_text);

        $documents = new Documents('access_token', $client);

        $document_id = 'my_id';

        $response_body = $documents->details($document_id);

        $this->assertEquals($dummy_response_text, $response_body->value);
        $this->assertTrue(strpos($client->uri, $document_id) !== false);
    }
    
    /**
     * Test status method.
     */
    public function testStatus()
    {
        $dummy_response_text = 'dummy body';

        $client = new TestHttpClient($dummy_response_text);
        
        $documents = new Documents('access_token', $client);
        
        $document_id = 'my_id';

        $response_body = $documents->status($document_id);

        $this->assertEquals($dummy_response_text, $response_body->value);
        $this->assertTrue(strpos($client->uri, $document_id) !== false);
    }

    /**
     * Test download method.
     */
    public function testDownload()
    {
        $dummy_response_text = 'dummy body';

        $client = new TestHttpClient($dummy_response_text);
        
        $documents = new TestDocuments('access_token', $client);
        
        $document_id = 'my_id';
        $destination = '/some/path';

        $documents->download($document_id, $destination);

        $this->assertTrue(strpos($client->uri, $document_id) !== false);
    }
    
    /**
     * Test createFromTemplate method.
     */
    public function testCreateFromTemplate()
    {
        $dummy_response_text = 'dummy body';
        
        $name = 'some document name';

        $client = new TestHttpClient($dummy_response_text);

        $documents = new Documents('access_token', $client);

        $document_builder = new DocumentBuilder($name);
        
        $fname = 'Jon';
        
        $lname = 'Dow';
        
        $email = 'test@me.com';
        
        $document_builder->addRecipient($fname, $lname, $email);
        
        $response_body = $documents->createFromTemplate($document_builder);

        $this->assertEquals($dummy_response_text, $response_body->value);
    }
}
