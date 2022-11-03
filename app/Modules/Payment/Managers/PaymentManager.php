<?php

namespace App\Modules\Payment\Managers;


use App\Modules\Payment\Contracts\PaymentInterface;
use App\Modules\Payment\Services\BraintreeService;
use Illuminate\Support\Manager;

class PaymentManager extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver():string
    {
        return config('payment.default') ?? 'braintree';
    }


    /**
     * @return PaymentInterface
     */
    public function createBraintreeDriver(): PaymentInterface
    {
        return new BraintreeService();
    }
}