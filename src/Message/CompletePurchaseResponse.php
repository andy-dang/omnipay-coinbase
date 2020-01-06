<?php
/**
 * Created by PhpStorm.
 * User: andydang
 * Date: 11/1/19
 * Time: 10:03 AM
 */

namespace Omnipay\Coinbase\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompletePurchaseResponse extends AbstractResponse
{
    const STATE_PAYMENT_RECEIVED = 'PAYMENT_RECEIVED';
    const STATE_PAYMENT_PROCESSING = 'PAYMENT_PROCESSING';

    const RESPONSE_STATUS_SUCCESS = 1;
    const RESPONSE_STATUS_FAIL = 2;
    const RESPONSE_STATUS_CANCEL = 3;
    const RESPONSE_STATUS_PENDING = 4;

    private $responseStatus;
    private $message;

    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        $this->responseStatus = self::RESPONSE_STATUS_PENDING;
        $this->message = 'The payment is still in process and it doesn\'t have the final result';
    }

    public function isPending()
    {
        return $this->responseStatus == self::RESPONSE_STATUS_PENDING;
    }

    public function isSuccessful()
    {
        return $this->responseStatus == self::RESPONSE_STATUS_SUCCESS;
    }

    public function isCancelled()
    {
        return $this->responseStatus == self::RESPONSE_STATUS_CANCEL;
    }

    public function getTransactionId()
    {
        if (!$this->isSuccessful()) {
            return null;
        }

        return isset($this->data['order_no']) ? $this->data['order_no'] : null;
    }

    public function getTransactionReference()
    {
        return null;
    }

    public function getMessage()
    {
        return $this->message;
    }
}