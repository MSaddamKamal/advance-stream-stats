<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\ProcessPaymentRequest;
use App\Http\Resources\ClientTokenResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use App\Models\User;
use App\Modules\Payment\Facades\Payment;
use App\Repositories\SubscriptionRepository;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
     * @return ClientTokenResource
     */
    public function getClientSdkToken(): ClientTokenResource
    {
        $clientToken = Payment::getClientToken();
        return new ClientTokenResource($clientToken);

    }

    /**
     * @param ProcessPaymentRequest $request
     * @return ErrorResource|SubscriptionResource|void
     */
    public function processPayment(ProcessPaymentRequest $request)
    {
        if ($request->payment_method_nonce) {
            $payment_method_data = $request->payment_method_nonce;
            $nonce = $payment_method_data["nonce"];
            $method_type = $payment_method_data["type"];
            $user = auth()->user();
            if (!$user->braintree_id) {
                // create user

                $result = Payment::createCustomer([
                    'firstName' => $user->name,
                    'paymentMethodNonce' => $nonce
                ]);

                if ($result->success) {

                    $updatingUser = User::find($user->id);
                    $updatingUser->braintree_id = $result->customer->id;
                    $updatingUser->save();
                    $token = $result->customer->paymentMethods[0]->token;


                } else {
                    return new ErrorResource($result->message);
                }


            } else {
                $last_user_subscription = $this->subscription_repo->getLatestRecord([
                    'user_id' => $user->id,
                    'status' => Subscription::ACTIVE_SUBSCRIPTION,
                ]);
                if ($last_user_subscription) {
                    // already subscribed unsubscribe first
                    return new ErrorResource('Already Subscribed to a package, unsubscribe it first');
                }

                $result = Payment::createPaymentMethod([
                    'customerId' => $user->braintree_id,
                    'paymentMethodNonce' => $nonce
                ]);

                if ($result->success) {
                    $token = $result->paymentMethod->token;
                } else {
                    return new ErrorResource($result->message);
                }
            }

            if ($result->success) {
                $subscription = Payment::createSubscription([
                    'paymentMethodToken' => $token,
                    'planId' => $request->plan_id
                ]);
                if ($subscription->success) {

                    $subscription_details = $subscription->subscription;
                    $subscribedDb = $this->subscription_repo->create([
                        'user_id' => $user->id,
                        'payment_method' => $method_type,
                        'braintree_subscription_id' => $subscription_details->id,
                        'braintree_plan_id' => $subscription_details->planId,
                        'cost' => $subscription_details->price,
                        'ends_at' => $subscription_details->billingPeriodEndDate,
                    ]);

                    return new SubscriptionResource(Subscription::find($subscribedDb->id));


                } else {
                    return new ErrorResource($subscription->message);
                }
            } else {
                return new ErrorResource($result->message);
            }

        }


    }
}
