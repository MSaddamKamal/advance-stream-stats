<?php

namespace App\Modules\Payment\Providers;

use App\Modules\Payment\Managers\PaymentManager;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('payment', function ($app) {
            return new PaymentManager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides():array
    {
        return ['payment'];
    }
}