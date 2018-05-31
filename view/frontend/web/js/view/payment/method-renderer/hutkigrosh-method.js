/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*browser:true*/
/*global define*/
define(
    [
        'Magento_Checkout/js/view/payment/default'
    ],
    function (Component) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Esas_Hutkigrosh/payment/hutkigrosh-form',
                transactionResult: ''
            },

            getCode: function () {
                return 'esas_hutkigrosh';
            },

            isActive: function () {
                return true;
            },

            getMethodDescription: function () {
                return window.checkoutConfig.payment.esas_hutkigrosh.hutkigrosh_payment_method_description;
            }
        });
    }
);