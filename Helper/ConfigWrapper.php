<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 28.05.2018
 * Time: 13:58
 */

namespace Esas\Hutkigrosh\Helper;

use esas\hutkigrosh\wrappers\ConfigurationWrapper;


class ConfigWrapper extends ConfigurationWrapper
{
    /**
     * @var ConfigHelper
     */
    private $config;


    public function __construct(
        ConfigHelper $config
    )
    {
        $this->config = $config;
    }

    /**
     * Произольно название интернет-мазагина
     * @return string
     */
    public function getShopName()
    {
        return $this->config->getConfigData(self::CONFIG_HG_SHOP_NAME);
    }

    /**
     * Описание системы ХуткиГрош, отображаемое клиенту на этапе оформления заказа
     * @return string
     */
    public function getPaymentMethodDescription()
    {
        return $this->config->getConfigData(self::CONFIG_HG_PAYMENT_METHOD_DESCRIPTION);
    }

    /**
     * Имя пользователя для доступа к системе ХуткиГрош
     * @return string
     */
    public function getHutkigroshLogin()
    {
        return $this->config->getConfigData(self::CONFIG_HG_LOGIN);
    }

    /**
     * Пароль для доступа к системе ХуткиГрош
     * @return string
     */
    public function getHutkigroshPassword()
    {
        return $this->config->getSecretConfigData(self::CONFIG_HG_PASSWORD);
    }

    /**
     * Включен ли режим песчоницы
     * @return boolean
     */
    public function isSandbox()
    {
        return $this->config->getConfigData(self::CONFIG_HG_SANDBOX, true);
    }

    /**
     * Уникальный идентификатор услуги в ЕРИП
     * @return string
     */
    public function getEripId()
    {
        return $this->config->getConfigData(self::CONFIG_HG_ERIP_ID);
    }

    /**
     * Включена ля оповещение клиента по Email
     * @return boolean
     */
    public function isEmailNotification()
    {
        return $this->config->getConfigData(self::CONFIG_HG_EMAIL_NOTIFICATION, true);
    }

    /**
     * Включена ля оповещение клиента по Sms
     * @return boolean
     */
    public function isSmsNotification()
    {
        return $this->config->getConfigData(self::CONFIG_HG_SMS_NOTIFICATION, true);
    }

    /**
     * Итоговый текст, отображаемый клменту после успешного выставления счета
     * Чаще всего содержит подробную инструкцию по оплате счета в ЕРИП
     * @return string
     */
    public function getCompletionText()
    {
        return $this->config->getConfigData(self::CONFIG_HG_COMPLETION_TEXT);
    }

    /**
     * Какой статус присвоить заказу после успешно выставления счета в ЕРИП (на шлюз Хуткигрош_
     * @return string
     */
    public function getBillStatusPending()
    {
        return $this->config->getConfigData(self::CONFIG_HG_BILL_STATUS_PENDING);
    }

    /**
     * Какой статус присвоить заказу после успешно оплаты счета в ЕРИП (после вызова callback-а шлюзом ХуткиГрош)
     * @return string
     */
    public function getBillStatusPayed()
    {
        return $this->config->getConfigData(self::CONFIG_HG_BILL_STATUS_PAYED);
    }

    /**
     * Какой статус присвоить заказу в случаче ошибки выставления счета в ЕРИП
     * @return string
     */
    public function getBillStatusFailed()
    {
        return $this->config->getConfigData(self::CONFIG_HG_BILL_STATUS_FAILED);
    }

    /**
     * Какой статус присвоить заказу после успешно оплаты счета в ЕРИП (после вызова callback-а шлюзом ХуткиГрош)
     * @return string
     */
    public function getBillStatusCanceled()
    {
        return $this->config->getConfigData(self::CONFIG_HG_BILL_STATUS_CANCELED);
    }
}