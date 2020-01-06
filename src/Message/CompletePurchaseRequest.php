<?php
/**
 * Created by PhpStorm.
 * User: andydang
 * Date: 11/1/19
 * Time: 10:03 AM
 */

namespace Omnipay\Coinbase\Message;


class CompletePurchaseRequest extends AbstractRequest
{

    public function getData()
    {

        return [];
    }

    public function sendData($data)
    {
        return new CompletePurchaseResponse($this, $data);
    }
}