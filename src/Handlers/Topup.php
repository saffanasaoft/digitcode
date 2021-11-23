<?php

namespace Digitcode\Digitcodeflazz\Handlers;

use Digitcode\Digitcodeflazz\DigitcodeClient;

class Topup extends Base
{
    /**
     * CheckBalance constructor.
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @param string $msg
     * @param DigitcodeClient $client
     */
    public function __construct(DigitcodeClient $client, string $buyerSkuCode, string $customerNo, string $refId, string $msg)
    {
        parent::__construct($client);

        $body = [
            'buyer_sku_code' => $buyerSkuCode,
            'customer_no' => $customerNo,
            'ref_id' => $refId,
            'sign' => $this->sign($refId)
        ];

        if ($msg) {
            $body['msg'] = $msg;
        }

        $this->client->setUrl('/transaction')
            ->setBody($body);
    }
}
