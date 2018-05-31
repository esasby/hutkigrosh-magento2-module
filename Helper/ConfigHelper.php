<?php

namespace Esas\Hutkigrosh\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Encryption\EncryptorInterface;
use esas\hutkigrosh\wrappers\ConfigurationWrapper;

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
    public function isEnabled()
    {
        return $this->getConfigData('active', true);
    }

    /*
     * @return string
     */
    public function getTitle()
    {
        return $this->getConfigData('title');
    }

    public function getConfigData($field, $flag = false)
    {
        $path = 'payment/' . \Esas\Hutkigrosh\Model\Config\ConfigProvider::CODE . '/' . $field;
        if (!$flag) {
            return $this->scopeConfig->getValue($path, ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
        } else {
            return $this->scopeConfig->isSetFlag($path, ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
        }
    }

    public function getSecretConfigData($field)
    {
        $path = 'payment/' . \Esas\Hutkigrosh\Model\Config\ConfigProvider::CODE . '/' . $field;
        $secret = $this->scopeConfig->getValue($path, ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
        return $this->encryptor->decrypt($secret);
    }
}