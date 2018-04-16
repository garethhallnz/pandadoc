<?php

use PandaDoc\Documents;
use PandaDoc\Templates;

require 'vendor/autoload.php';

$token = '79db8145307f250566e31b1b5950a4259017f56c';

### Documents ###
$documents = new Documents($token);

// List all the documents.
//$data = $documents->list();

// Search for a document.
//$filter = [
//    'q' => 'C32825'
//];

// $data = $documents->list($filter);

// Show document details.
// $data = $documents->details('5dJjUW7AbEErPQEULVWr3h');

// Show document state.
 $data = $documents->status('5dJjUW7AbEErPQEULVWr3h');

// Download a document
// $data = $documents->download('5dJjUW7AbEErPQEULVWr3h', "tmp/foo.pdf");

### Templates ###
//$templates = new Templates($token);

// List all the templates.
// $data = $templates->list();


// Show template details.
//$data =$templates->details('uxhndjbKMaxnXabXmprepB');

print '<pre>';

print_r($data);
