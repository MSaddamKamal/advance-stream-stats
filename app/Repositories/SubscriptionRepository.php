<?php

namespace App\Repositories;

use App\Models\Subscription;


class SubscriptionRepository extends AbstractRepository
{
    protected $model;

    public function __construct(Subscription $model)
    {
        $this->model = $model;
    }

    public function updateStatus($subscription_id,$status)
    {
        return $this->model->where('braintree_subscription_id', $subscription_id)->update([
            'status' => $status
        ]);
    }

    public function getLatestRecord(array $filter){
        $queryBuilder = $this->model;

        foreach ($filter as $column => $value) {

            $queryBuilder = $queryBuilder->where($column, $value);
        }
        return $queryBuilder->latest('id')->first();
    }

}