<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 29.05.2018
 * Time: 13:28
 */

namespace Esas\Hutkigrosh\Helper;

use esas\hutkigrosh\wrappers\OrderProductWrapper as ParentOrderProductWrapperr;
use Magento\Sales\Api\Data\OrderItemInterface;


class OrderProductWrapper extends ParentOrderProductWrapperr
{

    /**
     * @var OrderItemInterface
     */
    private $orderItem;

    /**
     * OrderProductWrapper constructor.
     * @param OrderItemInterface $orderItem
     */
    public function __construct(OrderItemInterface $orderItem)
    {
        $this->orderItem = $orderItem;
    }


    /**
     * Артикул товара
     * @return string
     */
    public function getInvId()
    {
        return $this->orderItem->getProductId();
    }

    /**
     * Название или краткое описание товара
     * @return string
     */
    public function getName()
    {
        return $this->orderItem->getName();
    }

    /**
     * Количество товароа в корзине
     * @return mixed
     */
    public function getCount()
    {
        return $this->orderItem->getQtyOrdered();
    }

    /**
     * Цена за единицу товара
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->orderItem->getRowTotalInclTax();
    }
}