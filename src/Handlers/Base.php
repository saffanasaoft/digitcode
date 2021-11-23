<?php

namespace Digitcode\Digitcodeflazz\Handlers;

use Digitcode\Digitcodeflazz\DigitcodeClient;

class Base
{
    protected $client;

    /**
     * Base constructor.
     * @param DigitcodeClient $client
     */
    protected function __construct(DigitcodeClient $client)
    {
        $this->client = $client;
    }

    public function sign(string $keyword)
    {
        return md5(config('digitcode.username') . config('digitcode.key') . $keyword);
    }

    public function perform()
    {
        return $this->client->run();
    }
}
