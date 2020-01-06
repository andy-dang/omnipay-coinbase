<?php
/**
 * Created by PhpStorm.
 * User: andydang
 * Date: 11/1/19
 * Time: 10:01 AM
 */

namespace Omnipay\Coinbase\Message;

use Omnipay\Common\Message\ResponseInterface;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /*
     * {
	"name": "Tuong ddmdd",
       "description": "mua hang dai cap",
       "local_price": {
         "amount": "1880.00",
         "currency": "USD"
       },
       "pricing_type": "fixed_price",
       "metadata": {
         "customer_id": "id_1005",
         "customer_name": "Satoshi Nakamoto"
       },
       "redirect_url": "https://charge/completed/page",
       "cancel_url": "https://charge/canceled/page"
         }

     */

    public function getChargeDescription()
    {
        return $this->getParameter('charge_description');
    }

    public function setChargeDescription($chargeDescription)
    {
        return $this->setParameter('charge_description', $chargeDescription);
    }

    public function getChargeName()
    {
        return $this->getParameter('charge_name');
    }

    public function setChargeName($chargeName)
    {
        return $this->setParameter('charge_name', $chargeName);
    }


    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($secretKey)
    {
        return $this->setParameter('secretKey', $secretKey);
    }

    protected function postStr($url, $data)
    {
        $ch = curl_init();
        $options = array(
            CURLOPT_HEADER => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_URL => $url,
        );

        $request_headers = array(
            'X-CC-Api-Key: ' . $this->getSecretKey(), //613f9ad2-6e13-452d-a397-481c5bb0c767', // a91d3247-2f54-4434-9ebe-69bc3ad9c49b
            'X-CC-Version:2018-03-22',
            'Content-Type:application/json'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    protected function jsonToArray($json)
    {
        return json_decode($json, true);
    }

}