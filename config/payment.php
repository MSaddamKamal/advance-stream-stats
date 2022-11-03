<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Default Payment Driver
    |--------------------------------------------------------------------------
    |
    | This option defines the default payment driver that gets used when try to
    | pay  subscriptions. The name specified in this option should match
    | one of the driver defined in the "drivers" configuration array.
    |
    */

    'default' => env('PAYMENT_DRIVER', 'braintree'),

    /*
    |--------------------------------------------------------------------------
    | Configuration options for each driver
    |--------------------------------------------------------------------------
    |
    | Here you may configure the firewall drivers for Inspector. Out of
    | the box, Inspector is able to allow and deny traffic using the
    | firewalls below.
    |
    */

    'drivers' => [
        'braintree' => [

        ]
    ]
];