<?php

namespace Digitcode\Digitcodeflazz\Handlers;

use Digitcode\Digitcodeflazz\DigitcodeClient;

class PayBill extends Base
{
    /**
     * CheckBalance constructor.
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @param DigitcodeClient $client
     */
    public function __construct(DigitcodeClient $client, string $buyerSkuCode, string $customerNo, string $refId)
    {
        parent::__construct($client);

        $body = [
            'commands' => 'pay-pasca',
            'buyer_sku_code' => $buyerSkuCode,
            'customer_no' => $customerNo,
            'ref_id' => $refId,
            'sign' => $this->sign($refId)
        ];

        $this->client->setUrl('/transaction')
            ->setBody($body);
    }
}
