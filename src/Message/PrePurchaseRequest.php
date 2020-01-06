<?php
/**
 * Created by PhpStorm.
 * User: andydang
 * Date: 11/1/19
 * Time: 10:02 AM
 */

namespace Omnipay\Coinbase\Message;


use Cake\Chronos\Chronos;
use Omnipay\Common\Exception\InvalidRequestException;
use Symfony\Component\HttpFoundation\ParameterBag;

class PrePurchaseRequest extends AbstractRequest
{

    private $endPointProduction = 'https://api.commerce.coinbase.com/charges';
    private $endPointSandbox = 'https://newsandbox.payoo.com.vn/v2/paynow/order/create';
    const RULE_DES_MIN_LENGTH = 50;

    const TIME_ZONE = 'Asia/Ho_Chi_Minh';

    public function getData()
    {
        $this->validate(

        );

        return [
            "name" => "Tuong ddmdd",
            "description" => "mua hàng tại Glink",
            "local_price" => [
                "amount" => 1,//$this->getAmountInteger(),
                "currency" => $this->getCurrency()
            ],
            "pricing_type" => "fixed_price",
            "metadata" => [
                "customer_id" => (string)$this->getTransactionId(),
                "customer_name" => $this->getCard()->getName()
            ],
            'cancel_url' => $this->getCancelUrl(),
            'redirect_url' => $this->getReturnUrl(),
        ];
    }

    public function sendData($data)
    {
        return $this->jsonToArray($this->postStr($this->getRedirectUrl(), $data));
    }

    public function getRedirectUrl()
    {
        if ($this->getTestMode()) {
            return $this->endPointSandbox;
        }

        return $this->endPointProduction;
    }
}