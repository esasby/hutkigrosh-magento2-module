<?php

namespace Esas\Hutkigrosh\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Encryption\EncryptorInterface;

class ConfigHelper extends AbstractHelper
{
    /**
     * @var EncryptorInterface
     */
    protected $encryptor;

    /**
     * @param Context $context
     * @param EncryptorInterface $encryptor
     */
    public function __construct(
        Context $context,
        EncryptorInterface $encryptor
    )
    {
        parent::__construct($context);
        $this->encryptor = $encryptor;
    }

    /*
     * @return bool
     */
    public function isEnabled($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'payment/esas_hutkigrosh/active',
            $scope
        );
    }

    /*
     * @return string
     */
    public function getTitle($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->getValue(
            'payment/esas_hutkigrosh/title',
            $scope
        );
    }

    /*
     * @return string
     */
    public function getPaymentMethodDescription($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->getValue(
            'payment/esas_hutkigrosh/hutkigrosh_payment_method_description',
            $scope
        );
    }


    /*
     * @return string
     */
    public function getHGPassword($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $secret = $this->scopeConfig->getValue(
            '\'payment/esas_hutkigrosh/hutkigrosh_hg_password',
            $scope
        );
        $secret = $this->encryptor->decrypt($secret);

        return $secret;
    }


}