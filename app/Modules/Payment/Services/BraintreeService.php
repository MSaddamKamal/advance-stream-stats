<?php

namespace App\Modules\Payment\Services;

use App\Modules\Payment\Contracts\PaymentInterface;
use Braintree\Gateway;

class BraintreeService implements PaymentInterface
{

    /**
     * @var Gateway
     */
    public Gateway $gateway;

    /**
     * Create an instance of BraintreeService
     *
     */
    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    }


    /**
     * @return string
     */
    public function getClientToken(): string
    {
        return $this->gateway->clientToken()->generate();
    }

    /**
     * @param $subscription_id
     * @return object
     */
    public function cancelSubscription($subscription_id): object
    {
        return $this->gateway->subscription()->cancel($subscription_id);
    }

    /**
     * @param array $customer_data
     * @return object
     */
    public function createCustomer(array $customer_data): object
    {
        return $this->gateway->customer()->create($customer_data);
    }

    /**
     * @param array $payment_method_data
     * @return object
     */
    public function createPaymentMethod(array $payment_method_data): object
    {
        return $this->gateway->paymentMethod()->create($payment_method_data);
    }

    /**
     * @param array $subscription_data
     * @return object
     */
    public function createSubscription(array $subscription_data): object
    {
        return $this->gateway->subscription()->create($subscription_data);
    }

    /**
     * @return array
     */
    public function getPlans(): array
    {
        return $this->gateway->plan()->all();
    }
}