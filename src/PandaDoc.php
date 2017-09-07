<?php
declare(strict_types=1);

namespace PandaDoc;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class PandaDoc.
 *
 * @package PandaDoc
 */
abstract class PandaDoc
{
    /**
     * API url.
     *
     * @var string
     */
    protected $endpoint = 'https://api.pandadoc.com/public/v1';

    /**
     * API access token.
     *
     * @var string
     */
    protected $token;

    /**
     * Guzzle client.
     *
     * @var Client
     */
    protected $client;

    /**
     * PandaDoc constructor.
     *
     * @param string $token
     * @param Client $client
     */
    public function __construct($token = '', Client $client = null)
    {
        $this->token = $token;

        if (empty($client)) {
            $this->client = new Client();
        } else {
            $this->client = $client;
        }
    }

    /**
     * Makes a request to the PandaDoc API.
     *
     * @param $method
     * @param $resource
     * @param array $options
     * @return mixed
     */
    public function request(string $method, string $resource, array $options = []): \stdClass
    {
        $headers = [
          'headers' => [
            'Authorization' => 'Bearer ' . $this->token,
          ],
        ];

        $options = array_merge_recursive($headers, $options);

        if (!empty($options['query'])) {
            $options['query'] = http_build_query(['query']);
        }

        return $this->handleRequest($method, $this->endpoint . $resource, $options);
    }

    /**
     * Makes a request to the PandaDoc API using the Guzzle HTTP client.
     *
     * @param $method
     * @param string $uri
     * @param array $options
     * @return mixed
     * @throws PandaDocAPIException
     *
     * @see PandaDoc::request()
     */
    public function handleRequest(string $method, string $uri, array $options = []): \stdClass
    {
        try {
            $response = $this->client->request($method, $uri, $options);
            $data = $response->getBody();
            return json_decode($data->getContents());
        } catch (RequestException $e) {
            $response = $e->getResponse();

            throw new PandaDocAPIException($response, $e);
        }
    }
}
