<?php

namespace App\Http\Resources;

use App\Models\Subscription;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PlanCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'data' => $this->collection->map(function ($item) {
                return [
                    'name' => $item->name,
                    'price' => $item->price,
                    'monthly_billing_frequency' => $item->monthly_billing_frequency,
                    'braintree_plan_id' => $item->braintree_plan_id,
                    'subscribed' => $this->checkSubscriptionStatus($item->braintree_plan_id),

                ];
            }),

            'message' => 'Success'


        ];
    }

    public function checkSubscriptionStatus($braintree_plan_id){
        $record = Subscription::where([
            'braintree_plan_id'=>$braintree_plan_id,
            'user_id'=>auth()->user()->id,
            'status'=>Subscription::ACTIVE_SUBSCRIPTION,
        ])->first();

        return !is_null($record);
    }
}
