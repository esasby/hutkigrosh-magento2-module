<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 25.05.2018
 * Time: 13:34
 */

namespace Esas\Hutkigrosh\Gateway\Command;

use esas\hutkigrosh\controllers\ControllerAddBill;
use Esas\Hutkigrosh\Helper\ConfigWrapper;
use Esas\Hutkigrosh\Helper\OrderWrapper;
use Magento\Framework\Phrase;
use Magento\Payment\Gateway\CommandInterface;
use Magento\Payment\Gateway\ConfigInterface;
use Magento\Payment\Model\Method\Logger;

class AddBillCommand implements CommandInterface
{
    /**
     * @var ConfigWrapper
     */
    private $configurationWrapper;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param ConfigInterface $config
     */
    public function __construct(
        ConfigWrapper $configurationWrapper,
        Logger $logger
    )
    {
        $this->configurationWrapper = $configurationWrapper;
        $this->logger = $logger;
    }

    /**
     * @param array $commandSubject
     * @return $this
     */
    public function execute(array $commandSubject)
    {
        $paymentDO = \Magento\Payment\Gateway\Helper\SubjectReader::readPayment($commandSubject);
        $orderWrapper = new OrderWrapper($paymentDO);
        $controller = new ControllerAddBill($this->configurationWrapper);
        $resp = $controller->process($orderWrapper);
        return $this;
    }

    /**
     * @param Phrase[] $fails
     * @return void
     */
    private function logExceptions(array $fails)
    {
        foreach ($fails as $failPhrase) {
            $this->logger->critical((string)$failPhrase);
        }
    }
}