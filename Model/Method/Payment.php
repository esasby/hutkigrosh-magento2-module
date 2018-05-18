<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 16.05.2018
 * Time: 13:42
 */

namespace Esas\Hutkigrosh\Model\Method;


class Payment extends \Magento\Payment\Model\Method\AbstractMethod
{
    const CODE = 'esas_hutkigrosh';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::CODE;

    /**
     * Cash On Delivery payment block paths
     *
     * @var string
     */
    protected $_formBlockType = \Magento\OfflinePayments\Block\Form\Cashondelivery::class;

    /**
     * Info instructions block path
     *
     * @var string
     */
    protected $_infoBlockType = \Magento\Payment\Block\Info\Instructions::class;

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;

    /**
     * Get instructions text from config
     *
     * @return string
     */
    public function getInstructions()
    {
        return trim($this->getConfigData('instructions'));
    }
}