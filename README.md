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
    
    $accessToken = 'your-access-token';
    
    $documents = new Documents($accessToken);
    
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
    
    $accessToken = 'your-access-token';
    
    $templates = new Templates($accessToken);
    
    // List all the templates.
    $data = $templates->list();
    
    // Show template details.
    $data =$templates->details('templateID');
```

## Refresh Access Token
```php
<?php
    require 'vendor/autoload.php';
    
    $accessToken = 'your-access-token';
    
    // Refresh access token
    $auth = new Auth();
    $client_id = 'your-client-id';
    $client_secret = 'your-secret';
    $refresh_token = 'your-refresh-token';

    // Show new tokens.
    $data = $auth->refreshAccessToken($client_id, $client_secret, $refresh_token);
```