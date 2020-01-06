<?php
/**
 * Created by PhpStorm.
 * User: andydang
 * Date: 11/1/19
 * Time: 10:01 AM
 */

namespace Omnipay\Coinbase;


use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{

    public function getName()
    {
        return 'Coinbase';
    }

    public function getDefaultParameters()
    {
        return [
            'apiUsername' => '',
            'secretKey' => '',
            'shopId' => '',
            'shopTitle' => '',
            'shopDomain' => '',
        ];
    }

    public function getShopDomain()
    {
        return $this->getParameter('shopDomain');
    }

    public function setShopDomain($shopDomain)
    {
        return $this->setParameter('shopDomain', $shopDomain);
    }

    public function getShopTitle()
    {
        return $this->getParameter('shopTitle');
    }

    public function setShopTitle($shopTitle)
    {
        return $this->setParameter('shopTitle', $shopTitle);
    }

    public function getShopId()
    {
        return $this->getParameter('shopId');
    }

    public function setShopId($shopId)
    {
        return $this->setParameter('shopId', $shopId);
    }

    public function getApiUsername()
    {
        return $this->getParameter('apiUsername');
    }

    public function setApiUsername($apiUsername)
    {
        return $this->setParameter('apiUsername', $apiUsername);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($secretKey)
    {
        return $this->setParameter('secretKey', $secretKey);
    }

    public function purchase(array $parameters = array())
    {
        if (empty($parameters['hosted_url'])) {
            $res = $this->prePurchase($parameters)->send();
            if (empty($res)) {
                throw new \RuntimeException('this payment gateway is not available right now.');
            }
        }
        return $this->createRequest('\Omnipay\Coinbase\Message\PurchaseRequest', $res);
    }
    public function prePurchase($parameters = array())
    {
        return $this->createRequest('\Omnipay\Coinbase\Message\PrePurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Coinbase\Message\CompletePurchaseRequest', $parameters);
    }

}