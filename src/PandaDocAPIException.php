<?php

namespace PandaDoc;

use \Exception;
use Psr\Http\Message\ResponseInterface;

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
    public function __construct(ResponseInterface $response, Exception $previous = null)
    {
        $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();

        parent::__construct($message, $response->getStatusCode(), $previous);
    }
}
