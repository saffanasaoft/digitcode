<?php

namespace Digitcode\Digitcodeflazz\Handlers;

use Digitcode\Digitcodeflazz\DigitcodeClient;

class CheckBalance extends Base
{
    private $keyword = 'depo';

    /**
     * CheckBalance constructor.
     * @param DigitcodeClient $client
     */
    public function __construct(DigitcodeClient $client)
    {
        parent::__construct($client);
        $this->client->setUrl('/cek-saldo')
            ->setBody([
                'cmd' => 'deposit',
                'sign' => $this->sign($this->keyword)
            ]);
    }
}
