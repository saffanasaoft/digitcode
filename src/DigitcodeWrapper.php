<?php

namespace Digitcode\Digitcodeflazz;

use Digitcode\Digitcodeflazz\Handlers\CheckBalance;
use Digitcode\Digitcodeflazz\Handlers\CheckBill;
use Digitcode\Digitcodeflazz\Handlers\CheckStatusBill;
use Digitcode\Digitcodeflazz\Handlers\Deposit;
use Digitcode\Digitcodeflazz\Handlers\InquiryPLN;
use Digitcode\Digitcodeflazz\Handlers\PayBill;
use Digitcode\Digitcodeflazz\Handlers\PriceList;
use Digitcode\Digitcodeflazz\Handlers\Topup;

class DigitcodeWrapper {

    private $client;

    /**
     * Svaflazz constructor.
     * @param DigitcodeClient $client
     */
    public function __construct(DigitcodeClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function checkBalance()
    {
        return (new CheckBalance($this->client))->perform();
    }

    /**
     * @param string|null $buyerSkuCode
     * @return mixed
     */
    public function priceList(string $buyerSkuCode = '')
    {
        return (new PriceList($this->client, $buyerSkuCode))->perform();
    }

    /**
     * @param int $amount
     * @param string $bank
     * @param string $ownerName
     * @return mixed
     */
    public function deposit(int $amount, string $bank, string $ownerName)
    {
        return (new Deposit($this->client, $amount, $bank, $ownerName))->perform();
    }

    /**
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @param string|null $msg
     * @return mixed
     */
    public function topup(string $buyerSkuCode, string $customerNo, string $refId, string $msg = '')
    {
        return (new Topup($this->client, $buyerSkuCode, $customerNo, $refId, $msg))->perform();
    }

    /**
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @return mixed
     */
    public function checkBill(string $buyerSkuCode, string $customerNo, string $refId)
    {
        return (new CheckBill($this->client, $buyerSkuCode, $customerNo, $refId))->perform();
    }

    /**
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @return mixed
     */
    public function payBill(string $buyerSkuCode, string $customerNo, string $refId)
    {
        return (new PayBill($this->client, $buyerSkuCode, $customerNo, $refId))->perform();
    }

    /**
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @return mixed
     */
    public function checkStatusBill(string $buyerSkuCode, string $customerNo, string $refId)
    {
        return (new CheckStatusBill($this->client, $buyerSkuCode, $customerNo, $refId))->perform();
    }

    /**
     * @param string $customerNo
     * @return mixed
     */
    public function inquiryPLN(string $customerNo)
    {
        return (new InquiryPLN($this->client, $customerNo))->perform();
    }

}