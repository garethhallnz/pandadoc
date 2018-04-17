<?php

namespace PandaDoc;

use GuzzleHttp\Client;

/**
 * Class Documents.
 *
 * @package PandaDoc
 */
class Auth
{
    /**
     * API url.
     *
     * @var string
     */
    const ENDPOINT = 'https://api.pandadoc.com/oauth2/access_token/';

    /**
     * Guzzle client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Auth constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Add data for refresh token
     */
    public function refreshAccessToken($client_id, $client_secret, $refresh_token)
    {

        $options = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'grant_type'=> "refresh_token",
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'refresh_token' => $refresh_token,
                'scope'=>'read+write',
            ]
        ];

        try {
            $response = $this->client->request('POST', self::ENDPOINT, $options);
            $data = $response->getBody();
            return json_decode($data->getContents());
        } catch (RequestException $e) {
            $response = $e->getResponse();

            throw new PandaDocAPIException($response, $e);
        }
    }
}
