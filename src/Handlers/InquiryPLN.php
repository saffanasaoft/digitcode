<?php

namespace Digitcode\Digitcodeflazz\Handlers;

use Digitcode\Digitcodeflazz\DigitcodeClient;

class InquiryPLN extends Base
{
    /**
     * CheckBalance constructor.
     * @param string $customerNo
     * @param DigitcodeClient $client
     */
    public function __construct(DigitcodeClient $client, string $customerNo)
    {
        parent::__construct($client);
        $this->client->setUrl('/transaction')
            ->setBody([
                'commands' => 'pln-subscribe',
                'customer_no' => $customerNo
            ]);
    }
}
