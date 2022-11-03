<?php

namespace App\Modules\Payment\Contracts;

interface PaymentInterface
{
    /**
     * @return string
     */
    public function getClientToken():string;

    /**
     * @param $subscription_id
     * @return object
     */
    public function cancelSubscription($subscription_id):object;

    /**
     * @param array $customer_data
     * @return object
     */
    public function createCustomer(array $customer_data):object;

    /**
     * @param array $payment_method_data
     * @return object
     */
    public function createPaymentMethod(array $payment_method_data):object;

    /**
     * @param array $subscription_data
     * @return object
     */
    public function createSubscription(array $subscription_data):object;

    /**
     * @return array
     */
    public function getPlans():array;
}