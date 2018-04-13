<?php

namespace PandaDoc;

use \Exception;
use \GuzzleHttp\Psr7\Response;

/**
 * Custom PandaDoc API exception.
 *
 * @package PandaDoc
 */
class PandaDocAPIException extends Exception
{

    /**
     * @inheritdoc
     */
    public function __construct(Response $response, Exception $previous = null)
    {
        $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();

        parent::__construct($message, $response->getStatusCode(), $previous);
    }
}
