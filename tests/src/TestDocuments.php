<?php

namespace PandaDoc\Tests;

use PandaDoc\Documents;

class TestDocuments extends Documents
{

    /**
     * Mock details method to test download.
     */
    public function details(string $id) :\stdClass
    {
        $document = new \stdClass();
        
        $document->name = $id;
        
        return $document;
    }
}
