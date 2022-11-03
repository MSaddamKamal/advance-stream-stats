<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use App\Modules\Payment\Facades\Payment;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = Payment::getPlans();

        foreach ($plans as $key => $val) {
            Plan::create([
            'name' => $val->name,
            'braintree_plan_id' => $val->id,
            'currency' => $val->currencyIsoCode,
            'price' => $val->price,
            'monthly_billing_frequency' => $val->billingFrequency,
            'description' => $val->description,
            ]);
        }


    }
}
