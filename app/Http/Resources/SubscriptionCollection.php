<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SubscriptionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'data' => $this->collection->map(function ($item) {
                return [
                    'payment_method' => $item->payment_method,
                    'cost' => $item->cost,
                    'braintree_plan_id' => $item->braintree_plan_id,
                    'status' => $item->status,
                    'ends_at' => $item->ends_at,
                    'braintree_subscription_id' => $item->braintree_subscription_id,
                    'plan' => $item->plan

                ];
            }),

            'message' => 'Success'


        ];
    }
}
