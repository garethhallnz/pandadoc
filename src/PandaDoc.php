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
    const ENDPOINT = 'https://api.pandadoc.com/public/';

    /**
     * API version.
     *
     * @var string
     */
    const API_VERSION = 'v1';

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

        return $this->handleRequest($method, $resource, $options);
    }

  /**
   * Makes a request for token update to the PandaDoc API.
   *
   * @param $method
   * @param $resource
   * @param array $options
   * @return mixed
   */
    public function requestToken(string $method, string $resource, array $options = []): \stdClass
    {
        $headers = [
        'headers' => [
            'Content-type' => 'application/x-www-form-urlencoded',
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
   * @param string $resource
   * @param array $options
   * @return mixed
   * @throws PandaDocAPIException
   *
   * @see PandaDoc::request()
   */
    public function handleRequest(string $method, string $resource, array $options = []): \stdClass
    {

        $uri = self::ENDPOINT . self::API_VERSION . $resource;

        try {
            $response = $this->client->request($method, $uri, $options);

            $headers = $response->getHeaders();

            if (!empty($headers['Content-Type']) && in_array('application/pdf', $headers['Content-Type'])) {
                $result = new \stdClass();
                $result->status = 200;
                return $result;
            }

            $data = $response->getBody();
            return json_decode($data->getContents());

        } catch (RequestException $e) {
            $response = $e->getResponse();

            throw new PandaDocAPIException($response, $e);
        }
    }
}
