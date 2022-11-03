<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success' =>true,
            'data' =>[
                'payment_method' => $this->payment_method,
                'cost' => $this->cost,
                'status' => $this->status,
                'ends_at' => $this->ends_at,
                'braintree_plan_id' => $this->braintree_plan_id,
                'braintree_subscription_id' => $this->braintree_subscription_id
            ],
            'message' => 'Success'


        ];
    }
}
