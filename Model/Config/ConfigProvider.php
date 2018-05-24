<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 18.05.2018
 * Time: 15:03
 */

namespace Esas\Hutkigrosh\Model\Config;

use \Esas\Hutkigrosh\Helper\ConfigHelper;

/**
 * Class ConfigProvider передается через DI в
 * @package Esas\Hutkigrosh\Model\Config
 */
class ConfigProvider implements \Magento\Checkout\Model\ConfigProviderInterface
{
    /**
     * ConfigProvider constructor.
     */
    public function __construct(ConfigHelper $configHelper)
    {
        $this->configHelper = $configHelper;
    }


    /**
     * Retrieve assoc array of checkout configuration
     *
     * @return array
     */
    public function getConfig()
    {
        $config['payment']['esas_hutkigrosh']['hutkigrosh_payment_method_description'] = $this->configHelper->getPaymentMethodDescription();
        return $config;
    }
}