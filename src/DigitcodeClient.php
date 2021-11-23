<?php

namespace Digitcode\Digitcodeflazz;

use Digitcode\Digitcodeflazz\Exceptions\DigitcodeException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class DigitcodeClient {
    protected $client, $url, $body;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->body = [
            'username' => config('digitcode.username'),
        ];
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    public function setBody(array $body)
    {
        $this->body = array_merge($this->body, $body);
        return $this;
    }

    protected function url()
    {
        return config('digitcode.base_url') . $this->url;
    }

    protected function options()
    {
        return ['json' => $this->body];
    }

    public function run()
    {
        try {
            $response = $this->client->post($this->url(), $this->options());
        } catch (RequestException $ex) {
            $response = $ex->getResponse();
            $body = json_decode($response->getBody());
            if (isset($body->data)) {
                throw DigitcodeException::requestFailed($body->data->rc, $body->data->message, $ex->getCode());
            } else {
                throw DigitcodeException::requestFailed('-', $ex->getMessage(), $ex->getCode());
            }
        }

        return json_decode($response->getBody());
    }
}