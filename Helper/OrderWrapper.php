<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 28.05.2018
 * Time: 16:33
 */

namespace Esas\Hutkigrosh\Helper;

use esas\hutkigrosh\wrappers\OrderWrapper as ParentOrderWrapper;
use Magento\Framework\DataObject;
use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Sales\Api\Data\OrderPaymentInterface;
use Magento\Sales\Model\Order;

class OrderWrapper extends ParentOrderWrapper
{
    /** @var OrderPaymentInterface */
    private $payment;

    /** @var Order */
    private $order;

    /**
     * OrderWrapper constructor.
     * @param PaymentDataObjectInterface $payment
     */
    public function __construct(PaymentDataObjectInterface $paymentDataObject)
    {
        $this->payment = $paymentDataObject->getPayment();
        $this->order = $this->payment->getOrder();
    }


    /**
     * Уникальный номер заказ в рамках CMS
     * @return string
     */
    public function getOrderId()
    {
        return $this->order->getIncrementId();
    }

    /**
     * Полное имя покупателя
     * @return string
     */
    public function getFullName()
    {
//        return $this->order->getCustomerFirstname() . " " . $this->order->getCustomerLastname();
        return $this->order->getBillingAddress()->getFirstname() . " " . $this->order->getBillingAddress()->getLastname();
    }

    /**
     * Мобильный номер покупателя для sms-оповещения
     * (если включено администратором)
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->order->getBillingAddress()->getTelephone();
    }

    /**
     * Email покупателя для email-оповещения
     * (если включено администратором)
     * @return string
     */
    public function getEmail()
    {
        return $this->order->getBillingAddress()->getEmail();
    }

    /**
     * Физический адрес покупателя
     * @return string
     */
    public function getAddress()
    {
        return $this->order->getBillingAddress()->getCompany() . ", " .
            $this->order->getBillingAddress()->getCity() . ", " .
            $this->order->getBillingAddress()->getStreetLine1() . ", " .
            $this->order->getBillingAddress()->getStreetLine2();
    }

    /**
     * Общая сумма товаров в заказе
     * @return string
     */
    public function getAmount()
    {
        return $this->order->getGrandTotal();
    }

    /**
     * Валюта заказа (буквенный код)
     * @return string
     */
    public function getCurrency()
    {
        return $this->order->getCurrencyCode();
    }

    /**
     * Массив товаров в заказе
     * @return OrderProductWrapper[]
     */
    public function getProducts()
    {
        $products = $this->order->getItems();
        foreach ($products as $item) {
            $ret[] = new OrderProductWrapper($item);
        }
        return $ret;
    }

    /**
     * BillId (идентификатор хуткигрош) успешно выставленного счета
     * @return mixed
     */
    public function getBillId()
    {
        return $this->payment->getLastTransId();
    }

    /**
     * Текущий статус заказа в CMS
     * @return mixed
     */
    public function getStatus()
    {
        return $this->order->getStatus();
    }

    /**
     * Обновляет статус заказа в БД
     * @param $newStatus
     * @return mixed
     */
    public function updateStatus($newStatus)
    {
        $this->order->setStatus($newStatus);
        $this->order->save();
        $this->payment->getOrder()->setStatus($newStatus);

    }

    /**
     * Сохраняет привязку billid к заказу
     * @param $billId
     * @return mixed
     */
    public function saveBillId($billId)
    {
        $this->payment->setTransactionId($billId);
    }
}