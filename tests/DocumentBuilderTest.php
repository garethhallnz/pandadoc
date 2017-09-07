<?php

namespace PandaDoc\Tests;

use PandaDoc\Entity\DocumentBuilder;
use PHPUnit\Framework\TestCase;

class DocumentBuilderTest extends TestCase
{

    /**
     * Test addField method.
     */
    public function testAddField()
    {
        $name = 'test doc';

        $document_builder = new DocumentBuilder($name);

        $field_name = 'some field';

        $field_value = 'field value';

        $document_builder->addField($field_name, $field_value);

        $document_data = $document_builder->getData();

        $data_fields = $document_data['fields'];

        $this->assertTrue(!empty($data_fields));
        $this->assertTrue(in_array($field_name, array_keys($data_fields)));
        $this->assertEquals($field_value, $data_fields[$field_name]['value']);
    }
    
    /**
     * Test addRecipient method.
     */
    public function testAddRecipient()
    {
        $name = 'test doc';

        $document_builder = new DocumentBuilder($name);
        
        $fname = 'Jon';
        
        $lname = 'Dow';
        
        $email = 'test@me.com';
        
        $document_builder->addRecipient($fname, $lname, $email);
        
        $document_data = $document_builder->getData();
        
        $recipients = $document_data['recipients'];
        
        $this->assertTrue(!empty($recipients));
        $this->assertEquals($fname, $recipients[0]['first_name']);
        $this->assertEquals($lname, $recipients[0]['last_name']);
        $this->assertEquals($email, $recipients[0]['email']);
    }
}
