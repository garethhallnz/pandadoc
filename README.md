# PHP library for PandaDoc's API

[![Build Status](https://travis-ci.org/garethhallnz/pandadoc.svg?branch=master)](https://travis-ci.org/garethhallnz)
[![License](https://poser.pugx.org/garethhallnz/pandadoc/license)](https://packagist.org/packages/garethhallnz/pandadoc)

This library provides convenient wrapper functions for PandaDoc's REST API.
The API is [documented here](https://developers.pandadoc.com/).

## Requirements

- PHP 7.0 or greater
- [Composer](https://getcomposer.org/)
- [Guzzle](https://github.com/guzzle/guzzle)

## Installation

Dependencies are managed by [Composer](https://getcomposer.org/). After
installing Composer, run the following command from the library root:

`composer install --no-dev --ignore-platform-reqs`

Or to install with phpunit:

`composer install`


## Usage Documents
```php
<?php
    require 'vendor/autoload.php';
    
    $token = 'my-token';
    
    $documents = new Documents($token);
    
    // List all the documents.
    $data = $documents->list();
    
    // Search for a document.
    $filter = [
        'q' => 'Search string here'
    ];
    
    $data = $documents->list($filter);
    
    // Show document details.
    $data = $documents->details('documentID');
    
    // Show document state.
    $data = $documents->status('documentID');
    
    // Download a document
    $data = $documents->download('documentID', "destination-path");
```

## Usage Templates
```php
<?php
    require 'vendor/autoload.php';
    
    $token = 'my-token';
    
    $templates = new Templates($token);
    
    // List all the templates.
    $data = $templates->list();
    
    // Show template details.
    $data =$templates->details('templateID');
```