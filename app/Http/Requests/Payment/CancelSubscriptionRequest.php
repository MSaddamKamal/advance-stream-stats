<?php

namespace App\Http\Requests\Payment;

use App\Http\Requests\BaseFormRequest;
use App\Models\Subscription;
use Illuminate\Foundation\Http\FormRequest;


class CancelSubscriptionRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
         return !empty(Subscription::where([
            'braintree_subscription_id' => $this->subscription_id,
            'user_id' => auth()->user()->id,
            'status'=> Subscription::ACTIVE_SUBSCRIPTION
        ])->get()->toArray());


    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'subscription_id' => 'required|string',
        ];
    }
}
