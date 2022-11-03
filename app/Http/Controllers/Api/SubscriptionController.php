<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SubscriptionCollection;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use App\Modules\Payment\Facades\Payment;
use App\Repositories\SubscriptionRepository;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * @var SubscriptionRepository
     */
    public SubscriptionRepository $subscription_repo;

    /**
     * @param SubscriptionRepository $subscription_repo
     */
    public function __construct(SubscriptionRepository $subscription_repo)
    {
        $this->subscription_repo = $subscription_repo;
    }

    /**
     * @return SubscriptionCollection
     */
    public function getUserSubscriptions():SubscriptionCollection
    {
        $subscription = $this->subscription_repo->getByAttribute([
            'user_id' => auth()->user()->id
        ]);
        return new SubscriptionCollection($subscription);
    }

    /**
     * @param Request $request
     * @return ErrorResource|SubscriptionResource
     */
    public function cancelSubscription(Request $request)
    {

        $result = Payment::cancelSubscription($request->subscription_id);

        if ($result->success) {
            $this->subscription_repo->updateStatus($request->subscription_id,Subscription::CANCELLED_SUBSCRIPTION);
            return new SubscriptionResource(Subscription::where('braintree_subscription_id', $request->subscription_id)->first());
        }else{
            return new ErrorResource($result->message);
        }

    }
}
